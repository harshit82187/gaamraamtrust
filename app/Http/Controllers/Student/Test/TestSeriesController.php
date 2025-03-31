<?php

namespace App\Http\Controllers\Student\Test;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;



use App\Models\TestSeries;
use App\Models\QuestionBank;
use App\Models\TestResult;


use Auth;
use Hash;
use Str;
use Mail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\File;

class TestSeriesController extends Controller
{
    public function list(Request $req){
        $testSeries = TestSeries::orderBy('created_at','desc')->paginate(10);
        return view('student.test-series.list',compact('testSeries'));
    }

    public function attemptSeriesTest($slug)
    {
        $student = Auth::guard('student')->user();    
        $testSeries = TestSeries::where('slug', $slug)->firstOrFail();
        // dd($student->id,$testSeries->id);
        $testResultExists = TestResult::where([
            'student_id' => $student->id,
            'test_series_id' => $testSeries->id
        ])->exists();    
        if ($testResultExists) {
            return back()->with('error', "You have already attempted the '{$testSeries->name}' series!");
        }    
        $questions = QuestionBank::where('test_series_id', $testSeries->id)->get();    
        return view('student.test-series.attempt', compact('testSeries', 'questions'));
    }
    

    public function saveAnswer(Request $request)
    {
        // dd($request->all());
        $validated = $request->validate([
            'question_id' => 'required|exists:question_banks,id',
            'answer' => 'required|string',
            'test_series_id' => 'required|exists:test_series,id',
        ]);    
        $question = QuestionBank::findOrFail($request->question_id);
        $status = ($question->correct == $request->answer) ? 1 : 0;    
        TestResult::create([
            'student_id' => Auth::guard('student')->user()->id,
            'question_id' => $validated['question_id'],
            'student_mark_option' => $validated['answer'],
            'test_series_id' => $validated['test_series_id'],
            'status' => $status,
        ]);
    
        $totalQuestions = QuestionBank::where('test_series_id',$request->test_series_id)->count();     
        $attemptedQuestions = TestResult::where('student_id', Auth::guard('student')->user()->id)->count();
    
        // If all questions are attempted, redirect to results page
        if ($attemptedQuestions >= $totalQuestions) {
            return response()->json([
                'message' => 'Test completed successfully!',
                'redirect' => route('student.test-result', ['testSeriesId' => $question->test_series_id])
            ]);
        }    
        return response()->json(['message' => 'Answer saved successfully']);
    }

    public function testResult($testSeriesId){
        $studentId = Auth::guard('student')->id();
        $testSeries = TestSeries::findOrFail($testSeriesId);
        $totalQuestions = QuestionBank::where('test_series_id', $testSeriesId)->count();
        $totalCorrect = TestResult::where('student_id', $studentId)
        ->whereHas('question', function ($query) use ($testSeriesId) {
            $query->where('test_series_id', $testSeriesId);
        })
        ->where('status', 1)
        ->count();
        return view('student.test-series.result', compact('testSeries', 'totalQuestions', 'totalCorrect'));
    }
    


    

}
