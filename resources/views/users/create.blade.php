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



    <script>
    
    </script>
@endsection

