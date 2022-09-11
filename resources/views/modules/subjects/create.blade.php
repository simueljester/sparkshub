@extends('layouts.app')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('modules.index')}}"> Modules </a> </li>
            <li class="breadcrumb-item"> <a href="{{route('modules.subjects.index')}}"> Subjects </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Add Subject </li>
        </ol>
    </nav>
           
    <form action="{{route('modules.subjects.save')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Add Subject </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Name </small>
                    <input type="text" name="name" id="name" class="form-control border-custom" required>
                </div>
                <hr>
                <button class="btn btn-success border-custom"> Save Subject </button>
            </div>
        </div>
    </form>

@endsection

