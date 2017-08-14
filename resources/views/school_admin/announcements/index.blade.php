@extends('layouts.app')

@section('title', '| Posted Announcements')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <h1>Posted Announcements</h1>
            </div>

            <div class="col-md-3">
                @if(Auth::user()->school_admin->status <> 'active')
                    <a class="btn btn-lg btn-success btn-block" style="margin-top:18px;" disabled><i class="fa fa-plus" aria-hidden="true"></i> Post New Announcement</a>
                @else
                    <a href="{{ route('school_admin_announcement.create') }}" class="btn btn-lg btn-success btn-block" style="margin-top:18px;"><i class="fa fa-plus" aria-hidden="true"></i> Post New Announcement</a>
                @endif

            </div>
        </div>
        <hr>

        @if(count($announcements) == 0)
            <p>No Result Found...</p>
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
                            <th class="col-md-2">Title</th>
                            <th class="col-md-4">Body</th>
                            <th class="col-md-2">Posted At</th>
                            <th class="col-md-3"></th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($announcements as $announcement)
                            <tr>
                                <th>{{ $announcement->id }}</th>
                                <td>{{ $announcement->title }}</td>
                                <td>{{ str_limit(strip_tags($announcement->body), 50) }}</td>
                                <td>{{ date('M j, Y', strtotime($announcement->created_at)) }}</td>
                                <td>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <a href="{{ route('school_admin_announcement.show', $announcement->id) }}" class="btn btn-info btn-sm btn-block"><i class="fa fa-eye" aria-hidden="true"></i> View</a>
                                        </div>
                                        <div class="col-md-4">
                                            <a href="{{ route('school_admin_announcement.edit', $announcement->id) }}" class="btn btn-primary btn-sm btn-block"><i class="fa fa-pencil" aria-hidden="true"></i> Edit</a>
                                        </div>
                                        <div class="col-md-4">
                                            {!! Form::open(['method' => 'DELETE', 'route' => ['school_admin_announcement.destroy', $announcement->id], 'onsubmit' => 'return ConfirmDelete()']) !!}
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
                        {!! $announcements->links() !!}
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
            var result = confirm("Are you sure you want to delete the announcement?");
            return result ? true : false;
        }
    </script>
@endsection
