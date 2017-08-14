<?php

namespace App\Http\Controllers\school_admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolAdmin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SchoolAdminAccountController extends Controller
{
    /**
     * SchoolAdminAccountController constructor.
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
        return view('school_admin.account.create');
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
            'school_name' => 'required|string|min:10|max:60',
            'letter' => 'required|file'
        ));

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'school_admin';
        $user->save();

        $admin = new SchoolAdmin();
        $admin->school_name = $request->school_name;
        $admin->status = 'inactive';
        $admin->user_id = $user->id;

        $letter = $request->file('letter');
        $filename = time() . '.' . $letter->getClientOriginalExtension();
        Storage::disk('letters')->put($filename, File::get($letter));
        $admin->letter = $filename;

        $admin->save();

        $notification = array(
            'title' => 'Account Created',
            'message' => 'You have successfully created your school admin account!',
            'alert-type' => 'success'
        );

        Auth::guard()->login($user);
        return redirect()->route('school_admin.home')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     * Redirect users back to their page if they are not school admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = $this->checkUser('school_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $user = User::find($id);
        return view('school_admin.account.edit')->withUser($user);
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
        $admin = $user->school_admin;

        $this->validate($request,array(
            'email' => "required|string|email|max:255|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'school_name' => 'required|string|min:10|max:60',
            'letter' => 'file'
        ));

        $user->email = $request->email;
        if($request->password <> '') {$user->password = bcrypt($request->password);}
        $user->save();


        $admin->school_name = $request->school_name;
        if($request->hasFile('letter'))
        {
            $letter = $request->file('letter');
            $filename = time() . '.' . $letter->getClientOriginalExtension();
            Storage::disk('letters')->put($filename, File::get($letter));

            $oldfilename = $admin->letter;
            $admin->letter = $filename;

            Storage::disk('letters')->delete($oldfilename);
        }

        if($request->hasFile('letter') && $admin->status == 'rejected')
        {
            $admin->status = 'inactive';
        }
        $admin->save();

        $notification = array(
            'title' => 'Account Updated',
            'message' => 'You have successfully updated your account!',
            'alert-type' => 'success'
        );

        return redirect()->route('school_admin.home')->with($notification);
    }
}
