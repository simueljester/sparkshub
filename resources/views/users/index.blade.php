@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>

    <div class="row p-3">
        <a href="{{route('users.create')}}" class="btn btn-warning border-custom"> <i class="fas fa-user-plus"></i> Add Users </a>
        <form action="">
            @if ($status == 'active')
                <button class="btn btn-outline-danger border-custom" name="status" value="archive"> <i class="fas fa-archive"></i> Archived Users </button>
            @else
                <button class="btn btn-success border-custom" name="status" value="active"> <i class="fas fa-users"></i> Active Users </button>
            @endif
        </form>
    </div>
    
    <div class="card bg-secondary shadow mt-1">
        <div class="card-header bg-white border-0">
            @if ($status == 'active')
                <strong> Active Users List </strong> 
            @else
                <strong> Archived Users List </strong> 
            @endif
         
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
                        @forelse ($users as $user)
                            <tr>
                                <td> {{$user->name}} </td>
                                <td> {{$user->student_number ?? '--'}} </td>
                                <td> {{$user->role}} </td>
                                <td> {{$user->email}} </td>
                                <td> 
                                    <a href="{{route('users.edit',$user)}}" class="text-primary"> <i class="fas fa-edit"></i> Edit </a>

                                    @if ($user->archived_at)
                                        <a href="{{route('users.set-active',$user)}}" class="text-success ml-3"> <i class="fas fa-check-circle"></i> Set to active books </a>
                                    @else
                                        <a style="cursor: pointer;" onclick="showRemoveConfirmation({{$user}})" class="text-warning ml-3"> <i class="fas fa-archive"></i> Archive user </a>
                                    @endif  

                                    {{-- <a style="cursor: pointer;" class="text-warning ml-3"> <i class="fas fa-archive"></i> Archive User </a> --}}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5"> No user found </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal remove category -->
    <form action="{{route('users.archive')}}" method="post">
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
    </script>
@endsection

