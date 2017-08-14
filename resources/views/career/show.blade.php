@extends('layouts.app')

@section('title', "| $career->name")

@section('stylesheets')
<style>
    .nav-tabs>li>a {
        padding: 10px 30px;
        font-weight: bold;
    }
</style>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <h1>{{ $career->name }}</h1>
        <hr>

        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset('careers/' . $career->image) }}" height="300" width="500" alt="No image for this career">
            </div>
            <div class="col-md-6">
                <p class="lead" style="font-style: italic">Holland Code:</p>
                <p>
                    @foreach($career->interests as $interest)
                        <span class="label label-default" style="font-size:15px;">{{ $interest->name }}</span>
                        @if (!$loop->last) , @endif
                    @endforeach
                </p><br>
                <p class="lead" style="font-style: italic">Ability:</p>
                <p>
                    @foreach($career->abilities as $ability)
                        <span class="label label-default" style="font-size:15px;">{{ $ability->name }}</span>
                        @if (!$loop->last) , @endif
                    @endforeach
                </p><br>
                <p class="lead" style="font-style: italic">Work Value:</p>
                <p>
                    @foreach($career->work_values as $value)
                        <span class="label label-default" style="font-size:15px;">{{ $value->name }}</span>
                        @if (!$loop->last) , @endif
                    @endforeach
                </p>
            </div>
        </div>
        <hr>

        <div class="row" style="min-height:300px;">
            <ul class="nav nav-tabs">
                <li class="active"><a data-toggle="tab" href="#tasks"><i class="fa fa-tasks" aria-hidden="true"></i>&nbsp; Job Tasks</a></li>
                <li><a data-toggle="tab" href="#work_setting"><i class="fa fa-briefcase" aria-hidden="true"></i>&nbsp; Work Setting</a></li>
                <li><a data-toggle="tab" href="#skills"><i class="fa fa-cogs" aria-hidden="true"></i>&nbsp; Skills</a></li>
                <li><a data-toggle="tab" href="#majors"><i class="fa fa-graduation-cap" aria-hidden="true"></i>&nbsp; Education Requirement</a></li>
                <li><a data-toggle="tab" href="#salary_outlook"><i class="fa fa-money" aria-hidden="true"></i>&nbsp; Salary & Outlook</a></li>
                <li><a data-toggle="tab" href="#path"><i class="fa fa-road" aria-hidden="true"></i>&nbsp; Career Path</a></li>
            </ul>

            <div class="col-md-10 tab-content">
                <div id="tasks" class="tab-pane fade in active">
                    <p>{!! $career->tasks !!}</p>
                </div>
                <div id="work_setting" class="tab-pane fade">
                    <p>{!! $career->work_setting !!}</p>
                </div>
                <div id="skills" class="tab-pane fade">
                    <p>{!! $career->skills !!}</p>
                </div>
                <div id="majors" class="tab-pane fade">
                    <br>
                    <p style="font-variant-numeric: inherit; font-stretch: inherit; font-size: 17.008px; line-height: inherit; font-family: 'Hoefler Text', 'Songti TC', serif;">The following majors could help you prepare for this career:</p>
                    <ul style="margin: 0px 0px 1.875rem 2.5rem; padding: 0px; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 17.008px; line-height: inherit; font-family: 'Hoefler Text', 'Songti TC', serif; vertical-align: baseline; list-style: square;">
                        @foreach($career->majors as $major)
                            <li style="margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;"><a href="{{ route('school.index', 'fromCareer=' . $major->name) }}" target="_blank">{{ $major->name }}</a></li>
                        @endforeach
                    </ul>
                    <p>(Click the link to check which schools are offering the major)</p>
                </div>
                <div id="salary_outlook" class="tab-pane fade">
                    <p>{!! $career->salary_outlook !!}</p>
                </div>
                <div id="path" class="tab-pane fade">
                    <p>{!! $career->career_path !!}</p>
                </div>
            </div>
        </div>

        <div class="row" style="margin-top:30px;">
            @if(Auth::user()->role == 'system_admin')
                <div class="col-md-6">
                    <a href="{{ route('career.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('career.edit', $career->id) }}" class="btn btn-success btn-lg btn-block">Go Edit <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            @else
                <a href="{{ URL::previous() }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
            @endif

        </div>
    </div>
</div>
@endsection