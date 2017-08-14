<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\SchoolAdmin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnnouncementController extends Controller
{
    /**
     * AnnouncementController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show selected announcement.
     *
     * @param $id
     * @return mixed
     */
    public function single($id)
    {
        $announcement = Announcement::find($id);
        return view('announcements.single')->withAnnouncement($announcement);
    }

    /**
     * Return the school name that posted the announcement.
     *
     * @param $admin_id
     * @return mixed
     */
    public static function getSchoolName($admin_id)
    {
        $admin = SchoolAdmin::find($admin_id);
        return $admin->school_name;
    }
}
