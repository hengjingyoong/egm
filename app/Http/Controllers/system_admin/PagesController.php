<?php

namespace App\Http\Controllers\system_admin;

use App\Http\Controllers\Controller;
use App\Models\Counselor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    /**
     * PagesController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show list of all counselor accounts.
     * Redirect users back to their page if they are not system admin.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        $notification = $this->checkUser('system_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        if(isset($request->keyword) || isset($request->search_status))
        {
            $keyword = $request->keyword;

            if($request->search_status == 'all'){
                $counselors = Counselor::join('users', 'users.id', '=', 'counselors.user_id')
                    ->orwhere('counselors.first_name', 'like', '%' . $keyword . '%')
                    ->orwhere('counselors.last_name', 'like', '%' . $keyword . '%')
                    ->orwhere('counselors.school_name', 'like', '%' . $keyword . '%')
                    ->orwhere('users.email', 'like', '%' . $keyword . '%')
                    ->select('*','counselors.id as counselor_id')
                    ->orderBy('counselors.id', 'desc')
                    ->paginate(5);
            }else{
                $counselors = Counselor::join('users', 'users.id', '=', 'counselors.user_id')
                    ->where('counselors.status', '=', $request->search_status)
                    ->where(function($query) use ($keyword) {
                        $query->orwhere('counselors.first_name', 'like', '%' . $keyword . '%')
                            ->orwhere('counselors.last_name', 'like', '%' . $keyword . '%')
                            ->orwhere('counselors.school_name', 'like', '%' . $keyword . '%')
                            ->orwhere('users.email', 'like', '%' . $keyword . '%');
                    })
                    ->select('*','counselors.id as counselor_id')
                    ->orderBy('counselors.id', 'desc')
                    ->paginate(5);
            }
            return view('system_admin.home')->withCounselors($counselors);
        }

        $counselors = Counselor::join('users', 'users.id', '=', 'counselors.user_id')
            ->select('*','counselors.id as counselor_id')
            ->orderBy('counselors.id', 'desc')
            ->paginate(5);
        return view('system_admin.home')->withCounselors($counselors);
    }
}
