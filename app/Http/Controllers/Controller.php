<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Check if the correct users access the pages.
     *
     * @param $userType
     * @return array|string
     */
    public function checkUser($userType)
    {
        $notification = '';
        if(Auth::user()->role <> $userType)
        {
            $notification = array(
                'title' => 'Access Denied',
                'message' => 'You have no access right to ' . $userType .' pages!',
                'alert-type' => 'error'
            );
        }
        return $notification;
    }
}