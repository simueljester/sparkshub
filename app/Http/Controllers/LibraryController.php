<?php

namespace App\Http\Controllers;

use Auth;
use App\Module;
use Illuminate\Http\Request;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\ModuleRepository;
use App\Http\Repositories\SubjectRepository;
use App\Http\Repositories\BookCategoryRepository;

class LibraryController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    
    public function index(Request $request){
        return view('library.index');
    }

    public function indexBooks(Request $request){
        $keyword = $request->keyword ?? null;
        $category_filter = $request->category_filter ?? null;
        $books = app(BookRepository::class)->query()
        ->when(Auth::user()->role == 'student', function ($query) {
            $query->whereGradeLevel(Auth::user()->grade_level); 
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
        ->whereNull('archived_at')
        ->get();

        $categories = app(BookCategoryRepository::class)->query()->get();

        return view('library.index-books',compact('books','keyword','categories','category_filter'));
    }

    public function indexModules(Request $request){
        $keyword = $request->keyword ?? null;
        $subjects = app(SubjectRepository::class)->query()->get();
        $subject_filter = $request->subject_filter ?? null;

        $modules = app(ModuleRepository::class)->query()
        ->when(Auth::user()->role == 'student', function ($query) {
            $query->whereGradeLevel(Auth::user()->grade_level); 
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('title', 'like', '%' . $keyword . '%');
        })
        ->when($subject_filter, function ($query) use ($subject_filter) {
            $query->whereSubjectId($subject_filter);
        })
        ->with('subject:id,name','user:id,name')
        ->orderBy('title','ASC')
        ->whereNull('archived_at')
        ->whereNotNull('approved_at')
        ->get();
       
        return view('library.index-modules',compact('keyword','subjects','subject_filter','modules'));
    }

    public function showModules(Module $module){
        $module->load('user','subject','files');
        return view('library.show-module',compact('module'));
    }
}
