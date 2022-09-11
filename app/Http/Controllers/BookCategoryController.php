<?php

namespace App\Http\Controllers;

use App\BookCategory;
use Illuminate\Http\Request;
use App\Http\Repositories\BookCategoryRepository;

class BookCategoryController extends Controller
{
    //
     public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        $categories = app(BookCategoryRepository::class)->query()->withCount('books')->get();
        return view('books.categories.index',compact('categories'));
    }

    public function create(){
        return view('books.categories.create');
    }

    public function save(Request $request){
        $request->validate([
            'name'   => 'required'
        ]);
        
        $data = [
            'name'  => $request->name
        ];

        app(BookCategoryRepository::class)->save($data);
        return redirect()->route('books.categories.index')->with('success', 'Category saved!');
    }

    public function edit(BookCategory $book_category){
        return view('books.categories.edit',compact('book_category'));
    }

    public function update(Request $request){
     
        $request->validate([
            'name'   => 'required'
        ]);
        
        $data = [
            'name'  => $request->name
        ];
       
        app(BookCategoryRepository::class)->update($request->category_id,$data);
        return redirect()->route('books.categories.index')->with('success', 'Category updated!');
    }

    public function remove(Request $request){
        app(BookCategoryRepository::class)->delete($request->category_id);
        return redirect()->route('books.categories.index')->with('success', 'Category removed!');
    }
}
