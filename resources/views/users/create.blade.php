@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Users</li>
        </ol>
    </nav>
    <div class="p-2">
        <a href="{{route('users.download-template')}}" class="btn btn-info border-custom"> <i class="fas fa-download"></i> Download Template </a>
    </div>
    <div class="card bg-secondary shadow mt-1">
        <div class="card-header bg-white border-0">
          <strong> Users Upload </strong> 
        </div>
        <div class="card-body">
            <ul>
                <li> <span> Download Excel Template </span> </li>
                <li> Fill up Excel fields </li>
                <li> Upload Excel file </li>
            </ul>
            <form action="{{route('users.upload')}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('POST')
                <div class="form-group">
                    <small class="text-muted"> File </small>
                    <input type="file" name="file" id="file" class="form-control border-custom" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                </div>
                <button class="btn btn-success border-custom"> Upload </button>
            </form>

        </div>
    </div>
    
    <form action="{{route('users.save-manual')}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
            <strong> Manual Create </strong> 
            </div>
            <div class="card-body">
            <div class="form-group">
                    <small class="text-muted"> First Name </small>
                    <input type="text" name="fname" id="fname" class="form-control border-custom" required>
            </div>
                <div class="form-group">
                    <small class="text-muted"> Last Name </small>
                    <input type="text" name="lname" id="lname" class="form-control border-custom" required>
            </div>
                <div class="form-group">
                    <small class="text-muted"> Student No. (required if student account) </small>
                    <input type="text" name="student_no" id="student_no" class="form-control border-custom">
                </div>
                <div class="form-group">
                    <small class="text-muted"> Email </small>
                    <input type="email" name="email" id="email" class="form-control border-custom" required>
                </div>
                <div class="form-group">
                    <small class="text-muted"> Password </small>
                    <input type="password" onkeyup="checkPasswordStrength(this.value)" name="password" id="password" class="form-control border-custom" required>
                    <small id="pass_strength"></small>
                </div>

                <div class="form-group">
                    <small class="text-muted"> Role </small>
                    <select name="role" id="role" class="form-control border-custom" required>
                        <option value="student"> Student </option>
                        <option value="teacher"> Teacher </option>
                        <option value="librarian"> Librarian </option>
                    </select>
                </div>

                <button class="btn btn-success border-custom"> Save User </button>

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
                msg.html('Very Weak').attr("class","text-danger");
                break;

                case /^(?:([A-Z])*([a-z])*){8,12}$/.test(input):
                level = 2;
                msg.html('Weak').attr("class","text-warning");
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*){8,12}$/.test(input):
                level = 3;
                msg.html('Acceptable').attr("class","text-primary");
                break;

                case /^(?:([A-Z])*([a-z])*(\d)*(\W)*){8,12}$/.test(input):
                level = 4;
                msg.html('Strong').attr("class","text-success");
                break;
            }
            
        }
    </script>
@endsection

