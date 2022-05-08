@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Student Pending Requests
@endsection

@section('main-menu-AS')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Approve Students</li>
            </ol>
        </nav>
    </div>

    <div class="col-xl-12">
        
        @if (session('student_updated'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('student_updated') }}
                </div>
            </div>
        @endif
        
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
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Approve Student List</h1>
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
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($approve_students as $approve_student)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                    {{ $approve_student->name }}<br/>
                                    <span class="badge badge-primary">Roll : {{ $approve_student->student_roll }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-primary">Mobile Number : {{ $approve_student->mobile }}</span><br/>
                                    <span class="badge badge-primary">Email : {{ $approve_student->email }}</span><br/>
                                    <span class="badge badge-primary">Blood Group : {{ $approve_student->blood_grp }}</span>
                                </td>
                                <td><span class="badge badge-info">{{ $approve_student->UsrCrs->course_name }}</span></td>
                                <td>{{ $approve_student->clg_name }}</td>
                                <td><span class="badge badge-success">{{ $approve_student->status }}</span></td>
                                <td>
                                    <button type="button" class="btn  btn-warning btn-block" data-toggle="modal" data-target="#update_student{{ $approve_student->id }}"><i data-feather="edit"></i> Edit</button>
                                    <a href="{{ url('/delete/student',$approve_student->id) }}" class="btn  btn-danger btn-block"><i data-feather="trash-2"></i> Delete</a>
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
@foreach ($approve_students as $approve_student)
    <div class="modal fade" id="update_student{{ $approve_student->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Update {{ $approve_student->name }}'s data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/update/student/details' , $approve_student->id) }}"> 
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" name="name" value="{{ $approve_student->name }}">
                        </div>
                        
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="old_roll" value="{{ $approve_student->student_roll }}">
                            <input type="text" class="form-control" name="student_roll" value="{{ $approve_student->student_roll }}">
                        </div>
                        
                        <div class="form-group">
                            <input type="text" class="form-control" name="clg_name" value="{{ $approve_student->clg_name }}">
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="mobile" value="{{ $approve_student->mobile }}">
                        </div>

                        <div class="form-group">
                            <input type="email" class="form-control" name="email" value="{{ $approve_student->email }}" disabled>
                        </div>

                        <div class="form-group">
                            <input type="text" class="form-control" name="blood_grp" value="{{ $approve_student->blood_grp }}">
                        </div>

                        <div class="form-group">
                            <select class="form-control" name="course_id">
                                <option value="{{ $approve_student->course_id }}" selected>{{ $approve_student->UsrCrs->course_name }}</option>
                                @foreach ($course_names as $course_name)
                                <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
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