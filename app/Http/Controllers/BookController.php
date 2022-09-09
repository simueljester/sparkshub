<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\BookCategoryRepository;

class BookController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $status = $request->status ?? 'active';
        $books = app(BookRepository::class)->query()
        ->when($status == 'archive', function ($q, $search) {
                $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q, $search) {
                $q->whereNull('archived_at');
        })
        ->with('category:id,name')
        ->orderBy('title','ASC')
        ->get();
        return view('books.index',compact('books','status'));
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
            'category'          => 'required',
            'copies'            => 'required|integer',
            'author'            => 'required'
        ]);
        
        $data = [
            'isbn'              => $request->isbn,
            'title'             => $request->title,
            'publication_date'  => $request->publication_date,
            'category_id'       => $request->category,
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
            'category'          => 'required',
            'copies'            =>'required|integer',
            'author'            => 'required'
        ]);
        
        $data = [
            'isbn'              => $request->isbn,
            'title'             => $request->title,
            'publication_date'  => $request->publication_date,
            'category_id'       => $request->category,
            'copies'            => $request->copies,
            'author'            => $request->author
        ];
       
        app(BookRepository::class)->update($request->book_id,$data);
        return redirect()->route('books.index')->with('success', 'Book updated!');
    }

    public function remove(Request $request){
        app(BookRepository::class)->archive($request->book_id);
        return redirect()->route('books.index')->with('success', 'Book archived!');
    }

    public function setToActive($book_id){
        app(BookRepository::class)->archiveRemove($book_id);
        return redirect()->back()->with('success', 'Book set to active!');
    }

}
