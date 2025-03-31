<?php

namespace App\Http\Controllers\Member\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


use App\Models\User;
use App\Models\ForgetPassword;
use Mail; 
use Hash;
use Auth;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;


class ForgetPasswordController extends Controller
{
    public function forgetPassword(Request $req)
    {     
            // dd($req->all());
              $req->validate([
                'email' => 'required|email',
              ]);              
              $user = User::where('email',$req->email)->first();   
              if($user != null){
                  $token = Str::random(64);
                  $subject = "Password Forget Email";
                  $email = $req->email;
                  ForgetPassword::insert([
                      'email' => $email,
                      'token' => $token,
                      'created_at' => now(),
                      'updated_at' => now(),
                  ]);
                  $data =[
                      'name' => $user->name,
                      'email' => $email,
                      'token' => $token,
                  ];              

                  try {
                      Mail::send('mail-template.member.forget-password-link', ['data' => $data], function($message) use ($subject, $email) {
                          $message->to($email);
                          $message->subject($subject);
                      });    
                      Log::channel('email')->info('Email sent successfully to ' . $email);    
                  } catch (\Exception $mailException) {
                      Log::channel('email')->info('Failed to send email to ' . $email . '. Error: ' . $mailException->getMessage());
                      return redirect()->back()->with('error', 'Warning :'. $mailException->getMessage());
                  }
                  return back()->with('success','Please Check Your Email');

              }else{
                  return back()->with('error','This Mail Does Not Exist in The Database.');
              }             
             
       
    }

    public function showResetPasswordForm($token, $email){
      // dd($token,$email);
        $existingToken = ForgetPassword::where('email', $email)->where('created_at', '>=', now()->subMinutes(10))->latest()->first();
        // dd($existingToken);
        if(!$existingToken){
          return redirect()->route('member-register')->with('error', 'Password Token Expired');
        }
        return view('member.auth.forget-password-update-form', ['token' => $token , 'email' => $email]);
    }

    public function submitResetPasswordForm(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'cpassword' => 'required'
          ]);

          $updatePassword = ForgetPassword::where([
            'email' => $request->email,
            'token' => $request->token,
          ])->first();
          // dd($updatePassword);

          if(!$updatePassword){
            return back()->with('error','Invalid Token');
          }

          User::where('email', $request->email)->update([
            'password' => Hash::make($request->password)
          ]);
          ForgetPassword::where('email', $request->email)->delete();
          return redirect()->route('member-register')->with('success','Your Password Has Been Changed');
    }
}