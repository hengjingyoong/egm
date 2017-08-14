@extends('layouts.app')

@section('title', '| Article')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $article->title }}</h1>
            <hr>

            @if(Storage::disk('article_images')->exists($article->image))
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{ asset('article_images/' . $article->image) }}" height="200" width="400">
                    </div>
                </div>
            @endif

            <p class="lead">{!! $article->body !!}</p>
            <hr>

            <div class="row">
                <p class="col-md-4 col-md-offset-8" style="font-style: italic;">Published At: {{ date('M j, Y', strtotime($article->created_at)) }}</p>
            </div>

            <br><br><br>

            @if(count($files) <> 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th class="col-md-3">No</th>
                                    <th class="col-md-9">Downloadable files</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($files as $file)
                                    <tr>
                                        <th>{{ $loop->iteration }}</th>
                                        <td><a href="{{ asset('article_files/' . $file->file) }}" target="_blank"> {{ $file->filename }} </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif

            <div class="row" style="margin-top:30px;">
                @if(Auth::user()->role == 'system_admin')
                    <div class="col-md-6">
                        <a href="{{ route('articles.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                    </div>
                    <div class="col-md-6">
                        <a href="{{ route('articles.edit', $article->id) }}" class="btn btn-success btn-lg btn-block">Go Edit <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                    </div>
                @else
                    <a href="{{ URL::previous() }}" class="btn btn-success btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection