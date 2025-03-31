<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;
use Str;

use App\Models\Course;
use App\Models\Document;
use App\Models\Student;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;

class CourseController extends Controller
{
    public function courses(){
        $courses = Course::paginate(10);
        return view('admin.course.index', compact('courses'));
    }

    public function addCourse(Request $req){
        // dd($req->all());
        $req->validate([
            'name' => 'required|string|max:250',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
        ]);
        $course = new Course();
        $course->name = $req->name;
        $course->status = '1';
        $course->slug = Str::slug($req->name);

        if($req->image != null){
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("app/courses/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $course->image = "app/courses/{$year}/{$month}/" . $filename;
        }
        $course->save();
        return back()->with('success','Couse Saved Successfully!');
    }

    public function editCourse($id){
        $course = Course::find($id);
        if(!$course){
            return back()->with('error','Course Not Found!');
        }
        $courseDetails = json_decode($course->details,true);
        $tagsDetails =  json_decode($course->tag,true);
        $whyJoinUs   = json_decode($course->why_join_us,true);
        $programs   = json_decode($course->programs,true);
        $preparation_plans   = json_decode($course->preparation_plans,true);
        $test_series   = json_decode($course->test_series,true);
        $criterias   = json_decode($course->criteria,true);        
        return view('admin.course.edit', compact('course','courseDetails','tagsDetails','whyJoinUs','programs','preparation_plans','test_series','criterias'));
    }

    public function updateCourse(Request $req){
        // dd($req->all());
        $req->validate([
            'course_id' => 'required|exists:courses,id',
            'tab_one' => 'nullable|string',
            'tab_two' => 'nullable|string',
            'tab_three' => 'nullable|string',
            'tab_four' => 'nullable|string',
            'why_join_us' => 'required|array',
            'programs' => 'required|array',
            'preparation_plans' => 'nullable|string',
            'test_series' => 'nullable|array', 
            'criteria' => 'nullable|array', 
            'name' => 'required|string|max:250',
        ]);
        $course = Course::find($req->course_id);
        if(!$course){
            return back()->with('error','Course Not Found!');
        }
        

        $dataToUpdate = [
            'tab_one' => $req->tab_one,
            'tab_two' => $req->tab_two,
            'tab_three' => $req->tab_three,
            'tab_four' => $req->tab_four,
            'why_join_us' => json_encode($req->why_join_us),
            'programs' => json_encode($req->programs),
            'programs' => json_encode($req->programs),
            'preparation_plans' => $req->preparation_plans,
            'test_series' => json_encode($req->test_series),
            'criteria' => json_encode($req->criteria),
            'name' => $req->name,
            'slug' => Str::slug($req->name),
        ];
        if($req->image != null){
            $req->validate([
                'image' => 'mimes:jpeg,png,jpg|max:2048', 
            ]);
            $file = $req->image;
            $filename = time(). '.' . $file->getClientOriginalExtension();
            $year = now()->year;
            $month = now()->format('M');
            $folderPath = public_path("app/courses/{$year}/{$month}");
            if (!file_exists($folderPath)) {
                mkdir($folderPath, 0777, true);  
            }
            $file->move($folderPath, $filename);
            $dataToUpdate['image'] = "app/courses/{$year}/{$month}/" . $filename;
        }    
      
        $course->update($dataToUpdate);
        return back()->with('success', 'Course details updated  successfully.');

    }

    public function updateStatus(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'course_id' => 'required|numeric',  
            'status' => 'required|boolean',  
        ]);
      

        $course = Course::findOrFail($request->course_id);
        $course->status = $request->status;
        $course->save();
        return response()->json([
            'success' => true,
            'message' => 'Course status updated successfully',
        ]);
    }
  
 

    

   

}