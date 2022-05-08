@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Create Course - Course Access
@endsection

@section('main-menu-CC')
show
@endsection
@section('sub-menu-CA')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Access</li>
            </ol>
        </nav>
    </div>


    {{-- main content start --}}

    <div class="col-lg-7 col-md-7">
        @if (session('already_given'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('already_given') }}
                </div>
            </div>
        @endif
        @if (session('access_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('access_deleted') }}
                </div>
            </div>
        @endif
        
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Course Access List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Course Name</th>
                                <th>Topic Name</th>
                                <th>Course Access</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_topics as $course_topic)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $course_topic->CrsName->course_name }}</td>
                                <td>{{ $course_topic->course_topic }}</td>
                                <td>
                                    <button type="button" class="btn btn-success  btn-block" data-toggle="modal" data-target="#view_access{{ $course_topic->id }}"><i data-feather="eye"></i> View Access</button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-5 col-md-5">
        @if (session('access_given'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('access_given') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="users"></i> Give Course Access</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="/give/course/access"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Select Course</label>
                        <select id="course_name" class="form-control mb-3" name="course_id">
                            <option value="">Select Course</option>
                            @foreach ($course_names as $course_name)
                            <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Topic Name</label>
                        <select id="course_topic" class="form-control mb-3" name="topic_id" required>
                            <option>Select Topic Name</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Student</label>
                        <select id="notice_for" class="form-control mb-3 select2" name="student_id[]" multiple>
                            <option value="">Select Single or Multiple Student</option>
                            @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->student_roll }}</option>
                            @endforeach
                        </select>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i data-feather="user-plus"></i> Give Access</button>
                </form>
            </div>
        </div>
    </div>

    

</div>


@foreach ($course_topics as $course_topic)

    <div class="modal fade" id="view_access{{ $course_topic->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="users"></i> Notice Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    
                    <div class="row">
                        <div class="col-sm-12">
                            <h2 class="h4 text-center">Students</h2>
                            <hr/>
                            <table class="table text-center table-borderless">
                                <tr>
                                    <th>Sl. No</th>
                                    <th>Student Name</th>
                                    <th>Access Date</th>
                                    <th>Action</th>
                                </tr>
                                @forelse (get_video_accesses($course_topic->course_name_id , $course_topic->id) as $student_access)
                                <tr class="alert alert-dismissible d-TR" role="alert">
                                    <td>{{ $loop->index + 1 }}</td>
                                    <td>{{ $student_access->CourseStudent->name }}</td>
                                    <td>@php echo date('d-M-Y',strtotime($student_access->created_at)) @endphp</td>
                                    <td>
                                        <button type="button" onclick="remove('{{ $student_access->id }}')" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </td>
                                </tr>
                                
                                @empty
                                <tr>
                                    <td colspan="4"><span class="text-waring text-center">No Access Found!</span></td>
                                </tr>
                                @endforelse
                            </table>
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    
@endforeach


@section('admin_script')
    
    <script>
        $(function() {
			$('#course_name').change(function(){
                var course_name_id =  $('#course_name').val();
        
                // alert(course_name_id);

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // ajax request send
                $.ajax({
                    type:'POST',
                    url:'/get/course_topic/list',
                    data:{course_name_id:course_name_id},
                    success: function(data) {
                        $('#course_topic').html(data);
                        // alert(data);
                    }
                });
            });
		});
    
        function remove(id){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ajax request send
            $.ajax({
                type:'POST',
                url:'/remove/acccess',
                data:{id:id},
                success: function(data) {
                    // $('#course_topic').html(data);
                    alert('Successfully remove from course access');
                }
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.select2').select2();
        });
        
    </script>

@endsection
@endsection











