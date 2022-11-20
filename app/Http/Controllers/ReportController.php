<?php

namespace App\Http\Controllers;

use Excel;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Exports\BookExport;
use Illuminate\Http\Request;
use App\Exports\ModuleExport;
use Illuminate\Pagination\Paginator;
use App\Http\Repositories\BookRepository;
use App\Http\Repositories\UserRepository;
use App\Http\Repositories\ModuleRepository;
use App\Http\Repositories\UserLogRepository;
use App\Http\Repositories\LostBookRepository;
use App\Http\Repositories\RequestedBookRepository;

class ReportController extends Controller
{
    //

    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        //get general counts
        $books_requested_count = app(RequestedBookRepository::class)->query()->count();
        $modules_count = app(ModuleRepository::class)->query()->whereNull('archived_at')->count();
        $users_count = app(UserRepository::class)->query()->whereNull('archived_at')->count();
        $counts = (object)[
            'books_requested_count' => $books_requested_count,
            'modules' => $modules_count,
            'users' => $users_count
        ];
        return view('reports.index',compact('counts'));
    }

    public function indexRequestedBookReports(Request $request){
        $filter_year = $request->filter_year ??  Carbon::now()->format('Y');

        //get requested books per month
        $requested_books = app(RequestedBookRepository::class)->query()->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        $requested_books = $requested_books->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        $arr_requested_books = [];
        for($month = 1; $month <= 12; $month ++){
            $arr_requested_books[$month] = $requested_books[$month]->data ?? 0;
        }


        //get approved books per month
        $approved_books = app(RequestedBookRepository::class)->query()->selectRaw('year(approved_at) year, month(approved_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        $approved_books = $approved_books->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        $arr_approved = [];
        for($month = 1; $month <= 12; $month ++){
            $arr_approved[$month] = $approved_books[$month]->data ?? 0;
        }


        //get lost books per month
        $lost_books = app(RequestedBookRepository::class)->query()->selectRaw('year(lost_at) year, month(lost_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();
        
        $lost_books = $lost_books->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        $arr_lost = [];
        for($month = 1; $month <= 12; $month ++){
            $arr_lost[$month] = $lost_books[$month]->data ?? 0;
        }

        return view('reports.book-report',compact('filter_year','arr_requested_books','arr_approved','arr_lost'));
    }

    public function indexRequestedBookReportsMonthly($month,$year){

   


        //daily
        $month_year = Carbon::parse($year.'-'.$month)->format('F-Y');
        $parsed_month_year_start = Carbon::parse($year.'-'.$month)->startOfMonth()->format('Y-m-d');
        $parsed_month_year_end = Carbon::parse($year.'-'.$month)->endOfMonth()->format('Y-m-d');
        $period = CarbonPeriod::create($parsed_month_year_start, $parsed_month_year_end);
        $daily = [];
        foreach ($period as $date) {
            $d = $date->format('Y-m-d');
            $requested = app(RequestedBookRepository::class)->query()
            ->with('user:id,name','approverAccount:id,name','book:id,title,isbn')
            ->whereDate('created_at','=',$d)
            ->get();
            $daily[] = [
                'date' => $d,
                'data' => $requested,
                'total_count' => $requested->count(),
                'approved_count' => $requested->whereNotNull('approved_at')->count(),
                'lost_count' => $requested->whereNotNull('lost_at')->count(),
                'pending_count' => $requested->whereNull('approved_at')->whereNull('lost_at')->count()
            ];
        }
        // dd($daily);
        $daily = json_encode($daily);
        return view('reports.book-report-monthly',compact('month_year','daily'));
    }

    public function indexRequestedBookReportsExport(){
        $data = app(RequestedBookRepository::class)->query()->with('book:id,title,category_id','book.category:id,name','user:id,role,name','approverAccount:id,name')->get();
        return Excel::download(new BookExport($data), 'BookReports.xlsx');
    }
    
    public function indexModuleReports(Request $request){
        $filter_year = $request->filter_year ??  Carbon::now()->format('Y');
    
        //get created modules per month
        $created_modules = app(ModuleRepository::class)->query()->selectRaw('year(created_at) year, month(created_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        $created_modules = $created_modules->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        $arr_created_modules = [];
        for($month = 1; $month <= 12; $month ++){
            $arr_created_modules[$month] = $created_modules[$month]->data ?? 0;
        }

        //get approved modules per month
        $approved_modules = app(ModuleRepository::class)->query()->selectRaw('year(approved_at) year, month(approved_at) month, count(*) data')
        ->groupBy('year', 'month')
        ->orderBy('year', 'desc')
        ->get();

        $approved_modules = $approved_modules->filter(function ($item) use($filter_year) {
            return $item->year == $filter_year;
        })->values()->keyBy('month');

        $arr_approved_modules = [];
        for($month = 1; $month <= 12; $month ++){
            $arr_approved_modules[$month] = $approved_modules[$month]->data ?? 0;
        }
        return view('reports.module-report',compact('arr_approved_modules','arr_created_modules','filter_year'));
    }

    public function indexModuleReportsExport(){
        $data = app(ModuleRepository::class)->query()->with('subject:id,name','user:id,role,name','approverAccount:id,name')
        ->withCount('files')->get();
        return Excel::download(new ModuleExport($data), 'ModuleReport.xlsx');
    }

    public function indexUserReports(Request $request){
        Paginator::useBootstrap();
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
        //logs
        $start_date = $request->start_date ? Carbon::parse($request->start_date)->format('Y-m-d')." 00:00:00" : null;
        $end_date = $request->end_date ? Carbon::parse($request->end_date)->format('Y-m-d')." 23:59:59" : null;
   
        $logs = app(UserLogRepository::class)->query()->with('user:id,name,student_number,role,avatar')
        ->when($start_date && $end_date, function ($query) use($start_date,$end_date){
            $query->whereBetween('created_at', [$start_date, $end_date]);
        })
        ->orderby('created_at','DESC')
        ->paginate(50);
        return view('reports.user-report',compact('logs','role_counts','start_date','end_date'));
    }

}
