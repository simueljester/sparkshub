@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page"> Modules </li>
        </ol>
    </nav>
           
    <div class="row p-3">
        <a href="{{route('modules.create')}}" class="btn btn-warning border-custom ml-2"> <i class="fas fa-plus"></i> Add module </a>
        <a href="{{route('modules.subjects.index')}}" class="btn btn-primary border-custom "> <i class="fas fa-cog"></i> Manage Subjects </a>
        <form action="">
            @if ($status == 'active')
                <button class="btn btn-outline-danger border-custom" name="status" value="archive"> <i class="fas fa-archive"></i> Archived Modules </button>
            @else
                <button class="btn btn-success border-custom" name="status" value="active"> <i class="far fa-newspaper"></i> Active Modules </button>
            @endif
        </form>
    </div>
    <div class="card bg-secondary shadow mt-4">
        <div class="card-header bg-white border-0">
            <strong> Module Master List </strong> 
            @if ($status == 'active')
                <strong class="text-success"> - Active List </strong>
            @else
                <strong class="text-warning"> - Archived List </strong>
            @endif
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <small> Showing {{ $modules->firstItem() }} to {{ $modules->lastItem() }} of {{ $modules->total() }} records </small>
                <table class="table align-items-center mt-1">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Creator</th>
                            <th scope="col">Downloadable</th>
                            <th scope="col">Uploaded Content</th>
                            <th scope="col">Approve</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($modules as $module)
                            <tr>
                                <td>
                                    <strong style="font-size:15px;" class="text-uppercase"> <i class="far fa-newspaper text-warning"></i> {{$module->title}} </strong> <br>
                                    <small> {{$module->subject->name}} </small>
                                </td>
                                <td>
                                    {{$module->user->name}} <br>
                                    <small> {{$module->user->role}} </small>
                                </td>
                                <td>
                                    @if ($module->downloadable == 1)
                                        <strong class="text-success"> Yes </strong>
                                    @else
                                        <span class="text-muted"> No </span>
                                    @endif
                                </td>
                                <td>
                                    {{$module->files->count()}}
                                </td>
                                <td>
                                    @if ($module->approved_at)
                                        <strong class="text-success"> Approved </strong>
                                    @else
                                        <span class="text-muted"> Pending </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('modules.manage',$module)}}" class="text-primary"> <i class="fas fa-cogs"></i> Manage </a>
                                    <a href="{{route('modules.edit',$module)}}" class="text-primary ml-3"> <i class="fas fa-edit"></i> Edit </a>
                                    @if ($module->archived_at)
                                        <a href="{{route('modules.set-active',$module)}}" class="text-success ml-3"> <i class="fas fa-check-circle"></i> Set to active module </a>
                                    @else
                                        <a style="cursor: pointer;" onclick="showRemoveConfirmation({{$module}})" class="text-danger ml-3"> <i class="fas fa-archive"></i> Archive </a>
                                    @endif  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> No record found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                {{$modules->links()}}
            </div>
        </div>
    </div>
    
  
    <!-- Modal archive module -->
    <form action="{{route('modules.archive')}}" method="post">
        @method('POST')
        @csrf
        <div class="modal fade" id="archive-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> Archive Module </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-exclamation-triangle"></i> <br>
                        <span> Warning! Archiving <strong id="archive-title"> </strong> will make it inaccessible to users. Are you sure you want to archive this module? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="module_id" id="archive_module_id">
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary border-custom"> Proceed </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showRemoveConfirmation(module){
            $('#archive-modal').modal('show'); 
            $('#archive_module_id').val(module.id); 
            $('#archive-title').html(module.title)
        }
    </script>


@endsection

