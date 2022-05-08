<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Responsive Web UI Kit &amp; Dashboard Template based on Bootstrap">
	<meta name="author" content="AdminKit">
	<meta name="keywords" content="adminkit, bootstrap, web ui kit, dashboard template, admin template">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<link rel="icon" href="{{ asset('student_asset/img/fav.png') }}" type="image/gif" sizes="56x56">

	<title>@yield('title')</title>

	<link href="{{ asset('admin_assets') }}/css/app.css" rel="stylesheet">
	<link href="{{ asset('admin_assets') }}/css/pagination.css" rel="stylesheet">
	<!--dataTable css-->
	<link rel="stylesheet" href="{{ asset('admin_assets') }}/vendor/data-table/media/css/dataTables.bootstrap.min.css">
	<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
	@yield('admin_css')
	<style>
	    .d-TR{
	        display :table-row !important;
	    }
	    .text-underline:hover{
	        text-decoration: underline !important;
	    }
	</style>
</head>

<body>
	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="
				@if (Auth::user()->role == 'Student')
				{{ url('/student/home') }}
				@else
				{{ url('/admin/home') }}
				@endif">
                    <span class="align-middle">{{ env('APP_NAME') }}</span>
                </a>

				{{-- admin and student dashboard menu --}}

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Pages
					</li>

					<li class="sidebar-item @yield('main-menu-HOME')">
						<a class="sidebar-link" href="{{ url('/admin/home') }}">
                            <i class="align-middle" data-feather="home"></i> <span class="align-middle">Dashboard</span>
                        </a>
					</li>
					<li class="sidebar-item @yield('main-menu-AS')">
						<a class="sidebar-link" href="{{ url('/view/approved/student') }}">
                            <i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Approve Students </span>
                        </a>
					</li>
					<li class="sidebar-item @yield('main-menu-PR')">
						<a class="sidebar-link" href="{{ url('/view/pending/request') }}">
                            <i class="align-middle" data-feather="users"></i> <span class="align-middle">Pending Request @if (count_pending_request() > 0) <span class="badge badge-pill badge-danger"> {{ count_pending_request() }}</span> @endif </span>
                        </a>
					</li>
                    <li class="sidebar-item @yield('main-menu-ECR')">
						<a class="sidebar-link" href="{{ url('/view/enroll/request') }}">
                            <i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Enroll Request @if (cnt_enrollcourse() > 0) <span class="badge badge-pill badge-danger"> {{ cnt_enrollcourse() }}</span> @endif </span>
                        </a>
					</li>
					<li class="sidebar-item">
						<a href="#ui" data-toggle="collapse" class="sidebar-link collapsed">
                            <i class="align-middle" data-feather="video"></i> <span class="align-middle">Course Creation</span>
                        </a>
						<ul id="ui" class="sidebar-dropdown list-unstyled collapse @yield('main-menu-CC')" data-parent="#sidebar">
							<li class="sidebar-item @yield('sub-menu-CN')"><a class="sidebar-link" href="/course/name">Course Name</a></li>
							<li class="sidebar-item @yield('sub-menu-CT')"><a class="sidebar-link" href="/course/topic">Course Topic</a></li>
							<li class="sidebar-item @yield('sub-menu-CV')"><a class="sidebar-link" href="/course/video">Add Course Video</a></li>
							<li class="sidebar-item @yield('sub-menu-AV')"><a class="sidebar-link" href="/all/video">All Course Video</a></li>
							<li class="sidebar-item @yield('sub-menu-CA')"><a class="sidebar-link" href="/course/access">Course Access</a></li>
						</ul>
					</li>
					<li class="sidebar-item @yield('main-menu-LOCATION')">
						<a class="sidebar-link" href="{{ url('/view/location') }}">
                            <i class="align-middle" data-feather="map-pin"></i> <span class="align-location">Location</span>
                        </a>
					</li>
					<li class="sidebar-item @yield('main-menu-PDF')">
						<a class="sidebar-link" href="{{ url('/library/system/pdf') }}">
                            <i class="align-middle" data-feather="file-text"></i> <span class="align-middle">PDF</span>
                        </a>
					</li>
                    <li class="sidebar-item  @yield('main-menu-NOTICE')">
						<a class="sidebar-link" href="{{ url('/view/notice') }}">
                            <i class="align-middle" data-feather="bell"></i> <span class="align-middle">Notice Board</span>
                        </a>
					</li>
				</ul>
			</div>
		</nav>

		<div class="main">
			<nav class="navbar navbar-expand navbar-light navbar-bg">
				<a class="sidebar-toggle d-flex">
                    <i class="hamburger align-self-center"></i>
                </a>

				<form class="form-inline d-none d-sm-inline-block">
					<div class="input-group input-group-navbar">
						<input type="text" class="form-control" placeholder="Search…" aria-label="Search">
						<div class="input-group-append">
							<button class="btn" type="button">
                                <i class="align-middle" data-feather="search"></i>
                            </button>
						</div>
					</div>
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav navbar-align">
						
						<li class="nav-item dropdown">
							<a class="nav-icon dropdown-toggle d-inline-block d-sm-none" href="#" data-toggle="dropdown">
                                <i class="align-middle" data-feather="settings"></i>
                            </a>

							<a class="nav-link dropdown-toggle d-none d-sm-inline-block" href="#" data-toggle="dropdown">
                                <img src="{{ asset('student_asset') }}/img/profile.jpg" class="avatar img-fluid rounded mr-1" alt="{{ Auth::user()->name }}" /> <span class="text-dark">{{ Auth::user()->name }}</span>
                            </a>
							<div class="dropdown-menu dropdown-menu-right">
								<a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="user"></i> Profile</a>
								<a class="dropdown-item" href="#"><i class="align-middle mr-1" data-feather="settings"></i> Settings & Privacy</a>
								<a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();"><i class="align-middle mr-1" data-feather="log-out"></i> Log out
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
							</div>
						</li>
					</ul>
				</div>
			</nav>

			<main class="content">
				<div class="container-fluid p-0">

                    @yield('admin_content')
					

				</div>
			</main>

			
		</div>
	</div>

	{{-- <script src="{{ asset('admin_assets') }}/js/vendor.js"></script> --}}
	<script src="{{ asset('admin_assets') }}/js/app.js"></script>
	<!--dataTable js-->
	<script src="{{ asset('admin_assets') }}/vendor/data-table/media/js/jquery.dataTables.min.js"></script>
	<script src="{{ asset('admin_assets') }}/vendor/data-table/media/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
	
	
	<script>
		$(function() {
			$('#datetimepicker-dashboard').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'L'
			});
			//DATATABLE
			// =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
			$('.data-table').DataTable({});
		});
	</script>
	@yield('admin_script')
</body>

</html>