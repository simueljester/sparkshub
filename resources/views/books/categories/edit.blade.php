@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item"><a href="{{route('books.categories.index')}}">Categories</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$book_category->name}}</li>
        </ol>
    </nav>
 
    <form action="{{route('books.categories.update')}}" method="post">
        @method('POST')
        @csrf
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Edit Category </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Category Name </small>
                    <input type="text" name="name" id="name" class="form-control border-custom" value="{{$book_category->name}}">
                </div>
                <input type="hidden" name="category_id" id="category_id" value="{{$book_category->id}}">
                <button class="btn btn-success border-custom"> Update </button>
            </div>
        </div>
    </form>

  
    

@endsection

