@extends('layouts.student_app')
@section('title')
Touhid Physics Academic and Admission Care - Edit Profile
@endsection
@section('password')
active
@endsection
@section('MM_password')
main__menu-active
@endsection
@section('student_css')
    <style>
        .button{
            padding: 15px 20px;
            text-decoration: none;
            text-transform: uppercase;
            font-size: 20px;
            font-weight: 500;
            border-radius: 50px;
            cursor: pointer;
        }
        .full-width-btn{
            width: 100%;
        }
        .pink-button{
            background: #fa80b2;
            border: 2px solid #fa80b2;
            color: #fff;
        }
        .border-button{
            background: transparent;
            border: 2px solid #fff;
            color: #fff;
        }
        .border-button:hover{
            background: #fff;
            color: #fa80b2;
            transition: all 0.3s;
        }
        .pink-button:hover{
            background: transparent;
            color: #fa80b2;
            transition: all 0.3s;
        }
        .form_group {
            width: 100%;
            margin-bottom: 20px;
            color: #656565;
        }
        .custom_input {
            padding: 5px 10px;
            width: 100%;
            background: transparent;
            border: none;
            margin-top: 5px;
            border-bottom: 1px solid rgb(97, 97, 97);
        }
        .custom_input:focus-visible{
            outline: none;
            border-bottom: 1px solid #fa80b2;
        }
        .form-label{
            padding-left: 10px;
            color: #5966f3;
        }
    </style>

@endsection
@section('student_content')

    <div class="top_part">
        <h2 class="page__heading mb-30">
            <a href="{{ url('student/home') }}">
            <svg class="icon icon-keyboard_arrow_left"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-keyboard_arrow_left"></use></svg>
            </a>
            Change Password
        </h2>
    </div>
    @if ($errors->all())
        @foreach ($errors->all() as $error)
        <div  style="color: #ffffff;font-size:12px;background: #ffa2c8bd;padding: 10px;margin-bottom: 20px;">
            <span>{{ $error }}</span>
        </div>
        @endforeach
    @endif
    @if(session('old_pass_error'))
    <div  style="color: #ffffff;font-size:12px;background: #ffa2c8bd;padding: 10px;margin-bottom: 20px;">
         <span>{{ session('old_pass_error') }}</span>
    </div>
    @endif
    @if(session('pass_updated'))
    <div  style="color: #ffffff;font-size:12px;background: #ffa2c8bd;padding: 10px;margin-bottom: 20px;">
         <span>{{ session('pass_updated') }}</span>
    </div>
    @endif
    @if(session('old_pass_same'))
    <div  style="color: #ffffff;font-size:12px;background: #ffa2c8bd;padding: 10px;margin-bottom: 20px;">
         <span>{{ session('old_pass_same') }}</span>
    </div>
    @endif
    <div class="forms-fields">
         <form method="POST" action="{{ url('/update/password', Auth::id()) }}">
            @csrf

            <div class="form_group">
                <label class="form-label">Old Password:</label>
                <input type="text" class="custom_input" name="old_password" value="{{old('old_password') }}" placeholder="********">
            </div>
            <div class="form_group">
                <label class="form-label">New Password:</label>
                <input type="text" class="custom_input" name="password" placeholder="********" required>
            </div>
            <div class="form_group">
                <label class="form-label">Confrim Password:</label>
                <input type="text" class="custom_input" name="password_confirmation" placeholder="********" required>
            </div>
            <div class="form_group">
                <button type="submit" style="margin:20px 0px" class="button pink-button full-width-btn">Chnage Password</button>
            </div>
        </form>
    </div>
    
       
@endsection