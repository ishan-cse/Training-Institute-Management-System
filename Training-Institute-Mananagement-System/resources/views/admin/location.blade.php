@extends('layouts.admin_app')
@section('title')
Touhid Physics Academic and Admission Care - Location
@endsection

@section('main-menu-LOCATION')
active
@endsection

@section('admin_content')

<div class="row">
    {{-- breadcrum area --}}

    <div class="col-lg-12 col-md-12 ml-auto text-right mt-n1">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/admin/home') }}">Home</a></li>
                <li class="breadcrumb-item active">Location</li>
            </ol>
        </nav>
    </div>
    
    <div class="col-lg-8 col-md-8">
        
        @if (session('location_updated'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('location_updated') }}
                </div>
            </div>
        @endif
        @if (session('location_deleted'))
            <div class="alert alert-danger alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('location_deleted') }}
                </div>
            </div>
        @endif
        <h1 class="h3 mb-3"><i data-feather="list"></i> All Location List</h1>
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table id="basic-table" class="data-table table table-striped table-hover" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>Sl No.</th>
                                <th>Location Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($locations as $location)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $location->location_name }}</td>
                                <td>
                                    <button type="button" class="btn btn-success btn-sm " data-toggle="modal" data-target="#update_location{{ $location->id }}"><i data-feather="edit"></i> Edit</button>
                                    <a href="{{ url('/delete/notice',$location->id) }}" class="btn btn-danger btn-sm"><i data-feather="trash-2"></i> Delete </a>
                                </td>
                            </tr>
                            
                            <div class="modal fade" id="update_location{{ $location->id }}" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title"><i data-feather="edit-2"></i> Update Notice</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body m-3">
                                            <form method="POST" action="{{ url('/update/location', $location->id) }}"> 
                                                @csrf
                                                <div class="form-group">
                                                    <label class="form-label">Location Name</label>
                                                    <input type="text" name="location_name" class="form-control" value="{{ $location->location_name }}">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-success"><i data-feather="edit-3"></i> Update</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4">
        @if (session('location_added'))
            <div class="alert alert-success alert-dismissible" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">×</span>
                </button>
                <div class="alert-message">
                    {{ session('location_added') }}
                </div>
            </div>
        @endif

        <h1 class="h3 mb-3"><i data-feather="plus"></i> Add Location</h1>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ url('/add/location') }}"> 
                    @csrf
                    <div class="form-group">
                        <label class="form-label">Location Name</label>
                        <input type="text" name="location_name" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-primary"><i data-feather="plus"></i> Add</button>
                </form>
            </div>
        </div>
    </div>
</div>




@section('admin_script')
@endsection

@endsection