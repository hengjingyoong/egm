@extends('layouts.app')

@section('title', '| Combined Assessments Result')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1><strong>Combined Assessments</strong></h1>
            <hr>
        </div>
        <br>
        <div class="text-center">
            <h2><strong>Your Results:</strong></h2>
        </div>

        <br>

        <div class="row well">
            @foreach($interests as $interest)
                @if($interest->pivot->primary == 'y')
                    <h4>Your Primary Interest Area: &nbsp;<strong>{{ $interest->name }}</strong></h4>
                    <p>{!! $interest->description !!}</p>
                @endif
            @endforeach
        </div>

        <div class="row well">
            <h4>Your Secondary Interest Areas: </h4>
            @foreach($interests as $interest)
                @if($interest->pivot->primary != 'y')
                    <div class="col-md-6">
                        <h4><strong>{{ $interest->name }}</strong></h4>
                        <p>{!! $interest->description !!}</p>
                    </div>
                @endif
            @endforeach
        </div>

        <div class="row">
            <div class="text-center">
                <i class="fa fa-plus-circle fa-4x" aria-hidden="true"></i>
            </div>
        </div>

        <br>

        <div class="row well">
            <h4>Your Top 5 Abilities: &nbsp;
                @foreach($abilities as $ability)
                    <strong>{{ $ability->name }}</strong>
                    @if($loop->iteration <> 5)
                        ,
                    @endif
                @endforeach
            </h4>
        </div>

        <div class="row">
            <div class="text-center">
                <i class="fa fa-plus-circle fa-4x" aria-hidden="true"></i>
            </div>
        </div>

        <br>

        <div class="row well">
            @foreach($values as $value)
                @if($value->pivot->primary == 'y')
                    <h4>Your Highest Score Of Work Value: &nbsp;<strong>{{ $value->name }}</strong></h4>
                    <p>{!! $value->description !!}</p>
                @endif
            @endforeach
        </div>

        <div class="row well">
            @foreach($values as $value)
                @if($value->pivot->primary == 'n')
                    <h4>Your Next Highest Score Of Work Value: &nbsp;<strong>{{ $value->name }}</strong></h4>
                    <p>{!! $value->description !!}</p>
                @endif
            @endforeach
        </div>

        <div class="row">
            <div class="text-center">
                <i class="fa fa-arrow-circle-down fa-4x"></i>
            </div>
        </div>

        <div class="row" style="margin-top:35px;">
            <h4><strong>Careers that might match your interests, abilities and work values:</strong></h4>
            <hr>
            @if(count($careers) != 0)
                <ul style="margin: 0px 0px 1.875rem 2.5rem; padding: 0px; border: 0px; font-variant-numeric: inherit; font-stretch: inherit; font-size: 20px; line-height: inherit; font-family: 'Hoefler Text', 'Songti TC', serif; vertical-align: baseline; list-style: square;">
                    @foreach($careers as $career)
                        <li style="margin: 0px; padding: 0px; border: 0px; font-style: inherit; font-variant: inherit; font-weight: inherit; font-stretch: inherit; font-size: inherit; line-height: inherit; font-family: inherit; vertical-align: baseline;"><a href="{{ route('career.show', $career->id) }}" target="_blank">{{ $career->name }}</a></li>
                    @endforeach
                </ul>
            @else
                <p>There is no suitable career for you at this moment...</p>
                <p>Try finish other assessments and get the combined assessment results!</p>
            @endif
        </div>

        <div class="row">
            <a href="{{ route('assessment.index') }}" class="btn btn-success btn-lg btn-block" style="margin-top:120px;"><i class="fa fa-arrow-left" aria-hidden="true"></i>&nbsp; Go Back</a>
        </div>
    </div>
@endsection