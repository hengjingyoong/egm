@extends('layouts.app')

@section('title', '| School Admin Accounts')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-5">
                <h1>School Admin Accounts</h1>
            </div>

            <div class="col-md-7" style="margin-top:16px;">
                {!! Form::open(['method' => 'GET', 'route' => ['account_manager.admin.index'], 'class' => 'navbar-form']) !!}
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

        @if(count($admins) == 0)
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
                            <th style="width:10%;">No</th>
                            <th style="width:20%;">Email</th>
                            <th style="width:25%;">School Name</th>
                            <th style="width:25%;">Letter of Authentication</th>
                            <th style="width:20%;"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($admins as $admin)
                            <tr>
                                <th>{{ $admin->school_admin_id }}</th>
                                <td>{{ $admin->email }}</td>
                                <td>{{ $admin->school_name }}</td>
                                <td><a href="{{ asset('letters/' . $admin->letter) }}" target="_blank">{{ $admin->letter }}</a></td>
                                <td>
                                    <div class="row">
                                        @if($admin->status == 'active')
                                            <strong style="margin-right:20px;color:limegreen;"><i class="fa fa-toggle-on" aria-hidden="true"></i> Active</strong>

                                            {!! Form::model($admin,['route' => ['account_manager.admin.update', $admin->school_admin_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-power-off" aria-hidden="true"></i> Deactivate', ['type' => 'submit', 'class' => 'btn btn-danger btn-md btn-block'])  }}
                                            {{ Form::hidden('status', 'inactive') }}
                                            {!! Form::close() !!}
                                        @elseif($admin->status == 'inactive')
                                            {!! Form::model($admin,['route' => ['account_manager.admin.update', $admin->school_admin_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
                                            {{ Form::button('<i class="fa fa-check" aria-hidden="true"></i> Approve', ['type' => 'submit', 'class' => 'btn btn-success btn-md btn-block'])  }}
                                            {{ Form::hidden('status', 'active') }}
                                            {!! Form::close() !!}

                                            {!! Form::model($admin,['route' => ['account_manager.admin.update', $admin->school_admin_id], 'method' => 'PUT', 'style' => 'display:inline-block;']) !!}
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
                        {!! $admins->appends(Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection
