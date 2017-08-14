<?php

namespace App\Http\Controllers\student;

use App\Models\Announcement;
use App\Models\Career;
use App\Models\Counselor;
use App\Models\Major;
use App\Models\SchoolAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
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
     * Show the home page for student.
     * Redirect users back to their page if they are not student.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index(Request $request)
    {
        $notification = $this->checkUser('student');
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
            return view('student.home')->withAnnouncements($announcements);
        }

        $announcements = Announcement::orderBy('id', 'desc')->paginate(6);
        return view('student.home')->withAnnouncements($announcements);
    }

    /**
     * Show the message page for student.
     * Redirect users back to their page if they are not student.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function message(Request $request)
    {
        $notification = $this->checkUser('student');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        if(isset($request->keyword))
        {
            $keyword = $request->keyword;

            $counselors = Counselor::join('users', 'users.id', '=', 'counselors.user_id')
                ->where('counselors.status', '=', 'active')
                ->where(function($query) use ($keyword) {
                    $query->orwhere('counselors.first_name', 'like', '%' . $keyword . '%')
                        ->orwhere('counselors.last_name', 'like', '%' . $keyword . '%')
                        ->orwhere('counselors.school_name', 'like', '%' . $keyword . '%')
                        ->orwhere('users.email', 'like', '%' . $keyword . '%');
                })
                ->select('*','counselors.id as counselor_id')
                ->paginate(5);
            return view('student.message')->withCounselors($counselors);
        }

        $counselors = Counselor::join('users', 'users.id', '=', 'counselors.user_id')
            ->where('counselors.status', '=', 'active')
            ->select('*','counselors.id as counselor_id')
            ->paginate(5);
        return view('student.message')->withCounselors($counselors);
    }

    public function decision()
    {
        $majors = Major::all();
        $careers = Career::all();
        $decision = Auth::user()->student->decision;

        return view('student.decision')->withMajors($majors)->withCareers($careers)->withDecision($decision);
    }

    public function decision_store(Request $request)
    {
        $decision = Auth::user()->student->decision;
        $decision->major_id = $request->majors;
        $decision->career_id = $request->careers;

        $decision->save();

        $notification = array(
            'title' => 'Decisions Saved',
            'message' => 'You have successfully saved your decisions!',
            'alert-type' => 'success'
        );

        return redirect()->route('student.home')->with($notification);
    }
}
