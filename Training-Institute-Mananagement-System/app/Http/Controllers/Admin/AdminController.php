<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\WelcomeMail;
use App\Mail\EnrollAccess;
use App\Mail\UserupMail;
use App\Models\CourseAcceass;
use App\Models\CourseName;
use App\Models\Notice;
use App\Models\NoticeAccess;
use App\Models\Pdf;
use App\Models\PdfAccess;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('role');
    }

    // Admin Controller -> admin home , notice settings ,

    function home(){
        
        return view('admin.home');
    }
    
    function enroll_course_request(){
        return view('admin.enroll_request' , [
            'enroll_requests' => DB::table('course_request')->latest()->get(),
        ]);
    }
    
    function give_enroll_request($id){
        $student_id = DB::table('course_request')->find($id)->student_id;
        $course_id = DB::table('course_request')->find($id)->course_id;
        $topic_id = DB::table('course_request')->find($id)->topic_id;
        $course_name = CourseName::find($course_id)->course_name;
        CourseAcceass::insert([
            'course_id'=>$course_id,
            'student_id'=>$student_id,
            'topic_id'=>$topic_id,
            'created_at'=>Carbon::now()
        ]);
        $details = [
            'title' => 'Conformation Mail',
            'course_name' => $course_name,
        ];
        DB::table('course_request')->where('id',$id)->delete();
        $email = User::find($student_id)->email;
        Mail::to($email)->send(new EnrollAccess($details));
        
        return back()->with('enroll_approved','Enroll approved successfully');
        
   }
   function delete_enroll_request($id){
       DB::table('course_request')->where('id',$id)->delete();
       return back()->with('enroll_deleted','Enroll request deleted successfully');
   }
   
   // location
   
   function view_location(){
        return view('admin.location' , [
           'locations' => DB::table('location')->latest()->get()
        ]);
   }
   function add_location(Request $request){
       
        DB::table('location')->insert([
           'location_name' => $request->location_name
        ]);
        return back()->with('location_added','Location Added Successfully');
       
   }
   function update_location(Request $request , $id){
       DB::table('location')->where('id',$id)->update([
           'location_name' => $request->location_name
        ]);
        return back()->with('location_updated','Location Updated');
   }
   function delete_location($id){
       DB::table('location')->where('id',$id)->delete();
        return back()->with('location_deleted','Location Deleted');
   }
   
   
   
   
    // pdf
    
    function pdf(){
        return view('admin.pdf',[
            'pdfs'=> Pdf::latest()->get(),
            'students'=>User::where('role','Student')->where('status','Approved')->latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
        ]);
    }
    function add_pdf(Request $request){
        
        // upload main file
        if($request->hasFile('file')){
            $main_file = $request->file('file');
            $slug = Str::of($request->title)->slug('-');
            $file_ex = $main_file->getClientOriginalExtension();
            $file_name = $slug.'.'.$file_ex;
            $path = $main_file->storeAs(
                'pdfs', $file_name
            );
        }
        $id = Pdf::insertGetId([
            'title'=>$request->title,
            'file'=>$file_name,
            'created_at'=> Carbon::now()
        ]);
        $student_ids = $request->student_id;
        $course_ids = $request->course_id;
        if($student_ids){
            foreach($student_ids as $student_id){
                PdfAccess::insert([
                    'pdf_id'=>$id,
                    'pdf_for'=>'Student',
                    'student_id'=>$student_id,
                    'created_at'=>Carbon::now()
                ]);
            } 
        }
        if($course_ids){
            foreach($course_ids as $course_id){
                PdfAccess::insert([
                    'pdf_id'=>$id,
                    'pdf_for'=>'Course',
                    'course_id'=>$course_id,
                    'created_at'=>Carbon::now()
                ]);
            }
        }
        return back()->with('pdf_added','File added successfully');
    }
    function update_pdf(Request $request,$id){
        Pdf::find($id)->update([
            'title'=>$request->title,
        ]);
        if($request->hasFile('file')){
            $file = Pdf::find($id)->file;
            $location = base_path('storage/app/pdfs/');
            unlink($location.$file);
            $main_file = $request->file('file');
            $slug = Str::of($request->title)->slug('-');
            $file_ex = $main_file->getClientOriginalExtension();
            $file_name = $slug.'.'.$file_ex;
            $path = $main_file->storeAs(
                'pdfs', $file_name
            );
            Pdf::find($id)->update([
                'file'=>$file_name,
            ]);
        }
        return back()->with('pdf_updated','File hasbeen updated');
    }
    function delete_pdf($id){
        $file = Pdf::find($id)->file;
        $location = base_path('storage/app/pdfs/');
        unlink($location.$file);
        $file_accesses = PdfAccess::where('pdf_id',$id)->get();
        foreach($file_accesses as $file_accesse){
            PdfAccess::find($file_accesse->id)->delete();
        }
        Pdf::find($id)->delete();
        return back()->with('pdf_deleted','File successfully deleted');
    }
    function give_fileAccess(Request $request , $id){
        // echo "im here";
        // die();
        $student_ids = $request->student_id;
        $course_ids = $request->course_id;
        if($student_ids){
            foreach($student_ids as $student_id){
                PdfAccess::insert([
                    'pdf_id'=>$id,
                    'pdf_for'=>'Student',
                    'student_id'=>$student_id,
                    'created_at'=>Carbon::now()
                ]);
            } 
        }
        if($course_ids){
            foreach($course_ids as $course_id){
                PdfAccess::insert([
                    'pdf_id'=>$id,
                    'pdf_for'=>'Course',
                    'course_id'=>$course_id,
                    'created_at'=>Carbon::now()
                ]);
            }
        }
        return back()->with('access_given','Access given successfully');
    }
    function delete_fileAccess(Request $request){
        PdfAccess::find($request->id)->delete();
        // return back()->with('access_deleted','Access deleted successfully');
    }
    
    
    
    // notice

    function view_notice(){
        return view('admin.notice' , [
            'notices'=>Notice::latest()->get(),
            'students'=>User::where('role','Student')->where('status','Approved')->latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
        ]);
    }
    function add_notice(Request $request){
 
        $id = Notice::insertGetId($request->except('_token','student_id','course_id')+[
            'created_at'=>Carbon::now()
        ]);
        $student_ids = $request->student_id;
        $course_ids = $request->course_id;
        if($student_ids){
            foreach($student_ids as $student_id){
                NoticeAccess::insert([
                    'notice_id'=>$id,
                    'notice_for'=>'Student',
                    'student_id'=>$student_id,
                    'created_at'=>Carbon::now()
                ]);
            } 
        }
        if($course_ids){
            foreach($course_ids as $course_id){
                NoticeAccess::insert([
                    'notice_id'=>$id,
                    'notice_for'=>'Course',
                    'course_id'=>$course_id,
                    'created_at'=>Carbon::now()
                ]);
            }
        }
        return back()->with('notice_added','Notice added');
    }
    function update_notice(Request $request,$id){
        Notice::where('id',$id)->update([
            'notice_title'=>$request->notice_title,
            'notice'=>$request->notice,
        ]);
        return back()->with('notice_updaed','Notice update successfully');
    }
    function delete_notice($id){
        Notice::find($id)->delete();
        $notice_accesses = NoticeAccess::where('notice_id',$id)->get();
        foreach($notice_accesses as $notice_accesse){
            NoticeAccess::find($notice_accesse->id)->delete();
        }
        
        return back()->with('notice_deleted','Notice delete successfully');
    }
    function give_new_access(Request $request, $id){
        $student_ids = $request->student_id;
        $course_ids = $request->course_id;
        if($student_ids){
            foreach($student_ids as $student_id){
                NoticeAccess::insert([
                    'notice_id'=>$id,
                    'notice_for'=>'Student',
                    'student_id'=>$student_id,
                    'created_at'=>Carbon::now()
                ]);
            } 
        }
        if($course_ids){
            foreach($course_ids as $course_id){
                NoticeAccess::insert([
                    'notice_id'=>$id,
                    'notice_for'=>'Course',
                    'course_id'=>$course_id,
                    'created_at'=>Carbon::now()
                ]);
            }
        }
        return back()->with('access_added','New Access added successfully');
    }
    function delete_notice_access(Request $request){

        NoticeAccess::find($request->id)->delete();
        // return back()->with('access_deleted','Remove form Notice Access successfully');
    }


    // Students setting -> view pending request , delete pending student , edit user opton , delete user    

    function view_approve_student(){
        return view('admin.approved_student',[
            'approve_students' => User::where('role','Student')->where('status','Approved')->latest()->get(),
            'course_names'=>CourseName::where('status','Active')->latest()->get(),
        ]);
    }
    function view_pending_request(){
        return view('admin.pending_request',[
            'pending_requests' => User::where('role','Student')->where('status','Pending')->get()
        ]);
    }
    function approve_request(Request $request , $id){
        
        $validatedData = $request->validate([
            'student_roll' => 'required|unique:users',
        ]);
        User::where('id',$id)->update([
            'student_roll' => $request->student_roll,
            'status' => 'Approved',
        ]);
        $details = [
            'title' => 'Welcome Mail',
            'student_id' => $request->student_roll,
            'url' => 'https://touhidphysics.com/student/login'
        ];
        $course_id = User::find($id)->course_id;
        CourseAcceass::insert([
            'course_id'=>$course_id,
            'topic_id'=>$request->topic_id,
            'student_id'=>$id,
            'created_at'=>Carbon::now()
        ]);
        $email = User::find($id)->email;
        Mail::to($email)->send(new WelcomeMail($details));
        
        return back()->with('request_updated','Request approved successfully');
    }
    function update_student_details(Request $request , $id){
        $old_roll = $request->old_roll;
        $new_roll = $request->student_roll;
        
        User::where('id',$id)->update($request->except('_token','old_roll','student_roll'));
        if($old_roll != $new_roll){
            $email = User::find($id)->email;
            $details = [
                'title' => 'Student Roll Update Mail',
                'student_id' => $new_roll,
            ];
            User::where('id',$id)->update([
                'student_roll'=>$new_roll
            ]);
            Mail::to($email)->send(new UserupMail($details));
        }
        return back()->with('student_updated','Student details updated');
    }
    
    function delete_request($id){
        
        $course_accesses = CourseAcceass::where('student_id',$id)->get();
        $notice_accesses = NoticeAccess::where('notice_for','Student')->where('student_id',$id)->get();
        $pdf_accesses = PdfAccess::where('pdf_for','Student')->where('student_id',$id)->get();
        foreach($course_accesses as $course_accesse){
            CourseAcceass::find($course_accesse->id)->delete();
        }
        foreach($pdf_accesses as $pdf_accesse){
            PdfAccess::find($pdf_accesse->id)->delete();
        }
        foreach($notice_accesses as $notice_accesse){
            NoticeAccess::find($notice_accesse->id)->delete();
        }
        User::find($id)->delete();
        return back()->with('student_deleted','Student removed successfully');
    }
    function get_students_ajaax(Request $request){
        $students = User::where('role','Student')->where('status','Approved')->latest()->get();
        foreach ($students as $student){
            echo "<option value='$student->id'>".$student->name."</option>";
        }
    }
}
