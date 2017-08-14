@extends('layouts.app')

@section('title', '| Feedbacks')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h1>Feedbacks</h1>
        </div>

        <div class="col-md-7 col-md-offset-2" style="margin-top:16px;">
            {!! Form::open(['method' => 'GET', 'route' => ['feedback.index'], 'class' => 'navbar-form']) !!}
            <div class="input-group">
                <div class="input-group-btn">
                    {{ Form::select('search_status', [2 => 'All', 0 => 'Read', 1 => 'Unread'], null, ['class' => 'form-control', 'style' => 'width: 100px;']) }}
                </div>
                {{ Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'Search', 'style' => 'width:500px;']) }}
                <div class="input-group-btn">
                    {{ Form::button('<i class="glyphicon glyphicon-search"></i>', array('type' => 'submit', 'class' => 'btn btn-default')) }}
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    <hr>

    @if(count($feedbacks) == 0)
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
                            <th style="width:3%;">No</th>
                            <th style="width:27%;">Body</th>
                            <th style="width:18%;">Sender Name</th>
                            <th style="width:20%;">Sender Email</th>
                            <th style="width:15%;">Received At</th>
                            <th style="width:17%;"></th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($feedbacks as $feedback)
                        <tr>
                            <th>{{ $feedback->feedback_id }}</th>
                            <td>{{ $feedback->body }}</td>
                            <td>{{ $feedback->last_name . ' ' . $feedback->first_name }}</td>
                            <td>{{ $feedback->email }}</td>
                            <td>{{ date('M j, Y', strtotime($feedback->created_at)) }}</td>
                            <td>
                                <div class="row">
                                    @if($feedback->status == 0)
                                        <strong style="margin-right:20px;color:limegreen;"><i class="fa fa-eye" aria-hidden="true"></i> Read</strong>

                                        {!! Form::model($feedback,['route' => ['feedback.update', $feedback->feedback_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                        {{ Form::button('<i class="fa fa-eye-slash" aria-hidden="true"></i> Mark Unread', ['type' => 'submit', 'class' => 'btn btn-info btn-sm btn-block'])  }}
                                        {{ Form::hidden('status', '1') }}
                                        {!! Form::close() !!}
                                    @else
                                        {!! Form::model($feedback,['route' => ['feedback.update', $feedback->feedback_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                        {{ Form::button('<i class="fa fa-eye" aria-hidden="true"></i> Mark Read', ['type' => 'submit', 'class' => 'btn btn-success btn-sm btn-block'])  }}
                                        {{ Form::hidden('status', '0') }}
                                        {!! Form::close() !!}

                                        <strong style="margin-left:20px;color:dodgerblue;"><i class="fa fa-eye-slash" aria-hidden="true"></i> Unread</strong>
                                    @endif
                                </div>

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {!! $feedbacks->appends(Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
