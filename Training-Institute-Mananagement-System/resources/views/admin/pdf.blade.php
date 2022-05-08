@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - PDF
@endsection

@section('main-menu-PDF')
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
                <li class="breadcrumb-item active">PDF</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-lg-8 col-md-8">
        @if (session('pdf_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('pdf_updated') }}
                </div>
            </div>
        @endif
        @if (session('pdf_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('pdf_deleted') }}
                </div>
            </div>
        @endif
        
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
        <h1 class="h3 mb-3"><i data-feather="list"></i> All PDFS List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Title</th>
                                <th>File</th>
                                <th>File Access</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($pdfs as $pdf)
                            <tr>
                                <td>{{ $loop->index +1 }}</td>
                                <td>{{ $pdf->title }}</td>
                                <td>
                                    <a href="{{ url('/TPAAC/storage/app/pdfs/'.$pdf->file) }}" class="btn  btn-info btn-block" target="_blank">View File</a>
                                    
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#view_access{{ $pdf->id }}" class="btn  btn-info btn-block">View Access</a>
                                    <a href="#" data-toggle="modal" data-target="#new_access{{ $pdf->id }}" class="btn  btn-primary btn-block">New Access</a>
                                </td>
                                <td>
                                    <a href="#" data-toggle="modal" data-target="#update_pdf{{ $pdf->id }}" class="btn  btn-warning btn-block">Edit</a>
                                    <a href="{{ url('/delete/pdf/file',$pdf->id) }}" class="btn  btn-danger btn-block">Delete</a>
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
        @if (session('pdf_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('pdf_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add PDF</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/pdf/file') }}" enctype="multipart/form-data"> 
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
                    <div class="form-group">
                        <label class="form-label">PDF Title </label>
                        <input type="text" class="form-control mb-3" name="title" placeholder="Title" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Add File</label>
                        <input type="file" class="form-control mb-1" name="file" required>
                        <small class="text-danger font-weight-bold">Here you can upload PDF,Image,docx and etc files</small>
                    </div>
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!--modals-->
@foreach ($pdfs as $pdf)

    <div class="modal fade" id="update_pdf{{ $pdf->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="edit-2"></i> Update Files</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/update/pdf/file', $pdf->id) }}" enctype="multipart/form-data"> 
                        @csrf
                        <div class="form-group">
                            <label class="form-label">PDF Title </label>
                            <input type="text" class="form-control mb-3" value="{{ $pdf->title }}" name="title" placeholder="Title">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Add File</label>
                            <input type="file" class="form-control mb-1" name="file">
                            <small class="text-danger font-weight-bold">Here you can upload PDF,Image,docx and etc files</small>
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

    <div class="modal fade" id="new_access{{ $pdf->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="users"></i> Give New Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3">
                    <form method="POST" action="{{ url('/add/new/file/access', $pdf->id) }}"> 
                        @csrf
                        
                        <div class="form-group">
                            <label class="form-label">Select Student</label>
                            <select id="select2" class="form-control mb-3" name="student_id[]" multiple>
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

    <div class="modal fade" id="view_access{{ $pdf->id }}" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i data-feather="users"></i> File Access</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body m-3 row">
                    <div class="col-sm-6">
                        <h2 class="h4 text-center">Students</h2>
                        <hr/>
                        <table class="table table-borderless">
                            @foreach (student_pdf_access($pdf->id) as $student_access)
                                <tr class="alert alert-dismissible d-TR" role="alert">
                                    <td> {{ $loop->index + 1 }}.  Name : {{ $student_access->PdfStudent->name }} <a style="margin-left:30px" type="button" onclick="remove('{{ $student_access->id }}')" class="text-underline" data-dismiss="alert" aria-label="Close">X</a>

                                </tr>
                            @endforeach
                            
                        </table>
                    </div>
                    <div class="col-sm-6">
                        <h2 class="h4 text-center">Course</h2>
                    <hr/>
                    <table class="table text-center table-borderless">
                        @foreach (course_pdf_access($pdf->id) as $course_access)
                            <tr class="alert alert-dismissible d-TR" role="alert">
                                <td> {{ $loop->index + 1 }}. Course Name : {{ $course_access->PdfCourse->course_name }} <a style="margin-left:30px" type="button" onclick="remove('{{ $course_access->id }}')" class="text-underline" data-dismiss="alert" aria-label="Close">X</a>
                            </tr>
                        @endforeach
                    </table>
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
`<script>
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
                url:'/delete/pdf/access',
                data:{id:id},
                success: function(data) {
                    // alert(data);
                    alert('Access deleted successfully');
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