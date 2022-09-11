<?php

namespace App\Http\Controllers;

use App\ModuleFile;
use Illuminate\Http\Request;
use App\Helpers\UploadHelper;
use App\Http\Repositories\ModuleFileRepository;

class ModuleFileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function addFile(Request $request){

        $file = $request->file ? UploadHelper::uploadFile($request->file) : null;

        $data = [
            'module_id' => $request->module_id,
            'file'      => $file
        ];

        app(ModuleFileRepository::class)->save($data);
        return redirect()->back()->with('success', 'Module file added!');
    }

    public function downloadContent(ModuleFile $file){
        $filepath = public_path('files/'.$file->file);
        return Response()->download($filepath);
    }

    public function removeFile(ModuleFile $file){
        app(ModuleFileRepository::class)->delete($file->id);
        return redirect()->back()->with('success', 'Module removed!');
    }
 

}
