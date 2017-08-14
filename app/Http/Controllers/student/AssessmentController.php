<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\Ability;
use App\Models\Career;
use App\Models\Interest;
use App\Models\Student;
use App\Models\Work_value;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AssessmentController extends Controller
{
    /**
     * AssessmentController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the assessment page for student.
     * Redirect users back to their page if they are not student.
     *
     * @return mixed
     */
    public function index()
    {
        $notification = $this->checkUser('student');
        if($notification <> '') {
            return redirect()->back()->with($notification);
        }

        $no = 0;

        if(count(Auth::user()->student->interests) <> 0) { $no += 1;}
        if(count(Auth::user()->student->abilities) <> 0) { $no += 1;}
        if(count(Auth::user()->student->work_values) <> 0) { $no += 1;}

        return view('student.assessment.index')->withNo($no);
    }

    /**
     * Show the combined assessments result.
     *
     * @return mixed
     */
    public function result()
    {
        $interests = Auth::user()->student->interests;
        $abilities = Auth::user()->student->abilities;
        $values = Auth::user()->student->work_values;

        $careers_id1 = DB::table('career_interest')->whereIn('interest_id', $interests->pluck('id'))
            ->havingRaw("COUNT(DISTINCT interest_id) >= 2")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();
        $careers_id2 = DB::table('ability_career')->whereIn('ability_id', $abilities->pluck('id'))
            ->havingRaw("COUNT(DISTINCT ability_id) >= 4")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();
        $careers_id3 = DB::table('career_work_value')->whereIn('work_value_id', $abilities->pluck('id'))
            ->havingRaw("COUNT(DISTINCT work_value_id) = 2")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();

        $careers_id = [];
        foreach ($careers_id1 as $id)
        {
            $careers_id[] = $id;
        }
        foreach ($careers_id2 as $id)
        {
            $careers_id[] = $id;
        }
        foreach ($careers_id3 as $id)
        {
            $careers_id[] = $id;
        }

        $top5_id = array_slice(array_keys(array_count_values($careers_id)), 0, 5);

        $careers = Career::whereIn('id', $top5_id)->get();

        return view('student.assessment.result')
            ->withInterests($interests)
            ->withAbilities($abilities)
            ->withValues($values)
            ->withCareers($careers);
    }

    /**
     * Show the interest tests.
     *
     * @return mixed
     */
    public function interest_test()
    {
        $sets1 = DB::table('interest_questions')->where('id', '<=', '15')->get();
        $sets2 = DB::table('interest_questions')->where('id', '>', '15')->where('id', '<=', '30')->get();
        $sets3 = DB::table('interest_questions')->where('id', '>', '30')->where('id', '<=', '45')->get();
        $sets4 = DB::table('interest_questions')->where('id', '>', '45')->where('id', '<=', '60')->get();
        $sets5 = DB::table('interest_questions')->where('id', '>', '60')->where('id', '<=', '75')->get();
        $sets6 = DB::table('interest_questions')->where('id', '>', '75')->where('id', '<=', '90')->get();
        $sets7 = DB::table('interest_questions')->where('id', '>', '90')->where('id', '<=', '105')->get();
        $sets8 = DB::table('interest_questions')->where('id', '>', '105')->where('id', '<=', '120')->get();
        $sets9 = DB::table('interest_questions')->where('id', '>', '120')->where('id', '<=', '135')->get();
        $sets10 = DB::table('interest_questions')->where('id', '>', '135')->where('id', '<=', '150')->get();
        $sets11 = DB::table('interest_questions')->where('id', '>', '150')->where('id', '<=', '165')->get();
        $sets12 = DB::table('interest_questions')->where('id', '>', '165')->where('id', '<=', '180')->get();
        return view('student.assessment.interest.test')
            ->withSets1($sets1)
            ->withSets2($sets2)
            ->withSets3($sets3)
            ->withSets4($sets4)
            ->withSets5($sets5)
            ->withSets6($sets6)
            ->withSets7($sets7)
            ->withSets8($sets8)
            ->withSets9($sets9)
            ->withSets10($sets10)
            ->withSets11($sets11)
            ->withSets12($sets12);
    }

    /**
     * Store the interest assessment result for current student.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function interest_store(Request $request)
    {
        $lists['Realistic'] = 0;
        $lists['Investigative'] = 0;
        $lists['Artistic'] = 0;
        $lists['Social'] = 0;
        $lists['Enterprising'] = 0;
        $lists['Conventional'] = 0;

        foreach($request->realistic as $realistic){
            if($realistic == '1'){
                $lists['Realistic']++;
            }
        }

        foreach($request->investigative as $investigative){
            if($investigative == '1'){
                $lists['Investigative']++;
            }
        }

        foreach($request->artistic as $artistic){
            if($artistic == '1'){
                $lists['Artistic']++;
            }
        }

        foreach($request->social as $social){
            if($social == '1'){
                $lists['Social']++;
            }
        }

        foreach($request->enterprising as $enterprising){
            if($enterprising == '1'){
                $lists['Enterprising']++;
            }
        }

        foreach($request->conventional as $conventional){
            if($conventional == '1'){
                $lists['Conventional']++;
            }
        }

        arsort($lists);
        $top3 = array_slice($lists, 0, 3);

        $top_id = [];
        foreach($top3 as $key=>$value)
        {
            if($value >= 10)
            {
                $top_id[] = Interest::where('name', '=', $key)->value('id');
            }
        }

        $data = [];
        $i = 0;
        foreach($top_id as $id)
        {
            if($i == 0){
                $data[$id] = ['primary' => 'y'];
                $i++;
            }else{
                $data[$id] = ['primary' => 'n'];
            }
        }

        $student = Student::find(Auth::user()->student->id);

        if(count($student->interests) == 0)
        {
            $student->interests()->sync($data, false);
        }
        else{
            $student->interests()->sync($data);
        }

        return redirect()->route('assessment.interest.result');
    }

    /**
     * Show the result of interest assessment.
     *
     * @return mixed
     */
    public function interest_result()
    {
        $interests = Auth::user()->student->interests;

        $interests_id = Auth::user()->student->interests->pluck('id');
        $careers_id = DB::table('career_interest')->whereIn('interest_id', $interests_id)
            ->havingRaw("COUNT(DISTINCT interest_id) >= 2")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();
        $careers = Career::whereIn('id', $careers_id)->get();

        return view('student.assessment.interest.result')->withInterests($interests)->withCareers($careers);
    }

    /**
     * Show the abilities tests.
     *
     * @return mixed
     */
    public function ability_test()
    {
        $abilities = Ability::all();
        return view('student.assessment.abilities.test')->withAbilities($abilities);
    }

    /**
     * Store the abilities assessment result for current student.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function ability_store(Request $request)
    {
        $student = Student::find(Auth::user()->student->id);

        if(count($student->abilities) == 0)
        {
            $student->abilities()->sync($request->lists, false);
        }
        else{
            $student->abilities()->sync($request->lists);
        }

        return redirect()->route('assessment.ability.result');
    }

    /**
     * Show the result of abilities assessment.
     *
     * @return mixed
     */
    public function ability_result()
    {
        $abilities = Auth::user()->student->abilities;

        $abilities_id = Auth::user()->student->abilities->pluck('id');
        $careers_id = DB::table('ability_career')->whereIn('ability_id', $abilities_id)
            ->havingRaw("COUNT(DISTINCT ability_id) >= 4")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();
        $careers = Career::whereIn('id', $careers_id)->get();

        return view('student.assessment.abilities.result')->withAbilities($abilities)->withCareers($careers);
    }

    /**
     * Show the work values tests.
     *
     * @return mixed
     */
    public function value_test()
    {
        $sets1 = DB::table('work_values_questions')->where('id', '<=', '10')->get();
        $sets2 = DB::table('work_values_questions')->where('id', '>', '10')->where('id', '<=', '20')->get();

        return view('student.assessment.values.test')->withSets1($sets1)->withSets2($sets2);
    }

    /**
     * Store the work values assessment result for current student.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function value_store(Request $request)
    {
        $lists['Achievement'] = 0;
        $lists['Independence'] = 0;
        $lists['Recognition'] = 0;
        $lists['Relationships'] = 0;
        $lists['Support'] = 0;
        $lists['Working Conditions'] = 0;

        foreach($request->achievement as $achievement){
            $lists['Achievement'] += $achievement;
        }

        foreach($request->independence as $independence){
            $lists['Independence'] += $independence;
        }

        foreach($request->recognition as $recognition){
            $lists['Recognition'] += $recognition;
        }

        foreach($request->relationships as $relationships){
            $lists['Relationships'] += $relationships;
        }

        foreach($request->support as $support){
            $lists['Support'] += $support;
        }

        foreach($request->working_conditions as $working_conditions){
            $lists['Working Conditions'] += $working_conditions;
        }

        $lists['Achievement'] *= 3;
        $lists['Independence'] *= 2;
        $lists['Recognition'] *= 2;
        $lists['Relationships'] *= 2;
        $lists['Support'] *= 2;

        arsort($lists);
        $top2 = array_slice($lists, 0, 2);

        $top2_id = [];
        foreach($top2 as $key=>$value)
        {
            $top2_id[] = Work_value::where('name', '=', $key)->value('id');
        }

        $data = [];
        $i = 0;
        foreach($top2_id as $id)
        {
            if($i == 0){
                $data[$id] = ['primary' => 'y'];
                $i++;
            }else{
                $data[$id] = ['primary' => 'n'];
            }
        }

        $student = Student::find(Auth::user()->student->id);

        if(count($student->work_values) == 0)
        {
            $student->work_values()->sync($data, false);
        }
        else{
            $student->work_values()->sync($data);
        }

        return redirect()->route('assessment.value.result');
    }

    /**
     * Show the result of work values assessment.
     *
     * @return mixed
     */
    public function value_result()
    {
        $values = Auth::user()->student->work_values;

        $values_id = Auth::user()->student->work_values->pluck('id');
        $careers_id = DB::table('career_work_value')->whereIn('work_value_id', $values_id)
            ->havingRaw("COUNT(DISTINCT work_value_id) = 2")
            ->groupBy('career_id')
            ->pluck('career_id')
            ->toArray();
        $careers = Career::whereIn('id', $careers_id)->get();

        return view('student.assessment.values.result')->withValues($values)->withCareers($careers);
    }
}
