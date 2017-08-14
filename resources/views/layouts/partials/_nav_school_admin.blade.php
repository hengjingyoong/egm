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
            <a href="{{ route('school_admin.home') }}"><img alt="EGM" src="{{ asset('pictures/egm_logo.png') }}" style="margin-top: 8px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown {{ Request::is('school_admin/home') || Request::is('school_admin/school_admin_announcement')
                || Request::is('school_admin/school_admin_announcement/*') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Announcements <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('school_admin.home') }}">All Announcements</a></li>
                        <li><a href="{{ route('school_admin_announcement.index') }}">Posted Announcements</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('school_admin/statistic') ? "active" : "" }}"><a href="{{ route('school_admin.statistic') }}">Statistic</a></li>
                <li class="dropdown {{ Request::is('school_admin/school_admin_account/*') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('school_admin_account.edit', Auth::user()->id) }}">My Account</a></li>
                        <li>
                            <a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Logout
                            </a>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>