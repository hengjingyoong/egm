@extends('layouts.app')

@section('title', '| Submit Feedback')

@section('content')
<div class="container">
    <h1><i class="fa fa-commenting-o" aria-hidden="true"></i> Feedback</h1>
    <hr>
    <p class="lead">Tell us what you think about the system.</p>

    {!! Form::open(['route' => 'feedback.store']) !!}

    {{ Form::textarea('body', null, [
        'class'         => 'form-control form-spacing-top',
        'placeholder'   => "What's on your mind?",
        'required'      => '',
        'minlength'     => '10',
        'maxlenght'     => '150'
    ]) }}

    <div class="row" style="margin-top:30px;">
        <div class="col-md-6">
            <a href="{{ URL::previous() }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
        </div>
        <div class="col-md-6">
            <button type="submit" class="btn btn-success btn-lg btn-block">
                <i class="fa fa-paper-plane" aria-hidden="true"></i> Send Feedback
            </button>
        </div>
    </div>

    {!! Form::close() !!}
</div>
@endsection