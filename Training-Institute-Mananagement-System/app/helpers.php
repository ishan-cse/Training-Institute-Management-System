<?php

use App\Models\CourseAcceass;
use App\Models\PdfAccess;
use App\Models\User;
use App\Models\CourseVideo;
use App\Models\CourseTopic;
use Illuminate\Support\Facades\DB;
use App\Models\NoticeAccess;

// for admin panel
function count_pending_request(){
    return User::where('role','Student')->where('status','Pending')->count();
}
function get_notice_students($id){
    return NoticeAccess::where('notice_for','Student')->where('notice_id',$id)->get();
}
function get_notice_course($id){
    return NoticeAccess::where('notice_for','Course')->where('notice_id',$id)->get();
}
function get_video_accesses($course_id , $topic_id){
    return CourseAcceass::where('course_id',$course_id)->where('topic_id',$topic_id)->get();
}
function student_pdf_access($id){
    return PdfAccess::where('pdf_id' , $id)->where('pdf_for','Student')->get();
}
function course_pdf_access($id){
    return PdfAccess::where('pdf_id' , $id)->where('pdf_for','Course')->get();
}
function get_topics($course_id){
    return CourseTopic::where('course_name_id',$course_id)->get();
}

// ======================================
// for student panel
// ======================================


function view_course_access($id){
    return CourseAcceass::where('student_id' , $id)->get();
}
function check_courseTopics($course_id,$topic_id,$id){
    if(CourseAcceass::where('course_id' , $course_id)->where('topic_id' , $topic_id)->where('student_id' , $id)->exists()){
      return 'found';
    }else{
        return 'not_found';
    }
}
function course_videos($course_id,$topic_id){
    return CourseVideo::where('course_name_id',$course_id)->where('course_topic_id',$topic_id)->get();
}
function checkEnroll($course_id,$topic_id){
    $check = DB::table('course_request')->where('Student_id',Auth::id())->where('Course_id',$course_id)->where('topic_id',$topic_id)->exists();
    if($check){
        return 'found';
    }else{
        return 'not_found';
    }
}
function cnt_enrollcourse(){
     return DB::table('course_request')->count();
}
function check_courseAccessEnroll($course_id){
    $enrollCheck = CourseAcceass::where('student_id',Auth::id())->where('course_id',$course_id)->exists();
    if($enrollCheck){
        return 'show';
    }else{
        return 'not_show';
    }
}


// count unseen videos
function count_unseenCourse($course_id,$student_id){
    return DB::table('video_view_status')->where('course_id',$course_id)->where('student_id',$student_id)->where('status','Unseen')->count();
}
function count_unseenTopics($course_id,$course_topic_id,$student_id){
    return DB::table('video_view_status')->where('course_id',$course_id)->where('course_topic_id' , $course_topic_id)->where('student_id',$student_id)->where('status','Unseen')->count();
}

// notice
function course_noticeAccess($course_id){
    return NoticeAccess::where('course_id' , $course_id)->latest()->get();
}
function check_sameNotice($notice_id,$student_id){
    if(!NoticeAccess::where('notice_id',$notice_id)->where('student_id' , $student_id)->exists()){
        return 'Show';
    }
}

// pdfs
function student_pdfAccess($student_id){
     return PdfAccess::where('student_id' , $student_id)->latest()->get();
}
function course_pdfAccess($course_id){
    return PdfAccess::where('course_id' , $course_id)->latest()->get();
}
function check_samePdf($pdf_id,$student_id){
    if(!PdfAccess::where('pdf_id',$pdf_id)->where('student_id' , $student_id)->exists()){
        return 'Show';
    }
}



