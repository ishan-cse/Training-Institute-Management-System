<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\CourseName;
use App\Models\User;
use App\Models\CourseVideo;
use App\Models\CourseTopic;
use App\Models\NoticeAccess;
use App\Models\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StudentController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    // home
    function home(){
        
        return view('student.home' , [
            'others_cources' => CourseName::whereNotIn('id', [Auth::user()->course_id])->where('status','Active')->latest()->get(),
        ]);
    }
    function my_courses(){
        return view('student.courses' , [
            'others_cources' => CourseName::whereNotIn('id', [Auth::user()->course_id])->where('status','Active')->latest()->get(),
        ]);
    }
    function student_pdfs(){
        return view('student.pdfs');
    }
    function download_pdf($id){
        $file = Pdf::find($id)->file;
        return Storage::download('pdfs/'.$file);
    }
    function edit_profile(){
        return view('student.edit_profile');
    }
    function update_profile(Request $request , $id){
        User::where('id',$id)->update($request->except('_token'));
        return back()->with('student_updated','Succesfully profile updated');
    }
    function change_password(){
        return view('student.change_password');
    }
    function update_password(Request $request , $id){
        $request->validate([
            'password'=>'required|min:8|same:password_confirmation',
            'old_password'=>'required'
        ]);
        if(Hash::check ($request->old_password,Auth::User()->password) ){
            if($request->old_password==$request->password){
                return back()->with('old_pass_same' , 'Old and New Password Same Please Change !');
            }else{
                User::find($id)->update([
                    'password'=> Hash::make($request->password)
                   
                ]);
                return back()->with('pass_updated','Your Pasasword Hasbeen Updated');
            }
        }else{
            return back()->with('old_pass_error' , 'Incorrect Password');
        }
    }
    // course
    function view_course($id){
        if(DB::table('video_view_status')->where('course_id',$id)->where('student_id',Auth::id())->where('status','Unseen')->exists()){
            DB::table('video_view_status')->where('course_id',$id)->where('student_id',Auth::id())->update([
                'status'=>'Seen'
            ]);
        }
        return view('student.view_course',[
            'course_detail'=> CourseName::where('id',$id)->first(),
            'course_topics'=> CourseTopic::where('course_name_id',$id)->get(),
            // 'videos'=> CourseVideo::where('course_name_id',$id)->get(),
        ]);
    }
    function view_courseTopices($id){
        return view('student.view_course_topices',[
            'course_detail'=> CourseName::where('id',$id)->first(),
            'course_topics'=> CourseTopic::where('course_name_id',$id)->get(),
        ]);
    }
    function request_course($id){
        $ids = explode('-',$id);
        $course_id = $ids[0];
        $topic_id = $ids[1];
        DB::table('course_request')->insert([
            'student_id'=> Auth::id(),
            'course_id'=>$course_id,
            'topic_id'=>$topic_id,
            'created_at'=>Carbon::now()
        ]);
        return back()->with('request_access' , 'Course Enroll Success');
    }
    function view_notice(){
        
        return view('student.view_notice' , [
            'self_notices'=>NoticeAccess::where('notice_for','Student')->where('student_id',Auth::id())->latest()->limit(5)->get(),
            'course_notices'=>NoticeAccess::where('notice_for' ,'Course')->where('course_id',Auth::user()->course_name_id)->latest()->limit(5)->get(),

        ]);
    }
}
