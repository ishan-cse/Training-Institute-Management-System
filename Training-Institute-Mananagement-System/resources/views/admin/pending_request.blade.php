@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Student Pending Requests
@endsection

@section('main-menu-PR')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Pending Request</li>
            </ol>
        </nav>
    </div>

    <div class="col-xl-12">
        @if (session('student_deleted'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('student_deleted') }}
                </div>
            </div>
        @endif
        @if (session('request_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('request_updated') }}
                </div>
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    <ul style="margin:0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Pending Student List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Student Name</th>
                                <th>Details</th>
                                <th>Course</th>
                                <th>College</th>
                                <th>Request Date</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($pending_requests as $pending_request)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $pending_request->name }}</td>
                                <td>
                                    <span class="badge badge-primary">Mobile Number : {{ $pending_request->mobile }}</span><br/>
                                    <span class="badge badge-primary">Email : {{ $pending_request->email }}</span><br/>
                                    <span class="badge badge-primary">Blood Group : {{ $pending_request->blood_grp }}</span>
                                </td>
                                <td><span class="badge badge-info">{{ $pending_request->UsrCrs->course_name }}</span></td>
                                <td>{{ $pending_request->clg_name }}</td>
                                <td>@php echo date('d-M-Y',strtotime($pending_request->created_at)) @endphp</td>
                                <td><span class="badge badge-warning">{{ $pending_request->status }}</span></td>
                                <td>
                                    <button type="button" class="btn  btn-success btn-block" data-toggle="modal" data-target="#approve_student_{{ $pending_request->id }}"> Approve</button>
                                    {{-- <a href="{{ url('/approve/pending/student',$pending_request->id) }}" class="btn  btn-success btn-block">Approve</a> --}}
                                    <a href="{{ url('/delete/student',$pending_request->id) }}" class="btn  btn-danger btn-block">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



{{-- modal for edit data --}}
@foreach ($pending_requests as $pending_request)
    <div class="modal fade" id="approve_student_{{ $pending_request->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Give a unique studnet roll</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/approve/pending/student',$pending_request->id) }}"> 
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Student Unique Roll</label>
                            <input type="text" name="student_roll" placeholder="Student Roll" class="form-control mb-3" id="">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Enrolled Course Name</label>
                            <input type="text" value="{{ $pending_request->UsrCrs->course_name }}" class="form-control mb-3" readonly />
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Course Topic</label>
                            <select id="course_topic" class="form-control mb-3" name="topic_id">
                                @foreach(get_topics($pending_request->course_id) as $get_topic)
                                <option value="{{ $get_topic->id }}">{{ $get_topic->course_topic }}</option>
                                @endforeach
                            </select>
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
@endsection