<?php

namespace App\Http\Controllers\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Task;
use App\Models\TaskUpdate;


use Hash;
use Str;
use Mail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\File;


class TaskController extends Controller
{
    public function taskList(){
        $member = Auth::user();
        $tasks = Task::with('member')->whereJsonContains('assign_to', strval($member->id))->paginate(10);
        return view('member.task.index',compact('member','tasks'));
    }

    public function taskUpdate($id){
        $member = Auth::user();
        $task = Task::whereJsonContains('assign_to', strval($member->id))->first();
        if(!$task){
            return back()->with('error','Task Not Found!');
        }
        $taskUpdates = TaskUpdate::where('member_id',$member->id)->where('task_id',$task->id)->paginate(10);
        return view('member.task.update',compact('task','taskUpdates'));
    }

    public function taskUpdates(Request $req){
        // dd($req->all());
        $req->validate([
            'updates' => 'required|array',
            'task_id' => 'required|numeric',
        ]);
        $member = Auth::user();
        foreach($req->updates as $updates){
            $taskUpdate = new TaskUpdate();
            $taskUpdate->task_id = $req->task_id;
            $taskUpdate->member_id = $member->id;
            $taskUpdate->updates = $updates;
            $taskUpdate->save();           
        }   
        return back()->with('success','Task Update Successfully');
    }

    



}
