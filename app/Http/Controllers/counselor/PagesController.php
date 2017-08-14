<?php

namespace App\Http\Controllers\counselor;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;

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
     * Show the home page for counselor.
     * Redirect users back to their page if they are not counselor.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $notification = $this->checkUser('counselor');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        if(isset($request->keyword))
        {
            $announcements = Announcement::where('title', 'like', '%' . $request->keyword . '%')
                ->orWhere('body', 'like', '%' . $request->keyword . '%')
                ->WhereYear('created_at', '=', $request->keyword, 'or')
                ->orderBy('id', 'desc')
                ->paginate(6);
            return view('counselor.home')->withAnnouncements($announcements);
        }

        $announcements = Announcement::orderBy('id', 'desc')->paginate(6);
        return view('counselor.home')->withAnnouncements($announcements);
    }
}
