<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\BookCategoryRepository;
use App\Http\Repositories\RequestedBookRepository;

class BookController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $keyword = $request->keyword ?? null;
        $category_filter = $request->category_filter ?? null;
        Paginator::useBootstrap();
        $status = $request->status ?? 'active';
        $books = app(BookRepository::class)->query()
        ->when($status == 'archive', function ($q, $search) {
                $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q, $search) {
                $q->whereNull('archived_at');
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('isbn', 'like', '%' . $keyword . '%')
            ->orWhere('author', 'like', '%' . $keyword . '%'); 
   
        })
        ->when($category_filter, function ($query) use ($category_filter) {
            $query->whereCategoryId($category_filter);
        })
        ->with('category:id,name')
        ->orderBy('title','ASC')
        ->paginate(10);

        $categories = app(BookCategoryRepository::class)->query()->orderBy('name','ASC')->get();
        return view('books.index',compact('books','status','categories','keyword','category_filter'));
    }

    public function create(){
        $categories = app(BookCategoryRepository::class)->query()->orderBy('name','ASC')->get();
        return view('books.create',compact('categories'));
    }

    public function save(Request $request){
        $request->validate([
            'title'             => 'required',
            'isbn'              => 'required|unique:books,isbn',
            'publication_date'  => 'required|date',
            'grade_level'       => 'required|integer',
            'category'          => 'required',
            'copies'            => 'required|integer',
            'author'            => 'required'
        ]);
        
        $data = [
            'isbn'              => $request->isbn,
            'title'             => $request->title,
            'publication_date'  => $request->publication_date,
            'category_id'       => $request->category,
            'grade_level'       => $request->grade_level,
            'copies'            => $request->copies,
            'author'            => $request->author
        ];

        app(BookRepository::class)->save($data);
        return redirect()->route('books.index')->with('success', 'Book added!');
    }

    public function edit(Book $book){
        $categories = app(BookCategoryRepository::class)->query()->orderBy('name','ASC')->get();
        return view('books.edit',compact('book','categories'));
    }

    public function update(Request $request){
        $request->validate([
            'title'             => 'required',
            'publication_date'  => 'required|date',
            'grade_level'       => 'required|integer',
            'category'          => 'required',
            'copies'            =>'required|integer',
            'author'            => 'required'
        ]);
        
        $data = [
            'isbn'              => $request->isbn,
            'title'             => $request->title,
            'publication_date'  => $request->publication_date,
            'category_id'       => $request->category,
            'grade_level'       => $request->grade_level,
            'copies'            => $request->copies,
            'author'            => $request->author
        ];
       
        app(BookRepository::class)->update($request->book_id,$data);
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function remove(Request $request){
        app(BookRepository::class)->archive($request->book_id);
        app(RequestedBookRepository::class)->query()->whereBookId($request->book_id)->delete();
        return redirect()->route('books.index')->with('success', 'Book archived!');
    }

    public function setToActive($book_id){
        app(BookRepository::class)->archiveRemove($book_id);
        return redirect()->back()->with('success', 'Book set to active!');
    }

    public function delete(Request $request){
        app(BookRepository::class)->delete($request->book_id);
         return redirect()->back()->with('success', 'Book successfully deleted!');
    }

}
