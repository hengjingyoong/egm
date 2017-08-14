@extends('layouts.app')

@section('title', '| School Admin Registration')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">School Admin Registration</div>

            <div class="panel-body">
                <div class="col-md-5">
                    <legend><h3>Verification Information</h3></legend>
                    {!! Form::open(['route' => 'school_admin_account.store', 'files' => true]) !!}

                    {{ Form::label('school_name', 'School Name:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::text('school_name', null, [
                        'class'         => 'form-control',
                        'required'      => '',
                        'minlength'     => '10',
                        'maxlength'     => '60'
                    ]) }}

                    <div class="form-group{{ $errors->has('letter') ? ' has-error' : '' }}">
                        {{ Form::label('letter', 'Letter of Authentication:', ['style' => 'margin-top:25px;','class' => 'control-label required']) }}
                        {{ Form::file('letter', ['required' => '']) }}

                        @if ($errors->has('letter'))
                            <span class="help-block">
                                <strong>{{ $errors->first('letter') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>

                <div class="col-md-6 col-md-offset-1">
                    <legend><h3>Login Information</h3></legend>

                    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                        {{ Form::label('email', 'Email Address:', ['class' => 'form-spacing-top control-label required']) }}
                        {{ Form::email('email', null, [
                            'class'                 => 'form-control',
                            'required'              => '',
                        ]) }}

                        @if ($errors->has('email'))
                            <span class="help-block">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                        {{ Form::label('password', 'Password:', ['class' => 'form-spacing-top control-label required']) }}
                        {{ Form::password('password', [
                            'class'                 => 'form-control',
                            'required'              => '',
                            'minlength'             => '6',
                            'maxlength'             => '20'
                        ]) }}

                        @if ($errors->has('password'))
                            <span class="help-block">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                        @endif
                    </div>

                    {{ Form::label('password_confirmation', 'Confirm Password:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::password('password_confirmation', [
                        'class'                 => 'form-control',
                        'required'              => '',
                        'minlength'             => '6',
                        'maxlength'             => '20'
                    ]) }}

                    {{ Form::submit('Register', array('class' => 'btn btn-success btn-lg pull-right', 'style' => 'margin-top: 20px;')) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection