@extends('layouts.app')

@section('title', '| Welcome To EGM')

@section('content')
<div style="background-image:url('{{ asset('pictures/welcome_0.jpg') }}');height:410px;margin-top: -25px;"></div>
<div class="container">
    <div class="row">
        <h2 class="text-center"><strong>Our Services</strong></h2>
        <hr>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="col-md-10 col-md-offset-1 well">
                <div class="text-center">
                    <i class="fa fa-graduation-cap fa-4x 3" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Secondary Students</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, secondary students in Malaysia can take the psychometric tests, explore
                    careers, colleges and universities, get the latest update from colleges and universities, read
                    useful articles, download resources and have discussion with the counselors.
                </p><br>
                <a href="{{ route('guest.sss') }}" class="btn btn-primary btn-lg col-md-6 col-md-offset-3">Learn More</a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="col-md-10 col-md-offset-1 well">
                <div class="text-center">
                    <i class="fa fa-university fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Colleges and Universities</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    With our system, admins and counselors from colleges and universities can promote their courses,
                    get the statistic for top 10 majors and careers selected by students, and connect with the
                    secondary students in Malaysia.
                </p><br><br>
                <a href="{{ route('guest.suc') }}" class="btn btn-primary btn-lg col-md-6 col-md-offset-3">Learn More</a>
            </div>
        </div>
    </div>
</div>
@endsection

