<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\BookCategoryRepository;

class LibraryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(Request $request){
        $keyword = $request->keyword ?? null;
        $category_filter = $request->category_filter ?? null;
        $books = app(BookRepository::class)->query()
        ->when($keyword, function ($query) use ($keyword,$category_filter) {
            $query->whereCategoryId($category_filter)
            ->where('title', 'like', '%' . $keyword . '%')
            ->orWhere('isbn', 'like', '%' . $keyword . '%')
            ->orWhere('author', 'like', '%' . $keyword . '%'); 
   
        })
        ->when($category_filter, function ($query) use ($category_filter) {
            $query->whereCategoryId($category_filter);
        })
        ->with('category:id,name')
        ->orderBy('title','ASC')
        ->whereNull('archived_at')
        ->get();

        $categories = app(BookCategoryRepository::class)->query()->get();

        return view('library.index',compact('books','keyword','categories','category_filter'));
    }
}
