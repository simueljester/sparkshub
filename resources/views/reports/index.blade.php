@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Reports</li>
        </ol>
    </nav>

    <div class="card border-custom">
        <div class="card-body bg-white border-custom">
            <div class="row">
                <div class="col-sm-4 text-center">
                    <strong class="text-warning"> System Reports </strong>
                    <img src="{{ asset('images') }}/1311213_313.jpg" width="400px;" alt="">
                </div>
                <div class="col-sm-8">
                    <div class="card bg-secondary shadow mt-2 border-custom">
                        <div class="card-body bg-gradient-info border-custom">
                            <a href="{{route('reports.borrowed-book.index')}}" class="text-secondary">
                                <strong style="font-size:25px;"> {{$counts->books_requested_count}} </strong>
                                Total Books Requested
                                <i class="fas fa-book fa-2x float-right"></i>
                            </a>
                        </div>
                    </div>
                    <div class="card bg-secondary shadow mt-2 border-custom">
                        <div class="card-body border-custom bg-gradient-info ">
                            <a href="{{route('reports.module.index')}}" class="text-white">
                                <strong style="font-size:25px;"> {{$counts->modules}} </strong>
                                Total Modules
                                <i class="far fa-file-alt fa-2x float-right"></i> 
                            </a>
                        </div>
                    </div>
                    <div class="card bg-secondary shadow mt-2 border-custom">
                        <div class="card-body border-custom bg-gradient-info">
                            <a href="{{route('reports.user.index')}}" class="text-white">
                                <strong style="font-size:25px;"> {{$counts->users}} </strong>
                                Total Users
                                <i class="fas fa-users fa-2x float-right"></i> 
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
     
    <div class="row">
        <div class="col-sm-4">
          
        </div>
        <div class="col-sm-4">

        </div>
        <div class="col-sm-4">
       
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

