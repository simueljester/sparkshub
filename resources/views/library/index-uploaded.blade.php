@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('library.index')}}">Library</a></li>
            <li class="breadcrumb-item active" aria-current="page"> Uploaded Modules </li>
        </ol>
    </nav>
           
    <button class="btn btn-primary border-custom ml-2"> <i class="fas fa-cloud-upload-alt"></i> Add module </button>
  




 
@endsection

