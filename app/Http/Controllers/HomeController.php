<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\ModuleRepository;
use App\Http\Repositories\RequestedBookRepository;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('dashboard');
    }

     public function dashboard(Request $request)
    {
        //get general counts
        $books_count = app(BookRepository::class)->query()->whereNull('archived_at')->count();
        $modules_count = app(ModuleRepository::class)->query()->whereNull('archived_at')->count();
        $users_count = app(UserRepository::class)->query()->whereNull('archived_at')->count();
        $counts = (object)[
            'books' => $books_count,
            'modules' => $modules_count,
            'users' => $users_count
        ];

        //get user role counts
        $users = app(UserRepository::class)->query()->whereNull('archived_at')->get()->toArray();
        $librarians = count(array_filter($users, function ($var) {
            return ($var['role'] == 'librarian');
        }));
        $students = count(array_filter($users, function ($var) {
            return ($var['role'] == 'student');
        }));
        $teachers = count(array_filter($users, function ($var) {
            return ($var['role'] == 'teacher');
        }));
        $role_counts = (object)[
            'librarians' => $librarians,
            'students' => $students,
            'teachers' => $teachers
        ];

        //get requested books per month
        $requested_books = app(RequestedBookRepository::class)->query()->selectRaw('year(approved_at) year, month(approved_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        $filter_year = $request->filter_year ??  Carbon::now()->format('Y');

        $requested_books = $requested_books->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        return view('dashboard-new',compact('counts','role_counts','filter_year','requested_books'));
    }
}
