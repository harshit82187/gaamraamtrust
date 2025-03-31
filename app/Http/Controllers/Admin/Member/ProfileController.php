<?php

namespace App\Http\Controllers\Admin\Member;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Auth;

use App\Models\User;

use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class ProfileController extends Controller
{
   public function indianMemberList(){
        $indianMembers = User::where('member_type','1')->where('status','1')->paginate(10);
        return view('admin.member.profile.indian-list', compact('indianMembers'));
   }

   public function nriMemberList(){
    $nriMembers = User::where('member_type','2')->where('status','1')->paginate(10);
    return view('admin.member.profile.nri-list', compact('nriMembers'));
}

   

}