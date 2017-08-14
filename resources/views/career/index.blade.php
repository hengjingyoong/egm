@extends('layouts.app')

@section('title', '| Careers')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-4">
                <h1 style="display:inline-block;">Careers</h1>
                @if(Auth::user()->role == 'system_admin')
                    <a href="{{ route('career.create') }}" class="btn btn-md btn-success" style="margin-left:25px;margin-bottom:15px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
                @endif
            </div>

            <div class="col-md-6 col-md-offset-2" style="margin-top:16px;">
                {!! Form::open(['method' => 'GET', 'route' => ['career.index'], 'class' => 'navbar-form']) !!}
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

        @if(count($careers) == 0)
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
                            <th style="width:15%;">Name</th>
                            <th style="width:18%;">Holland Code</th>
                            <th style="width:18%;">Ability</th>
                            <th style="width:18%;">Value</th>
                            <th style="width:26%;"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($careers as $career)
                            <tr>
                                <th>{{ $career->id }}</th>
                                <td>{{ $career->name }}</td>
                                <td>
                                    @foreach($career->interests as $interest)
                                        <span class="label label-default" style="font-size:11px;">{{ $interest->name }}</span>
                                        @if (!$loop->last) , @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($career->abilities as $ability)
                                        <span class="label label-default" style="font-size:11px;">{{ $ability->name }}</span>
                                        @if (!$loop->last) , @endif
                                    @endforeach
                                </td>
                                <td>
                                    @foreach($career->work_values as $value)
                                        <span class="label label-default" style="font-size:11px;">{{ $value->name }}</span>
                                        @if (!$loop->last) , @endif
                                    @endforeach
                                </td>
                                <td>
                                    <div class="row">
                                        @if(Auth::user()->role == 'system_admin')
                                            <div class="col-md-4">
                                                <a href="{{ route('career.show', $career->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                            </div>
                                            <div class="col-md-4">
                                                <a href="{{ route('career.edit', $career->id) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                            </div>
                                            <div class="col-md-4">
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['career.destroy', $career->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                                {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-block')) !!}
                                                {!! Form::close() !!}
                                            </div>
                                        @else
                                            <div class="col-md-6 col-md-offset-3">
                                                <a href="{{ route('career.show', $career->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {!! $careers->appends(Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function ConfirmDelete() {
        var result = confirm("Are you sure you want to delete the career?");
        return result ? true : false;
    }
</script>
@endsection
