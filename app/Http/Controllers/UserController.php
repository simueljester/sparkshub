<?php

namespace App\Http\Controllers;

use App\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\User  $model
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $status = $request->status ?? 'active';
        $users = app(UserRepository::class)->query()
        ->when($status == 'archive', function ($q) {
                $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q) {
                $q->whereNull('archived_at');
        })
        ->where('role','!=','admin')
        ->orderBy('name','ASC')
        ->get();
        return view('users.index',compact('users','status'));
    }

     public function create()
    {
        return view('users.create');
    }

    public function downloadTemplate(){
        $filepath = public_path('files/users-templateMain.xlsx');
        return Response()->download($filepath);
    }

    public function upload(Request $request){
    
        $request->validate([
            'file'=> 'required|mimes:xlsx,xls'
        ]);
     
        $rows = Excel::toArray(new UsersImport, $request->file('file'));
        $uploaded_users = $rows[0];
        $existing_emails = [];
        $existing_student_number = [];
        foreach($uploaded_users as $user){
            $existing_emails[] = User::whereEmail($user['email'])->first()->email ?? null;
            $existing_student_number[] = User::whereStudentNumber($user['student_number'])->first()->student_number ?? null;
        }

        $existing_emails = array_filter($existing_emails);
     
        $existing_student_number = array_filter($existing_student_number);
       
        //validate each field 
        Validator::make($uploaded_users, [
            '*.first_name'   => 'required',
            '*.last_name'    => 'required',
            '*.email'        => 'required',
            '*.role'         => 'required|in:student,teacher,librarian'
        ])->validate();

        return view('users.create-check-upload',compact('uploaded_users','existing_emails','existing_student_number'));
    }

    public function saveUpload(Request $request){
        $uploaded_users = json_decode($request->uploaded_users);
        foreach($uploaded_users as $user){
            if($user->role != 'student'){
                $student_number = null;
            }else{
                $student_number = $user->student_number;
            }
            $data = [
                'fname'                 => $user->first_name,
                'lname'                 => $user->last_name,
                'name'                  => $user->last_name.' '.$user->first_name,
                'student_number'        => $student_number,
                'email'                 => $user->email,
                'role'                  => $user->role,
                'password'              => Hash::make('user1234')
            ];

            app(UserRepository::class)->save($data);
        }
           
        return redirect()->route('users.index')->with('success', 'Users successfully uploaded');
    }

    public function edit(User $user){
        return view('users.edit',compact('user'));
    }

    public function update(Request $request){
   
        $request->validate([
            'fname'             => 'required',
            'lname'             => 'required',
            'student_number'    => ['required_if:role,student',Rule::unique('users')->ignore($request->id)],
            'email'             => ['required',Rule::unique('users')->ignore($request->id)],
            'role'              => 'required',
        ]);
        
        $user = User::find($request->id);
        if($user){
            $data = [
                'fname'                 => $request->fname,
                'lname'                 => $request->lname,
                'name'                  => $request->lname .' '. $request->fname,
                'student_number'        => $request->student_number,
                'email'                 => $request->email,
                'role'                  => $request->role,
                'password'              => $request->password ? Hash::make($request->password) : $user->password
            ];
        
            app(UserRepository::class)->update($request->id,$data);
            return redirect()->back()->with('success', 'User updated!');
        }else{
            return redirect()->route('users.index')->with('error', 'User not found!');
        }
    }

    public function archive(Request $request){
        app(UserRepository::class)->archive($request->user_id);
        return redirect()->route('users.index')->with('success', 'User archived!');
    }
    public function setToActive($user){
        app(UserRepository::class)->archiveRemove($user);
        return redirect()->back()->with('success', 'User set to active!');
    }

}
