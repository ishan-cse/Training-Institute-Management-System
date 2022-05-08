<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('student_asset/img/fav.png') }}" type="image/gif" sizes="56x56">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('student_asset') }}/inner-style.css">
    <link rel="stylesheet" href="{{ asset('student_asset') }}/custom.css">
    <title>@yield('title')</title>
    @yield('student_css')
    <style>
        .header-menu-icon {
            position: absolute;
            width: 20px;
            right: 15px;
            z-index: 999;
            top: 18px;
            cursor: pointer;
        }
        .menu-icon {
            content: '';
            width: 100%;
            height: 3px;
            background: #f2f7fd;
            margin-bottom: 4px;
        }
        .header-menu-icon:hover .menu-icon{
            background: #fb90b2;
            transition: .2s;
        }
        .menu-contents {
            width: 100%;
            position: absolute;
            background: #5966f3;
            left: 0;
            height: 100%;
            z-index: 9;
            bottom: 0;
            top: 0;
            transform: scaleY(0);
            transform-origin: top;
        }
        .nav_active{
            background: #fb90b2;
        }
        .footer{
            z-index: 99;
        }
        .menus{
            width: 100%;
            padding: 0px 30px;
            /*margin-top: 60px;*/
        }
        .menu-items {
           width: 100%;
            
        }
        .main__menu-active{
            background: #4a56de !important;
        }
        .menu__list{
            margin-bottom: 5px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            padding: 5px 15px;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 20px;
            background: none;
        }
        .menu__list:hover {
            background: #4a56de;
        }
        .menu__icon {
            width: 35px;
            height: 35px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-pack: center;
            -ms-flex-pack: center;
            justify-content: center;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            border-radius: 10px;
            margin-right: 15px;
        }
        .menu__icon svg{
            fill: #fff;
            width: 22px;
        }
        .menu__description h3 {
            font-size: 14px;
            color: #fff;
        }
        .menu-items a {
            text-decoration: none;
        }
        .menu__hedding {
            text-align: center;
            /* margin-bottom: 0; */
            padding: 15px 0px;
        }
        .display-flex{
            display: flex;
            width: 100%;
            align-items: center;
        }
        .width-60{
            width:60%;
        }
        .enroll-btn-area{
            width:40%;
            text-align: right;
        }
        .menu__hedding h3 {
            font-size: 18px;
            font-weight: 500;
            color:#fff;
        }
        .badge.badge-primary {
            margin-left: 20px;
            border-radius: 10px;
            height: 25px;
            width: 25px;
            background: #5966f3;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: bold;
            color: #fff;
        }
        @media screen and (max-width: 486px) {
          a.button.pink-button , .dis-btn{
                font-size: 10px;
                padding: 5px 10px;
            }
        }
        @media screen and (max-width: 349px) {
          a.button.pink-button , .dis-btn{
                font-size: 8px;
            }
        }
    </style>
</head>
<body onload="@yield('body_js')">
    <div class="container h-100vh p-30">
        <div class="header-menu-icon">
            <div class="menu-icon"></div>
            <div class="menu-icon"></div>
            <div class="menu-icon"></div>
        </div>
        
        <div class="menu-contents">
            <div class="menu__hedding">
                <h3>Mian Menu</h3>
            </div>
            <div class="menus">
                <div class="menu-items">
                    <a href="{{ url('/student/home') }}">
                        <div class="menu__list @yield('MM_home')">
                            <div class="menu__icon">
                                <svg class="icon icon-home"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-home"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Home</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ url('/my/courses') }}">
                        <div class="menu__list  @yield('MM_courses')">
                            <div class="menu__icon">
                                <svg class="icon icon-file-text2"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-file-text2"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Courses</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ url('/student/pdfs') }}">
                        <div class="menu__list @yield('MM_pdfs')">
                            <div class="menu__icon">
                                <svg class="icon icon-books"><use xlink:href="{{ asset('student_asset') }}/icons/book.svg#icon-books"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Pdfs</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ url('/student/notice') }}">
                        <div class="menu__list @yield('MM_notice')">
                            <div class="menu__icon">
                                <svg class="icon icon-bell-o"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-bell-o"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Notice</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ url('/student/edit/profile') }}">
                        <div class="menu__list @yield('MM_edit-profile')">
                            <div class="menu__icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M7.127 22.562l-7.127 1.438 1.438-7.128 5.689 5.69zm1.414-1.414l11.228-11.225-5.69-5.692-11.227 11.227 5.689 5.69zm9.768-21.148l-2.816 2.817 5.691 5.691 2.816-2.819-5.691-5.689z"/></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Edit Profile</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ url('/change/password') }}">
                        <div class="menu__list @yield('MM_password')">
                            <div class="menu__icon">
                                <svg class="icon icon-settings"><use xlink:href="{{ asset('student_asset') }}/icons/settings.svg#icon-settings"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Change Password</h3>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="menu-items">
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <div class="menu__list">
                            <div class="menu__icon">
                                <svg class="icon icon-lock"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-lock"></use></svg>
                            </div>
                            <div class="menu__description">
                                <h3>Logout</h3>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        @yield('student_content')

        <div class="footer">
            <a href="{{ url('/student/home') }}" class="@yield('home')">
                <svg class="icon icon-home"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-home"></use></svg>
            </a>
            <a href="{{ url('/student/pdfs') }}" class="@yield('FM_pdfs')">
                <svg class="icon icon-books"><use xlink:href="{{ asset('student_asset') }}/icons/book.svg#icon-books"></use></svg>
            </a>
            <a href="{{ url('/student/notice') }}" class="@yield('notice')">
                <svg class="icon icon-bell-o"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-bell-o"></use></svg>
            </a>
            
            
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <svg class="icon icon-lock"><use xlink:href="{{ asset('student_asset') }}/icons/icons.svg#icon-lock"></use></svg>
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>
        $(".header-menu-icon").click(function() {
            $('.menu-icon').toggleClass('nav_active');
            // $(".menu-contents").addClass('clicked');
            
            if($(".menu-contents").hasClass('clicked')){
                $(".menu-contents").css({'transform':'scaleY(0)','transition':'.5s'}); 
                $(".menu-contents").removeClass('clicked');
            }else{
                $(".menu-contents").css({'transform':'scaleY(1)','transition':'.5s'});
                $(".menu-contents").addClass('clicked');
            }
             
            
            
        });
    </script>
    @yield('student_js')
    
</body>
</html>