@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Add Book</li>
        </ol>
    </nav>
 
    <form action="{{route('books.save')}}" method="POST">
        @csrf
        @method('POST')
        <div class="card bg-secondary shadow mt-3">
            <div class="card-header bg-white border-0">
                <strong> Add Book </strong>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <small class="text-muted"> Title </small>
                    <input type="text" name="title" id="title" class="form-control border-custom" required>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> International Standard Book Number (ISBN) </small>
                            <input type="text" name="isbn" id="isbn" class="form-control border-custom" required>
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Publication Date </small>
                            <input type="date" name="publication_date" id="publication_date" class="form-control border-custom" required>
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Grade Level </small>
                            <select name="grade_level" id="grade_level" class="form-control border-custom" required>
                                <option value="7"> Grade 7 </option>
                                <option value="8"> Grade 8 </option>
                                <option value="9"> Grade 9 </option>
                                <option value="10"> Grade 10 </option>
                                <option value="11"> Grade 11 </option>
                                <option value="12"> Grade 12 </option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <small class="text-muted"> Category </small>
                            @if ($categories->count() != 0)
                                <select name="category" id="category" class="form-control border-custom" required>
                                    <option value=""> Select Category </option>
                                    @forelse ($categories as $category)
                                        <option value="{{$category->id}}"> {{$category->name}} </option>
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
                            <small class="text-muted"> Author </small>
                            <input type="text" name="author" id="author" class="form-control border-custom" required>
                        </div>
                        <div class="form-group">
                            <small class="text-muted"> Copies Available </small>
                            <input type="number" name="copies" id="copies" class="form-control border-custom" value="1" min="0" required>
                        </div>
                    </div>
                </div>
                <hr>
                <button class="btn btn-success border-custom"> Save Book </button>
            </div>
        </div>
    </form>
@endsection

@push('js')
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="{{ asset('argon') }}/vendor/chart.js/dist/Chart.extension.js"></script>
@endpush