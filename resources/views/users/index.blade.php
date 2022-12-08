@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Users</li>
        </ol>
    </nav>

    <div class="row p-3">
        <a href="{{route('users.create')}}" class="btn btn-info border-custom"> <i class="fas fa-user-plus"></i> Add Users </a>
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
            <div class="p-1">
                <form action="">
                    <div class="row">
                        <div class="col-sm-8">
                            <div class="form-group">
                                <small class="text-muted"> Search User </small>
                                <input type="text" name="keyword" id="keyword" class="form-control border-custom" placeholder="search name, student number..." value="{{$keyword}}">
                            </div>
                        </div>
                        <div class="col-sm-4">
                            @if ($keyword)
                                <a href="{{route('users.index')}}" class="btn btn-secondary border-custom mt-4"> Clear </a>
                            @endif
                            <button class="btn btn-info border-custom mt-4"> <i class="fas fa-search"></i> Search User </button>
                        </div>
                    </div>
                </form>

            </div>
            <div class="table-responsive">
                <small> Showing {{ $users->firstItem() }} to {{ $users->lastItem() }} of {{ $users->total() }} records </small>
                <table class="table align-items-center">
                    <thead>
                        <tr>
                            <th scope="col">Name</th>
                            <th scope="col">Student No</th>
                            <th scope="col"> Grade Level </th>
                            <th scope="col">Role</th>
                            <th scope="col">Email</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $user)
                            <tr>
                                <td> <i class="fas fa-user"></i> {{$user->name}} </td>
                                <td> {{$user->student_number ?? '--'}} </td>
                                <td> {{$user->grade_level == 0 ? 'n/a' : $user->grade_level }} </td>
                                <td>
                                    @if ($user->role == 'student')
                                        <span class="badge badge-pill badge-warning">Student</span>
                                    @elseif($user->role == 'teacher')
                                        <span class="badge badge-pill badge-primary">Teacher</span>
                                    @elseif($user->role == 'librarian')
                                        <span class="badge badge-pill badge-success">Librarian</span>
                                    @endif 
                             
                                </td>
                                <td> {{$user->email}} </td>
                                <td> 
                                    <a href="{{route('users.edit',$user)}}" class="text-primary"> <i class="fas fa-edit"></i> Edit </a>

                                    @if ($user->archived_at)
                                        <a href="{{route('users.set-active',$user)}}" class="text-success ml-3"> <i class="fas fa-check-circle"></i> Set to active </a>
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
                {{$users->links()}}
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
                        <div class="mb-3 mt-3 form-group">
                            <small class="text-muted"> Reason to archive / Message to user </small>
                            <textarea class="form-control border-custom text-left" name="archived_reason" id="archived_reason" cols="30" rows="10">This user already lost multiple books and has temporary deactivated account. Please contact your administrator</textarea>
                        </div>
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

