<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CourseAcceass;
use App\Models\CourseName;
use App\Models\CourseTopic;
use App\Models\CourseVideo;
use App\Models\NoticeAccess;
use App\Models\PdfAccess;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class CourseCreationController extends Controller
{
    // Course Name
    
    function view_courseName(){
        return view('admin.course_creation.course_name' , [
            'course_names'=>CourseName::latest()->get()
        ]);
    }
    function add_courseName(Request $request){
        CourseName::insert([
            'course_name'=> $request->course_name,
            'created_at'=> Carbon::now()
        ]);
        return back()->with('course_name_added','Course Name hasbeen added');
    }
    function update_courseName(Request $request , $id){

        CourseName::find($id)->update([
            'course_name'=> $request->course_name
        ]);
        return back()->with('course_name_updated','Course Name hasbeen updated');
    }
    function dalete_courseName($id){

        $course_topics = CourseTopic::where('course_name_id',$id)->get();
        $course_videos = CourseVideo::where('course_name_id',$id)->get();
        $course_accesses = CourseAcceass::where('course_id',$id)->get();
        $notice_accesses = NoticeAccess::where('notice_for','Course')->where('course_id',$id)->get();
        $students = User::where('course_id',$id)->get();
        $pdf_accesses = PdfAccess::where('pdf_for','Course')->where('course_id',$id)->get();
        foreach($pdf_accesses as $pdf_accesse){
            PdfAccess::find($pdf_accesse->id)->delete();
        }
        foreach($course_topics as $course_topic){
            CourseTopic::find($course_topic->id)->delete();
        }
        foreach($course_videos as $course_video){
            CourseVideo::find($course_video->id)->delete();
        }
        foreach($course_accesses as $course_accesse){
            CourseAcceass::find($course_accesse->id)->delete();
        }
        foreach($notice_accesses as $notice_accesse){
            NoticeAccess::find($notice_accesse->id)->delete();
        }
        foreach($students as $student){
            User::find($student->id)->delete();
        }
        CourseName::find($id)->delete();

        return back()->with('course_name_deleted','Course Name hasbeen deleted');
    }
    function deactive_courseName($id){
        CourseName::find($id)->update([
            'status'=> 'Deactive'
        ]);
        return back();
    }
    function active_courseName($id){
        CourseName::find($id)->update([
            'status'=> 'Active'
        ]);
        return back();
    }
    function get_courseNames_ajaax(Request $request){
        $course_names = CourseName::latest()->get();
        foreach ($course_names as $course_name){
            echo "<option value='$course_name->id'>".$course_name->course_name."</option>";
        }
    }


    // Course topic
    
    function view_courseTopic(){
        return view('admin.course_creation.course_topic',[
            'course_topics'=>CourseTopic::latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
            
        ]);
    }
    function add_courseTpoic(Request $request){
        
        CourseTopic::insert($request->except('_token')+[
            'created_at'=> Carbon::now()
        ]);
        return back()->with('course_topic_added','Course Topic hasbeen added');
    }
    function update_courseTopic(Request $request , $id){

        CourseTopic::find($id)->update($request->except('_token'));
        return back()->with('course_topic_updated','Course Topic hasbeen updated');
    }
    function dalete_courseTopic($id){
        
        $course_videos = CourseVideo::where('course_topic_id',$id)->get();
        $course_accesses = CourseAcceass::where('topic_id',$id)->get();
        $enroll_requests = DB::table('course_request')->where('topic_id',$id)->get();
        foreach($course_accesses as $course_accesse){
            CourseAcceass::find($course_accesse->id)->delete();
        }
        foreach($course_videos as $course_video){
            CourseVideo::find($course_video->id)->delete();
        }
        foreach($enroll_requests as $enroll_request){
           DB::table('course_request')->where('id',$enroll_request->id)->delete();
        }
        
        CourseTopic::find($id)->delete();
        return back()->with('course_topic_deleted','Course Topic hasbeen deleted');
    }
    function get_courseTopic_ajaax(Request $request){
        $topics = CourseTopic::where('course_name_id' , $request->course_name_id)->get();
        foreach($topics as $topic){
            echo "<option value='$topic->id'>".$topic->course_topic."</option>";
        }
    }


    // Course video

    function view_courseVideo(){
        return view('admin.course_creation.course_video',[
            'course_videos'=>CourseVideo::latest()->get(),
            'students'=>User::where('role','Student')->where('status','Approved')->latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
            
        ]);
    }
    function all_courseVideo(){
        return view('admin.course_creation.all_videos',[
            'course_videos'=> CourseVideo::latest()->get(),
        ]);
    }
    function add_courseVideo(Request $request){
        $users = CourseAcceass::where('course_id',$request->course_name_id)->get();
        
        foreach($users as $user){
            DB::table('video_view_status')->insert([
                'course_id' =>$request->course_name_id,
                'course_topic_id'=>$request->course_topic_id,
                'student_id'=>$user->student_id,
                'created_at'=> Carbon::now()
            ]);
        }
        CourseVideo::insert($request->except('_token')+[
            'created_at'=> Carbon::now()
        ]);
        return back()->with('course_video_added','Course Video hasbeen added');
    }
    function update_courseVideo($id , Request $request){
        CourseVideo::where('id',$id)->update([
            'video_title'=>$request->video_title,
            'video_link'=>$request->video_link,
            'video_des'=>$request->video_des,
        ]);
        return back()->with('course_video_updated','Course Video hasbeen updated');
    }
    function dalete_courseVideo($id){
        CourseVideo::find($id)->delete();
        return back()->with('course_video_deleted','Course video hasbeen deleted');
    }

    // Course access

    function view_courseAccess(){
        return view('admin.course_creation.course_access',[
            'students'=>User::where('role','Student')->where('status','Approved')->latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
            'course_topics'=>CourseTopic::latest()->get(),
        ]);
    }
    function give_courseAccess(Request $request){
        $student_ids = $request->student_id;
        if($student_ids){
            foreach($student_ids as $student_id){
                if(CourseAcceass::where('course_id',$request->course_id)->where('topic_id',$request->topic_id)->where('student_id',$student_id)->exists()){
                    $name = User::find($student_id)->name;
                    return back()->with('already_given' , $name.' already has access to this topic.');
                }
                CourseAcceass::insert([
                    'course_id'=>$request->course_id,
                    'topic_id'=>$request->topic_id,
                    'student_id'=>$student_id,
                    'created_at'=>Carbon::now()
                ]);
            } 
        }
        return back()->with('access_given','Course Access given');
    }
    function remove_access(Request $request){
        // die();
        CourseAcceass::find( $request->id)->delete();
    }


}
