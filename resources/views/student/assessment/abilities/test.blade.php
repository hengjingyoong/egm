@extends('layouts.app')

@section('title', '| Abilities Assessment')

@section('stylesheets')
<style>
    label {
        display:block;
        border:solid 1px gray;
        line-height:50px;
        height:50px;
        width: 88%;
        border-radius:10px;
        -webkit-font-smoothing: antialiased;
        margin-top:10px;
        font-family:Arial,Helvetica,sans-serif;
        font-size:20px;
        color:#384749;
        text-align:center;
        cursor:pointer;
    }

    input[type=checkbox] {
        display: none;
    }

    input[type=checkbox][disabled] + label {
        cursor:default;
        color:#b5c7c9;
    }

    input:checked + label {
        border: solid 1px limegreen;
        color: limegreen;
    }

    input:checked + label:before {
        content: "\2713";
    }
</style>
@endsection

@section('content')
    <div class="container">
        <div class="text-center">
            <h1><strong>Abilities Assessment</strong></h1>
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
                            <p>The Abilities Assessment has <strong>18 abilities statements</strong>.
                                It can help you see how your abilities relate to occupations.</p>

                            <br>

                            <p>Please complete the abilities assessment by following the steps in order.</p>
                            <strong>STEP 1. READ THE ABILITIES</strong>
                            <p> ▼ Read all 18 abilities statements before you go to Step 2. <br>
                                ▼ Consider your level of ability, not how much you would like doing it.</p>

                            <br>

                            <strong>STEP 2. SELECT YOUR TOP 5 ABILITIES</strong>
                            <p> ▼ Select your top 5 abilities from all the abilities statements by clicking the ability name.</p>

                            <br>

                            <strong>STEP 3. GET RESULTS</strong>
                            <p> ▼ Submit the test to get your result.</p>
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
                    {!! Form::open(['route' => 'assessment.ability.store']) !!}
                    @foreach($abilities as $ability)
                    {!! $ability->id % 2 != 0  ? '<div class="'. 'row">' : '' !!}
                        <div class="col-md-6">
                            <div class="col-md-10 col-md-offset-1">
                                <input id="{{ $ability->id }}" type="checkbox" name="lists[]" value="{{ $ability->id }}" onchange="checkMax()"/>
                                <label for="{{ $ability->id }}">{{ $ability->name }}</label>
                                <img src="{{ asset('assessments/' . $ability->image) }}"/>
                                <p>{!! $ability->description !!}</p>
                            </div>
                        </div>
                    {!! $ability->id % 2 == 0  ? '</div><br><br>' : '' !!}
                    @endforeach

                    <div class="row" style="margin-top:30px;">
                        <hr>
                        <div class="col-md-2">
                            <button type="button" class="goPage0 btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous</button>
                        </div>
                        <div class="col-md-2 col-md-offset-8">
                            <button type="submit" id="btn1" class="btn btn-success btn-lg btn-block" disabled>Get Result</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
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

        function checkMax() {
            var maxChecks = 5;

            var checkCount = $(':checked').length;

            if (checkCount >= maxChecks) {
                $(":checkbox[name='lists[]']").not(':checked').attr('disabled', true);
            } else {
                $(":checkbox[name='lists[]']:disabled").attr('disabled', false);
            }

            if(checkCount >= 5) {
                document.getElementById("btn1").removeAttribute('disabled');
            }else{
                document.getElementById("btn1").disabled = true;
            }
        }
    </script>
@endsection