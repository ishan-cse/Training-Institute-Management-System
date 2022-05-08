@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - View Course Topices
@endsection

@section('student_css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
<style>
    .course__item{
        position: relative
    }
    .loader-div {
        width: 100%;
        background: #8a8a8a;
        position: absolute;
        z-index: 1;
        height: 210px;
        display: flex;
        justify-content: center;
        align-items: center;
        background-repeat: no-repeat;
        background-position: center;
        background-size: contain;
    }
    .loader-div img {
        width: 50px;
    }
    .display-none{
        display:none
    }
    
    .fancybox-close{position: relative;}


</style>
@endsection

@section('student_content')

    <div class="top_part">
        <h2 class="page__heading mb-30">
            <a href="{{ url('student/home') }}">
            <svg class="icon icon-keyboard_arrow_left"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-keyboard_arrow_left"></use></svg>
            </a>
            {{ $course_detail->course_name }}
        </h2>
    </div>
        @forelse($course_topics as $course_topic)
            <div class="course__list shadow">
                
                <div class="course__icon">
                    <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
                </div>
                <div class="course__description display-flex">
                    <div class="width-60">
                        <h3>{{ $course_topic->course_topic }}</h3>
                    </div>
                    <div class="enroll-btn-area">
                        @if(checkEnroll( $course_detail->id,$course_topic->id) == 'not_found')
                         <a href="{{ url('/request/enroll/course' , $course_detail->id.'-'.$course_topic->id) }}" class="button pink-button">Enroll Now</a>
                        @else
                           <span class="button dis-btn">Request Sent</span>
                        @endif
                        
                       
                    </div>
                </div>
            </div>
        @empty
            <p>No Course Topics added from admin</p>
        @endforelse


    @section('student_js')
        @if (session('request_access'))
         <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script>
            $(window ).on("load",(function() {
              swal("Enroll Request Successfull", "Your enroll request has been submitted successfully. Please wait for a while. You will get a confirmation email.", "success")
            }));
        </script>
        @endif
    @endsection

@endsection