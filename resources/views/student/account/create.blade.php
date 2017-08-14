@extends('layouts.app')

@section('title', '| Student Registration')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Student Registration</div>

            <div class="panel-body">
                <div class="col-md-5">
                    <legend><h3>Personal Information</h3></legend>
                    {!! Form::open(['route' => 'student_account.store']) !!}

                    {{ Form::label('first_name', 'First Name:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::text('first_name', null, [
                        'class'         => 'form-control',
                        'required'      => '',
                        'minlength'     => '2',
                        'maxlength'     => '32'
                    ]) }}

                    {{ Form::label('last_name', 'Last Name:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::text('last_name', null, [
                        'class'         => 'form-control',
                        'required'      => '',
                        'minlength'     => '2',
                        'maxlength'     => '32'
                    ]) }}

                    {{ Form::label('gender', 'Gender:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::select('gender', ['m' => 'Male', 'f' => 'Female'], null, ['class' => 'form-control', 'style' => 'width: 100px;']) }}

                    {{ Form::label('age', 'Age:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::select('age', ['15' => '15',
                                            '16' => '16',
                                            '17' => '17',
                                            '18' => '18',
                                            '19' => '19',
                                            '20' => '20',
                                            ], null, ['class' => 'form-control', 'style' => 'width: 100px;']) }}
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