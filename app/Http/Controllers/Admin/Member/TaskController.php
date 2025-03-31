<?php

namespace App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskUpdate;

use App\Mail\Member\SendTaskMail;

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

class TaskController extends Controller
{
    public function taskList(){
        $members = User::where('status','1')->get();
        $tasks = Task::with('member')->where('assign_by',Auth::guard('admin')->user()->id)->paginate(10);
        return view('admin.member.task.index',compact('members','tasks'));
    }

    public function taskAdd(Request $req){
        // dd($req->all());
        $req->validate([
            'member_id' => 'required|array',
            'task' => 'required',
        ]);
        $admin = Auth::guard('admin')->user();
        $task = new Task();
        $task->assign_to = json_encode($req->member_id); 
        $task->task = $req->task;
        $task->assign_by = $admin->id;
        $task->save(); 

        foreach ($req->member_id as $member_id) {
            $email = User::where('id', $member_id)->value('email');
            $name = User::where('id', $member_id)->value('name');
    
            $data = [
                'task' => $req->task,
                'name' => $name,
                'adminName' => $admin->name,
            ];
    
            try {
                $subject = 'A New Task is assigned to you ' . $req->task . ' | ' . \Carbon\Carbon::today()->format('d-M-Y') . ' | ' . \Carbon\Carbon::now()->format('h:i A');
                Mail::to($email)->queue(new SendTaskMail($data, $subject));
                Log::channel('member')->info('Task Mail :: Success to send email to ' . $email);
            } catch (\Exception $mailException) {
                Log::channel('member')->error('Task Mail :: Failed to send email to ' . $email . '. Error: ' . $mailException->getMessage());
            }
        }

        return back()->with('success','Task Added Successfully');
    }

    public function checkReport(Request $request)
    {
        // dd($request->all());
        $taskId = $request->task_id;
        $memberId = $request->member_id;
        $task = Task::find($taskId);
        $taskUpdates = TaskUpdate::where('task_id',$taskId)->where('member_id',$memberId)->paginate(10);
        $member = User::find($memberId);

        if (!$task || !$member) {
            return redirect()->back()->with('error', 'Invalid Task or Member.');
        }

        return view('admin.member.task.report.view', compact('task', 'member','taskUpdates'));
    }



}
