<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\Document;
use App\Models\Notification;
use App\Models\Student;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class StudentController extends Controller
{
  
    public function enroolStudent(Request $req){
        $query = Student::query();
        if($req->has('name') && $req->name != null){
            $query->where('name','like','%' .$req->name . '%');
        }
        $students = $query->orderBy('created_at', 'desc')->paginate(10);
        // dd($students);
        return view('admin.student.index', compact('students'));
    }

    public function sendNotification(Request $req){
        // dd($req->all());
        $notification = new Notification();
        $notification->subject = $req->subject;
        $notification->user_id = $req->student_id;
        $notification->description = $req->description;

        if($req->image != null){
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("notification/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $notification->image = "notification/{$year}/{$month}/" . $filename;
        }
        $notification->save();
        return back()->with('success','Notification Send Successfully!');

    }

    public function enroolStudentInfo($id){
        // dd($id);
        $student = Student::find($id);
        if(!$student){
            return back()->with('error','Student Not Found!');
        }
        $documents = Document::where('student_id',$student->id)->paginate(10);
        return view('admin.student.info', compact('student','documents'));
    }

   

}