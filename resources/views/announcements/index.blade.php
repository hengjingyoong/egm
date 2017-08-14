<div class="container">
    <div class="row">
        <div class="col-md-3">
            <h1>Announcements</h1>
        </div>
        <div class="col-md-6 col-md-offset-3" style="margin-top:16px;">
            {!! Form::open(['method' => 'GET', 'route' => [Auth::user()->role . '.home'], 'class' => 'navbar-form']) !!}
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

    @if(count($announcements) == 0)
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
    @endif

    @foreach($announcements as $announcement)
        <div class="row well">
            <div class="row">
                <h2 class="col-md-7">{{ $announcement->title }}</h2>
                <h5 class="col-md-5" style="font-style: italic;margin-top:36px;">
                    Published At: {{ date('M j, Y', strtotime($announcement->created_at)) }} &nbsp &nbsp &nbsp &nbsp
                    Published By: {{ \App\Http\Controllers\shared\AnnouncementController::getSchoolName($announcement->admin_id) }}
                </h5>
            </div>
            <legend></legend>
            <p>{{ substr(strip_tags($announcement->body), 0, 250) }}{{ strlen(strip_tags($announcement->body)) > 250 ? "..." : "" }}</p><hr>

            <a href="{{ route('announcement.single', $announcement->id) }}" class="btn btn-primary pull-right">Read More</a>
        </div>
    @endforeach


    <div class="row">
        <div class="text-center">
            {!! $announcements->appends(Request::except('page'))->links() !!}
        </div>
    </div>
</div>