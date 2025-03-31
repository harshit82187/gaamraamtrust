<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Document;
use App\Models\Student;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class DocumentController extends Controller
{
  
    public function document(Request $req){
        $query = Document::query();
        if($req->has('name') && $req->name != null){
            $student = Student::where('name',$req->name)->first();
            $query->where('student_id',$student->id);
        }
        $documents = $query->orderBy('created_at', 'desc')->paginate(10);
        // dd($documents);
        return view('admin.document.index', compact('documents'));
    }

    

   

}