<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Student;
use App\Models\College;
use App\Models\Payment;
use App\Models\Task;
use App\Models\Document;



use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $req){
        try{
            if($req->isMethod('get')){
                // dd(121);
                // dd(Auth::guard('admin')->check());
                return view('admin.auth.login');
    
            }else{
    
                $req->validate([
                    'email' => 'required|email',
                    'password' => 'required'
                ]);
    
                $email = $req->email;
                $password = $req->password;
    
                $admin = Admin::where('email',$email)->first();
                if($admin){
                    if(Auth::guard('admin')->attempt([ 'email' => $email, 'password' => $password ])){
                        return redirect()->route('admin.dashboard')->with('success','Login Successfully!');
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
        // dd(Auth::guard('admin')->user());
        $member = User::where('member_type','1')->where('status','1')->count();
        $nriMember = User::where('member_type','2')->where('status','1')->count();
        $student = Student::where('status','1')->count();
        $college = College::where('status','1')->count();
        $task = Task::count();
        $donation = Payment::sum('amount');
        $monthlyData = [];
        for ($month = 1; $month <= 12; $month++) {
            $monthlyData['student'][] = Student::where('status', '1')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();
    
            $monthlyData['member'][] = User::where('status', '1')->where('member_type','1')
                ->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();
    
            $monthlyData['nriMember'][] = User::where('member_type','2')->whereMonth('created_at', $month)
                ->whereYear('created_at', date('Y'))
                ->count();
        }

        return view('admin.dashboard', compact('member','nriMember','student','monthlyData','college','task','donation'));
    }

    public function dataFilter(Request $req) {
        // dd($req->all());
        $dateRange = $req->input('filter_values'); 
        $startDate = now()->startOfDay();
        $endDate = now()->endOfDay();
    
        switch ($dateRange) {
            case 'yesterday':
                $startDate = now()->subDay()->startOfDay();
                $endDate = now()->subDay()->endOfDay();
                break;
            case 'last7days':
                $startDate = now()->subDays(6)->startOfDay(); // Start from 6 days ago to today
                $endDate = now()->endOfDay();
                break;
            case 'last30days':
                $startDate = now()->subDays(29)->startOfDay(); // Start from 29 days ago to today
                $endDate = now()->endOfDay();
                break;
            case 'thisMonth':
                $startDate = now()->startOfMonth();
                $endDate = now()->endOfMonth();
                break;
            case 'lastMonth':
                $startDate = now()->subMonth()->startOfMonth();
                $endDate = now()->subMonth()->endOfMonth();
                break;
            case 'custom':
                $startDate = Carbon::parse($req->input('startDate', now()->startOfDay()->toDateString()))->startOfDay();
                $endDate = Carbon::parse($req->input('endDate', now()->endOfDay()->toDateString()))->endOfDay();
                break;
            default:
                break;
        }
    
        $student_count = Student::where('status', '1')->whereBetween('created_at', [$startDate, $endDate])->count();    
        $document_count = Document::whereBetween('created_at', [$startDate, $endDate])->count();    
        $college_count = College::where('status', '1')->whereBetween('created_at', [$startDate, $endDate])->count();    
        $task_count = Task::whereBetween('created_at', [$startDate, $endDate])->count();    
        $donation_sum = Payment::whereBetween('created_at', [$startDate, $endDate])->sum('amount');
    
        // dd([
        //     'student_count' => $student_count,
        //     'document_count' => $document_count,
        //     'college_count' => $college_count,
        //     'task_count' => $task_count,
        //     'donation_sum' => $donation_sum,
        //     'startDate' => $startDate,
        //     'endDate' => $endDate,
        // ]);
    
        return response()->json([
            'data' => [
                'student_count' => $student_count,
                'document_count' => $document_count,
                'college_count' => $college_count,
                'task_count' => $task_count,
                'donation_sum' => $donation_sum,
            ]
        ]);
    }

    public function users(){
        return view('backend.user.index');
    }

    public function logout(){
        Auth::guard('admin')->logout();
        session()->flush();
        // dd('Logged out');
        return redirect()->route('admin.login')->with('error','Logout Successfully!');
    }

   

}