@extends('layouts.app')

@section('title', '| Schools')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-4">
            <h1 style="display:inline-block;">Schools</h1>
            @if(Auth::user()->role == 'system_admin')
                <a href="{{ route('school.create') }}" class="btn btn-md btn-success" style="margin-left:25px;margin-bottom:15px;"><i class="fa fa-plus" aria-hidden="true"></i> Add New</a>
            @endif
        </div>

        <div class="col-md-7 col-md-offset-1" style="margin-top:16px;">
            {!! Form::open(['method' => 'GET', 'route' => ['school.index'], 'class' => 'navbar-form']) !!}
            <div class="input-group">
                <div class="input-group-btn">
                    {{ Form::select('search_state', ['All' => 'All',
                                      'Johor' => 'Johor',
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
                                      'Terengganu' => 'Terengganu'], null, ['class' => 'form-control', 'style' => 'width: 160px;']) }}
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

    @if(count($schools) == 0)
        <p>No Result Found...</p>
        @if(app('request')->input('keyword') || app('request')->input('search_state'))
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
                        @if(Auth::user()->role == 'system_admin')
                            <th style="width:5%;">No</th>
                            <th style="width:20%;">Name</th>
                            <th style="width:25%;">Majors</th>
                            <th style="width:10%;">State</th>
                            <th style="width:15%;">Link</th>
                            <th style="width:25%;"></th>
                         @else
                            <th style="width:5%;">No</th>
                            <th style="width:25%;">Name</th>
                            <th style="width:30%;">Majors</th>
                            <th style="width:20%;">State</th>
                            <th style="width:20%;">Link</th>
                        @endif
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($schools as $school)
                        <tr>
                            <th>{{ $school->id }}</th>
                            <td>{{ $school->name }}</td>
                            <td>
                                @foreach($school->majors as $major)
                                    <span style="font-size:15px;margin-bottom: 5px;">{{ $major->name }}</span>
                                    @if (!$loop->last)
                                        ,<br>
                                    @endif
                                @endforeach
                            </td>
                            <td>{{ $school->state }}</td>
                            <td><a href="{{ $school->link }}" target="_blank">{{ $school->link }}</a></td>
                            @if(Auth::user()->role == 'system_admin')
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <a href="{{ route('school.edit', $school->id) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['school.destroy', $school->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-block')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                <div class="text-center">
                    {!! $schools->appends(Request::except('page'))->links() !!}
                </div>
            </div>
        </div>
    @endif
</div>
@endsection

@section('scripts')
<script>
    function ConfirmDelete() {
        var result = confirm("Are you sure you want to delete the school?");
        return result ? true : false;
    }
</script>
@endsection
