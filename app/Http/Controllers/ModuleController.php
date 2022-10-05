<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Module;
use Carbon\Carbon;
use App\ModuleFile;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File; 
use App\Http\Repositories\ModuleRepository;
use App\Http\Repositories\SubjectRepository;
use App\Http\Repositories\ModuleFileRepository;
use App\Http\Repositories\NotificationRepository;

class ModuleController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request){
        Paginator::useBootstrap();
        $status = $request->status ?? 'active';
        $modules = app(ModuleRepository::class)->query()
        ->when($status == 'archive', function ($q) {
            $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q) {
            $q->whereNull('archived_at');
        })
        ->with('subject','user') 
        ->orderBy('title','ASC')
        ->paginate(10);

        return view('modules.index',compact('modules','status'));
    }

    public function create(){
        $subjects = app(SubjectRepository::class)->query()->get();
        return view('modules.create',compact('subjects'));
    }

    public function save(Request $request){
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'subject_id'    => 'required'
        ]);
        
        $data = [
            'title'         => $request->title,
            'description'   => $request->description,
            'user_id'       => Auth::user()->id,
            'subject_id'    => $request->subject_id,
            'downloadable'  => $request->downloadable ?? 0
        ];

        $module = app(ModuleRepository::class)->save($data);
        return redirect()->route('modules.manage',$module)->with('success', 'Module is subject for aporoval!');
    }  
    
    public function edit(Module $module){
        $subjects = app(SubjectRepository::class)->query()->get();
        $module->load('user','subject','files');
        return view('modules.edit',compact('module','subjects'));
    }

    public function update(Request $request){
        $request->validate([
            'title'         => 'required',
            'description'   => 'required',
            'subject_id'    => 'required'
        ]);
        
        $data = [
            'title'         => $request->title,
            'description'   => $request->description,
            'user_id'       => Auth::user()->id,
            'subject_id'    => $request->subject_id,
            'downloadable'  => $request->downloadable ?? 0
        ];

        app(ModuleRepository::class)->update($request->module_id,$data);
        return redirect()->route('modules.manage',$request->module_id)->with('success', 'Module updated!');
    }

    public function manage(Module $module){
        $module->load('user','subject','files');
        return view('modules.manage',compact('module'));
    }

    public function approve(Module $module){
        DB::beginTransaction();
        try {
            $requested_book = app(ModuleRepository::class)->approve($module->id,Carbon::now()->format('Y-m-d'));
            $notification_data = [
                'notifiable_id' => $module->user_id,
                'notified_by'   => Auth::user()->id,
                'description'   => 'approved your modules',
                'url'           => '/modules/manage/'.$module->id,
                'read_at'       => null
            ];
            app(NotificationRepository::class)->save($notification_data);
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->route('modules.index')->with('error', 'There are some errors in your requests');
        }
        return redirect()->back()->with('success', 'Modules approved');
    }

    public function archive(Request $request){
        app(ModuleRepository::class)->archive($request->module_id);
        return redirect()->route('modules.index',['status'=>'archive'])->with('success', 'Module set to archived!');
    }

    public function setToActive($module_id){
        app(ModuleRepository::class)->archiveRemove($module_id);
        return redirect()->route('modules.index',['status'=>'active'])->with('success', 'Module set to active!');
    }

    public function delete(Request $request){
        $files = app(ModuleFileRepository::class)->query()->whereModuleId($request->module_id)->pluck('file');
        if(!empty($files)){
            foreach($files as $file){
                 File::delete(public_path('files/'.$file));
            }
        }
        app(ModuleRepository::class)->delete($request->module_id);
        return redirect()->back()->with('success', 'Module successfully deleted!');
    }
}
