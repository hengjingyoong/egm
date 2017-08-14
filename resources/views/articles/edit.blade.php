@extends('layouts.app')

@section('title', '| Edit Article')

@section('stylesheets')
<script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=ul2svc6wl2z2f3vzr4h9ken5z7zxsym7zf0g8sb3cnga33i1"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        plugins: 'lists link wordcount',
        menubar: false
    });﻿
</script>
@endsection

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>Edit Article</h1>
            <hr>
            <div class="well" style="margin-bottom:50px;">
                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <table class="table table-hover">
                            <thead>
                            <tr>
                                <th class="col-md-1">No</th>
                                <th class="col-md-8">Downloadable files</th>
                                <th class="col-md-3"></th>
                            </tr>
                            </thead>

                            <tbody>
                            @if(count($files) == 0)
                                <tr><td></td><td style="font-style:italic;">No file for this article...</td><td></td></tr>
                            @endif
                            @foreach($files as $file)
                                <tr>
                                    <th>{{ $loop->iteration }}</th>
                                    <td><a href="{{ asset('article_files/' . $file->file) }}" target="_blank"> {{ $file->filename }} </a></td>
                                    <td>
                                        <div class="row">
                                            {!! Form::open(['route' => ['article_files.delete', $file->id], 'onsubmit' => 'return ConfirmDelete()', 'method' => 'DELETE']) !!}
                                            {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i> Delete', array('type' => 'submit', 'class' => 'btn btn-danger btn-sm btn-block')) !!}
                                            {!! Form::close() !!}
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row" style="margin-top:20px;">
                    {!! Form::model($article,['route' => ['articles.update', $article->id], 'method' => 'PUT', 'files' => true]) !!}
                    <div class="form-group{{ $errors->has('files') ? ' has-error' : '' }}">
                        <div class="col-md-5 col-md-offset-2">
                            {{ Form::label('files', 'Add More Files To This Articles:', ['class' => 'control-label']) }}
                        </div>
                        <div class="col-md-5">
                            {{ Form::file('files[]', ['multiple' => 'multiple']) }}

                            @if ($errors->has('files'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('files') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            {{ Form::label('title', 'Title:', ['class' => 'form-spacing-top required']) }}
            {{ Form::text('title', null, [
                'class'         => 'form-control',
                'required'      => '',
                'minlength'     => '5',
                'maxlength'     => '100'
            ]) }}

            <div class="form-group{{ $errors->has('image') ? ' has-error' : '' }}">
                {{ Form::label('image', 'Update Image For Article:', ['class' => 'control-label', 'style' => 'margin-top:20px;']) }}
                {{ Form::file('image') }}

                @if ($errors->has('image'))
                    <span class="help-block">
                    <strong>{{ $errors->first('image') }}</strong>
                </span>
                @endif
            </div>

            <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                {{ Form::label('body', 'Content:', ['class' => 'control-label required', 'style' => 'margin-top:20px;']) }}
                {{ Form::textarea('body', null, [
                    'class'         => 'form-control'
                ]) }}

                @if ($errors->has('body'))
                    <span class="help-block">
                    <strong>{{ $errors->first('body') }}</strong>
                </span>
                @endif
            </div>

            <div class="row" style="margin-top:100px;">
                <div class="col-md-6">
                    <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success btn-lg btn-block">
                        <i class="fa fa-pencil" aria-hidden="true"></i> Edit Article
                    </button>
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script>
        function ConfirmDelete()
        {
            var result = confirm("Are you sure you want to delete the file?");
            return result ? true : false;
        }
    </script>
@endsection