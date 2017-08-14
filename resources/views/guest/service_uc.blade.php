@extends('layouts.app')

@section('title', '| Our Services')

@section('content')
<div style="background-image:url('{{ asset('pictures/service_1.png') }}');height:410px;margin-top: -25px;"></div>
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-volume-up fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Courses Promotion</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, admins from colleges and universities can promote their courses
                    to secondary students in Malaysia. They also allowed to view other announcements
                    published by other colleges or universities.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-share-alt fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Connection With Students</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, counselors from colleges and universities can connect with
                    the secondary students in Malaysia. They can give their advices and suggestions
                    to students that contact with them in Skype.
                </p>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-12 well">
            <div class="text-center">
                <i class="fa fa-line-chart fa-4x" aria-hidden="true"></i>
            </div>

            <h4 class="text-center"><strong>Statistic of Majors & Careers</strong></h4>
            <hr>
            <p class="text-justify" style="font-family:serif; font-size: 18px;">
                With our system, admins from colleges and universities can get the statistic for top 10 majors
                and careers selected by students. It can be used as a reference to plan for their courses
                as well as the marketing strategy.
            </p>
        </div>
    </div>
</div>
@endsection