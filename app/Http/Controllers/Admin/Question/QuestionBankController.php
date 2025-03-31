<?php

namespace App\Http\Controllers\Admin\Question;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\TestSeries;
use App\Models\QuestionBank;



use Hash;
use Str;
use Mail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class QuestionBankController extends Controller
{
    public function list(Request $req){
        $testSeries = TestSeries::orderBy('created_at','desc')->paginate(10);
        return view('admin.question.test-series.list',compact('testSeries'));
    }

    public function add(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string|unique:test_series,name',
            'image' => 'required|image', 
            'duration' => 'required|numeric',
        ]);
        $serie = new TestSeries();
        $serie->name = $req->name;
        $serie->slug = Str::slug($req->name);
        $serie->duration = $req->duration;

        if($req->image != null){
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("app/test-series/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $serie->image = "app/test-series/{$year}/{$month}/" . $filename;
        }
        $serie->save();
        return back()->with('success', 'Series Added Successfully!');
    }

    public function questionList(Request $req){
        $questions = QuestionBank::orderBy('created_at','desc')->paginate(10);
        $series = TestSeries::where('status','1')->whereNull('deleted_at')->get();
        return view('admin.question.list',compact('questions','series'));
    }

    public function questionAdd(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string|unique:question_banks,name',
            'options' => 'required|array',
            'correct' => 'required|numeric',
            'test_series_id' => 'required|numeric',
        ]);
        $formattedOptions = [];
        foreach ($req->options as $key => $option) {
            $formattedOptions[$key + 1] = $option;
        }
        $question = new QuestionBank();
        $question->name = $req->name;
        $question->options = json_encode($formattedOptions);
        $question->correct = $req->correct;
        $question->test_series_id = $req->test_series_id;     
        $question->save();
        return back()->with('success', 'Question Added Successfully!');
    }


}
