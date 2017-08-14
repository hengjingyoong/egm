@extends('layouts.app')

@section('title', '| Add New School')

@section('stylesheets')
    {{ Html::style('css/select2.min.css') }}
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Add New School</h1>
            <hr>
            {!! Form::open(['route' => 'school.store']) !!}
            {{ Form::label('name', 'School Name:', ['class' => 'form-spacing-top required']) }}
            {{ Form::text('name', null, [
                'class'         => 'form-control',
                'required'      => '',
                'minlength'     => '10',
                'maxlength'     => '60'
            ]) }}

            {{ Form::label('majors', 'Majors:', ['class' => 'form-spacing-top required']) }}
            <select class="form-control select2-multi" multiple="multiple" name="majors[]" required>
                @foreach($majors as $major)
                    <option value="{{ $major->id }}">{{ $major->name }}</option>
                @endforeach
            </select>

            {{ Form::label('state', 'State:', ['class' => 'form-spacing-top required']) }}
            {{ Form::select('state', ['Johor' => 'Johor',
                                      'Kedah' => 'Kedah',
                                      'Kelantan' => 'Kelantan',
                                      'Malacca' => 'Malacca',
                                      'Negeri Sembilan' => 'Negeri Sembilan',
                                      'Pahang' => 'Pahang',
                                      'Penang' => 'Penang',
                                      'Perak' => 'Perak',
                                      'Perlis' => 'Perlis',
                                      'Sabah' => 'Sabah',
                                      'Sarawak' => 'Sarawak',
                                      'Selangor' => 'Selangor',
                                      'Terengganu' => 'Terengganu'
                                     ], null, ['class' => 'form-control', 'style' => 'width: 200px;']) }}

            {{ Form::label('link', 'Official Website:', ['class' => 'form-spacing-top']) }}
            {{ Form::text('link', null, [
                'class'         => 'form-control',
            ]) }}

            <div class="row" style="margin-top:30px;">
                <div class="col-md-6">
                    <a href="{{ route('school.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-plus" aria-hidden="true"></i> Add School
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