@extends('layouts.app')

@section('title', '| Interest Assessment')

@section('content')
<div class="container">
    <div class="text-center">
        <h1><strong>Interest Assessment</strong></h1>
        <hr>
    </div>
    <br>
    <div class="row" style="min-height:300px;">
        <ul id="myTab" class="nav nav-tabs" style="display:none;">
            <li class="active"><a data-toggle="tab" href="#instruction">Instruction</a></li>
            <li><a data-toggle="tab" href="#page1">Page 1</a></li>
            <li><a data-toggle="tab" href="#page2">Page 2</a></li>
            <li><a data-toggle="tab" href="#page3">Page 3</a></li>
            <li><a data-toggle="tab" href="#page4">Page 4</a></li>
            <li><a data-toggle="tab" href="#page5">Page 5</a></li>
            <li><a data-toggle="tab" href="#page6">Page 6</a></li>
        </ul>

        <div class="tab-content">
            <div id="instruction" class="tab-pane fade in active">
                <div class="row">
                    <div class="well">
                        <p>The Interest Assessment has <strong>180 questions</strong> about work activities that some people do on their jobs.</p>
                        <p>Read each question carefully and decide how you would feel about doing each type of work:</p>
                        <img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/> = Dislike &nbsp &nbsp &nbsp &nbsp
                        <img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/> = Unsure &nbsp &nbsp &nbsp &nbsp
                        <img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/> = Like
                    </div>

                    <div class="well">
                        <p>As you answer the questions: </p>
                        <p><strong>TRY NOT TO THINK ABOUT :</strong></p>
                        <p> <strong>( 1 )</strong> Whether you have enough education or training to perform the activity, or <br>
                            <strong>( 2 )</strong> How much money you would make performing the activity.
                        </p>
                        <p><strong>SIMPLY THINK ABOUT WHETHER YOU WOULD “LIKE” OR “DISLIKE” PERFORMING THE WORK ACTIVITY.</strong></p>

                        <br><br>

                        <p><strong>POINTS TO REMEMBER:</strong></p>
                        <p> <strong>( 1 ) THIS IS NOT A TEST!</strong> There are no right or wrong answers to the questions. The goal is for you to learn more about your personal work-related interests. <br>
                            <strong>( 2 ) THERE IS NO TIME LIMIT</strong> for completing the questions. Take your time.
                        </p>
                    </div>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <a href="{{ URL::previous() }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" class="goPage1 btn btn-primary btn-lg btn-block">Get Started</button>
                    </div>
                </div>
            </div>


            <div id="page1" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        {!! Form::open(['route' => 'assessment.interest.store']) !!}
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets1 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p1Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets2 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p1Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete1()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 1 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage0 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" id="btn1" class="goPage2 btn btn-primary btn-lg btn-block" disabled>Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div id="page2" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets3 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p2Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets4 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p2Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete2()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 2 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage1 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" id="btn2" class="goPage3 btn btn-primary btn-lg btn-block" disabled>Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div id="page3" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets5 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p3Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets6 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p3Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete3()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 3 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage2 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" id="btn3" class="goPage4 btn btn-primary btn-lg btn-block" disabled>Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div id="page4" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets7 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p4Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets8 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p4Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete4()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 4 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage3 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" id="btn4" class="goPage5 btn btn-primary btn-lg btn-block" disabled>Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div id="page5" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets9 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p5Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets10 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p5Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete5()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 5 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage4 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="button" id="btn5" class="goPage6 btn btn-primary btn-lg btn-block" disabled>Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
                    </div>
                </div>
            </div>

            <div id="page6" class="tab-pane fade">
                <div class="row">
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets11 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p6Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-6">Activity</th>
                                <th class="col-md-5">
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_dislike.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_unsure.png') }}" width="50" height="50"/></div>
                                    <div class="col-md-4"><img src="{{ asset('assessments/interest_like.png') }}" width="50" height="50"/></div>
                                </th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($sets12 as $question)
                                <tr>
                                    <th>{{ $question->id }}</th>
                                    <td>{{ $question->name }}</td>
                                    <td class="p6Question">
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '0', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                        <div class="col-md-4 text-center">
                                            {{ Form::radio($question->type .'['. $question->id .']', '1', false, ['onChange' => 'checkComplete6()']) }}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="row well">
                    <p class="pull-right" style="font-size:16px;font-style: italic;">Page 6 of 6</p>
                </div>

                <div class="row" style="margin-top:30px;">
                    <hr>
                    <div class="col-md-2">
                        <button type="button" class="goPage5 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                    </div>
                    <div class="col-md-2 col-md-offset-8">
                        <button type="submit" id="btn6" class="btn btn-success btn-lg btn-block" disabled>Get Result</button>
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

<script>
    $(function(){
        $('.goPage0').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#instruction"]').tab('show');
        });
        $('.goPage1').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page1"]').tab('show');
        });
        $('.goPage2').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page2"]').tab('show');
        });
        $('.goPage3').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page3"]').tab('show');
        });
        $('.goPage4').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page4"]').tab('show');
        });
        $('.goPage5').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page5"]').tab('show');
        });
        $('.goPage6').click(function(e){
            e.preventDefault();
            $('#myTab a[href="#page6"]').tab('show');
        });
    });

    function checkComplete1() {
        var $questions = $(".p1Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn1").removeAttribute('disabled');
        }
    }
    function checkComplete2() {
        var $questions = $(".p2Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn2").removeAttribute('disabled');
        }
    }
    function checkComplete3() {
        var $questions = $(".p3Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn3").removeAttribute('disabled');
        }
    }
    function checkComplete4() {
        var $questions = $(".p4Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn4").removeAttribute('disabled');
        }
    }
    function checkComplete5() {
        var $questions = $(".p5Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn5").removeAttribute('disabled');
        }
    }
    function checkComplete6() {
        var $questions = $(".p6Question");
        if($questions.find("input:radio:checked").length === $questions.length) {
            document.getElementById("btn6").removeAttribute('disabled');
        }
    }
</script>

@endsection