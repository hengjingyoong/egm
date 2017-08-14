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
            <a href="{{ route('system_admin.home') }}"><img alt="EGM" src="{{ asset('pictures/egm_logo.png') }}" style="margin-top: 8px;"></a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown {{ Request::is('system_admin/system_admin_account/create') || Request::is('system_admin/home')
                                    || Request::is('system_admin/admin_acc') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Account <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('system_admin_account.create') }}">Create New Account ---- (System Admin)</a></li>
                        <li><a href="{{ route('system_admin.home') }}">Manage Account -------- (Counselor)</a></li>
                        <li><a href="{{ route('account_manager.admin.index') }}">Manage Account -------- (University/College Admin)</a></li>
                    </ul>
                </li>
                <li class="dropdown {{ Request::is('system_admin/major') || Request::is('career')
                                    || Request::is('career/*') || Request::is('school') || Request::is('school/*')
                                    || Request::is('scholarships') || Request::is('scholarships/*')
                                    || Request::is('articles') || Request::is('articles/*')
                                     ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Manage Resource <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('major.index') }}">Majors</a></li>
                        <li><a href="{{ route('career.index') }}">Careers</a></li>
                        <li><a href="{{ route('school.index') }}">Schools</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('scholarships.index') }}">Scholarships</a></li>
                        <li><a href="{{ route('articles.index') }}">Useful Articles</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('feedback') ? "active" : "" }}">
                    <a href="{{ route('feedback.index') }}">Feedbacks</a>
                </li>
                <li class="dropdown {{ Request::is('system_admin/system_admin_account/*') ? "active" : "" }}">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Profile <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('system_admin_account.edit', Auth::user()->id) }}">My Account</a></li>
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