@extends('layouts.app')

@section('title', '| Edit Scholarship')

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
                <h1>Edit Scholarship</h1>
                <hr>
                {!! Form::model($scholarship,['route' => ['scholarships.update', $scholarship->id], 'method' => 'PUT']) !!}
                {{ Form::label('offered_by', 'Offered By::', ['class' => 'form-spacing-top required']) }}
                {{ Form::text('offered_by', null, [
                    'class'         => 'form-control',
                    'required'      => '',
                    'minlength'     => '5',
                    'maxlength'     => '100'
                ]) }}

                <div class="form-group{{ $errors->has('details') ? ' has-error' : '' }}">
                    {{ Form::label('details', 'Scholarship Details:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('details', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('details'))
                        <span class="help-block">
                        <strong>{{ $errors->first('details') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-md-6">
                        <a href="{{ route('scholarships.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            <i class="fa fa-pencil" aria-hidden="true"></i> Edit Scholarship
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection