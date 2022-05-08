@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - Student Home
@endsection
@section('home')
active
@endsection
@section('MM_home')
main__menu-active
@endsection

@section('student_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<style>

    .header_logo {
        width: 100%;
    
        display: flex;
        justify-content: center;
        position: absolute;
        top: 15px;
        left: 0;
    }
    .profile{
        position: relative;
    }
    .profile_edit a {
        color: #fa80c3;
        /*text-decoration: none;*/
        margin-right: 20px;
    }
    .display-flex{
        display: flex;
        width: 100%;
        align-items: center;
    }
    .width-60{
        width:60%;
    }
    .enroll-btn-area{
        width:40%;
        text-align: right;
    }
    .badge.badge-primary {
        margin-left: 20px;
        border-radius: 10px;
        height: 25px;
        width: 25px;
        background: #5966f3;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 13px;
        font-weight: bold;
        color: #fff;
    }
    .profile_edit svg {
        fill: #fa80b2;
        width: 15px;
        padding-top: 10px;
        margin-right: 5px;
    }
    
    .profile_edit {
        position: absolute;
        display: flex;
        width: 100%;
        justify-content: flex-end;
        left: 0;
    }
    @media screen and (max-width: 486px) {
      a.button.pink-button , .dis-btn{
            font-size: 10px;
            padding: 5px 10px;
        }
    }
    @media screen and (max-width: 349px) {
      a.button.pink-button , .dis-btn{
            font-size: 8px;
        }
    }
</style>
@endsection
@section('student_content')

    <div class="top_part">
        <div class="header_logo">
            <img src="{{ asset('student_asset/img/home-logo.png') }}" />
        </div>
    </div>
    <div class="profile shadow" style="margin-top: 100px;">
        <div class="profile_edit">
             
            <a href="{{ url('/student/edit/profile') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/></svg>Edit</a>
        </div>
        <img src="{{ asset('student_asset') }}/img/profile.jpg" alt="" class="profile__picture">
        <!-- ================= only goes last name here ========================= -->
        <h2 class="profile__name">{{ Auth::user()->name }}</h1>

        <div class="profile__info">
            <div class="profile__info--box">
                <p class="value">{{ Auth::user()->student_roll }}</p>
                <p class="label">Student Roll</p>
            </div>
            <div class="profile__info--box">
                <p class="value">{{ Auth::user()->status }}</p>
                <p class="label">Status</p>
            </div>
        </div>
    </div>

    <h2 class="page__heading my-30" style="color:#fa80b2;">My Courses</h2>

    {{-- course access --}}

    @foreach ( view_course_access(Auth::id()) as $item )
    <div class="course__list shadow">
        <div class="course__icon">
            <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
        </div>
        <div class="course__description">
            <a href="{{ url('/student/view/course',$item->course_id) }}">
                <h3>{{ $item->CourseName->course_name }}</h3>
                <p>
                    <span>Click here for the details of the course</span>
                    <svg class="icon icon-arrow-right2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-arrow-right2"></use></svg>
                </p>
            </a>
            
        </div>
        @if( count_unseenCourse($item->course_id,Auth::id()) > 0 )
        <div class="badge badge-primary">{{ count_unseenCourse($item->course_id,Auth::id()) }}</div>
        @endif
    </div>
        
    @endforeach
        
    <h2 class="page__heading my-30" style="color:#fa80b2;">Other Courses</h2>

    @foreach ( $others_cources as $others_cource )
    @if(check_courseAccessEnroll($others_cource->id) == 'not_show')
        <div class="course__list shadow">
            <div class="course__icon">
                <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
            </div>
            <div class="course__description display-flex">
                <div class="width-60">
                    <h3>{{ $others_cource->course_name }}</h3>
                </div>
                <div class="enroll-btn-area">
                    <a href="{{ url('/view/course/topices' , $others_cource->id) }}" class="button pink-button">Enroll</a>
                   
                </div>
            </div>
        </div>
    @endif    
    @endforeach

@endsection