@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - View Course
@endsection

@section('student_css')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
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

    
        @foreach ($course_topics as $course_topic)
            @if(check_courseTopics( $course_detail->id,$course_topic->id,Auth::id()) =='found')
                <button class="course-accordion course__list shadow">
                    <div class="course__icon">
                        <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
                    </div>
                    <div class="course__description">
                        <a href="#">
                            <h3>{{ $course_topic->course_topic }}</h3>
                        </a>
                    </div>
                </button>
            @else
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
            @endif
            <!-- This div holds the content to be displayed-->
            <div class="course-panel">
                <ul class="course__items">
                @forelse (course_videos($course_detail->id,$course_topic->id) as $ctn => $video)
                    <li class="course__item fancybox-close"> 
                        <iframe onclick="pauseAll('{{ $ctn }}')" width="100%" height="210px" class="lazyload"  loading="lazy" src="{{ asset('student_asset') }}/img/load.gif" data-src="{{ $video->video_link }}" allowfullscreen="true">
                        </iframe>
                        <div style="width: 80px; height: 80px; position: absolute; opacity: 0; right: 0px; top: 0px;">&nbsp;</div>
                        <div style="display:flex">
                            <h3 style="width:80%">{{ $video->video_title }}</h3>
                            <a download="{{ $video->video_link }}" >downlaod</a>
                        </div>
                    </li>
                @empty
                <p>No video added from admin</p>
                @endforelse
                </ul>
            </div>
        @endforeach
        

    
        
    

    @section('student_js')
    <script>
        //this is the button
        var acc = document.getElementsByClassName("course-accordion");
        var i;

        for (i = 0; i < acc.length; i++) {
            //when one of the buttons are clicked run this function
            acc[i].onclick = function() {
            //variables
            var panel = this.nextElementSibling;
            var coursePanel = document.getElementsByClassName("course-panel");
            var courseAccordion = document.getElementsByClassName("course-accordion");
            var courseAccordionActive = document.getElementsByClassName("course-accordion active");

            /*if pannel is already open - minimize*/
            if (panel.style.maxHeight){
                //minifies current pannel if already open
                panel.style.maxHeight = null;
                //removes the 'active' class as toggle didnt work on browsers minus chrome
                this.classList.remove("active");
            } else { //pannel isnt open...
                //goes through the buttons and removes the 'active' css (+ and -)
                for (var ii = 0; ii < courseAccordionActive.length; ii++) {
                    courseAccordionActive[ii].classList.remove("active");
                }
                //Goes through and removes 'activ' from the css, also minifies any 'panels' that might be open
                for (var iii = 0; iii < coursePanel.length; iii++) {
                this.classList.remove("active");
                coursePanel[iii].style.maxHeight = null;
                }
                //opens the specified pannel
                panel.style.maxHeight = panel.scrollHeight + "px";
                //adds the 'active' addition to the css.
                this.classList.add("active");
                } 
            }//closing to the acc onclick function
        }//closing to the for loop.



        if ('loading' in HTMLIFrameElement.prototype) {
            const iframes = document.querySelectorAll('iframe[loading="lazy"]');
            
            iframes.forEach(iframe => {
                iframe.src = iframe.dataset.src;
            });

        }
        

        
    </script>
        @if (session('request_access'))
         
        <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
        <script>
            $(window ).on("load",(function() {
              swal("Enroll Request Successfull", "Your enroll request has been submitted successfully. Please wait for a while. You will get a confirmation email.", "success")
            }));
        </script>
        @endif

    @endsection
    

@endsection