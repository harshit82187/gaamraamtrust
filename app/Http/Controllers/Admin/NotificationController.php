<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Notification;
use App\Models\Student;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class NotificationController extends Controller
{
  
    public function notification(){
        $notifications = Notification::orderBy('created_at', 'desc')->paginate(10);
        $students = Student::where('status','1')->get();
        foreach ($notifications as $notification) {
            $studentIds = json_decode($notification->student_id, true);
    
            if (is_array($studentIds) && count($studentIds) === 1 && $studentIds[0] === "0") {
                $notification->students = "All Student"; // Display "All Student"
            } else {
                $notification->students = is_array($studentIds) 
                    ? Student::whereIn('id', $studentIds)->pluck('name')->toArray() 
                    : [];
            }
        }
        // dd($notifications);
        return view('admin.notification.index', compact('notifications','students'));
    }

    public function sendNotification(Request $req){
        // dd($req->all());
        $notification = new Notification();
        $notification->subject = $req->subject;
        $notification->student_id = json_encode($req->student_id);
        $notification->description = $req->description;

        if($req->image != null){
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("app/student-notification/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $notification->image = "app/student-notification/{$year}/{$month}/" . $filename;
        }
        $notification->save();
        return back()->with('success','Notification Send Successfully!');

    }

   

}