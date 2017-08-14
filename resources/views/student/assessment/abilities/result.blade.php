@extends('layouts.app')

@section('title', '| Abilities Assessment Result')

@section('content')
    <div class="container">
        <div class="text-center">
            <h1><strong>Abilities Assessment</strong></h1>
            <hr>
        </div>
        <br>
        <div class="text-center">
            <h2><strong>Your Top 5 Abilities:</strong></h2>
        </div>

        <br>

        <div class="row well">
            @foreach($abilities as $ability)
                @if($loop->iteration == 1 || $loop->iteration == 3 || $loop->iteration == 5)
                    <div class="row">
                @endif
                <div class="col-md-6">
                    <div class="col-md-10 col-md-offset-1">
                        <h3><strong>{{ $ability->name }}</strong></h3>
                        <img src="{{ asset('assessments/' . $ability->image) }}"/>
                        <p>{!! $ability->description !!}</p>
                    </div>
                </div>
                @if($loop->iteration == 2 || $loop->iteration == 4 || $loop->iteration == 5)
                    </div><br>
                @endif
            @endforeach
        </div>

        <div class="row">
            <div class="text-center">
                <i class="fa fa-arrow-circle-down fa-4x"></i>
            </div>
        </div>

        <div class="row" style="margin-top:25px;">
            <h4><strong>Careers that might suitable for you:</strong></h4>
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