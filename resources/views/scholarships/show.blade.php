@extends('layouts.app')

@section('title', '| Scholarship')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $scholarship->offered_by }}</h1>
            <hr>

            <p class="lead">{!! $scholarship->details !!}</p>
            <hr>

            <div class="row">
                <p class="col-md-4 col-md-offset-8" style="font-style: italic;">Published At: {{ date('M j, Y', strtotime($scholarship->created_at)) }}</p>
            </div>

            <div class="row" style="margin-top:80px;">
                @if(Auth::user()->role == 'system_admin')
                    <div class="col-md-6">
                        <a href="{{ route('scholarships.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('scholarships.edit', $scholarship->id) }}" class="btn btn-success btn-lg btn-block">Go Edit <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                @else
                    <a href="{{ URL::previous() }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection