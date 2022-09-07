@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Edit Book</li>
        </ol>
    </nav>
 
    <form action="{{route('books.update')}}" method="POST">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong class="text-capitalize"> Edit {{$book->title}} </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Title </small>
                    <input value="{{$book->title}}" type="text" name="title" id="title" class="form-control border-custom" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> International Standard Book Number (ISBN) </small>
                            <input value="{{$book->isbn}}" type="text" name="isbn" id="isbn" class="form-control border-custom" readonly>
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Publication Date </small>
                            <input value="{{ Carbon\Carbon::parse($book->publication_date)->format('Y-m-d')}}" type="date" name="publication_date" id="publication_date" class="form-control border-custom" required>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Category </small>
                            @if ($categories->count() != 0)
                                <select name="category" id="category" class="form-control border-custom" required>
                                    <option value=""> Select Category </option>
                                    @forelse ($categories as $category)
                                        <option value="{{$category->id}}" {{$book->category_id == $category->id ? 'Selected' : null}}> {{$category->name}} </option>
                                    @empty
                                        <option> </option>
                                    @endforelse
                                </select>
                            @else
                                <br>
                                <a href="{{route('books.categories.create')}}"> No category created. Click here to add. </a>
                            @endif
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Copies Available </small>
                            <input value="{{$book->copies}}" type="number" name="copies" id="copies" class="form-control border-custom" value="1" required>
                        </div>
                    </div>
                </div>
                <hr>
                <input type="hidden" name="book_id" id="book_id" value="{{$book->id}}">
                <button class="btn btn-success"> Update Book </button>
            </div>
        </div>
    </form>
@endsection

