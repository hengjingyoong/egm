@extends('layouts.app')

@section('title', '| Values Assessment')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1><strong>Values Assessment</strong></h1>
            <hr>
        </div>
        <br>
        <div class="row" style="min-height:300px;">
            <ul id="myTab" class="nav nav-tabs" style="display:none;">
                <li class="active"><a data-toggle="tab" href="#instruction">Instruction</a></li>
                <li><a data-toggle="tab" href="#page1">Page 1</a></li>
            </ul>

            <div class="tab-content">
                <div id="instruction" class="tab-pane fade in active">
                    <div class="row">
                        <div class="well">
                            <p>The Values Assessment has <strong>20 work values statements</strong>.</p>
                            <p>
                                When you complete the Values Assessment, you will get scores for six work values. These scores show how important
                                each of the work values is to you. In addition to your scores, you will be directed to a list of occupations that
                                are linked with your work values. This list can help you explore career options. The more a job agrees with
                                your work values, the more likely you are to be satisfied in that job.
                            </p>
                        </div>

                        <div class="well">
                            <p>Please complete the values assessment by following the steps in order.</p>
                            <strong>STEP 1. READ THE WORK VALUES</strong>
                            <p> ▼ Read all 20 work values statements before you go to Step 2. <br>
                                ▼ Think about how important it would be for you to have a job like the one described on each questions.</p>

                            <br><br>

                            <strong>STEP 2. RATE THE WORK VALUES</strong>
                            <p> ▼ Notice there are five columns for the the Importance Scale which from 5 (Most Important) to 1 (Least Important).<br>
                                ▼ Rate how important it is for you to have a job like the one described on the statements.
                                Rate exactly 4 statements for each column. When you are done, the 4 most important statements
                                should be marked at Column 5, the 4 next most important should be marked at Column 4, and so on. The 4
                                least important statements should be marked at Column 1.</p>

                            <br><br>

                            <strong>STEP 3. GET RESULTS</strong>
                            <p> ▼ Check again to make sure there should be 4 statements for each column.<br>
                                ▼ Submit the test to get your result.</p>
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
                    <div class="row text-center" style="margin-bottom:35px;">
                        <p class="lead">On my ideal job it is important that...</p>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            {!! Form::open(['route' => 'assessment.value.store']) !!}
                            <table class="table table-hover">
                                <thead>
                                <tr>
                                    <th class="col-md-1">No</th>
                                    <th class="col-md-7">Statement</th>
                                    <th class="col-md-4">
                                        <div class="col-md-1 text-center">5</div>
                                        <div class="col-md-1 text-center">4</div>
                                        <div class="col-md-1 text-center">3</div>
                                        <div class="col-md-1 text-center">2</div>
                                        <div class="col-md-1 text-center">1</div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($sets1 as $question)
                                    <tr>
                                        <th>{{ $question->id }}</th>
                                        <td>{{ $question->name }}</td>
                                        <td class="p1Question">
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 5, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 4, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 3, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 2, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 1, false, ['onChange' => 'checkComplete()']) }}
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
                                    <th class="col-md-6">Statement</th>
                                    <th class="col-md-4">
                                        <div class="col-md-1 text-center">5</div>
                                        <div class="col-md-1 text-center">4</div>
                                        <div class="col-md-1 text-center">3</div>
                                        <div class="col-md-1 text-center">2</div>
                                        <div class="col-md-1 text-center">1</div>
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($sets2 as $question)
                                    <tr>
                                        <th>{{ $question->id }}</th>
                                        <td>{{ $question->name }}</td>
                                        <td class="p1Question">
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 5, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 4, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 3, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 2, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                            <div class="col-md-1 text-center">
                                                {{ Form::radio($question->type .'['. $question->id .']', 1, false, ['onChange' => 'checkComplete()']) }}
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="row" style="margin-top:30px;">
                        <hr>
                        <div class="col-md-2">
                            <button type="button" class="goPage0 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                        </div>
                        <div class="col-md-2 col-md-offset-8">
                            <button type="submit" id="btn1" class="btn btn-success btn-lg btn-block" disabled>Get Result</button>
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
        });

        function checkComplete() {
            var $questions = $(".p1Question");
            if($questions.find("input:radio:checked").length === $questions.length) {
                document.getElementById("btn1").removeAttribute('disabled');
            }
        }
    </script>
@endsection