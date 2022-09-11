@extends('layouts.app')

@section('content')
    
 
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item active" aria-current="page">Books</li>
        </ol>
    </nav>
    
    <div class="row p-3">
        <a href="{{route('books.create')}}" class="btn btn-warning border-custom"> <i class="fas fa-plus-circle"></i> Add Book </a>
        <a href="{{route('books.categories.index')}}" class="btn btn-primary border-custom"> <i class="fas fa-cog"></i> Manage Category </a>
       
        <form action="">
            @if ($status == 'active')
                <button class="btn btn-outline-danger border-custom" name="status" value="archive"> <i class="fas fa-archive"></i> Archived Books </button>
            @else
                <button class="btn btn-success border-custom" name="status" value="active"> <i class="fas fa-book"></i> Active Books </button>
            @endif
        </form>
    </div>
   
    <div class="card bg-secondary shadow mt-1">
        <div class="card-header bg-white border-0">
            <strong> Book Master List </strong>
            @if ($status == 'active')
                <strong class="text-success"> - Active Book List </strong>
            @else
                <strong class="text-warning"> - Archived List </strong>
            @endif
          
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <small> Showing {{ $books->firstItem() }} to {{ $books->lastItem() }} of {{ $books->total() }} records </small>
                <table class="table align-items-center mt-1">
                    <thead>
                        <tr>
                            <th scope="col">Title</th>
                            <th scope="col">Category</th>
                            <th scope="col">Copies</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($books as $book)
                            <tr>
                                <td>
                                    <strong style="font-size:15px;" class="text-uppercase"> <i class="fas fa-book fa-lg text-warning"></i> {{$book->title}} </strong> <br>
                                    <small> ISBN #: {{$book->isbn}} </small>
                                </td>
                                <td>
                                    {{$book->category->name}}
                                </td>
                                <td>
                                    @if ($book->copies == 0)
                                         <strong class="text-danger"> {{$book->copies}} </strong> 
                                    @else
                                        <strong> {{$book->copies}} </strong> Available
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('books.edit',$book)}}" class="text-primary"> <i class="fas fa-edit"></i> Edit </a>
                                    
                                    @if ($book->archived_at)
                                        <a href="{{route('books.set-active',$book)}}" class="text-success ml-3"> <i class="fas fa-check-circle"></i> Set to active books </a>
                                    @else
                                        <a style="cursor: pointer;" onclick="showRemoveConfirmation({{$book}})" class="text-danger ml-3"> <i class="fas fa-minus-circle"></i> Remove </a>
                                    @endif  
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4"> No book available </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <br>
                {{$books->links()}}
            </div>
        </div>
    </div>

    <!-- Modal remove book -->
    <form action="{{route('books.remove')}}" method="post">
        @method('POST')
        @csrf
        <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Book</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-exclamation-triangle"></i> <br>
                        <span> Warning! Removing <strong id="remove-title"> </strong> will make it inaccessible to users. Are you sure you want to remove this book? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="book_id" id="delete_book_id">
                        <button type="button" class="btn btn-secondary border-custom" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary border-custom"> Proceed </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showRemoveConfirmation(book){
            $('#remove-modal').modal('show'); 
            $('#delete_book_id').val(book.id); 
            $('#remove-title').html(book.title)
        }
    </script>
@endsection

