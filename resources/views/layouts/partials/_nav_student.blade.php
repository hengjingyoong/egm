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
            <a href="{{ route('student.home') }}"><img alt="EGM" src="{{ asset('pictures/egm_logo.png') }}" style="margin-top: 8px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="{{ Request::is('student/home') || Request::is('student/announcements/*') ? "active" : "" }}"><a href="{{ route('student.home') }}">Announcement</a></li>
                <li class="{{ Request::is('student/assessment') || Request::is('student/assessment/*') ? "active" : "" }}"><a href="{{ route('assessment.index') }}">Self Assessment</a></li>
                <li class="dropdown {{ Request::is('career') || Request::is('career/*')
                                    || Request::is('school') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Search For <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('career.index') }}">Career</a></li>
                        <li><a href="{{ route('school.index') }}">Universities & Colleges</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('scholarships') || Request::is('scholarships/*')
                                    || Request::is('articles') || Request::is('articles/*') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Resource <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('scholarships.index') }}">Scholarships</a></li>
                        <li><a href="{{ route('articles.index') }}">Useful Articles</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('student/student_account/*') || Request::is('student/decision')
                                    || Request::is('student/message') || Request::is('feedback/create') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('student_account.edit', Auth::user()->id) }}">My Account</a></li>
                        <li><a href="{{ route('student.decision') }}">My Decision</a></li>
                        <li><a href="{{ route('student.message') }}">Messages</a></li>
                        <li><a href="{{ route('feedback.create') }}">Feedback</a></li>
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