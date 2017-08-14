<nav class="navbar navbar-default">
    <div class="container">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a href="{{ route('guest.welcome') }}"><img alt="EGM" src="{{ asset('pictures/egm_logo.png') }}" style="margin-top: 8px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('about_us') ? "active" : "" }}"><a href="{{ route('guest.about') }}">About us</a></li>
                <li class="dropdown {{ Request::is('service_ss', 'service_uc') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Our Services <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('guest.sss') }}">Secondary Students</a></li>
                        <li><a href="{{ route('guest.suc') }}">Universities & Colleges</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('login') ? "active" : "" }}"><a href="{{ route('login') }}">Login</a></li>
                <li class="dropdown {{ Request::is('*/create') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Register <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('student_account.create') }}">Student</a></li>
                        <li><a href="{{ route('counselor_account.create') }}">Counselor</a></li>
                        <li><a href="{{ route('school_admin_account.create') }}">School Admin</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>