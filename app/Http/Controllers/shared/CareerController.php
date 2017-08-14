<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Models\Career;
use App\Models\Interest;
use App\Models\Major;
use App\Models\Work_value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CareerController extends Controller
{
    /**
     * CareerController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the careers.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->keyword))
        {
            $careers = Career::where('name', 'like', '%' . $request->keyword . '%')->paginate(10);
        }
        else{
            $careers = Career::paginate(10);
        }

        return view('career.index')->withCareers($careers);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $interests = Interest::all();
        $abilities = Ability::all();
        $values = Work_value::all();
        $majors = Major::all();
        return view('career.create')->withInterests($interests)->withAbilities($abilities)->withValues($values)->withMajors($majors);
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
            "name" => 'required|max:100',
            'image' => 'image',
            'tasks' => 'required',
            'work_setting' => 'required',
            'skills' => 'required',
            'career_path' => 'required'
        ));

        $career = new Career();
        $career->name = $request->name;
        $career->tasks = $request->tasks;
        $career->work_setting = $request->work_setting;
        $career->skills = $request->skills;
        $career->salary_outlook = $request->salary_outlook;
        $career->career_path = $request->career_path;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('careers/' . $filename);
            Image::make($image)->resize(500,300)->save($location);

            $career->image = $filename;
        }

        $career->save();
        $career->interests()->sync($request->interests, false);
        $career->abilities()->sync($request->abilities, false);
        $career->work_values()->sync($request->values, false);
        $career->majors()->sync($request->majors, false);

        $notification = array(
            'title' => 'Career Added',
            'message' => 'You have successfully added new Career!',
            'alert-type' => 'success'
        );

        return redirect()->route('career.show', $career->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $career = Career::find($id);
        return view('career.show')->withCareer($career);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $career = Career::find($id);
        $interests = Interest::all();
        $abilities = Ability::all();
        $values = Work_value::all();
        $majors = Major::all();
        return view('career.edit')->withCareer($career)->withInterests($interests)->withAbilities($abilities)->withValues($values)->withMajors($majors);
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
        $career = Career::find($id);

        $this->validate($request,array(
            "name" => 'required|max:100',
            'image' => 'image',
            'tasks' => 'required',
            'work_setting' => 'required',
            'skills' => 'required',
            'career_path' => 'required'
        ));

        $career->name = $request->name;
        $career->tasks = $request->tasks;
        $career->work_setting = $request->work_setting;
        $career->skills = $request->skills;
        $career->salary_outlook = $request->salary_outlook;
        $career->career_path = $request->career_path;

        if($request->hasFile('image'))
        {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('careers/' . $filename);
            Image::make($image)->resize(500,300)->save($location);

            if($career->image <> null)
            {
                $oldFileName = $career->image;
                $career->image = $filename;
                Storage::disk('careers')->delete($oldFileName);
            }
            else {
                $career->image = $filename;
            }
        }

        $career->save();
        $career->interests()->sync($request->interests);
        $career->abilities()->sync($request->abilities);
        $career->work_values()->sync($request->values);
        $career->majors()->sync($request->majors);

        $notification = array(
            'title' => 'Career Updated',
            'message' => 'You have successfully updated the Career!',
            'alert-type' => 'success'
        );

        return redirect()->route('career.show', $career->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $career = Career::find($id);

        if($career->image <> null) {
            Storage::disk('careers')->delete($career->image);
        }
        $career->delete();

        $notification = array(
            'title' => 'Career Deleted',
            'message' => 'The career was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
