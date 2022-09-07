@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item"><a href="{{route('books.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Category</li>
        </ol>
    </nav>
 
    <form action="{{route('books.categories.save')}}" method="post">
        @method('POST')
        @csrf
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Add Category </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Category Name </small>
                    <input type="text" name="name" id="name" class="form-control border-custom">
                </div>
                <button class="btn btn-success"> Save New Category </button>
            </div>
        </div>
    </form>

  
    

@endsection

