@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>
    </nav>

   
    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                    <strong> Book Reports </strong>
                </div>
                <div class="card-body text-center">
                    <a href="{{route('reports.borrowed-book.index')}}">
                        <strong style="font-size:25px;"> {{$counts->books_requested_count}} </strong>
                        <br>
                        <i class="fas fa-book"></i> Borrowed Books Report
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                    <strong> Module Reports </strong>
                </div>
                <div class="card-body text-center">
                    <a href="{{route('reports.module.index')}}">
                        <strong style="font-size:25px;"> {{$counts->modules}} </strong>
                        <br>
                        <i class="far fa-file-alt"></i> Total Modules
                    </a>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                    <strong> User Reports </strong>
                </div>
                <div class="card-body text-center">
                    <a href="{{route('reports.user.index')}}">
                        <strong style="font-size:25px;"> {{$counts->users}} </strong>
                        <br>
                        <i class="fas fa-users"></i> Total Users
                    </a>
                </div>
            </div>
        </div>
    </div>
    


    <!-- Modal remove category -->
    {{-- <form action="{{route('users.archive')}}" method="post">
        @method('POST')
        @csrf
        <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Archive User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-user-times"></i> <br>
                        <span> Are you sure you want to archive <strong id="remove-title"> </strong> ? This user will not be able to login </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="user_id" id="archive_user_id">
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary border-custom"> Proceed </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
         function showRemoveConfirmation(user){
            $('#remove-modal').modal('show'); 
            $('#archive_user_id').val(user.id); 
            $('#remove-title').html(user.name)
        }
    </script> --}}
@endsection

