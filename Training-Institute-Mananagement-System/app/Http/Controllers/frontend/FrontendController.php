<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\CourseName;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    function view_registration_page(){
        return view('frontend.registration' , [
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
        ]);
        
    }
	
    public function view_login(){
        return view('student.login');
    }
    function view_admin_login(){
        return view('admin.login');
    }
    function post_registration(Request $request){
        
        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'clg_name' => 'required',
            'mobile' => 'required',
            'email' => 'required|email|unique:users',
            'course_id' => 'required',
            'password'=> 'required|min:8|same:password_confirmation',
            'password_confirmation' => 'required',
            'terms_condition' => 'required',
        ]);
        User::insert([
            'name' => $request->name,
            'clg_name' => $request->clg_name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'blood_grp' => $request->blood_grp,
            'course_id' => $request->course_id,
            'password' => Hash::make( $request->password),
            'created_at' => Carbon::now()
        ]);
        return redirect('/student/login')->with('registration_done' , 'Your registration done! Your request is on pending. You will get a email when admin approved your request');
    }
}
