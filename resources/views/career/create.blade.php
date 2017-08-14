@extends('layouts.app')

@section('title', '| Add New Career')

@section('stylesheets')
{{ Html::style('css/select2.min.css') }}

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
                <h1>Add New Career</h1>
                <hr>
                {!! Form::open(['route' => 'career.store', 'files' => true]) !!}
                {{ Form::label('name', 'Name:', ['class' => 'form-spacing-top required']) }}
                {{ Form::text('name', null, [
                    'class'         => 'form-control',
                    'required'      => '',
                    'maxlength'     => '100'
                ]) }}

                <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                    {{ Form::label('image', 'Upload Image For Career:', ['class' => 'control-label', 'style' => 'margin-top:20px;']) }}
                    {{ Form::file('image') }}

                    @if ($errors->has('image'))
                        <span class="help-block">
                        <strong>{{ $errors->first('image') }}</strong>
                    </span>
                    @endif
                </div>

                {{ Form::label('interests', 'Holland Code:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                <select class="form-control select2-multi" multiple="multiple" name="interests[]" required>
                    @foreach($interests as $interest)
                        <option value="{{ $interest->id }}">{{ $interest->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('abilities', 'Ability:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                <select class="form-control select2-multi" multiple="multiple" name="abilities[]" required>
                    @foreach($abilities as $ability)
                        <option value="{{ $ability->id }}">{{ $ability->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('values', 'Value:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                <select class="form-control select2-multi" multiple="multiple" name="values[]" required>
                    @foreach($values as $value)
                        <option value="{{ $value->id }}">{{ $value->name }}</option>
                    @endforeach
                </select>

                {{ Form::label('majors', 'Majors:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                <select class="form-control select2-multi" multiple="multiple" name="majors[]" required>
                    @foreach($majors as $major)
                        <option value="{{ $major->id }}">{{ $major->name }}</option>
                    @endforeach
                </select>

                <div class="form-group{{ $errors->has('tasks') ? ' has-error' : '' }}">
                    {{ Form::label('tasks', 'Job Tasks:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('tasks', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('tasks'))
                        <span class="help-block">
                        <strong>{{ $errors->first('tasks') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('work_setting') ? ' has-error' : '' }}">
                    {{ Form::label('work_setting', 'Work Setting:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('work_setting', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('work_setting'))
                        <span class="help-block">
                        <strong>{{ $errors->first('work_setting') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('skills') ? ' has-error' : '' }}">
                    {{ Form::label('skills', 'Skills:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('skills', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('skills'))
                        <span class="help-block">
                        <strong>{{ $errors->first('skills') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('salary_outlook') ? ' has-error' : '' }}">
                    {{ Form::label('salary_outlook', 'Salary & Outlooks:', ['class' => 'control-label', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('salary_outlook', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('salary_outlook'))
                        <span class="help-block">
                        <strong>{{ $errors->first('salary_outlook') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group{{ $errors->has('career_path') ? ' has-error' : '' }}">
                    {{ Form::label('career_path', 'Career Path:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                    {{ Form::textarea('career_path', null, [
                        'class'         => 'form-control'
                    ]) }}

                    @if ($errors->has('career_path'))
                        <span class="help-block">
                        <strong>{{ $errors->first('career_path') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-md-6">
                        <a href="{{ route('career.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-6">
                        <button type="submit" class="btn btn-success btn-lg btn-block">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add Career
                        </button>
                    </div>
                </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
{{ Html::script('js/select2.min.js') }}

<script type="text/javascript">
    $(".select2-multi").select2();
</script>
@endsection