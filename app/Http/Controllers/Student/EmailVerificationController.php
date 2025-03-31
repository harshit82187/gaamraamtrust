<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Mail\OtpMail;

class EmailVerificationController extends Controller
{
    // Send OTP
    public function sendOtp(Request $request)
    {
        $request->validate(['email' => 'required|email']);
        $studentExist = Student::where('email', $request->email)->first();
        if($studentExist){
            return response()->json(['success' => false, 'message' => 'Email already exists']);
        }

        $otp = rand(100000, 999999);
        Session::put('email_otp', $otp); 
        Session::put('email_to_verify', $request->email); 
        Mail::to($request->email)->queue(new OtpMail($otp, $request->email));
        Log::channel('email-verify')->info('Email sent successfully to ' . $request);
        return response()->json(['success' => true, 'message' => 'OTP Sent Successfully']);
    }

    public function verifyOtp(Request $request)
    {
        $request->validate(['otp' => 'required|digits:6']);

        $email = Session::get('email_to_verify');
        $otp = Session::get('email_otp');

        if ($request->otp == $otp) {
            
            Log::channel('email-verify')->info("OTP verified successfully for email: $email");
            Session::forget('email_otp');
            Session::forget('email_to_verify');
            return response()->json(['success' => true, 'message' => 'Email verified successfully']);
        }
        Log::channel('email-verify')->warning("Failed OTP verification attempt for email: $email with OTP: {$request->otp}");
        return response()->json(['success' => false, 'message' => 'Invalid OTP']);
    }
}
