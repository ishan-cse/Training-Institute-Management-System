@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Notice
@endsection

@section('main-menu-NOTICE')
active
@endsection
@section('admin_css')
<style>
    .select2-container{
        width: 100% !important;
    }
</style>
@endsection
@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Notice</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-lg-8 col-md-8">
        @if (session('notice_updaed'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('notice_updaed') }}
                </div>
            </div>
        @endif
        @if (session('notice_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('notice_deleted') }}
                </div>
            </div>
        @endif
        
        @if (session('access_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('access_added') }}
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
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Notice List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Notice</th>
                                <th>Notice Access</th>
                                <th>Notice Date</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($notices as $notice)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>
                                Notice Title : {{ $notice->notice_title }}<br/>
                                <span class="badge badge-primary">Notice :</span> {{ $notice->notice }}
                                
                                </td>
                                <td>
                                    <button type="button" class="btn btn-info  btn-block" data-toggle="modal" data-target="#new_access{{ $notice->id }}"><i data-feather="users"></i> Add Access</button>
                                    <button type="button" class="btn btn-primary  btn-block" data-toggle="modal" data-target="#view_access{{ $notice->id }}"><i data-feather="eye"></i> View Access</button>
                                    
                                </td>
                                <td>
                                    @php echo date('d-M-Y',strtotime($notice->created_at)) @endphp
                                </td>
                                <td>
                                    <button type="button" class="btn btn-success btn-block " data-toggle="modal" data-target="#update_notice{{ $notice->id }}"><i data-feather="edit"></i> Edit</button>
                                    <a href="{{ url('/delete/notice',$notice->id) }}" class="btn btn-danger btn-block "><i data-feather="trash-2"></i> Delete </a>
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
        @if (session('notice_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('notice_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add Notice</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/notice') }}"> 
                    @csrf
                    
                    <div class="form-group">
                        <label class="form-label">Select Student</label>
                        <select id="select2" class="form-control mb-3 " name="student_id[]" multiple>
                            <option value="">Select Single or Multiple Student</option>
                            @foreach ($students as $student)
                            <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->student_roll }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Select Course</label>
                        <select id="notice_access" class="form-control mb-3" name="course_id[]" multiple>
                            <option value="">Select Single or Multiple Course</option>
                            @foreach ($course_names as $course_name)
                            <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notice Title</label>
                        <input type="text" name="notice_title" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Notice</label>
                        <textarea name="notice" class="form-control mb-3" placeholder="Write Notice" id="" cols="30" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


{{-- modal for edit data --}}
@foreach ($notices as $notice)
    <div class="modal fade" id="update_notice{{ $notice->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Update Notice</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/update/notice', $notice->id) }}"> 
                        @csrf
                        <div class="form-group">
                            <label class="form-label">Notice Title</label>
                            <input type="text" name="notice_title" class="form-control" value="{{ $notice->notice_title }}">
                        </div>
                        
                        <div class="form-group">
                            <label class="form-label">Notice</label>
                            <textarea name="notice" class="form-control mb-3" id="" cols="30" rows="10">{{ $notice->notice }}</textarea>
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
    
    <div class="modal fade" id="new_access{{ $notice->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="users"></i> Give New Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/add/new/notice/access', $notice->id) }}"> 
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Select Student</label>
                            <select id="select" class="form-control mb-3" name="student_id[]" multiple>
                                <option value="">Select Single or Multiple Student</option>
                                @foreach ($students as $student)
                                <option value="{{ $student->id }}">{{ $student->name }} - {{ $student->student_roll }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Select Course</label>
                            <select id="notice_access" class="form-control mb-3" name="course_id[]" multiple>
                                <option value="">Select Single or Multiple Course</option>
                                @foreach ($course_names as $course_name)
                                <option value="{{ $course_name->id }}">{{ $course_name->course_name }}</option>
                                @endforeach
                            </select>
                        </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success"><i data-feather="user-plus"></i> Give New Access</button>
                </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="view_access{{ $notice->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="users"></i> Notice Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    
                    <div class="row">
                        <div class="col-sm-6">
                            <h2 class="h4 text-center">Students</h2>
                            <hr/>
                            <table class="table-borderless">
                                @foreach (get_notice_students($notice->id) as $student_access)
                                    
                                <tr class="alert alert-dismissible d-TR" role="alert">
                                    <td>{{ $loop->index + 1 }}. Name : {{ $student_access->NoticeStudent->name }} <a style="margin-left:30px" type="button" onclick="remove('{{ $student_access->id }}')" class="text-underline" data-dismiss="alert" aria-label="Close">X</a>
                                    <!--<a href="{{ url('/delete/notice/access',$student_access->id) }}" class="text-danger" style="font-size: 16px;">×</a></td>-->
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-sm-6">
                            <h2 class="h4 text-center">Course</h2>
                            <hr/>
                            <table class="table-borderless">
                                
                                @foreach (get_notice_course($notice->id) as $course_access)
                                    
                                <tr class="alert alert-dismissible d-TR" role="alert">
                                    <td>{{ $loop->index + 1 }}. Name : {{ $course_access->NoticeCourse->course_name }} <a style="margin-left:30px" type="button" onclick="remove('{{ $course_access->id }}')" class="text-underline" data-dismiss="alert" aria-label="Close">X</a>
                                    <!--<a href="{{ url('/delete/notice/access',$course_access->id) }}" class="text-danger" style="font-size: 16px;">×</a></td>-->
                                </tr>
                                @endforeach
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
        function remove(id){

            // alert(id);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            // ajax request send
            $.ajax({
                type:'POST',
                url:'/remove/notice/acccess',
                data:{id:id},
                success: function(data) {
                    // alert(data);
                    alert('Remove form Notice Access successfully');
                }
            });
        }
        
        
    </script>
    <script>
       $(document).ready(function() {
            $('#select2').select2();
            $('#select').select2();
        });
    </script>
@endsection

@endsection