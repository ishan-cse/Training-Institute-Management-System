@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Create Course - Course Video
@endsection

@section('main-menu-CC')
show
@endsection
@section('sub-menu-CV')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Video</li>
            </ol>
        </nav>
    </div>


    {{-- main content start --}}

    {{-- <div class="col-lg-8 col-md-8">
        @if (session('course_video_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_video_updated') }}
                </div>
            </div>
        @endif
        @if (session('course_video_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_video_deleted') }}
                </div>
            </div>
        @endif
        
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Course Video List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Course Name</th>
                                <th>Course Topic</th>
                                <th>Video Title</th>
                                <th>Course Video</th>
                                <th>Course Description</th>
                                <th>Dates</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_videos as $course_video)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $course_video->CrsName->course_name }}</td>
                                <td>{{ $course_video->CrsTopic->course_topic }}</td>
                                <td>{{ $course_video->video_title }}</td>
                                <td>
                                    <button type="button" class="btn btn-success  btn-block" data-toggle="modal" data-target="#view_courseVideo{{ $course_video->id }}"><i data-feather="eye"></i> View</button>
                                    
                                    
                                </td>
                                <td>{{ $course_video->video_des }}</td>
                                <td>
                                    <span class="badge badge-info">Class Date: @php echo date('d-M-Y',strtotime($course_video->class_date)) @endphp</span><br/>
                                    <span class="badge badge-primary">Published Date: @php echo date('d-M-Y',strtotime($course_video->created_at)) @endphp</span>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success  btn-block" data-toggle="modal" data-target="#update_courseVideo{{ $course_video->id }}"><i data-feather="edit"></i> Edit</button>
                                    <a href="{{ url('/delete/course/video',$course_video->id) }}" class="btn btn-danger  btn-block"><i data-feather="trash-2"></i> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="mx-auto col-lg-6 col-md-6">
        @if (session('course_video_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_video_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add Course Video</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/course/video') }}"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Select Course Name</label>
                        <select id="course_name" class="form-control mb-3" name="course_name_id">
                            <option selected>Select Course Name</option>
                            @foreach ($course_names as $course_name)
                            <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Topic Name</label>
                        <select id="course_topic" class="form-control mb-3" name="course_topic_id">
                            <option selected>Select Topic Name</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Video Title</label>
                        <textarea name="video_title" class="form-control mb-3" placeholder="Video Title" id="Video Title" cols="30" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Video Link</label>
                        <textarea name="video_link" class="form-control mb-3" placeholder="https://your video link" id="" cols="30" rows="2" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Video Description</label>
                        <textarea name="video_des" class="form-control mb-3" placeholder="Video Description" id="" cols="30" rows="5" required></textarea>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Class Date</label>
                        <input type="date" name="class_date" class="form-control mb-3" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>

    

</div>

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
    </script>
@endsection


@endsection