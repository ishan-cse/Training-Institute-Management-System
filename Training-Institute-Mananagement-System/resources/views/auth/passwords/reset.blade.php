@extends('layouts.auth')


@section('title')
Touhid Physics Academic and Admission Care - Reset Password
@endsection

@section('auth_css')
    <style>
        .logo {
            margin-top: 50px;
        }
        .logo img{
            width: 225px
        }
        .alert {
            padding: 20px;
            font-size: 15px;
            border-radius: 7px;
        }
        .alert-success{
            background: rgb(53, 202, 53);
            color: #fff;
        }
    </style>
@endsection



@section('auth_content')

    <div class="page_header text-center">
        {{-- <a href="{{ url('/student/login') }}" class="back_arrow">&#10229;</a>  --}}
        <p class="text-center">Password Reset</p>
    </div>
    <div class="top-part height-90">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('frontend_asset/img/logo.png') }}" alt="Logo"></a>
        </div>
        <div class="forms">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            <form method="POST" action="{{ route('password.update') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="form_group">

                    <input id="email" type="email" placeholder="Email" class="custom_input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                    <div style="margin-top: 10px">
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <div class="form_group">

                    <input id="password" placeholder="********" type="password" class="custom_input @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password"></span>
                    <div style="margin-top: 10px">
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                </div>
                <div class="form_group">

                    <input id="password-confirm" placeholder="********" type="password" class="custom_input" name="password_confirmation" required autocomplete="new-password">
                    <span toggle="#password-field" class="fa fa-fw fa-eye-slash field-icon toggle-password-con"></span>
                </div>
                
                <div class="form_group">
                    <button type="submit" style="font-size: 14px" class="button pink-button full-width-btn mb-15">
                        Reset Password
                    </button>
                </div>
               
            </form>
        </div>
    </div>
    <div class="bottom-part height-10">
    <div class="footers-link">
        <span>2021 &copy; all right resarved</span>
    </div>
    </div>


@section('auth_js')
    <script>
        $(".toggle-password").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $('#password');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
        $(".toggle-password-con").click(function() {

            $(this).toggleClass("fa-eye fa-eye-slash");
            var input = $('#password-confirm');
            if (input.attr("type") == "password") {
                input.attr("type", "text");
            } else {
                input.attr("type", "password");
            }
        });
    </script>
@endsection

@endsection

