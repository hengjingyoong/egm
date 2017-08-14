@extends('layouts.app')

@section('title', '| My Decision')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <br>
            <div class="panel panel-default">
                <div class="panel-heading" style="font-weight: bold;">My Decision</div>
                <div class="panel-body">
                    <p style="font-style: italic;">To help us improve our services, please provide your final decisions on major and career.</p>

                    {!! Form::model($decision,['route' => ['student.decision.update', $decision->id], 'method' => 'PUT']) !!}

                    {{ Form::label('majors', 'Majors:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                    <select class="form-control" name="majors" id="majors" required>
                        @foreach($majors as $major)
                            <option {{ $major->id == $decision->major_id ? 'selected' : '' }} value="{{ $major->id }}">{{ $major->name }}</option>
                        @endforeach
                    </select>

                    {{ Form::label('careers', 'Careers:', ['class' => 'required', 'style' => 'margin-top:20px;']) }}
                    <select class="form-control" name="careers" id="careers" required>
                        @foreach($careers as $career)
                            <option {{ $career->id == $decision->career_id ? 'selected' : '' }} value="{{ $career->id }}">{{ $career->name }}</option>
                        @endforeach
                    </select>

                    <div class="row" style="margin-top:30px;">
                        <div class="col-md-6">
                            <a href="{{ URL::previous() }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success btn-lg btn-block">
                                <i class="fa fa-pencil" aria-hidden="true"></i> Save Change
                            </button>
                        </div>
                    </div>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
