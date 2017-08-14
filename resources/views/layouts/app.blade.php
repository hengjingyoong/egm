<!DOCTYPE html>
<html lang="en">
    <head>
        @include('layouts.partials._head')
    </head>
    <body>
        @if(Auth::check() == false)
            @include('layouts.partials._nav_guest')
        @elseif(Auth::user()->role == 'student')
            @include('layouts.partials._nav_student')
        @elseif(Auth::user()->role == 'system_admin')
            @include('layouts.partials._nav_system_admin')
        @elseif(Auth::user()->role == 'school_admin')
            @include('layouts.partials._nav_school_admin')
        @elseif(Auth::user()->role == 'counselor')
            @include('layouts.partials._nav_counselor')
        @endif

        @yield('content')

        @include('layouts.partials._footer')

        @include('layouts.partials._javascript')
    </body>
</html>