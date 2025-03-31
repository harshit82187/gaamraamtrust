<?php

namespace App\Http\Controllers\Member\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Payment;

use App\Mail\MemberVerification;
use App\Mail\SendDonationInvoiceMail;


use Hash;
use Str;
use Mail;
use DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Support\Facades\File;
use Barryvdh\DomPDF\Facade\Pdf;

class AuthController extends Controller
{
    public function memberRegister(Request $req){
        try{
            if($req->isMethod('get')){
                // dd(121);
                // dd(session()->all());
                if ($req->has('showLogin')) {
                    return redirect()->route('member-register')->with('showLogin', true);
                }
                return view('member.auth.register');
    
            }else{
                // dd($req->all());
                $validator = Validator::make($req->all(), [
                   'email' => [
                        'required',
                        'email',
                        'unique:users,email',
                        'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/'
                    ],
                    'password' => 'required',
                    'mobile' => 'required|digits:10',
                    'password' => 'required',
                ]);

                if($req->member_type == 2){
                    $validator = Validator::make($req->all(), [
                        'passport' => 'required',
                     ]);
                }

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput();
                }                

                $member = new User();
                $member->name = $req->name;
                $member->email = $req->email;
                $member->mobile = $req->mobile;
                $member->password = Hash::make($req->password);
                $member->status = '1';
                $member->member_type = $req->member_type;
                $member->email_verified_at = null;
                $member->passport = $req->passport ?? null;
                $member->save();
                if (!$req->razorpay_payment_id || !$req->transaction_via || !$req->merchant_order_id) {
                    return response()->json(['error' => 'Missing payment details'], 400);
                }
                $invoiceData = [
                    'razorpay_payment_id' => $req->razorpay_payment_id,
                    'transaction_via'     => $req->transaction_via,
                    'merchant_order_id'   => $req->merchant_order_id,
                    'currency'            => $req->currency,
                    'amount'              => $req->amount,
                    'member_id'           => $member->id,
                    'member_name'           => $member->name,
                    'member_email'           => $member->email,
                    'member_mobile'           => $member->mobile,
                ];
                $this->sendInvoice($invoiceData);

                $data = [
                    'name' => $req->name,
                    'email' => $req->email,
                ];
                $email = $req->email;
                try {
                    Mail::to($email)->queue(new MemberVerification($data));
                    Log::channel('member')->info('Success to send email to ' . $email);
                } catch (\Exception $mailException) {
                    Log::channel('member')->error('Failed to send email to ' . $email . '. Error: ' . $mailException->getMessage());
                }
                return redirect()->route('member-register')->with('success','Registration Successfully! Please check your email for verification.'); 
            }
        }catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }catch(\Exception $e){
            return back()->with('error', 'Warning : ' .$e->getMessage());
        }        
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
                $currencyCode = $request['currency'];
                $amount = $request['amount'];
                $success = false;
                $error = '';

                Log::info('Starting payment process', [
                    'razorpay_payment_id' => $razorpayPaymentId,
                    'merchant_order_id' => $merchant_order_id,
                    'amount' => $amount,
                    'currency' => $currencyCode
                ]);
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
                                $payment = DB::table('payments')->insert([
                                    'mode' => '1',
                                    'r_payment_id' => $response_array['id'],
                                    'merchant_order_id' => $merchant_order_id,
                                    'method' => $response_array['method'],
                                    'currency' => $response_array['currency'],
                                    'user_id'   => $request['member_id'],
                                    'user_email' =>$request['member_email'],
                                    'user_name' =>$request['member_name'],
                                    'user_mobile' => $request['member_mobile'],
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

    public function sendInvoice($InvoiceData){
        // dd($InvoiceData);
        DB::beginTransaction();
        try{
          
            Log::channel('razorpay')->info('InvoiceData : ' . json_encode($InvoiceData));
            $paymentData = [
                'razorpay_payment_id' => $InvoiceData['razorpay_payment_id'],
                'transaction_via'     => $InvoiceData['transaction_via'],
                'merchant_order_id'   => $InvoiceData['merchant_order_id'],
                'currency'            => $InvoiceData['currency'],
                'amount'              => $InvoiceData['amount'],
                'member_id'              => $InvoiceData['member_id'],
                'member_name'              => $InvoiceData['member_name'],
                'member_email'              => $InvoiceData['member_email'],
                'member_mobile'              => $InvoiceData['member_mobile'],
            ];
          
            $email = $InvoiceData['member_email'];
            if (!$email) {
                Log::channel('razorpay')->error('Email key is missing in InvoiceData.');
                return back()->with('error', 'Invalid Invoice Data: Email missing.');
            }
            Log::channel('razorpay')->info('Email is :' .$email);
            $payment = $this->proceedPayment($paymentData);
            if ($payment === 'captured') {
                $r_payment_id =  $InvoiceData['razorpay_payment_id'];                
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
                $this->sendEmail($email, $r_payment_id,'member');
                $this->sendEmail($adminEmail, $r_payment_id,'admin');
                DB::commit();
                Log::channel('razorpay')->info('Donation Payment Successfully Complete!');
            }


        }catch (\Exception $e){
            DB::rollBack();
            Log::channel('razorpay')->error('Warning In sendInvoice Function : ' . $e->getMessage());
        }
    }

    private function sendEmail($email, $r_payment_id, $role)
    {
        try{
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


    public function memberVerify($email)
    {
        $user = User::where('email', $email)->first();    
        if (!$user) {
            return back()->with('error', 'Record Not Found!');
        }    
        $mobileNo = str_starts_with($user->mobile, '+91') ? $user->mobile : '+91' . $user->mobile;    
        $user->update(['email_verified_at' => now()]);
        Auth::login($user);    

        $apiKey = 'eGyZ9B45gSXn';
        $whatsappApiUrl = 'http://api.textmebot.com/send.php';
        
        $websiteName = "Gaam Raam Test";
        $websiteUrl = "https://server1.pearl-developer.com/gaamraam/public";
        $message = "Hello {$user->name}, your email has been successfully verified. 🎉 
        Welcome to {$websiteName}! You can now access your account here: {$websiteUrl}";
    

        $response = Http::get($whatsappApiUrl, [
            'recipient' => $mobileNo,
            'apikey' => $apiKey,
            'text' => $message
        ]);    
        if ($response->failed()) {
            return response()->json([
                'errors' => ['message' => 'Failed to send WhatsApp message.']
            ], 500);
        }
        return redirect()->route('member.dashboard')->with('success', 'Your account has been verified successfully!');
    }

    public function validateEmail(Request $request)
    {
        // dd($request->all());
        $validator = Validator::make($request->all(), [
            'email' => [
                'required',
                'email',
                'unique:users,email',
                'regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z.-]+\.[a-zA-Z]{2,}$/'
            ]
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first('email')]);
        }
        return response()->json(['status' => 'success']);
    }

    public function validateMobile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile' => ['required', 'unique:users,mobile', 'regex:/^[0-9]{10,15}$/']
        ]);
        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first('mobile')]);
        }
        return response()->json(['status' => 'success']);
    }
    

    public function memberLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'errors' => $validator->errors()
            ], 422);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            $member = Auth::user();
            
            if (is_null($member->email_verified_at)) {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account is not verified! Please check your email for verification.'
                ]);
            }

            if ($member->status == '0') {
                Auth::logout();
                return response()->json([
                    'status' => 'error',
                    'message' => 'Your account is not active! Please contact admin.'
                ]);
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Login Successfully!',
                'redirect_url' => route('member.dashboard')
            ]);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'Wrong Credentials!'
        ]);
    }


    public function dashboard(){
        // dd(Auth::user());    
        return view('member.dashboard');
    }

    public function profile(Request $request){
        if($request->isMethod('get')){
            $member = Auth::user();
            return view('member.profile',compact('member'));
        }else{
            // dd($request->all());
            
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'dob' => 'required',
                'gender' => 'required',
                'address' => 'required',

            ]);

            $member = User::find(Auth::user()->id);
            if($member->email != $request->email){
                $validator = Validator::make($request->all(),[
                    'email' => 'required|email|unique:users,email',
                ]);
                $member->email = $request->email;
            }
    
            if($member->mobile != $request->mobile){
                $validator = Validator::make($request->all(),[
                    'mobile' => 'required|numeric|unique:users,mobile',
                ]);
                $member->mobile = $request->mobile;
            }

            if($request->has('password') && $request->password != null){
                $member->password = Hash::make($request->password);
            }

            if($request->profile_image != null){
                $file = $request->profile_image;
                $filename = time(). '.' . $file->getClientOriginalExtension();
                $year = now()->year;
                $month = now()->format('M');
                $folderPath = public_path("app/member-profile/{$year}/{$month}");
                if (!file_exists($folderPath)) {
                    mkdir($folderPath, 0777, true);  
                }
                $file->move($folderPath, $filename);
                $member->profile_image = "app/member-profile/{$year}/{$month}/" . $filename;
            }

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }

            $member->name = $request->name;
            $member->mobile = $request->mobile;
            $member->dob = $request->dob;
            $member->gender = $request->gender;
            $member->address = $request->address;
            $member->save();        
            return redirect()->route('member.profile')->with('success','Profile Updated Successfully!');

        }
        
        
    }

    public function logout(){
        Auth::logout();
        session()->flush();
        // dd('Logged out');
        return redirect()->route('member-register')->with('error','Logout Successfully!');
    }

    public function memberDetail($id){
        return view('member.auth.detail');
    }

   

}