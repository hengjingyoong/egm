@extends('layouts.app')

@section('title', '| About EGM')

@section('content')
<div style="background-image:url('{{ asset('pictures/about_0.png') }}');height:410px;margin-top: -25px;"></div>
<div class="container">
    <br><br>
    <div class="row">
        <div class="col-md-4">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-tasks fa-4x 3" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>What We Do</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    Help secondary students in Malaysia to get prepared for their
                    tertiary education. Allow colleges & universities to promote courses.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-users fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Who We Serve</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    We aim to provide a platform that could bring students, counselors and
                    school admin together in one place.
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="col-md-12 well">
                <div class="text-center">
                    <i class="fa fa-bullseye fa-4x" aria-hidden="true"></i>
                </div>

                <h4 class="text-center"><strong>Our Mission</strong></h4>
                <hr>
                <p class="text-justify" style="font-family:serif; font-size: 18px;">
                    Helping students achieve education and workplace success.
                    Increase exposure of all the colleges and universities in Malaysia.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection