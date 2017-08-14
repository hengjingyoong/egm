@extends('layouts.app')

@section('title', '| Scholarships')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 style="display:inline-block;">List of Scholarships</h1>
            @if(Auth::user()->role == 'system_admin')
                <a href="{{ route('scholarships.create') }}" class="btn btn-md btn-success" style="margin-left:25px;margin-bottom:15px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            @endif
        </div>

        <div class="col-md-6" style="margin-top:16px;">
            {!! Form::open(['method' => 'GET', 'route' => ['scholarships.index'], 'class' => 'navbar-form']) !!}
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

    @if(count($scholarships) == 0)
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
                        <th style="width:25%;">Offered By</th>
                        <th style="width:30%;">Details</th>
                        <th style="width:15%;">Published At</th>
                        <th style="width:25%;"></th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($scholarships as $scholarship)
                        <tr>
                            <th>{{ $scholarship->id }}</th>
                            <td>{{ $scholarship->offered_by }}</td>
                            <td>{{ str_limit(strip_tags($scholarship->details), 50) }}</td>
                            <td>{{ date('M j, Y', strtotime($scholarship->created_at)) }}</td>
                            <td>
                                <div class="row">
                                    @if(Auth::user()->role == 'system_admin')
                                        <div class="col-md-4">
                                            <a href="{{ route('scholarships.show', $scholarship->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('scholarships.edit', $scholarship->id) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['scholarships.destroy', $scholarship->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-block')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    @else
                                        <div class="col-md-8 col-md-offset-2">
                                            <a href="{{ route('scholarships.show', $scholarship->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye" aria-hidden="true"></i> View Details</a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {!! $scholarships->appends(Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
    <script>
        function ConfirmDelete()
        {
            var result = confirm("Are you sure you want to delete the scholarship?");
            return result ? true : false;
        }
    </script>
@endsection
