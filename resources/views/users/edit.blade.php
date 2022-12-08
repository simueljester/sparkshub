@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit {{$user->fname}}</li>
        </ol>
    </nav>


    <form action="{{route('users.update')}}" method="POST">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-1">
            <div class="card-header bg-white border-0">
            <strong> Edit User </strong> 
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
                            @if ($user->role == 'student')
                                <input type="number" name="student_number" id="student_number" class="form-control border-custom" value="{{$user->student_number}}">
                            @else
                                <input type="number" name="student_number" id="student_number" class="form-control border-custom" value="N/a" disabled>
                            @endif
                            
                        </div>
                            @if ($user->role == 'student')
                                <div class="form-group">
                                    <small class="text-muted"> Grade Level </small>
                                    <select name="grade_level" id="grade_level" class="form-control border-custom" required>
                                        <option value="7" {{$user->grade_level == 7 ? 'Selected' : null}}> Grade 7 </option>
                                        <option value="8" {{$user->grade_level == 8 ? 'Selected' : null}}> Grade 8 </option>
                                        <option value="9" {{$user->grade_level == 9 ? 'Selected' : null}}> Grade 9 </option>
                                        <option value="10" {{$user->grade_level == 10 ? 'Selected' : null}}> Grade 10 </option>
                                        <option value="11" {{$user->grade_level == 11 ? 'Selected' : null}}> Grade 11 </option>
                                        <option value="12" {{$user->grade_level == 12 ? 'Selected' : null}}> Grade 12 </option>
                                    </select>
                                </div>
                            @endif
                        
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
                            <select name="role" id="role" class="form-control border-custom">
                                <option value="student" {{$user->role == 'student' ? 'selected' : null}}> Student </option>
                                <option value="teacher" {{$user->role == 'teacher' ? 'selected' : null}}> Teacher </option>
                                <option value="librarian" {{$user->role == 'librarian' ? 'selected' : null}}> Librarian </option>
                            </select>
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Reset Password </small>
                            <input onkeyup="checkPasswordStrength(this.value)" type="password" name="password" id="password" class="form-control border-custom">
                            <input type="checkbox" onclick="showPass()"> <small class="ml-1"> Show Password </small> 
                            <small class="ml-3" id="pass_strength"></small>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{$user->id}}">
                <button class="btn btn-success border-custom" id="btn-update"> Save Changes </button>
            
            </div>
        </div>
    </form>



    <script>
        function checkPasswordStrength(pwString) {
            var level = 0;
            var input = pwString;//user input goes here
            var msg = $('#pass_strength'); 
            switch(true){
                case /^(?:([A-Z])*){8,12}$/.test(input):
                level = 1;
                msg.html('').attr("class","text-danger");
            
                document.getElementById("btn-update").disabled = false;
                document.getElementById('btn-update').innerHTML = 'Save Changes';
                break;

                case /^(?:([A-Z])*([a-z])*){8,12}$/.test(input):
                level = 2;
                msg.html('Weak').attr("class","text-warning");
                document.getElementById("btn-update").disabled = true;
                document.getElementById('btn-update').innerHTML = ' Weak Password';
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*){8,12}$/.test(input):
                level = 3;
                msg.html('Acceptable').attr("class","text-primary");
                document.getElementById("btn-update").disabled = false;
                document.getElementById('btn-update').innerHTML = 'Save Changes';
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*(\W)*){8,12}$/.test(input):
                level = 4;
                msg.html('Strong').attr("class","text-success");
                document.getElementById("btn-update").disabled = false;
                document.getElementById('btn-update').innerHTML = 'Save Changes';
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

