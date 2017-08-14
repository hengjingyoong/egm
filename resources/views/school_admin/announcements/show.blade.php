@extends('layouts.app')

@section('title', '| Announcement')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <h1>{{ $announcement->title }}</h1>
            <hr>

            @if(Storage::disk('announcements')->exists($announcement->image))
                <div class="row">
                    <div class="col-md-6 col-md-offset-3">
                        <img src="{{ asset('announcements/' . $announcement->image) }}" height="200" width="400">
                    </div>
                </div>
            @endif

            <p class="lead">{!! $announcement->body !!}</p>
            <hr>

            <div class="row">
                <p class="col-md-3 col-md-offset-9" style="font-style: italic;">Posted At: {{ date('M j, Y', strtotime($announcement->created_at)) }}</p>
            </div>

            <div class="row" style="margin-top:80px;">
                <div class="col-md-6">
                    <a href="{{ route('school_admin_announcement.index') }}" class="btn btn-primary btn-lg btn-block"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('school_admin_announcement.edit', $announcement->id) }}" class="btn btn-success btn-lg btn-block">Go Edit <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection