@extends('layouts.auth')


@section('title')
Touhid Physics Academic and Admission Care - Login
@endsection

@section('auth_css')
    <style>
        .top-part{
            margin-top: 25px
        }
        #myBtn{
            cursor: pointer;
            text-decoration:underline;
        }
        #myBtn:hover{
            color: #5966f3;
        }
        .terms_hedding {
            color: #5966f3;
            margin-bottom: 20px;
        }
        ul.terms {
            color: #5966f3;
            list-style: bengali;
            margin-left: 20px;
        }
        ul.terms li {
            margin-bottom: 20px;
        }
        .forms h3{
                margin-bottom:50px;
        }
        /* respoinsive */
        @media screen and (max-width:992px){
            .forms h3{
                margin-bottom:30px;
            }
        }
        @media screen and (max-width:360px){
            .form_group {
                margin-bottom: 15px;
            }
            .forms h3{
                margin-bottom: unset
            }
        }
        @media screen and (max-width:320px){
            .form_group {
                margin-bottom: 10px;
            }
            .forms h3{
                margin-bottom: unset
            }
        }
    </style>
@endsection



@section('auth_content')

    <div class="page_header text-center">
        <a href="{{ url('/') }}" class="back_arrow">&#10229;</a> 
        <p class="text-center">Registration</p>
    </div>
    <div class="top-part height-90">
        
        <div class="forms">
            <h3>CREATE A NEW ACCOUNT</h3>
            @if ($errors->any())
                <div class="text-danger" style="font-size:12px;background: #eaeaea;padding: 5px;margin-bottom: 20px;">
                    @foreach ($errors->all() as $error)
                        <strong>{{ $error }}</span><br/>
                    @endforeach
                </div>
            @endif
            

            <form method="POST" action="{{ url('/post/registration') }}">
                @csrf

                <div class="form_group">
                    <input type="text" class="custom_input" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                </div>

                <div class="form_group">
                    <input type="text" class="custom_input" name="clg_name" value="{{ old('clg_name') }}" required autocomplete="clg_name" placeholder="College Name" autofocus>
                </div>

                <div class="form_group">
                    <input type="text" class="custom_input" name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" placeholder="Mobile Number" autofocus>
                </div>

                <div class="form_group">
                    <input type="email" class="custom_input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address">
                </div>

                <div class="form_group">
                    <input type="text" class="custom_input" name="blood_grp" value="{{ old('blood_grp') }}" required autocomplete="blood_grp" placeholder="Blood Group">
                </div>

                <div class="form_group">
                    <select class="custom_input" name="course_id" required>
                        <option value="">Select Course</option>
                        @foreach ($course_names as $course_name)
                        <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form_group">
                    <input type="password" id="password-field" class="custom_input" name="password" required autocomplete="new-password" placeholder="Password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                </div>

                <div class="form_group">
                    <input type="password" class="custom_input" name="password_confirmation" required autocomplete="new-password" id="confrim_password" placeholder="Confirm Password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password-con"></span>
                </div>

                <div class="form_group">
                    <input type="checkbox" class="" name="terms_condition" required><span id="myBtn"> I agree with terms and conditions</span> 
                </div>

                <div class="form_group">
                    <button type="submit" style="margin:20px 0px" class="button pink-button full-width-btn">Registration</button>
                </div>
            </form>

        </div>
    </div>
    <div class="bottom-part height-10">
    <div class="footers-link">
        <span>Already have an account? <a class="link-text" href="{{ url('/student/login') }}">Sign in</a></span>
    </div>

    

    <!-- The Modal -->
    <div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <h2 class="terms_hedding">শর্তাবলিঃ</h2>
        <ul class="terms">
            <li>মাসের বেতন ১০ তারিখের মাঝে অগ্রিম পরিশোধ করতে হবে </li>
            <li>ভর্তি ফি অফেরতযোগ্য </li>
            <li>পর পর দুই মাসের বেতন বকেয়া থাকলে ভর্তি বাতিল বলিয়া গণ্য হবে </li>
            <li>ক্লাস ও পরীক্ষায় অনুপস্থিত থাকা শাস্তিযোগ্য অপরাধ </li>
            <li>যেকোন অস্বাভাবিক পরিস্থিতিতে কর্তৃপক্ষ ভর্তি বাতিলের ক্ষমতা রাখে </li>
        </ul>
    </div>

</div>

@section('auth_js')


<script>


    $(".toggle-password").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $($(this).attr("toggle"));
        if (input.attr("type") == "password") {
        input.attr("type", "text");
        } else {
        input.attr("type", "password");
        }
    });
    $(".toggle-password-con").click(function() {

        $(this).toggleClass("fa-eye fa-eye-slash");
        var input = $('#confrim_password');
        if (input.attr("type") == "password") {
            input.attr("type", "text");
        } else {
            input.attr("type", "password");
        }
    });


    // Get the modal
    var modal = document.getElementById("myModal");

    // Get the button that opens the modal
    var btn = document.getElementById("myBtn");

    // Get the <span> element that closes the modal
    var span = document.getElementsByClassName("close")[0];

    // When the user clicks on the button, open the modal
    btn.onclick = function() {
    modal.style.display = "block";
    }

    // When the user clicks on <span> (x), close the modal
    span.onclick = function() {
    modal.style.display = "none";
    }

    // When the user clicks anywhere outside of the modal, close it
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>



@endsection

@endsection






















{{-- @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-7">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
                        <div class="card">
                <div class="card-header">Registration</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/post/registration') }}">
                        @csrf

                        <div class="form_group">
                            <input type="text" class="custom_input" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="Name" autofocus>
                        </div>

                        <div class="form_group">
                            <input type="text" class="custom_input" name="clg_name" value="{{ old('clg_name') }}" required autocomplete="name" placeholder="College Name" autofocus>
                        </div>

                        <div class="form_group">
                            <input type="text" class="custom_input" name="mobile" value="{{ old('mobile') }}" required autocomplete="name" placeholder="Mobile Number" autofocus>
                        </div>

                        <div class="form_group">
                            <input type="email" class="custom_input" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="E-Mail Address">
                        </div>

                        <div class="form_group">
                            <input type="text" class="custom_input" name="blood_grp" value="{{ old('blood_grp') }}" required autocomplete="email" placeholder="Blood Group">
                        </div>

                        <div class="form_group">
                            <select class="custom_input" name="course_id">
                                <option value="" selected>Select Course</option>
                                @foreach ($course_names as $course_name)
                                <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form_group">
                            <input type="password" class="custom_input" name="password" required autocomplete="new-password" placeholder="Password">
                            
                        </div>

                        <div class="form_group">
                            <input type="password" class="custom_input" name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password">
                        </div>

                        <div class="form_group">
                            <button type="submit" class="btn btn-primary btn-block">Registration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
