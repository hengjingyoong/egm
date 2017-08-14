<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Major;
use App\Models\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SchoolController extends Controller
{
    /**
     * SchoolController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the schools.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->fromCareer))
        {
            $major_id = Major::where('name', '=', $request->fromCareer)->pluck('id')->toArray();
            $school_id = DB::table('major_school')->whereIn('major_id', $major_id)->pluck('school_id')->toArray();
            $schools = School::whereIn('id', $school_id)->paginate(5);

            return view('school.index')->withSchools($schools);
        }

        if(isset($request->keyword) || isset($request->search_state))
        {
            $keyword = $request->keyword;

            if($request->search_state == 'All'){
                $schools = School::where('name', 'like', '%' . $keyword . '%')->paginate(2);

                if(count($schools) == 0)
                {
                    $major_id = Major::where('name', 'like', '%' . $keyword . '%')->pluck('id')->toArray();
                    $school_id = DB::table('major_school')->whereIn('major_id', $major_id)->pluck('school_id')->toArray();
                    $schools = School::whereIn('id', $school_id)->paginate(5);
                }
            }else{
                $schools = School::where('name', 'like', '%' . $keyword . '%')
                    ->where('state', '=', $request->search_state)
                    ->paginate(5);

                if(count($schools) == 0)
                {
                    $major_id = Major::where('name', 'like', '%' . $keyword . '%')->pluck('id')->toArray();
                    $school_id = DB::table('major_school')->whereIn('major_id', $major_id)->pluck('school_id')->toArray();
                    $schools = School::whereIn('id', $school_id)
                        ->where('state', '=', $request->search_state)
                        ->paginate(5);
                }
            }
            return view('school.index')->withSchools($schools);
        }
        $schools = School::paginate(5);
        return view('school.index')->withSchools($schools);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $majors = Major::all();
        return view('school.create')->withMajors($majors);
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
            "name" => 'required|min:10|max:60',
            "state" => 'required|max:30',
            'majors' => 'required'
        ));

        $school = new School();
        $school->name = $request->name;
        $school->state = $request->state;
        $school->link = $request->link;

        $school->save();
        $school->majors()->sync($request->majors, false);

        $notification = array(
            'title' => 'School Added',
            'message' => 'You have successfully added new school!',
            'alert-type' => 'success'
        );

        return redirect()->route('school.index')->with($notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $school = School::find($id);
        $majors = Major::all();
        return view('school.edit')->withSchool($school)->withMajors($majors);
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
        $school = School::find($id);

        $this->validate($request,array(
            "name" => 'required|min:10|max:60',
            "state" => 'required|max:30',
            'majors' => 'required'
        ));

        $school->name = $request->name;
        $school->state = $request->state;
        $school->link = $request->link;

        $school->save();
        $school->majors()->sync($request->majors);

        $notification = array(
            'title' => 'School Updated',
            'message' => 'You have successfully updated the school!',
            'alert-type' => 'success'
        );

        return redirect()->route('school.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $school = School::find($id);
        $school->delete();

        $notification = array(
            'title' => 'School Deleted',
            'message' => 'The school was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('school.index')->with($notification);
    }
}
