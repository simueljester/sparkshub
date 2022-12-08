<?php

namespace App\Http\Controllers;

use Auth;
use App\User;
use App\Imports\UsersImport;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Repositories\UserRepository;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Illuminate\Pagination\Paginator;

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
        Paginator::useBootstrap();
        $status = $request->status ?? 'active';
        $keyword = $request->keyword ?? null;
        $users = app(UserRepository::class)->query()
        ->when($status == 'archive', function ($q) {
                $q->whereNotNull('archived_at');
        })
        ->when($status == 'active', function ($q) {
                $q->whereNull('archived_at');
        })
        ->when($keyword, function ($query) use ($keyword) {
            $query->where('name', 'like', '%' . $keyword . '%')->orWhere('student_number', 'like', '%' . $keyword . '%');
        })
        ->where('role','!=','admin')
        ->orderBy('name','ASC')
        ->paginate(10);
        return view('users.index',compact('users','status','keyword'));
    }

     public function create()
    {
        return view('users.create');
    }

    public function downloadTemplate(){
        $filepath = public_path('files/users-templateMain.xlsx');
        return Response()->download($filepath);
    }

    public function saveManual(Request $request){
      
        $request->validate([
            'email'         => 'required|unique:users,email',
        ]);

        if($request->role == 'student'){
            $existing_student_number = User::whereStudentNumber($request->student_no)->first() ?? null;
            if($existing_student_number){
                return redirect()->route('users.create')->with('error', 'Student No. already exist');
            }
            if($request->grade_level == 0){
                return redirect()->route('users.create')->with('error', 'Grade Level required');
            }
           
        }

        $data = [
            'fname'                 => $request->fname,
            'lname'                 => $request->lname,
            'name'                  => $request->lname.' '.$request->fname,
            'student_number'        => $request->student_no,
            'email'                 => $request->email,
            'role'                  => $request->role,
            'grade_level'           => $request->role == 'student' ? $request->grade_level : 0,
            'password'              => Hash::make($request->password)
        ];

        try {
            app(UserRepository::class)->save($data);
            return redirect()->route('users.index')->with('success', 'User successfully added');
        }
        //catch exception
        catch(\Exception $e) {
            return redirect()->route('users.create')->with('error', 'The data you are trying to input is invalid. Please make sure the ff: 1.) Student No. must not contain special characters. 2.) Email Address must have "@" to be considered as email ');
        }
     

       
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
            '*.role'         => 'required|in:student,teacher,librarian',
            '*.grade_level'  => 'required',
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
                'grade_level'           => $user->role == 'student' ? $user->grade_level : 0,
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
            'email'             => ['required',Rule::unique('users')->ignore($request->id)],
            'role'              => 'required'
        ]);

        if($request->role == 'student'){
            $request->validate([
                'student_number'=> ['required_if:role,student',Rule::unique('users')->ignore($request->id)],
            ]);
        }
        
        $user = User::find($request->id);
        if($user){
            $data = [
                'fname'                 => $request->fname,
                'lname'                 => $request->lname,
                'name'                  => $request->lname .' '. $request->fname,
                'student_number'        => $request->student_number,
                'email'                 => $request->email,
                'role'                  => $request->role ?? $user->role,
                'grade_level'           => $request->role == 'student' ? $request->grade_level : 0,
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
        User::find($request->user_id)->update(['archived_reason' => $request->archived_reason ?? 'Your account is currently inactive. Please contact your administrator']);
        return redirect()->route('users.index')->with('success', 'User archived!');
    }
    public function setToActive($user){
        app(UserRepository::class)->archiveRemove($user);
        User::find($user)->update(['archived_reason' => null]);
        return redirect()->back()->with('success', 'User set to active!');
    }

    public function profile(User $user){
        return view('users.profile',compact('user'));
    }

    public function uploadAvatar(Request $request){

        $image = $request->image;
        $imageName = time().'.'.$image->getClientOriginalExtension();

        $destinationPath = 'images/';
        $img = Image::make($image->getRealPath());
        $img->resize(150, 150, function ($constraint) {
            $constraint->aspectRatio();
        })->save($destinationPath.'/'.$imageName);

        $user = app(UserRepository::class)->find(Auth::user()->id);
        $user->avatar = $imageName;
        $user->save();

        return redirect()->back()->with('success','Image uploaded successfully.')->with('image',$imageName);
    }

}
