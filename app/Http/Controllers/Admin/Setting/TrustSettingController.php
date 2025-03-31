<?php

namespace App\Http\Controllers\Admin\Setting;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\BussinessSetting;


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

class TrustSettingController extends Controller
{
  

    public function privacyPolicy(Request $req){
        if($req->isMethod('get')){
            $privacyPolicy = BussinessSetting::find(2);
            // dd($privacyPolicy);
            return view('admin.setting.social-pages.privacy-policy', compact('privacyPolicy'));

        }else{
            // dd($req->all());
            $req->validate([
                'value' => 'required|string',
            ]);
            BussinessSetting::where('id', 2)->update([
                'value' => $req->value,
            ]);
            return back()->with('success','Privacy Policy Update Successfully!');
        }
    }

    public function termCondition(Request $req){
        if($req->isMethod('get')){
            $termCondition = BussinessSetting::find(1);
            return view('admin.setting.social-pages.term-condition', compact('termCondition'));

        }else{
            // dd($req->all());
            $req->validate([
                'value' => 'required|string',
            ]);
            BussinessSetting::where('id', 1)->update([
                'value' => $req->value,
            ]);
            return back()->with('success','Term & Condition Update Successfully!');
        }
    }


 



}
