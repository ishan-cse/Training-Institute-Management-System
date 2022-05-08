@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Enroll Course Request
@endsection

@section('main-menu-ECR')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a> </li>
                <li class="breadcrumb-item active">View Enroll Request</li>
            </ol>
        </nav>
    </div>
    
     <div class="col-xl-12">
        @if (session('enroll_approved'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('enroll_approved') }}
                </div>
            </div>
        @endif
        @if (session('enroll_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('enroll_deleted') }}
                </div>
            </div>
        @endif
        
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Approve Student List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Student Name</th>
                                <th>Course Name</th>
                                <th>Topic Name</th>
                                <th>Request Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($enroll_requests as $enroll_request)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{!!  App\Models\User::where('id', $enroll_request->student_id)->value('name') !!}</td>
                                <td>{{ App\Models\CourseName::find($enroll_request->course_id)->course_name }}</td>
                                <td>{{ App\Models\CourseTopic::find($enroll_request->topic_id)->course_topic }}</td>
                                <td>@php echo date('d-M-Y',strtotime($enroll_request->created_at)) @endphp</td>
                                <td>
                                    <a href="{{ url('/give/enroll/request',$enroll_request->id) }}" class="btn btn-success ">Enroll Access</a>
                                    <a href="{{ url('/delete/enroll/request',$enroll_request->id) }}" class="btn btn-danger ">Remove Request</a>
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


@endsection