<?php

namespace App\Http\Controllers\Student;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

use Auth;
use Hash;

use App\Models\User;
use App\Models\Document;
use App\Models\Student;
use App\Models\Notification;


use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class AuthController extends Controller
{
    public function login(Request $req){
        try{
            if($req->isMethod('get')){
                // dd(121);
                return view('student.auth.login');
            }else{
    
                $req->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);    
                $email = $req->email;
                $password = $req->password;    
                $student = Student::where('email',$email)->first();
                if($student){
                    if(Auth::guard('student')->attempt([ 'email' => $email, 'password' => $password ])){
                        if($student->status == 0){
                            Auth::guard('student')->logout();
                            return back()->with('error','Your account is not active! Please contact to admin.');
                        }elseif($student->state == null || $student->city == null || $student->address == null ){
                            Auth::guard('student')->login($student);
                            return redirect()->route('student.profile')->with('success','Login Successfully, Please Complete Your Profile!');
                        }
                        return redirect()->route('student.dashboard')->with('success','Login Successfully!');
                    }else{
                        return back()->with('error','Wrong Credentials!');
                    }    
                }else{
                    return back()->with('error','Record Not Found!');
                } 
            }
        }catch (ValidationException $e) {
            return back()->withErrors($e->validator)->withInput();
        }catch(\Exception $e){
            return back()->with('error', 'Warning : ' .$e->getMessage());
        }        
    }

    public function dashboard(){
        // dd(Auth::guard('student')->user());
        $student = Auth::guard('student')->user();
        $documents = Document::where('student_id',$student->id)->count();
        $notifications = Notification::whereJsonContains('student_id', (string) $student->id)->orWhereJsonContains('student_id', "0")->count();
        return view('student.dashboard',compact('notifications','documents'));
    }

    public function notification(){
        $student = Auth::guard('student')->user();
        // dd($student);
        $notifications = Notification::whereJsonContains('student_id', (string) $student->id)->orWhereJsonContains('student_id', "0")->orderBy('created_at', 'desc')->paginate(10);
        return view('student.notification.index',compact('notifications'));
    }

    public function profile(){
        $student = Auth::guard('student')->user();
        return view('student.profile.index',compact('student'));

    } 

    public function profileUpdate(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string|max:255',
            'course' => 'required|string|max:255',
        ]);
        $student = Auth::guard('student')->user();
        $data = [
            'name' => $req->name,
            'course' => $req->course,
            'state' => $req->state,
            'city' => $req->city,
            'address' => $req->address,
        ];

        if($student->email != $req->email){
            $req->validate([
                'email' => 'required|email|unique:students,email',
            ]);
            $data['email'] = $req->email;
        }

        if($student->mobile != $req->mobile){
            $req->validate([
                'mobile' => 'required|numeric|unique:students,mobile',
            ]);
            $data['mobile'] = $req->mobile;
        }

        if($req->has('password') && $req->password != null){
            $data['password'] = Hash::make($req->password);
        }

        if($req->image != null){
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("app/student-profile/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $data['image'] = "app/student-profile/{$year}/{$month}/" . $filename;
        }
        $student->update($data);
        $documentExist = Document::where('student_id',$student->id)->first();
        if(!$documentExist){
            return redirect(route('student.document-list'))->with('success', 'Profile updated successfully! Now you can upload your documents.');
        }
        return redirect()->back()->with('success', 'Profile updated successfully!');
    }

    public function logout(){
        Auth::guard('student')->logout();
        session()->flush();
        // dd('Logged out');
        return redirect()->route('student.login')->with('error','Logout Successfully!');
    }

    public function autoLogout(Request $request)
    {
        Auth::guard('student')->logout();
        session()->flush();
        return response()->json(['status' => 'logged_out']);
    }

    public function sendWa(){
        $Name = 'Ankit Singh Chauhan';
                $MobileNo = '8006818216';
                
                // WhatsApp message with newline characters
                $message = "Dear " . ($Name ?? 'Aspirant') . ",\n\n".
                           "✅ Your sign-up is complete! Now, move to the next step—Document Upload & Verification.\n\n" .
                           "📌 What’s Next?\n" .
                           "✔ Log In: Click on “Student Login” on our website and enter your email ID and password.\n" .
                           "✔ Upload Documents: Go to the “Upload Documents” section in your Student Dashboard and submit the required files.\n" .
                           "✔ Verification: Our team will review them, and you’ll receive an email once your documents are verified.\n\n" .
                           "⏳ Complete this step on time to avoid delays in your enrollment.\n\n" .
                           "🚀 Start now!\n\n" .
                           "Best regards,\nGaamRaam NGO Team";
                
                if (!str_starts_with($MobileNo, '+91')) {
                    $MobileNo = '+91' . $MobileNo;
                }
                
                $apiKey = 'eGyZ9B45gSXn'; 
                $whatsappApiUrl = 'http://api.textmebot.com/send.php';
                
                $response = Http::get($whatsappApiUrl, [
                    'recipient' => $MobileNo,
                    'apikey' => $apiKey,
                    'text' => $message
                ]);
                
                if ($response->successful()) {
                    return response()->json([
                        'message' => 'WhatsApp message sent successfully!'
                    ], 200);
                } else {
                    return response()->json([
                        'errors' => ['message' => 'Failed to send WhatsApp message.']
                    ], 500);
                }
    }

   

}