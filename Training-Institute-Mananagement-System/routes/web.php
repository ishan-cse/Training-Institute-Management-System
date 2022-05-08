<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseCreationController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\frontend\FrontendController;
use App\Http\Controllers\student\StudentController;
use App\Http\Controllers\SocialiteController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes([
    'register'=>false,
    // 'login'=>false
]);

// custome login
Route::post('/student/make/login',[LoginController::class,'StdentLogin'])->name('student_login');
Route::post('/student/admin/login',[LoginController::class,'AdminLogin'])->name('admin_login');

// ======================================================================
// Frontend Panel
// ======================================================================

// Registration

Route::get('/student/login', [FrontendController::class, 'view_login']);
Route::get('/admin/login', [FrontendController::class, 'view_admin_login']);
Route::get('/registration',[FrontendController::class,'view_registration_page']);
Route::post('/post/registration',[FrontendController::class,'post_registration']);
// ======================================================================
// Student Panel
// ======================================================================

// Student Controller -> view course , notice and etc

Route::get('/student/home', [StudentController::class, 'home']);
Route::get('/student/view/course/{id}',[StudentController::class,'view_course']);
Route::get('/student/notice',[StudentController::class,'view_notice']);
Route::get('/student/edit/profile',[StudentController::class,'edit_profile']);
Route::post('/update/profile/{id}', [StudentController::class, 'update_profile']);
Route::get('/change/password', [StudentController::class, 'change_password']);
Route::post('/update/password/{id}', [StudentController::class, 'update_password']);
Route::get('/view/course/topices/{id}', [StudentController::class, 'view_courseTopices']);
Route::get('/request/enroll/course/{id}', [StudentController::class, 'request_course']);
Route::get('/my/courses', [StudentController::class, 'my_courses']);
Route::get('/student/pdfs', [StudentController::class, 'student_pdfs']);
Route::get('/download/pdf/file/{id}',[StudentController::class, 'download_pdf']);

// ======================================================================
// Admin Panel
// ======================================================================

// Admin Controller -> admin home , notice settings ,

Route::get('/admin/home', [AdminController::class, 'home'])->name('home');

// notice

Route::get('/view/notice', [AdminController::class, 'view_notice']);
Route::post('/add/notice', [AdminController::class, 'add_notice']);
Route::post('/update/notice/{id}', [AdminController::class, 'update_notice']);
Route::get('/delete/notice/{id}', [AdminController::class, 'delete_notice']);
Route::post('/remove/notice/acccess',[AdminController::class, 'delete_notice_access']);
Route::post('/add/new/notice/access/{id}',[AdminController::class, 'give_new_access']);
Route::get('/view/location',[AdminController::class, 'view_location']);
Route::post('/add/location',[AdminController::class, 'add_location']);
Route::post('/update/location/{id}',[AdminController::class, 'update_location']);
Route::get('/delete/notice/{id}',[AdminController::class, 'delete_location']);



// Students setting -> view pending request , delete pending student , edit user opton , delete user

Route::get('/view/approved/student', [AdminController::class, 'view_approve_student']);
Route::get('/view/pending/request', [AdminController::class, 'view_pending_request']);
Route::post('/approve/pending/student/{id}', [AdminController::class, 'approve_request']);
Route::get('/delete/student/{id}', [AdminController::class, 'delete_request']);
Route::post('/update/student/details/{id}', [AdminController::class, 'update_student_details']);
// get all students with ajax
Route::post('/get/all_students/name', [AdminController::class, 'get_students_ajaax']);

Route::get('/view/enroll/request', [AdminController::class, 'enroll_course_request']);
Route::get('/give/enroll/request/{id}', [AdminController::class, 'give_enroll_request']);
Route::get('/delete/enroll/request/{id}', [AdminController::class, 'delete_enroll_request']);

// library system -> pdf options

Route::get('/library/system/pdf', [AdminController::class, 'pdf']);
Route::post('/add/pdf/file',[AdminController::class, 'add_pdf']);
Route::post('/update/pdf/file/{id}', [AdminController::class, 'update_pdf']);
Route::get('/delete/pdf/file/{id}', [AdminController::class, 'delete_pdf']);
Route::post('/add/new/file/access/{id}', [AdminController::class, 'give_fileAccess']);
Route::post('/delete/pdf/access', [AdminController::class, 'delete_fileAccess']);



// Create Course Controller -> course name , course topic , course video , course access

// Course Name

Route::get('/course/name', [CourseCreationController::class, 'view_courseName']);
Route::post('/add/course/name', [CourseCreationController::class, 'add_courseName']);
Route::post('/update/course/name/{id}', [CourseCreationController::class, 'update_courseName']);
Route::get('/delete/course/name/{id}', [CourseCreationController::class, 'dalete_courseName']);
Route::get('/course/name/deactive/{id}', [CourseCreationController::class, 'deactive_courseName']);
Route::get('/course/name/active/{id}', [CourseCreationController::class, 'active_courseName']);
// get course names with ajax
Route::post('/get/all_course/name', [CourseCreationController::class, 'get_courseNames_ajaax']);

// Course Topic

Route::get('/course/topic', [CourseCreationController::class, 'view_courseTopic']);
Route::post('/add/course/topic', [CourseCreationController::class, 'add_courseTpoic']);
Route::post('/update/course/topic/{id}', [CourseCreationController::class, 'update_courseTopic']);
Route::get('/delete/course/topic/{id}', [CourseCreationController::class, 'dalete_courseTopic']);
// get course topic with ajax
Route::post('/get/course_topic/list', [CourseCreationController::class, 'get_courseTopic_ajaax']);


// Course Video

Route::get('/course/video', [CourseCreationController::class, 'view_courseVideo']);
Route::get('/all/video', [CourseCreationController::class, 'all_courseVideo']);
Route::post('/add/course/video', [CourseCreationController::class, 'add_courseVideo']);
Route::post('/update/course/video/{id}', [CourseCreationController::class, 'update_courseVideo']);
Route::get('/delete/course/video/{id}', [CourseCreationController::class, 'dalete_courseVideo']);

// Course access

Route::get('/course/access', [CourseCreationController::class, 'view_courseAccess']);
Route::post('/give/course/access', [CourseCreationController::class, 'give_courseAccess']);
// Route::post('/update/course/name/{id}', [CourseCreationController::class, 'update_courseName']);
Route::post('/remove/acccess', [CourseCreationController::class, 'remove_access']);



// socaial login 
// ========================================
Route::get('/auth/facebook', [SocialiteController::class, 'facebookRedirect']);
Route::get('/auth/facebook/callback', [SocialiteController::class, 'loginWithFacebook']);