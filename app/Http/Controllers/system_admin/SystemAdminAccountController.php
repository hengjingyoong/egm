<?php

namespace App\Http\Controllers\system_admin;

use App\Http\Controllers\Controller;
use App\Models\SystemAdmin;
use App\Models\User;
use Illuminate\Http\Request;

class SystemAdminAccountController extends Controller
{
    /**
     * SystemAdminAccountController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the form for creating a new resource.
     * Redirect users back to their page if they are not system admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = $this->checkUser('system_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        return view('system_admin.account.create');
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
            'last_name' => 'required|string|min:2|max:32'
        ));

        $user = new User();
        $user->email = $request->email;
        $user->password = bcrypt($request->password);
        $user->role = 'system_admin';
        $user->save();

        $admin= new SystemAdmin();
        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->user_id = $user->id;
        $admin->save();

        $notification = array(
            'title' => 'Account Created',
            'message' => 'You have successfully created the system admin account!',
            'alert-type' => 'success'
        );

        return redirect()->route('system_admin.home')->with($notification);
    }


    /**
     * Show the form for editing the specified resource.
     * Redirect users back to their page if they are not system admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification = $this->checkUser('system_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $user = User::find($id);
        return view('system_admin.account.edit')->withUser($user);
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
        $admin = $user->system_admin;

        $this->validate($request,array(
            'email' => "required|string|email|max:255|unique:users,email,$id",
            'password' => 'nullable|string|min:6|confirmed',
            'first_name' => 'required|string|min:2|max:32',
            'last_name' => 'required|string|min:2|max:32'
        ));

        $user->email = $request->email;
        if($request->password <> '') {$user->password = bcrypt($request->password);}
        $user->save();

        $admin->first_name = $request->first_name;
        $admin->last_name = $request->last_name;
        $admin->save();

        $notification = array(
            'title' => 'Account Updated',
            'message' => 'You have successfully updated your account!',
            'alert-type' => 'success'
        );

        return redirect()->route('system_admin.home')->with($notification);
    }
}
