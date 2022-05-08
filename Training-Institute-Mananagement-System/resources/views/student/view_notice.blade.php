@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - Notice Board
@endsection
@section('notice')
active
@endsection
@section('MM_notice')
main__menu-active
@endsection



@section('student_content')
    <div class="top_part">
    <h2 class="page__heading mb-30">
        <a href="{{ url('student/home') }}">
            <svg class="icon icon-keyboard_arrow_left"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-keyboard_arrow_left"></use></svg>
        </a>
        Notice Board
    </h2>
    </div>
    @foreach ( view_course_access(Auth::id()) as $view_course_accss )
        @foreach (course_noticeAccess($view_course_accss->course_id) as $course_notice)
        @if(check_sameNotice($course_notice->notice_id,Auth::id()) == 'Show')
            <button class="course-accordion course__list shadow">
                <div class="course__icon">
                    <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
                </div>
                <div class="course__description">
                    <a href="#">
                        <h3>{{ $course_notice->Notices->notice_title }}</h3>
                    </a>
                </div>
            </button>
            <!-- This div holds the content to be displayed-->
            <div class="course-panel">
                <div class="notice">
                    <span class="copy">
                        <svg class="icon icon-attachment"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-attachment"></use></svg>
                    </span>
    
                    <textarea class="notice-content" rows="4">{{ $course_notice->Notices->notice }}</textarea>
                </div>
            </div>
        @endif
        @endforeach
    @endforeach
    @foreach ($self_notices as $self_notice)
        
        <button class="course-accordion course__list shadow">
            <div class="course__icon">
                <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
            </div>
            <div class="course__description">
                <a href="#">
                    <h3>{{ $self_notice->Notices->notice_title }}</h3>
                </a>
            </div>
        </button>
        <!-- This div holds the content to be displayed-->
        <div class="course-panel">
            <div class="notice">
                <span class="copy">
                    <svg class="icon icon-attachment"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-attachment"></use></svg>
                </span>

                <textarea class="notice-content" rows="4">{{ $self_notice->Notices->notice }}</textarea>
            </div>
        </div>

    @endforeach

    



@section('student_js')

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
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

    $(function(){
        $('.copy').click(function(){
            var copyTextarea = $(this).next();
            copyTextarea.focus();
            copyTextarea.select();

            try {
                var successful = document.execCommand('copy');
                var msg = successful ? 'successful' : 'unsuccessful';
                console.log('Copying text command was ' + msg);
            } catch (err) {
                console.log('Oops, unable to copy');
            }
        })
    })


    </script>
    
@endsection


@endsection