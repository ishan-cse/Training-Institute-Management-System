@extends('layouts.auth')


@section('title')
Touhid Physics Academic and Admission Care - Login
@endsection

@section('auth_css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet">
    <style>
        .logo {
            margin-top: 50px;
        }
        /*.logo img{*/
        /*    width: 225px*/
        /*}*/
    </style>
@endsection



@section('auth_content')

    <div class="page_header text-center">
        <a href="{{ url('/') }}" class="back_arrow">&#10229;</a> 
        <p class="text-center">Login</p>
    </div>
    <div class="top-part height-90">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('frontend_asset/img/logo.png') }}" alt="Logo"></a>
        </div>
        
        
        <div class="forms">
            <form method="POST" action="{{ route('student_login') }}">
                @csrf

                <div class="form_group">
                    <input type="text" class="custom_input" placeholder="Student Roll" name="student_roll" value="{{ old('student_roll') }}" required autocomplete="student_roll" autofocus> 
                    @if (session('id_error'))
                    <div style="margin-top: 10px; font-size:12px">
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ session('id_error') }}</strong>
                        </span>
                    </div>
                    @endif
                </div>
                <div class="form_group">
                    <input id="password-field" type="password" class="custom_input" placeholder="Password" name="password" required autocomplete="current-password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    @if (session('password_error'))
                    <div style="margin-top: 10px; font-size:12px">
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ session('password_error') }}</strong>
                        </span>
                    </div>
                    @endif
                </div>
                <div class="form_group">
                    <button type="submit" class="button pink-button full-width-btn mb-15">
                        {{ __('Login') }}
                    </button>
                    @if (Route::has('password.request'))
                        <a class="btn btn-link" href="{{ route('password.request') }}">
                            {{ __('Forgot Your Password?') }}
                        </a>
                    @endif
                </div>
                <div class="form_group">
                    <a href="#" class="google-btn"><img src="https://www.freepnglogos.com/uploads/google-logo-png/google-logo-icon-png-transparent-background-osteopathy-16.png" width="30" alt="Goolgle Logo" /> Sign in with google</a>
                </div>
               
            </form>
        </div>
    </div>
    <div class="bottom-part height-10">
    <div class="footers-link">
        <span>Don't have an account? <a class="link-text" href="{{ url('/registration') }}">Register here</a></span>
    </div>


@section('auth_js')
    @if (session('registration_done'))
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script>
        $( window ).on("load",(function() {
          swal("Registration Successfull", "Your registration has been submitted successfully. Please wait for a while. You will get a confirmation email with your roll number. After getting your roll number you can log into your account.", "success")
        }));
    </script>
    @endif
    
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
    </script>
@endsection

@endsection

