@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Create Course - Course Name
@endsection

@section('main-menu-CC')
show
@endsection
@section('sub-menu-CN')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Course Name</li>
            </ol>
        </nav>
    </div>


    {{-- main content start --}}

    <div class="col-lg-8 col-md-8">
        @if (session('course_name_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_name_updated') }}
                </div>
            </div>
        @endif
        @if (session('course_name_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_name_deleted') }}
                </div>
            </div>
        @endif
        
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Course Name List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped nowrap table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Course Name</th>
                                <th>Status</th>
                                <th>Create Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($course_names as $course_name)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $course_name->course_name }}</td>
                                <td>
                                   @if ($course_name->status == 'Active')
                                       <span class="badge badge-info">{{ $course_name->status  }}</span>
                                   @else
                                        <span class="badge badge-warning">{{ $course_name->status  }}</span>
                                   @endif
                                </td>
                                <td>
                                    @php echo date('d-M-Y',strtotime($course_name->created_at)) @endphp
                                </td>
                                <td>
                                    @if ($course_name->status == 'Active')
                                        <a href="{{ url('/course/name/deactive',$course_name->id) }}" class="btn btn-warning ">Deactive</a>
                                   @else
                                        <a href="{{ url('/course/name/active',$course_name->id) }}" class="btn btn-success ">Active</a>
                                   @endif
                                   
                                    <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#update_courseName{{ $course_name->id }}"><i data-feather="edit"></i> Edit</button>

                                    <button type="submit" class="btn btn-danger " data-toggle="modal" data-target="#delete_alert{{ $course_name->id }}"><i data-feather="trash-2"></i> Delete</button>
                                    
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
        @if (session('course_name_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('course_name_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add Course Name</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/course/name') }}"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Course Name</label>
                        <input type="text" class="form-control" name="course_name" placeholder="Course Name" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- modal for edit data --}}
@foreach ($course_names as $course_name)
    <div class="modal fade" id="update_courseName{{ $course_name->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Update {{ $course_name->course_name }} data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/update/course/name', $course_name->id) }}"> 
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Course Name</label>
                            <input type="text" class="form-control" value="{{ $course_name->course_name }}" name="course_name">
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

    <div class="modal fade" id="delete_alert{{ $course_name->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Delete {{ $course_name->course_name }} data</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    
                    <strong class="text-danger">If you delete this {{ $course_name->course_name }} course, you will loose all the Students, Course Topics , Coure Videos , Course Access and All Notices of this course. If you want to remain them you can just deactive the active status and this course will not show to all</strong>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <a href="{{ url('/delete/course/name',$course_name->id) }}" class="btn btn-danger"><i data-feather="trash-2"></i> Confrim Delete </a>
                
                </div>
            </div>
        </div>
    </div>
@endforeach

@endsection