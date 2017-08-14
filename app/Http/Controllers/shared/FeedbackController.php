<?php

namespace App\Http\Controllers\shared;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
    /**
     * FeedbackController constructor.
     * Only authenticated user can access this controller.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the feedbacks.
     * Show search results if keyword variable is set.
     *
     * @param Request $request
     * @return mixed
     */
    public function index(Request $request)
    {
        if(isset($request->keyword) || isset($request->search_status))
        {
            $keyword = $request->keyword;
            // If system admin want to view all feedbacks
            if($request->search_status == 2){
                $feedbacks = Feedback::join('users', 'users.id', '=', 'feedbacks.sender_id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('feedbacks.body', 'like', '%' . $keyword . '%')
                    ->WhereYear('feedbacks.created_at', '=', $keyword, 'or')
                    ->select('*','feedbacks.id as feedback_id')
                    ->orderBy('feedbacks.id', 'desc')
                    ->paginate(6);
            }// If system admin want to view read / unread feedbacks
            else{
                $feedbacks = Feedback::join('users', 'users.id', '=', 'feedbacks.sender_id')
                    ->join('students', 'students.user_id', '=', 'users.id')
                    ->where('feedbacks.status', '=', $request->search_status)
                    ->where(function($query) use ($keyword) {
                        $query->where('feedbacks.body', 'like', '%' . $keyword . '%')
                            ->WhereYear('feedbacks.created_at', '=', $keyword, 'or');
                    })
                    ->select('*','feedbacks.id as feedback_id')
                    ->orderBy('feedbacks.id', 'desc')
                    ->paginate(6);
            }
            return view('feedbacks.index')->withFeedbacks($feedbacks);
        }

        $feedbacks = Feedback::join('users', 'users.id', '=', 'feedbacks.sender_id')
            ->join('students', 'students.user_id', '=', 'users.id')
            ->select('*','feedbacks.id as feedback_id')
            ->orderBy('feedbacks.id', 'desc')
            ->paginate(6);
        return View('feedbacks.index')->withFeedbacks($feedbacks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View('feedbacks.create');
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
            "body" => 'required|min:10|max:150'
        ));

        $feedback = new Feedback();
        $feedback->body = $request->body;
        $feedback->status = 1;
        $feedback->sender_id = Auth::user()->id;

        $feedback->save();

        $notification = array(
            'title' => 'Feedback Submitted',
            'message' => 'You have successfully submit your feedback!',
            'alert-type' => 'success'
        );
        return redirect()->route('student.home')->with($notification);
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
        $feedback = Feedback::find($id);

        $feedback->status = $request->status;
        $status = $request->status == 0 ? 'read' : 'unread';

        $feedback->save();

        $notification = array(
            'title' => 'Feedback Status Updated',
            'message' => 'You have marked it as ' . $status . '!',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
}
