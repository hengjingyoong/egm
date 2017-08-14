<?php

namespace App\Http\Controllers\school_admin;

use App\Models\Announcement;
use App\Models\Decision;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
     * Show the home page for school admin.
     * Redirect users back to their page if they are not school admin.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $notification = $this->checkUser('school_admin');
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
            return view('school_admin.home')->withAnnouncements($announcements);
        }

        $announcements = Announcement::orderBy('id', 'desc')->paginate(6);
        return view('school_admin.home')->withAnnouncements($announcements);
    }

    public function statistic()
    {
        $careers = Decision::with(array('career'=>function($query){
                                $query->select('id', 'name');
                                }))
                                ->select('career_id', DB::raw('COUNT(career_id) as count'))
                                ->groupBy('career_id')
                                ->orderBy('count', 'desc')
                                ->take(10)->get();

        $majors = Decision::with(array('major'=>function($query){
                                $query->select('id', 'name');
                                }))
                                ->select('major_id', DB::raw('COUNT(major_id) as count'))
                                ->groupBy('major_id')
                                ->orderBy('count', 'desc')
                                ->take(10)->get();

        return view('school_admin.statistic')->withCareers($careers)->withMajors($majors);
    }
}
