@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Profile</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-sm-4">
            <div class="card bg-secondary shadow mt-1">
                <div class="card-header bg-white border-0">
                    <strong> Display Photo </strong>
                </div>
                <form action="{{route('users.upload-avatar')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                    <div class="card-body text-center">
                        @if ($user->avatar)
                            <img id="output" style="border-radius: 50%;" width="150" height="150" src="{{ url('/images/' . Auth::user()->avatar)}}" />
                        @else
                            <img id="output" style="border-radius: 50%;" width="150" height="150" src="{{ Avatar::create($user->name)->toBase64() }}" />
                        @endif
                        <hr>
                        <p><input type="file"  accept="image/*" name="image" id="file"  onchange="loadFile(event)" style="display: none;"></p>
                        <p><label for="file" style="cursor: pointer;"> <i class="fas fa-upload"></i> Upload Image</label></p>
                        <button id="btn-upload" class="btn btn-warning border-custom btn-block"> Save Image </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-sm-8">
            <form action="{{route('users.update')}}" method="POST">
                @csrf
                @method('POST')
                <div class="card bg-secondary shadow mt-1">
                    <div class="card-header bg-white border-0">
                    <strong> Edit My Information </strong> 
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <small class="text-muted"> First Name </small>
                                    <input type="text" name="fname" id="fname" class="form-control border-custom" value="{{$user->fname}}">
                                </div>
                                <div class="form-group">
                                    <small class="text-muted"> Student Number </small>
                                    <input type="text" name="student_number" id="student_number" class="form-control border-custom" value="{{$user->student_number}}" readonly>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted"> Email Address </small>
                                    <input type="email" name="email" id="email" class="form-control border-custom" value="{{$user->email}}">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <small class="text-muted"> Last Name </small>
                                    <input type="text" name="lname" id="lname" class="form-control border-custom" value="{{$user->lname}}">
                                </div>
                                <div class="form-group">
                                    <small class="text-muted"> Role </small>
                                    <input type="text" name="role" id="role" class="form-control border-custom text-capitalize" value="{{$user->role}}" readonly>
                                </div>
                                <div class="form-group">
                                    <small class="text-muted"> Reset Password </small>
                                    <input onkeyup="checkPasswordStrength(this.value)" type="password" name="password" id="password" class="form-control border-custom">
                                    
                                     <input type="checkbox" onclick="showPass()"> <small class="ml-1"> Show Password </small><small class="ml-1" id="pass_strength"></small>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="id" id="id" value="{{$user->id}}">
                        <button class="btn btn-success border-custom" id="btn-update-profile"> Save Changes </button>
                    
                    </div>
                </div>
            </form>
        </div>
    </div>


    {{-- <!-- Modal remove category -->
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
    </form> --}}

    <script>
        //  function showRemoveConfirmation(user){
        //     $('#remove-modal').modal('show'); 
        //     $('#archive_user_id').val(user.id); 
        //     $('#remove-title').html(user.name)
        // }

    document.getElementById('btn-upload').style.visibility = "hidden";

    var loadFile = function(event) {
        var image = document.getElementById('output');
        image.src = URL.createObjectURL(event.target.files[0]);
        document.getElementById('btn-upload').style.visibility = "visible";

    };

       function checkPasswordStrength(pwString) {
            var level = 0;
            var input = pwString;//user input goes here
            var msg = $('#pass_strength'); 
            switch(true){
                case /^(?:([A-Z])*){8,12}$/.test(input):
                level = 1;
                msg.html('').attr("class","text-danger");
                
                document.getElementById("btn-update-profile").disabled = false;
                document.getElementById('btn-update-profile').innerHTML = 'Save Changes';
                break;

                case /^(?:([A-Z])*([a-z])*){8,12}$/.test(input):
                level = 2;
                msg.html('Weak').attr("class","text-warning");
                document.getElementById("btn-update-profile").disabled = true;
                document.getElementById('btn-update-profile').innerHTML = 'Weak Password';
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*){8,12}$/.test(input):
                level = 3;
                msg.html('Acceptable').attr("class","text-primary");
                document.getElementById("btn-update-profile").disabled = false;
                document.getElementById('btn-update-profile').innerHTML = 'Save Changes';
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*(\W)*){8,12}$/.test(input):
                level = 4;
                msg.html('Strong').attr("class","text-success");
                document.getElementById("btn-update-profile").disabled = false;
                document.getElementById('btn-update-profile').innerHTML = 'Save Changes';
                break;
            }
            
        }

        function showPass(){
            var x = document.getElementById("password");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }


    </script>
@endsection

