@extends('layouts.app')

@section('title', '| Post New Announcement')

@section('stylesheets')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ul2svc6wl2z2f3vzr4h9ken5z7zxsym7zf0g8sb3cnga33i1"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        plugins: 'lists link wordcount',
        menubar: false
    });﻿
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Post New Announcement</h1>
            <hr>
            {!! Form::open(['route' => 'school_admin_announcement.store', 'files' => true]) !!}
            {{ Form::label('title', 'Title:', ['class' => 'form-spacing-top required']) }}
            {{ Form::text('title', null, [
                'class'         => 'form-control',
                'required'      => '',
                'minlength'     => '5',
                'maxlength'     => '100'
            ]) }}

            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {{ Form::label('image', 'Upload Image For Announcement:', ['class' => 'control-label', 'style' => 'margin-top:20px;']) }}
                {{ Form::file('image') }}

                @if ($errors->has('image'))
                    <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                {{ Form::label('body', 'Announcement Body:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                {{ Form::textarea('body', null, [
                    'class'         => 'form-control'
                ]) }}

                @if ($errors->has('body'))
                    <span class="help-block">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                @endif
            </div>

            <div class="row" style="margin-top:30px;">
                <div class="col-md-6">
                    <a href="{{ route('school_admin_announcement.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-plus" aria-hidden="true"></i> Post Announcement
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection