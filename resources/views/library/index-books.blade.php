@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"> <a href="{{route('library.index')}}"> Library </a> </li>
            <li class="breadcrumb-item active" aria-current="page"> Books </li>
        </ol>
    </nav>
           
    <div class="card bg-secondary shadow m-2">
        <div class="card-body">
            <form action="">
                <div class="row">
                    <div class="col-sm-8">
                        <div class="form-group">
                            <small class="text-muted">  Title / ISBN / Author </small>
                            <input type="text" name="keyword" id="keyword" class="form-control border-custom" value="{{$keyword}}" placeholder="keyword...">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <small class="text-muted"> Category</small>
                            <select name="category_filter" id="category_filter" class="form-control border-custom">
                                <option value="0"> All Category </option>
                                @foreach ($categories as $category)
                                    <option value="{{$category->id}}" {{$category_filter == $category->id ? 'selected' : null}}> {{$category->name}} </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary border-custom"> Search </button>
                @if ($keyword || $category_filter != 0 || $category_filter)
                    <a href="{{route('library.books')}}" class="btn btn-outline-secondary border-custom"> Clear Keyword </a>
                @endif
            </form>
        </div>
    </div>

    <div class="row p-2">
        @forelse ($books as $book)
            <div class="col-sm-3">
                <div class="card text-center bg-secondary shadow border-custom mt-3 book-library" onclick="viewBook({{$book}})">
                    <div class="card-body">
                        <i class="fas fa-book fa-5x text-primary"></i>
                    </div>
                    <div class="card-footer">
                          <strong class="text-capitalize"> {{$book->title}}</strong> <br>
                          <small class="text-muted"> {{$book->author ?? 'No author indicated'}} </small>
                          <br>
                          <span class="badge badge-pill badge-success">{{$book->category->name}}</span>
                    </div>
                </div>
            </div>
        @empty
            <div class="p-3"> No books available </div>
        @endforelse
    </div>


    <!-- Modal view book -->
    <form action="{{route('request-book.request')}}" method="post">
        @csrf
        @method('POST')
        <div class="modal fade" id="view-book-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> View Book Information </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div> <i class="fas fa-book fa-5x text-primary"></i> </div>
                        <br>
                        <div class="mt-2"> <strong class="text-primary text-capitalize" style="font-size:22px;" id="book-title"></strong> </div>
                        <div class="mt-1 text-muted"> By <span class="text-muted" id="book-author"></span> </div>
                        <br>
                        <small> Additional Information </small>
                        <hr>
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="mt-1 text-muted"> 
                                    <br>
                                    <span id="copies" class="text-dark"> </span> <br>
                                    <small> Copies Available: </small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-1 text-muted"> 
                                    <br>
                                    <span id="category" class="text-dark"> </span> <br>
                                    <small> Category: </small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-1 text-muted"> 
                                    <br>
                                    <span id="publication-date" class="text-dark"> </span> <br>
                                    <small> Publication Date: </small>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="mt-1 text-muted"> 
                                    <br>
                                    <span id="isbn" class="text-dark"> </span> <br>
                                    <small> ISBN: </small>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="book_id" id="view_book_id">
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary border-custom" id="btn-borrow"> I want to borrow this book </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function viewBook(book){
            var st = book.publication_date;
            var pattern = /(\d{2})\.(\d{2})\.(\d{4})/;
            var dt = new Date(st.replace(pattern,'$3-$2-$1'));

            $('#view-book-modal').modal('show'); 
            $('#view_book_id').val(book.id); 
            $('#book-title').html(book.title); 
            $('#book-author').html(book.author); 
            $('#copies').html(book.copies); 
            $('#publication-date').html(dt.toDateString()); 
            $('#category').html(book.category.name); 
            $('#isbn').html(book.isbn); 

            if(book.copies == 0){
                 $("#btn-borrow").attr("disabled", true);
            }else{
                 $("#btn-borrow").attr("disabled", false);
            }
        }
    </script>
@endsection

