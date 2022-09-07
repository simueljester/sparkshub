@extends('layouts.app')

@section('content')
    
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('books.index')}}">Books</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
    
    <a href="{{route('books.categories.create')}}" class="btn btn-warning"> <i class="fas fa-plus-circle"></i> Add Category </a>
    <div class="card bg-secondary shadow mt-2">
        <div class="card-header bg-white border-0">
            <strong> Category List </strong>
        </div>
        <div class="card-body">
             <table class="table align-items-center">
                 <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr>
                            <td> {{$category->name}} </td>
                            <td> 
                                <a href="{{route('books.categories.edit',$category)}}" class="text-primary"> <i class="fas fa-edit"></i> Edit </a>
                                @if ($category->books_count == 0)
                                    <a style="cursor: pointer;" onclick="showRemoveConfirmation({{$category->id}})" class="text-danger ml-3"> <i class="fas fa-minus-circle"></i> Remove </a>
                                @else
                                    <small class="ml-3 text-muted"> Remove unable due to books assigned to this category </small>
                                @endif
                                
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2"> No category found. </td>
                        </tr>
                    @endforelse
                </tbody>
             </table>
        </div>
    </div>

    <!-- Modal remove category -->
    <form action="{{route('books.categories.remove')}}" method="post">
        @method('POST')
        @csrf
        <div class="modal fade" id="remove-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Remove Category</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <i class="fas fa-exclamation-triangle"></i> <br>
                        <span> Warning! Removing this category will make assigned books unavailable. Are you sure you want to remove this category? </span>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" name="category_id" id="delete_category_id">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <script>
        function showRemoveConfirmation(id){
            $('#remove-modal').modal('show'); 
            $('#delete_category_id').val(id); 
        }
    </script>
@endsection

