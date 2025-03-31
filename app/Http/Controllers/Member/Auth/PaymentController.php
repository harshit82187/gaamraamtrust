<?php

namespace App\Http\Controllers\Member\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Payment;

use App\Mail\SendDonationInvoiceMail;

use Hash;
use Str;
use Mail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class PaymentController extends Controller
{
   public function payment(Request $req){
        $id = Auth::user()->id;
        $donations = Payment::with('member')->where('user_id',$id)->paginate(10);
        // dd($donations, Auth::User()->mobile);
        return view('member.auth.payment.index', compact('donations'));    
    }

    public function get_curl_handle_razorpay($razorpayPaymentId, $amount, $currencyCode)
    {
        $url = 'https://api.razorpay.com/v1/payments/' . $razorpayPaymentId . '/capture';
        $key_id = env('RAZORPAY_KEY');
        $key_secret = env('RAZORPAY_SECRET');
        // $arr = ['amount' => $amount, 'currency' => $currencyCode];
        $arr = ['amount' => $amount * 100, 'currency' => $currencyCode];
        Log::channel('razorpay')->info('Razorpay Key ' . $key_id. 'And Secret Key ' . $key_secret);

        $arr1 = json_encode($arr);
        $fields_string = $arr1;
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERPWD, $key_id . ':' . $key_secret);
        curl_setopt($ch, CURLOPT_TIMEOUT, 60);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        return $ch;
    }

    public function proceedPayment($request)
    {
        try {
            if (!empty($request['razorpay_payment_id']) || !empty($request['merchant_order_id'])) {
                $razorpayPaymentId = $request['razorpay_payment_id'];
                $merchant_order_id = $request['merchant_order_id'];
                $currencyCode = "INR";
                $amount = $request['amount'];
                $success = false;
                $error = '';

                Log::info('Starting payment process', [
                    'razorpay_payment_id' => $razorpayPaymentId,
                    'merchant_order_id' => $merchant_order_id,
                    'amount' => $amount,
                    'currency' => $currencyCode
                ]);
                $user = Auth::User();
                try {
                    $ch = $this->get_curl_handle_razorpay($razorpayPaymentId, $amount, $currencyCode);
                    $result = curl_exec($ch);
                    // dd($result);
                    $http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);
                    Log::channel('razorpay')->info('Razorpay cURL Result', ['result' => $result, 'http_status' => $http_status]);
                    if ($result === false) {
                        $success = false;
                        $error = 'Curl error: ' . curl_error($ch);
                        Log::channel('razorpay')->error('Curl execution failed: ' . curl_error($ch));
                    } else {
                        $response_array = json_decode($result, true);
                        Log::channel('razorpay')->info('Razorpay Response', $response_array);
                        if ($http_status === 200 && isset($response_array['status'])) {
                            if ($response_array['status'] == 'captured') {
                                DB::enableQueryLog();
                                $email = Auth::user()->email;
                                $user_id = Auth::user()->id;
                                $payment = DB::table('payments')->insert([
                                    'mode' => '1',
                                    'r_payment_id' => $response_array['id'],
                                    'merchant_order_id' => $merchant_order_id,
                                    'method' => $response_array['method'],
                                    'currency' => $response_array['currency'],
                                    'user_id'   => $user_id,
                                    'user_email' => $email ?? '',
                                    'user_name' => Auth::user()->name ?? '',
                                    'user_mobile' => Auth::user()->mobile  ?? '',
                                    'amount' => $response_array['amount'] / 100,
                                    'json_response' => $result,
                                ]);
                                // Log::channel('razorpay')->info(DB::getQueryLog());
                                if (!$payment) {
                                    Log::channel('razorpay')->error('Payment creation failed in database', ['response' => $response_array]);
                                    throw new Exception('Payment not saved in database');
                                }
                                Log::channel('razorpay')->info('Payment successfully captured', ['status' => $response_array['status']]);
                                return 'captured';
                            } else {
                                $error = 'Payment capture failed: ' . $response_array['status'];
                                Log::channel('razorpay')->error('Payment capture failed', ['status' => $response_array['status']]);
                                return 'failed';
                            }
                        } else {
                            $success = false;
                            if (!empty($response_array['error']['code'])) {
                                $error = $response_array['error']['code'] . ': ' . $response_array['error']['description'];
                            } else {
                                $error = 'RAZORPAY_ERROR: Invalid Response';
                            }
                            Log::channel('razorpay')->error('Razorpay API error', ['error' => $error]);
                        }
                    }
                    curl_close($ch);
                } catch (Exception $e) {
                    $success = false;
                    $error = 'OPENCART_ERROR: Request to Razorpay Failed - ' . $e->getMessage();
                    Log::channel('razorpay')->error('Error processing payment: ' . $e->getMessage());
                }
            } else {
                $error = 'Missing required payment data';
                Log::channel('razorpay')->error('Error processing payment: ' . $error);
            }
        } catch (Exception $e) {
            $error = 'An error occurred: ' . $e->getMessage();
            Log::channel('razorpay')->error('Error processing payment: ' . $error);
        }
        if ($error) {
            Log::channel('razorpay')->error('Final error during payment: ' . $error);
            return 'An error occurred. Contact site administrator, please!';
        }
        return $success;
    }


    public function donate(Request $request){
        // dd($request->all());
        DB::beginTransaction();
        try{
            $request->validate([
                'razorpay_payment_id' => 'required|string',
                'transaction_via' => 'required|string',
                'amount' => 'required|numeric',
                'merchant_order_id' => 'required|string',
            ]);

            $paymentData = [
                'razorpay_payment_id' => $request->razorpay_payment_id,
                'merchant_order_id' => $request->merchant_order_id,
                'amount' => $request->amount,
            ];
            $payment = $this->proceedPayment($paymentData);
            if ($payment === 'captured') {
                $member = Auth::user();
                $r_payment_id = $request->razorpay_payment_id;                
                $payment_table = Payment::where('r_payment_id',$r_payment_id)->first();
                if(!$payment_table){
                    Log::channel('razorpay')->error("Payment record not found for r_payment_id: " . $r_payment_id);
                    return back()->with('error','Record Not Found!');
                }
                $invoiceNumber = now()->format('Ym') . rand(100000, 999999);
                // Generate invoice and save PDF
                $year = now()->year;
                $month = now()->format('M');
                $today = Carbon::now()->format('d-M-Y');
                $fileName = "invoice_{$invoiceNumber}.pdf";
                $directoryPath = public_path("app/member-donation/{$year}/{$month}");
                $adminEmail = "atul@pearlorganisation.com";

                if (!File::exists($directoryPath)) {
                    File::makeDirectory($directoryPath, 0777, true);
                }

                // Generate the QR code with the route
                $qrCode = new QrCode(route('member-invoice', ['invoiceNumber' => $invoiceNumber]));
                $writer = new PngWriter();
                $qrCodeContent = $writer->write($qrCode)->getString();

                // Save QR code to the local path
                $qrCodeDirectory = public_path("app/member-donation/qr-codes/{$year}/{$month}");
                if (!File::exists($qrCodeDirectory)) {
                    File::makeDirectory($qrCodeDirectory, 0777, true);
                }

                // Define the file path for the QR code
                $qrCodeFilePath = "{$qrCodeDirectory}/{$invoiceNumber}-qr.jpg"; 
                file_put_contents($qrCodeFilePath, $qrCodeContent);

                $payment_table->update([
                    'qr_image' => "app/member-donation/qr-codes/{$year}/{$month}/{$invoiceNumber}-qr.jpg",
                    'invoice_no' => $invoiceNumber,
                ]);

                 // Generate the PDF
                 $count = 0;
                 $filePath = "{$directoryPath}/{$fileName}";
                 $pdf = Pdf::loadView('pdf.member.donation-invoice', compact('payment_table','adminEmail', 'today', 'qrCodeFilePath','count'));
                 $pdf->save($filePath);

                // Update booking with generated PDF file path
                $payment_table->update([
                    'donation_pdf' => "app/member-donation/{$year}/{$month}/{$fileName}",
                ]);
                    
                // Send emails
                $this->sendEmail($member->email, $r_payment_id,'member');
                $this->sendEmail($adminEmail, $r_payment_id,'admin');
                DB::commit();
                return back()->with('success', 'Donation Payment Successfully Complete!');
            }


        }catch (\Exception $e){
            DB::rollBack();
            return back()->with('error', 'Warning : ' .$e->getMessage());
        }
    }

    private function sendEmail($email, $r_payment_id, $role)
    {
        try{
            $member = Auth::user();
            $payment_table = Payment::where('r_payment_id',$r_payment_id)->first();
            $invoice_no = $payment_table->invoice_no;
            $subject = 'Gaam Raam Trust Donation Invoice #'.$invoice_no.' | '.\Carbon\Carbon::today()->format('d-M-Y').' | '.\Carbon\Carbon::now()->format('h:i A');
            $isAdmin = ($role === 'admin');
            if (!$payment_table) {
                Log::channel('razorpay')->error('Payment record not found for R-Payment ID: ' . $r_payment_id);
                return;
            }
            $count = 0;
            $pdfPath = public_path($payment_table->donation_pdf); 
            Log::channel('razorpay')->info('Invoice PDF Path: ' . $pdfPath);
            Mail::to($email)->queue(
                (new SendDonationInvoiceMail($payment_table,$isAdmin,$count,$subject))
                    ->attach($pdfPath)
            );     
            Log::channel('razorpay')->info('Email Sent With PDF To ' . $email);

        }catch (\Exception $mailException) {
            Log::channel('razorpay')->error('Failed to send email to ' . $email . '. Error: ' . $mailException->getMessage());
        }
        
    }

    

    public function qrInvoice($invoiceNumber)
    {
        // dd($invoiceNumber);
        $payment_table = Payment::where('invoice_no',$invoiceNumber)->first();
        if (!$payment_table) {
            return abort(404, 'Invoice not found');
        }
        return view('member.auth.payment.qr-invoice-detail', compact('payment_table'));
    }
   

}