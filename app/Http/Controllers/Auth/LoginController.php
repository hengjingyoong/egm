<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    // Contains all the built in functions for login
    use AuthenticatesUsers;

    /**
     * LoginController constructor.
     * Only guest can access this controller.
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Override login function in AuthenticatesUsers
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        // Check if the login information is correct
        if(Auth::guard()->attempt(['email' => $request->email, 'password' => $request->password,
            'role' => $request->role], $request->remember))
        {
            // Set different name for different users
            switch($request->role)
            {
                case 'student':
                    $auth_user = Auth::user()->student->first_name;
                    break;
                case 'counselor':
                    $auth_user = Auth::user()->counselor->first_name;
                    break;
                case 'school_admin':
                    $auth_user = Auth::user()->school_admin->school_name . ' Admin';
                    break;
                case 'system_admin':
                    $auth_user = Auth::user()->system_admin->first_name;
                    break;
            }
            // This variable stores the pop out success login messages
            $notification = array(
                'title' => 'Login Successful ',
                'message' => 'Welcome ' . $auth_user . '! You have successfully login to your ' . $request->role . ' account!',
                'alert-type' => 'success'
            );
            // Redirect user to their respective home page based on their role
            return redirect()->route($request->role . '.home')->with($notification);
        }
        // This variable stores the pop out error login messages
        $notification = array(
            'title' => 'Invalid Credentials',
            'message' => 'Incorrect email address and/or password for ' . $request->role . '!',
            'alert-type' => 'error'
        );
        // Redirect users back to login page with error message
        return redirect()->back()->withInput($request->only('email', 'role','remember'))->with($notification);
    }
}
