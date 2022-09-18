@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('reports.index')}}"> Reports </a></li>
            <li class="breadcrumb-item active" aria-current="page">Module Reports</li>
        </ol>
    </nav>

   
    
    <div class="card bg-secondary shadow mt-1">
        <div class="card-header bg-white border-0">
           
         
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Student No</th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    </tbody>
                </table>
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

