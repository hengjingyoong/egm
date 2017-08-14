@extends('layouts.app')

@section('title', '| Majors')

@section('content')
<div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1 style="display:inline-block;">Majors</h1>
                {!! Form::open(['route' => ['major.store'], 'id' => 'addForm', 'style' => 'margin-left:25px;display:inline-block;']) !!}
                {!! Form::button('<i class="fa fa-plus" aria-hidden="true"></i> Add New', ['class' => 'btn btn-md btn-success', 'onclick' => 'addFunction()', 'style' => 'margin-bottom:15px;']) !!}
                {{ Form::hidden('name', '', array('id' => 'add_name')) }}
                {!! Form::close() !!}
            </div>

            <div class="col-md-6" style="margin-top:16px;">
                {!! Form::open(['method' => 'GET', 'route' => ['major.index'], 'class' => 'navbar-form']) !!}
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

        @if(count($majors) == 0)
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
                            <th class="col-md-1">No</th>
                            <th class="col-md-8">Name</th>
                            <th class="col-md-3"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($majors as $major)
                            <tr>
                                <th>{{ $major->id }}</th>
                                <td>{{ $major->name }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-6">
                                            {!! Form::open(['method' => 'PUT', 'route' => ['major.update', $major->id], 'id' => 'updateForm']) !!}
                                            {!! Form::button('<i class="fa fa-pencil" aria-hidden="true"></i> Edit', array('class' => 'btn btn-primary btn-sm btn-block', 'onclick' => 'updateFunction()')) !!}
                                            {{ Form::hidden('name', '', array('id' => 'update_name')) }}
                                            {!! Form::close() !!}
                                        </div>
                                        <div class="col-md-6">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['major.destroy', $major->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-block')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {!! $majors->appends(Request::except('page'))->links() !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@section('scripts')
<script>
    function ConfirmDelete() {
        var result = confirm("Are you sure you want to delete the major?");
        return result ? true : false;
    }

    function addFunction() {
        var major = prompt("Please enter major name:");
        if (major == null || major == "") {
            return;
        }
        else{
            document.getElementById("add_name").value = major;
            document.getElementById("addForm").submit();
        }
    }

    function updateFunction() {
        var major = prompt("Please enter new major name:");
        if (major == null || major == "") {
            return;
        }
        else{
            document.getElementById("update_name").value = major;
            document.getElementById("updateForm").submit();
        }
    }
</script>
@endsection
