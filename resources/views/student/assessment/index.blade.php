@extends('layouts.app')

@section('title', '| Self Assessment')

@section('content')
<div class="container">
    <div class="text-center">
        <h1><strong>Self Assessment</strong></h1>
        <h4 style="font-style: italic;">Take the psychometric test to learn more about yourself</h4>
    </div>

    <br><br>

    <div class="row">
        <div class="col-md-4">
            <div class="col-md-11 col-md-offset-1 well">
                <div class="text-center">
                    <h4><strong>Interest Assessment</strong></h4>
                    <img src="{{ asset('assessments/interest_0.gif') }}" width="210px" height="200px"/>
                </div>
                <br>
                <div class="text-justify" style="font-family: serif;font-size: 16px;">
                    The Interest Assessment helps you find out what your interests are and how they
                    relate to the world of work.
                    It does this by asking you to answer questions that represent important interest areas.
                    Your Interest Assessment scores will help you identify your strongest work-related interests.
                    Knowing your work interests can help you decide what kinds of jobs and careers you want to explore.
                </div>
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="row">
                    @if(count(Auth::user()->student->interests) == 0)
                        <a class="col-md-6 btn btn-lg" style="display:inline-block;" disabled><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @else
                        <a href="{{ route('assessment.interest.result') }}" class="col-md-6 btn btn-lg" style="display:inline-block;"><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @endif
                    <a href="{{ route('assessment.interest.test') }}" class="col-md-6 btn btn-default btn-lg" style="display:inline-block;">Start Test <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="col-md-11 col-md-offset-1 well">
                <div class="text-center">
                    <h4><strong>Abilities Assessment</strong></h4>
                    <img src="{{ asset('assessments/ability_0.jpg') }}" width="280px" height="200px"/>
                </div>
                <br>
                <div class="text-justify" style="font-family: serif;font-size: 16px;">
                    The Abilities Assessment helps you to learn
                    more about your job-related abilities. This
                    information can help you explore the world of
                    work. With this knowledge you can identify and
                    learn more about occupations that would give
                    you the highest chances to use your abilities.
                    You are much more likely to be satisfied with
                    work that best uses your abilities.
                </div>
                <br>
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="row">
                    @if(count(Auth::user()->student->abilities) == 0)
                        <a class="col-md-6 btn btn-lg" style="display:inline-block;" disabled><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @else
                        <a href="{{ route('assessment.ability.result') }}" class="col-md-6 btn btn-lg" style="display:inline-block;"><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @endif
                    <a href="{{ route('assessment.ability.test') }}" class="col-md-6 btn btn-default btn-lg" style="display:inline-block;">Start Test <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-11 col-md-offset-1 well">
                <div class="text-center">
                    <h4><strong>Values Assessment</strong></h4>
                    <img src="{{ asset('assessments/value_0.jpg') }}" width="280px" height="200px"/>
                </div>
                <br>
                <div class="text-justify" style="font-family: serif;font-size: 16px;">
                    The Values Assessment helps you think
                    about and identify your work values by asking you to rank different
                    aspects of work that represent six important work
                    values. Knowing your work values can help you
                    decide what kinds of jobs and careers you might want
                    to explore.
                </div>
                <br><br><br>
            </div>
            <div class="col-md-11 col-md-offset-1">
                <div class="row">
                    @if(count(Auth::user()->student->work_values) == 0)
                        <a class="col-md-6 btn btn-lg" style="display:inline-block;" disabled><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @else
                        <a href="{{ route('assessment.value.result') }}" class="col-md-6 btn btn-lg" style="display:inline-block;"><i class="fa fa-file-text" aria-hidden="true"></i> Results</a>
                    @endif
                    <a href="{{ route('assessment.value.test') }}" class="col-md-6 btn btn-default btn-lg" style="display:inline-block;">Start Test <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>

    <br><br><br>

    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            @if($no == 3)
                <a href="{{ route('assessment.result') }}" class="btn btn-default btn-lg btn-block" style="display:inline-block;">
            @else
                <a class="btn btn-default btn-lg btn-block" style="display:inline-block;" disabled>
            @endif
                <span class="col-md-10 text-center">
                    Combined Assessments <br> {{ $no }}/3 Completed
                </span>
                <span class="col-md-2" style="margin-top:6px;">
                    <i class="fa fa-arrow-circle-right fa-2x" aria-hidden="true"></i>
                </span>
            </a>
        </div>
    </div>
</div>
@endsection