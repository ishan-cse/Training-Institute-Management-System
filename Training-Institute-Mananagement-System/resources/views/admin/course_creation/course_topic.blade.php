@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Create Course - Course Topic
@endsection

@section('main-menu-CC')
show
@endsection
@section('sub-menu-CT')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Topic</li>
            </ol>
        </nav>
    </div>


    {{-- main content start --}}

    <div class="col-lg-8 col-md-8">
        @if (session('course_topic_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_topic_updated') }}
                </div>
            </div>
        @endif
        @if (session('course_topic_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_topic_deleted') }}
                </div>
            </div>
        @endif
        
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Course Topic List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Course Topic</th>
                                <th>Course Name</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_topics as $course_topic)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $course_topic->course_topic }}</td>
                                <td>{{ $course_topic->CrsName->course_name }}</td>
                                <td>
                                    @php echo date('d-M-Y',strtotime($course_topic->created_at)) @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success  btn-block" data-toggle="modal" data-target="#update_courseName{{ $course_topic->id }}"><i data-feather="edit"></i> Edit</button>
                                    <a href="{{ url('/delete/course/topic',$course_topic->id) }}" class="btn btn-danger  btn-block"><i data-feather="trash-2"></i> Delete </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">
        @if (session('course_topic_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_topic_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add Topic</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/course/topic') }}"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Select Course Name</label>
                        <select class="form-control mb-3" name="course_name_id">
                            <option selected>Select Course Name</option>
                            @foreach ($course_names as $course_name)
                            <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Topic Name</label>
                        <input type="text" class="form-control" name="course_topic" placeholder="Topic Name" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- modal for edit data --}}
@foreach ($course_topics as $course_topic)
    <div class="modal fade" id="update_courseName{{ $course_topic->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Update Course Topic data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/update/course/topic', $course_topic->id) }}"> 
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Select Course Name</label>
                            <select class="form-control mb-3" name="course_name_id">
                                <option value="{{ $course_topic->course_name_id }}" selected>{{ $course_topic->CrsName->course_name }}</option>
                                @foreach ($course_names as $course_name)
                                <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Topic Name</label>
                            <input type="text" class="form-control" name="course_topic" value="{{ $course_topic->course_topic }}" required>
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
@endforeach


</div>


@endsection