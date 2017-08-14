@extends('layouts.app')

@section('title', '| Counselor Accounts')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1>Counselor Accounts</h1>
            </div>

            <div class="col-md-7 col-md-offset-1" style="margin-top:16px;">
                {!! Form::open(['method' => 'GET', 'route' => ['system_admin.home'], 'class' => 'navbar-form']) !!}
                <div class="input-group">
                    <div class="input-group-btn">
                        {{ Form::select('search_status', ['all' => 'All Accounts', 'active' => 'Active Accounts', 'inactive' => 'Inactive Accounts', 'rejected' => 'Rejected Accounts'], null, ['class' => 'form-control', 'style' => 'width: 170px;']) }}
                    </div>
                    {{ Form::text('keyword', null, ['class' => 'form-control', 'placeholder' => 'Search', 'style' => 'width:430px;']) }}
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
            @if(app('request')->input('keyword') || app('request')->input('search_status'))
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
                            <th style="width:12%;">Name</th>
                            <th style="width:17%;">Email</th>
                            <th style="width:18%;">School Name</th>
                            <th style="width:12%;">Profile Picture</th>
                            <th style="width:18%;">Proof of Qualification</th>
                            <th style="width:18%;"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($counselors as $counselor)
                            <tr>
                                <th>{{ $counselor->counselor_id }}</th>
                                <td>{{ $counselor->last_name . ' ' . $counselor->first_name }}</td>
                                <td>{{ $counselor->email }}</td>
                                <td>{{ $counselor->school_name == null ? '-': $counselor->school_name}}</td>
                                <td> <img src="{{ asset('profiles/' . $counselor->profile) }}" width="100" height="115"/> </td>
                                <td><a href="{{ asset('proofs/' . $counselor->proof) }}" target="_blank">{{ $counselor->proof }}</a></td>
                                <td>
                                    <div class="row">
                                        @if($counselor->status == 'active')
                                            <strong style="margin-right:20px;color:limegreen;"><i class="fa fa-toggle-on" aria-hidden="true"></i> Active</strong>

                                            {!! Form::model($counselor,['route' => ['account_manager.counselor.update', $counselor->counselor_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-power-off" aria-hidden="true"></i> Deactivate', ['type' => 'submit', 'class' => 'btn btn-danger btn-md btn-block'])  }}
                                            {{ Form::hidden('status', 'inactive') }}
                                            {!! Form::close() !!}
                                        @elseif($counselor->status == 'inactive')
                                            {!! Form::model($counselor,['route' => ['account_manager.counselor.update', $counselor->counselor_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Approve', ['type' => 'submit', 'class' => 'btn btn-success btn-md btn-block'])  }}
                                            {{ Form::hidden('status', 'active') }}
                                            {!! Form::close() !!}

                                            {!! Form::model($counselor,['route' => ['account_manager.counselor.update', $counselor->counselor_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-times" aria-hidden="true"></i> Reject', ['type' => 'submit', 'class' => 'btn btn-danger btn-md btn-block'])  }}
                                            {{ Form::hidden('status', 'rejected') }}
                                            {!! Form::close() !!}
                                        @else
                                            <strong style="color: red;"><i class="fa fa-times" aria-hidden="true"></i> Rejected</strong>
                                        @endif
                                    </div>

                                </td>
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
