@extends('layouts.app')

@section('title', '| Messages')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>Contact Counselors</h1>
            </div>

            <div class="col-md-7 col-md-offset-1" style="margin-top:16px;">
                {!! Form::open(['method' => 'GET', 'route' => ['student.message'], 'class' => 'navbar-form']) !!}
                <div class="input-group">
                    {{ Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'Search', 'style' => 'width:500px;']) }}
                    <div class="input-group-btn">
                        {{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-default')) }}
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
        <hr>

        @if(count($counselors) == 0)
            <p>No Result Found...</p>
            @if(app('request')->input('keyword'))
                <p>Please try another keyword...</p>
            @endif
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        @else
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th style="width:5%;">No</th>
                            <th style="width:15%;">Profile Picture</th>
                            <th style="width:15%;">Name</th>
                            <th style="width:17%;">Email</th>
                            <th style="width:16%;">Type</th>
                            <th style="width:20%;">School Name</th>
                            <th style="width:12%;">Skype ID</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($counselors as $counselor)
                            <tr>
                                <th>{{ $counselor->counselor_id }}</th>
                                <td> <img src="{{ asset('profiles/' . $counselor->profile) }}" width="120" height="135"/> </td>
                                <td>{{ $counselor->last_name . ' ' . $counselor->first_name }}</td>
                                <td>{{ $counselor->email }}</td>
                                <td>{{ $counselor->type }}</td>
                                <td>{{ $counselor->school_name == null ? '-': $counselor->school_name}}</td>
                                <td>{{ $counselor->skype }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {!! $counselors->appends(Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
