@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - My Courses
@endsection

@section('MM_courses')
main__menu-active
@endsection



@section('student_content')
   
    <div class="top_part">
        <h2 class="page__heading mb-30">
            <a href="{{ url('student/home') }}">
                <svg class="icon icon-keyboard_arrow_left"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-keyboard_arrow_left"></use></svg>
            </a>
            My Courses
        </h2>
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