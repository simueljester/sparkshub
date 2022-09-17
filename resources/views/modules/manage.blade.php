@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('modules.index')}}"> Modules </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Manage {{$module->title}} </li>
        </ol>
    </nav>
           
    <div class="row">
        <div class="col-sm-6">
            <div class="card bg-secondary shadow mt-3">
                <div class="card-header bg-white border-0">
                    <strong class="text-capitalize"> Manage {{$module->title}} </strong>
                    <a href="{{route('modules.edit',$module)}}" class="text-primary float-right"> <i class="fas fa-edit"></i> Edit </a>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <small class="text-muted"> Title </small>
                        <input type="text" class="form-control border-custom" value="{{$module->title}}" readonly>
                    </div>
                    <div class="form-group">
                        <small class="text-muted"> Subject </small>
                        <input type="text" class="form-control border-custom" value="{{$module->subject->name}}" readonly>
                    </div>
                    <div class="form-group">
                        <small class="text-muted"> Description </small>
                        <p> {!! $module->description !!} </p>
                    </div>
                    <div class="row mt-5">
                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-muted"> Creator </small>
                                <br>
                                <span> {{$module->user->name}} </span>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-muted"> Downloadable </small>
                                <br>
                                @if ($module->downloadable == 1)
                                    <span class="text-success"> Yes </span>
                                @else
                                    <span class="text-muted"> No </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-muted"> Archived </small>
                                <br>
                                @if ($module->archived_at)
                                    <span class="text-success"> Yes </span>
                                @else
                                    <span class="text-muted"> -- </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group">
                                <small class="text-muted"> Approved </small>
                                <br>
                                @if ($module->approved_at)
                                    <span class="text-success"> Approved </span>
                                @else
                                    <span class="text-muted"> Pending </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <br>
                    <small class="text-muted"> Uploaded Content ({{$module->files->count()}}) </small>
                    <hr>
                    <div class="row">
                        @forelse($module->files as $file)
                            <div class="col-sm-6">
                                <div class="card shadow border-custom">
                                    <div class="card-body">
                                        <a href="{{route('modules.file.download-content',$file)}}" target="_blank" >
                                            <i class="fas fa-download"></i> {{$file->file}}
                                        </a>
                                        @if (Auth::user()->id == $module->user_id)
                                            <a href="{{route('modules.file.remove-file',$file)}}">
                                                <span class="badge badge-pill badge-danger ml-1"><i class="fas fa-times"></i></span>
                                            </a>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="col-sm-12">
                                No uploaded content
                            </div>
                        @endforelse
                    </div>
                    <br>
                    @if (Auth::user()->role == 'librarian' && $module->approved_at == null)
                        <small class="text-muted"> Action </small>
                        <hr>
                        <button type="button" onclick="showModal()" class="btn btn-success border-custom"> Approve Module </button>
                    @endif
                </div>
            </div>
        </div>
        @if (Auth::user()->id == $module->user_id)
            <div class="col-sm-6">
                <form action="{{route('modules.file.add-file')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="card bg-secondary shadow mt-3">
                        <div class="card-header bg-white border-0">
                            <strong class="text-capitalize"> <i class="fas fa-plus"></i> Add Content File </strong>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <small class="text-muted"> File </small>
                                <input type="file" name="file" id="file" class="form-control border-custom">
                            </div>
                            <input type="hidden" name="module_id" id="module_id" value="{{$module->id}}">
                            <button class="btn btn-primary border-custom"> Add File </button>
                        </div>
                    </div>
                </form>
            </div>
        @endif
    </div>
  

    <div class="modal fade" id="approve-module-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"> Approve Module </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body text-center">
                    Are you sure you want to approve this module? This will be displayed in Library and accessible by users.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal">Close</button>
                    <a href="{{route('modules.approve',$module)}}" class="btn btn-primary border-custom"> Proceed </a>
                </div>
            </div>
        </div>
    </div>

    <script>
        function showModal(){
            $('#approve-module-modal').modal('show'); 
        }
    </script>

@endsection

