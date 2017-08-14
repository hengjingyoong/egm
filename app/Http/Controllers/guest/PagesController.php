<?php

namespace App\Http\Controllers\guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function index()
    {
        if(Auth::check())
        {
            $notification = array(
                'title' => 'Access Denied',
                'message' => 'You have to logout first before access to the welcome page!',
                'alert-type' => 'warning'
            );
            return redirect()->back()->with($notification);
        }
        return view('guest.welcome');
    }

    public function about()
    {
        return view('guest.about_us');
    }

    public function serviceSS()
    {
        return view('guest.service_ss');
    }

    public function serviceUC()
    {
        return view('guest.service_uc');
    }

    public function term()
    {
        return view('guest.term');
    }

    public function privacy()
    {
        return view('guest.privacy');
    }
}
