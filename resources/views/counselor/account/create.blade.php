@extends('layouts.app')

@section('title', '| Counselor Registration')

@section('content')
<div class="container">
    <div class="row">
        <div class="panel panel-default">
            <div class="panel-heading">Counselor Registration</div>

            <div class="panel-body">
                <div class="col-md-4">
                    <legend><h3>Personal Information</h3></legend>
                    {!! Form::open(['route' => 'counselor_account.store', 'files' => true]) !!}

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

                    {{ Form::label('counselor', 'Counselor From:', ['class' => 'required', 'style' => 'margin-right:15px;margin-top:20px;display:block;']) }}
                    {{ Form::radio('type', 'University Counselor', false, ['onChange' => 'findselected()']) }}
                    <span style = "margin-right:15px;">University</span>
                    {{ Form::radio('type', 'College Counselor', false, ['onChange' => 'findselected()']) }}
                    <span style = "margin-right:15px;">College</span>
                    {{ Form::radio('type', 'Personal Counselor', true, ['onChange' => 'findselected()']) }}
                    <span style = "margin-right:15px;">Personal</span>

                    {{ Form::label('school_name', 'School Name:', ['style' => 'margin-top:20px;']) }}
                    {{ Form::text('school_name', null, [
                        'class'         => 'form-control',
                        'required'      => '',
                        'disabled'      => true,
                        'minlength'     => '10',
                        'maxlength'     => '60'
                    ]) }}

                    {{ Form::label('skype', 'Skype ID:', ['class' => 'form-spacing-top required']) }}
                    {{ Form::text('skype', null, [
                        'class'         => 'form-control',
                        'required'      => '',
                        'minlength'     => '2',
                        'maxlength'     => '60'
                    ]) }}
                </div>

                <div class="col-md-4">
                    <legend><h3>Verification Information</h3></legend>

                    <div class="form-group{{ $errors->has('profile') ? ' has-error' : '' }}">
                        {{ Form::label('profile', 'Profile Picture:', ['class' => 'form-spacing-top control-label required']) }}
                        {{ Form::file('profile', ['required' => '']) }}

                        @if ($errors->has('profile'))
                            <span class="help-block">
                                <strong>{{ $errors->first('profile') }}</strong>
                            </span>
                        @endif
                    </div>

                    <div class="form-group{{ $errors->has('proof') ? ' has-error' : '' }}">
                        {{ Form::label('proof', 'Proof of Qualification:', ['class' => 'control-label required', 'style' => 'margin-top:30px;']) }}
                        {{ Form::file('proof', ['required' => '']) }}

                        @if ($errors->has('proof'))
                            <span class="help-block">
                                <strong>{{ $errors->first('proof') }}</strong>
                            </span>
                        @endif
                    </div>


                </div>

                <div class="col-md-4">
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

                    {{ Form::submit('Register', array('class' => 'btn btn-success btn-lg pull-right', 'style' => 'margin-top: 135px;')) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript">
    function findselected() {
        var result = document.querySelector('input[name="type"]:checked').value;
        if(result == "Personal Counselor") {
            document.getElementById('school_name').value = "";
            document.getElementById("school_name").setAttribute('disabled', true);
        }
        else {
            document.getElementById("school_name").removeAttribute('disabled');
        }
    }
</script>
@endsection