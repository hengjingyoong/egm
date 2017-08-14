<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * ScholarshipController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the scholarships.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->keyword))
        {
            $scholarships = Scholarship::where('offered_by', 'like', '%' . $request->keyword . '%')
                ->orWhere('details', 'like', '%' . $request->keyword . '%')
                ->WhereYear('created_at', '=', $request->keyword, 'or')
                ->orderBy('id', 'desc')
                ->paginate(6);
            return view('scholarships.index')->withScholarships($scholarships);
        }
        $scholarships = Scholarship::orderBy('id', 'desc')->paginate(6);
        return view('scholarships.index')->withScholarships($scholarships);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('scholarships.create');
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
            "offered_by" => 'required|min:5|max:100',
            'details' => 'required'
        ));

        $scholarships = new Scholarship();
        $scholarships->offered_by = $request->offered_by;
        $scholarships->details = $request->details;

        $scholarships->save();

        $notification = array(
            'title' => 'Scholarship Added',
            'message' => 'You have successfully added new scholarship!',
            'alert-type' => 'success'
        );
        return redirect()->route('scholarships.show', $scholarships->id)->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $scholarship = Scholarship::find($id);
        return view('scholarships.show')->withScholarship($scholarship);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $scholarship = Scholarship::find($id);
        return view('scholarships.edit')->withScholarship($scholarship);
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
        $scholarships = Scholarship::find($id);

        $this->validate($request,array(
            "offered_by" => 'required|min:5|max:100',
            'details' => 'required'
        ));

        $scholarships->offered_by = $request->offered_by;
        $scholarships->details = $request->details;

        $scholarships->save();

        $notification = array(
            'title' => 'Scholarship Updated',
            'message' => 'You have successfully updated the scholarship!',
            'alert-type' => 'success'
        );
        return redirect()->route('scholarships.show', $scholarships->id)->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $scholarship = Scholarship::find($id);
        $scholarship->delete();

        $notification = array(
            'title' => 'Scholarship Deleted',
            'message' => 'The scholarship was successfully deleted!',
            'alert-type' => 'success'
        );
        return redirect()->route('scholarships.index')->with($notification);
    }
}
