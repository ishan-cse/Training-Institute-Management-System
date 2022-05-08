<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="icon" href="{{ asset('student_asset/img/fav.png') }}" type="image/gif" sizes="56x56">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('frontend_asset/style.css') }}">
    <script src="https://kit.fontawesome.com/1d7a3b85e6.js" crossorigin="anonymous"></script>
    @yield('auth_css')
</head>
<body>

    <div class="main-container">
       @yield('auth_content')
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    
    @yield('auth_js')
    
</body>
</html>