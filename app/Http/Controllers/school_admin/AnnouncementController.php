<?php

namespace App\Http\Controllers\school_admin;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

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
     * Display a listing of the posted announcements.
     * Show search results if keyword variable is set.
     *
     * @return mixed
     */
    public function index()
    {
        $announcements = Announcement::where('admin_id', Auth::user()->school_admin->id)->orderBy('id', 'desc')->paginate(6);
        return view('school_admin.announcements.index')->withAnnouncements($announcements);
    }

    /**
     * Show the form for creating a new resource.
     * Redirect users back to their page if they are not school admin.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $notification = $this->checkUser('school_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        return View('school_admin.announcements.create');
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
            "title" => 'required|min:5|max:100',
            'body' => 'required',
            'image' => 'image'
        ));

        $announcement = new Announcement();
        $announcement->title = $request->title;
        $announcement->body = $request->body;
        $announcement->admin_id = Auth::user()->school_admin->id;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('announcements/' . $filename);
            Image::make($image)->resize(400,200)->save($location);

            $announcement->image = $filename;
        }

        $announcement->save();

        $notification = array(
            'title' => 'Announcement Posted',
            'message' => 'You have successfully posted new announcement!',
            'alert-type' => 'success'
        );
        return redirect()->route('school_admin_announcement.show', $announcement->id)->with($notification);
    }

    /**
     * Display the specified resource.
     * Redirect users back to their page if they are not school admin.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = $this->checkUser('school_admin');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $announcement = Announcement::find($id);
        return view('school_admin.announcements.show')->withAnnouncement($announcement);
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

        $announcement = Announcement::find($id);
        return view('school_admin.announcements.edit')->withAnnouncement($announcement);
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
        $announcement = Announcement::find($id);

        $this->validate($request,array(
            "title" => 'required|min:5|max:100',
            'body' => 'required',
            'image' => 'image'
        ));

        $announcement->title = $request->title;
        $announcement->body = $request->body;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('announcements/' . $filename);
            Image::make($image)->resize(400,200)->save($location);

            if($announcement->image <> null)
            {
                $oldFileName = $announcement->image;
                $announcement->image = $filename;
                Storage::disk('announcements')->delete($oldFileName);
            }
            else {
                $announcement->image = $filename;
            }
        }
        $announcement->save();

        $notification = array(
            'title' => 'Announcement Updated',
            'message' => 'You have successfully updated the announcement!',
            'alert-type' => 'success'
        );
        return redirect()->route('school_admin_announcement.show', $announcement->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $announcement = Announcement::find($id);

        if($announcement->image <> null) {
            Storage::disk('announcements')->delete($announcement->image);
        }
        $announcement->delete();

        $notification = array(
            'title' => 'Announcement Deleted',
            'message' => 'The announcement was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('school_admin.home')->with($notification);
    }
}
