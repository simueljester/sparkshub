<?php

namespace App\Http\Controllers;

use App\Subject;
use Illuminate\Http\Request;
use App\Http\Repositories\SubjectRepository;

class SubjectController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $subjects = app(SubjectRepository::class)->query()->withCount('modules')->get();
        return view('modules.subjects.index',compact('subjects'));
    }

    public function create(){
        return view('modules.subjects.create');
    }

    public function save(Request $request){

        $request->validate([
            'name'   => 'required'
        ]);
        
        $data = [
            'name'  => $request->name
        ];

        app(SubjectRepository::class)->save($data);
        return redirect()->route('modules.subjects.index')->with('success', 'Subject saved!');
    }

    public function edit(Subject $subject){
        return view('modules.subjects.edit',compact('subject'));
    }

    public function update(Request $request){

        $request->validate([
            'name'   => 'required'
        ]);
        
        $data = [
            'name'  => $request->name
        ];

        app(SubjectRepository::class)->update($request->subject_id,$data);
        return redirect()->route('modules.subjects.index')->with('success', 'Subject updated!');
    }



}
