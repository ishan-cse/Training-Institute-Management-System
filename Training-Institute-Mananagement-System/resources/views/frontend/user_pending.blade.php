@extends('layouts.auth')
@section('title')
Touhid Physics Academic and Admission Care
@endsection
@section('auth_content')

    <div class="page_header text-center">
        {{-- <a href="{{ url('/') }}" class="back_arrow">&#10229;</a>  --}}
        <h2 class="text-center">Request on Pending</h2>
    </div>
    <div class="top-part height-90">
        <div class="logo">
            <a href="{{ url('/') }}"><img src="{{ asset('frontend_asset/img/logo.png') }}" alt="Logo"></a>
        </div>
        <div class="request-pending text-center" style="margin-top: 20px">
            <h2 class="text-pink" style="margin-bottom: 20px">Your request on pending waiting for admin approval</h2>
            <a class="link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> {{ __('Logout') }}</a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <div class="bottom-part height-10">
    <div class="footers-link">
        <span>2021 &copy; all right resarved</span>
    </div>
















{{-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Registration Pending</div>

                <div class="card-body">
                   <span class="text-danger font-weight-bold">Your request on pending waiting for admin approval</span>
                </div>
            </div>
        </div>
    </div>
</div> --}}
@endsection
