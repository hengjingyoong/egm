@extends('layouts.app')

@section('title', '| Our Services')

@section('content')
<div style="background-image:url('{{ asset('pictures/service_0.png') }}');height:410px;margin-top: -25px;"></div>
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-tasks fa-4x 3" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Psychometric Tests</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can discover their interests, abilities
                    and work values by taking the: <br>
                </p>
                <ul style="font-family:serif; font-size: 18px;">
                    <li>Interest Assessment  &nbsp; &nbsp; &rarr; 180 questions</li>
                    <li>Abilities Assessment &nbsp; &rarr; 18 statements</li>
                    <li>Values Assessment &nbsp;&nbsp; &nbsp; &rarr; 20 statements</li>
                </ul>
                <br>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-comments fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Discussion With Counselors</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can have the discussion with personal counselors
                    or counselors from colleges and universities. Students can get their skype ID in
                    our system and later contact the counselors when they are online. They can inquiry
                    the details of careers, courses offered by the school, or even discuss about their
                    results on the psychometric tests.
                </p>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-suitcase fa-4x 3" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Careers Discovery</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can explore the job tasks, work setting, skills, education
                    requirements, salary & outlook, career paths of different careers. They can easily search for
                    their desired career with our search feature, or get to know their ideal careers based on the
                    psychometric tests results.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-university fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Colleges & Universities Discovery</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can explore the colleges and universities
                    that have provide their desired majors. It can be done by using our search feature,
                    or through the career details page which showing what majors are suitable for
                    that career.
                </p>
                <br>
            </div>
        </div>
    </div>

    <br>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-refresh fa-4x 3" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Latest Update From School</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can get the latest update from the
                    colleges and universities. It can be the new courses established, fee
                    discount, and so on. Students can search for the specific announcements published by
                    the college or university through our search feature.
                </p>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-lightbulb-o fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Useful Article & Resources</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students can read the useful articles and download
                    the resources that are related to educational and career planning. It helps them
                    to get prepared for tertiary education.
                </p><br><br>
            </div>
        </div>
    </div>
</div>
@endsection