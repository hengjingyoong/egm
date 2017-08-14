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

                <div class="pull-right">
                    <p style="font-style: italic;">Published At: {{ date('M j, Y', strtotime($announcement->created_at)) }}</p>
                    <p style="font-style: italic;">Published By: {{ \App\Http\Controllers\shared\AnnouncementController::getSchoolName($announcement->admin_id) }}</p>
                </div>

                <a href="{{ URL::previous() }}" class="btn btn-primary btn-lg btn-block" style="margin-top:120px;"><i class="fa fa-arrow-left" aria-hidden="true"></i> Go Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection