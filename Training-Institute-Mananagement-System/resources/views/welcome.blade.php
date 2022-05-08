@extends('layouts.auth')


@section('title')
Touhid Physics Academic and Admission Care
@endsection

@section('auth_content')


    <div class="top-part height-70">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('frontend_asset/img/logo.png') }}" alt="Logo"></a>
        </div>
    </div>
    <div class="bottom-part height-30">
    <div class="buttons">
            <a class="button pink-button d-block text-center mb-40" href="{{ url('/student/login') }}">Sign in</a>
            <a class="button border-button d-block text-center" href="{{ url('/registration') }}">Register</a>
    </div>
    </div>


@endsection