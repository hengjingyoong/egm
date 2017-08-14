@extends('layouts.app')

@section('title', '| Home Page')

@section('content')
    <div class="container">
        <div class="row">
            <h2 class="text-center"><strong>EGM Statistic</strong></h2>
            <hr>

            <div class="col-md-6">
                <div class="well">
                    <h4 class="text-center">Top 10 Majors Selected By Students</h4>
                    <hr>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-2">No</th>
                            <th class="col-md-6">Major</th>
                            <th class="col-md-4">Number of Students</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($majors as $major)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $major->major->name }}</td>
                                <td class="text-center">{{ $major->count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="col-md-6">
                <div class="well">
                    <h4 class="text-center">Top 10 Careers Selected By Students</h4>
                    <hr>
                    <table class="table table-hover">
                        <thead>
                        <tr>
                            <th class="col-md-2">No</th>
                            <th class="col-md-6">Career</th>
                            <th class="col-md-4">Number of Students</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($careers as $career)
                            <tr>
                                <th>{{ $loop->iteration }}</th>
                                <td>{{ $career->career->name }}</td>
                                <td class="text-center">{{ $career->count }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection