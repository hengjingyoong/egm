<?php

namespace App\Http\Controllers\student;

use App\Models\Decision;
use App\Models\User;
use App\Models\Student;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class StudentAccountController extends Controller
{
    /**
     * StudentAccountController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth')->except('create', 'store');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('student.account.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'first_name' => 'required|string|min:2|max:32',
            'last_name' => 'required|string|min:2|max:32',
            'gender' => 'required|max:1',
            'age' => 'required|integer'
        ));

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'student';
        $user->save();

        $student = new Student();
        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->age = $request->age;
        $student->user_id = $user->id;
        $student->save();

        $decision = new Decision();
        $decision->student_id = $student->id;
        $decision->save();

        $notification = array(
            'title' => 'Account Created',
            'message' => 'You have successfully created your student account!',
            'alert-type' => 'success'
        );

        Auth::guard()->login($user);
        return redirect()->route('student.home')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     * Redirect users back to their page if they are not student.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = $this->checkUser('student');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $user = User::find($id);
        return view('student.account.edit')->withUser($user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $student = $user->student;

        $this->validate($request,array(
            'email' => "required|string|email|max:255|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'first_name' => 'required|string|min:2|max:32',
            'last_name' => 'required|string|min:2|max:32',
            'gender' => 'required|max:1',
            'age' => 'required|integer'
        ));

        $user->email = $request->email;
        if($request->password <> '') {$user->password = bcrypt($request->password);}
        $user->save();

        $student->first_name = $request->first_name;
        $student->last_name = $request->last_name;
        $student->gender = $request->gender;
        $student->age = $request->age;
        $student->save();

        $notification = array(
            'title' => 'Account Updated',
            'message' => 'You have successfully updated your account!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.home')->with($notification);
    }
}
