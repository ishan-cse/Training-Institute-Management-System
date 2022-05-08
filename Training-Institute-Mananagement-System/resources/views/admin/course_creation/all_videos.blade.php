@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care -Create Course - Course Access
@endsection

@section('main-menu-CC')
show
@endsection
@section('sub-menu-AV')
active
@endsection

@section('admin_content')

<div class="row">

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Access</li>
            </ol>
        </nav>
    </div>


    {{-- main content start --}}


    <div class="col-lg-12 col-md-12">
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
    </div>

    {{-- modal for edit data --}}
    @foreach ($course_videos as $course_video)
        <div class="modal fade" id="update_courseVideo{{ $course_video->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i data-feather="edit-2"></i> Update video data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        <form method="POST" action="{{ url('/update/course/video', $course_video->id) }}"> 
                            @csrf
                            <div class="form-group">
                                <label class="form-label">Video Title</label>
                                <textarea name="video_title" class="form-control mb-3" placeholder="Video Title" id="Video Title" cols="30" rows="2" required>{{ $course_video->video_title }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Video Link</label>
                                <textarea name="video_link" class="form-control mb-3" id="" cols="30" rows="2" required>{{ $course_video->video_link }}</textarea>
                            </div>
                            <div class="form-group">
                                <label class="form-label">Video Description</label>
                                <textarea name="video_des" class="form-control mb-3" placeholder="Video Description" id="" cols="30" rows="5" required>{{ $course_video->video_des }}</textarea>
                            </div>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success"><i data-feather="edit-3"></i> Update</button>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="view_courseVideo{{ $course_video->id }}" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title"><i data-feather="eye"></i> View Video</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body m-3">
                        
                        <iframe src="{{ $course_video->video_link }}" width="100%" height="300" allow="autoplay"></iframe>
                        
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    @endforeach

    

</div>


@endsection