<?php

namespace App\Http\Controllers\system_admin;

use App\Http\Controllers\Controller;
use App\Models\Major;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    /**
     * MajorController constructor.
     * Only authenticated user can access this controller.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the majors.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->keyword))
        {
            $majors = Major::where('name', 'like', '%' . $request->keyword . '%')->paginate(10);
            return view('system_admin.major.index')->withMajors($majors);
        }

        $majors = Major::paginate(10);
        return view('system_admin.major.index')->withMajors($majors);
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
            "name" => 'required|max:100'
        ));

        $major = new Major();
        $major->name = $request->name;

        $major->save();

        $notification = array(
            'title' => 'Major Added',
            'message' => 'You have successfully added new major!',
            'alert-type' => 'success'
        );

        return redirect()->route('major.index')->with($notification);
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
        $major = Major::find($id);

        $this->validate($request,array(
            "name" => 'required|max:100'
        ));

        $major->name = $request->name;
        $major->save();

        $notification = array(
            'title' => 'Major Updated',
            'message' => 'You have successfully updated the major!',
            'alert-type' => 'success'
        );

        return redirect()->route('major.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $major = Major::find($id);
        $major->delete();

        $notification = array(
            'title' => 'Major Deleted',
            'message' => 'The major was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('major.index')->with($notification);
    }
}
