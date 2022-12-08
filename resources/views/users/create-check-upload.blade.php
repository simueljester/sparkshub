@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('users.index')}}">Users</a></li>
            <li class="breadcrumb-item"><a href="{{route('users.create')}}">Add Users</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Check uploaded </li>
        </ol>
    </nav>
    <div class="card bg-secondary shadow mt-1">
        <div class="card-header bg-white border-0">
          <strong> Users Check Upload </strong> 
        </div>
        <div class="card-body">
            <table class="table table-hover">
                <thead>
                    <th> Student Number </th>
                    <th> First Name </th>
                    <th> Last Name </th>
                    <th> Email Address </th>
                    <th> Role </th>
                    <th> Grade Level </th>
                    <th> Remarks </th>
                </thead>
                <tbody>
                    @foreach ($uploaded_users as $user)
                        <tr>
                            <td> {{$user['student_number']}} </td>
                            <td> {{$user['first_name']}} </td>
                            <td> {{$user['last_name']}} </td>
                            <td> {{$user['email']}} </td>
                            <td> {{$user['role']}} </td>
                            <td> {{$user['grade_level']}} </td>
                            <td>
                                @if(in_array($user['email'], $existing_emails))
                                    &nbsp&nbsp<span class="text-danger"> <i class="fas fa-times-circle"></i> Existing Email </span>
                                @else
                                    &nbsp&nbsp<span class="text-success"><i class="fas fa-check-circle"></i> Email available </span>
                                @endif

                                @if(in_array($user['student_number'], $existing_student_number))
                                    &nbsp&nbsp<span class="text-danger"> <i class="fas fa-times-circle"></i> Existing Student No </span>
                                @else
                                    &nbsp&nbsp<span class="text-success"><i class="fas fa-check-circle"></i> Student ID available </span>
                                @endif

                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <form action="{{route('users.save-upload')}}" method="POST">
    @csrf
    @method('POST')
        <div class="card bg-secondary  shadow-sm mt-1">
            <div class="card-header bg-white border-0">
                <strong> Action </strong> 
            </div>
            <div class="card-body">
                <input type="hidden" name="uploaded_users" id="uploaded_users" value="{{json_encode($uploaded_users)}}">
                <a href="{{route('users.index')}}" class="btn btn-secondary border-custom"> Cancel </a>
                @if (empty($existing_emails) && empty($existing_student_number))
                    <button type="submit" class="btn btn-success border-custom"> Save Users </button>  
                @else
                <span class="text-danger ml-3"> <i class="fas fa-primary-circle"></i> There are errors found in your uploaded data. Please check <strong> remarks </strong> and reupload. </span>
                @endif
            </div>
        </div>
    </form>


    <script>
    
    </script>
@endsection

