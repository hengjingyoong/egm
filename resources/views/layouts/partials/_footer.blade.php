<div class="footer-distributed">
    <div class="footer-left">
        <a href="{{ route(Auth::check() ? Auth::user()->role . '.home' : 'guest.welcome') }}"><img alt="EGM" src="{{ asset('pictures/egm_logo.png') }}"></a>
    </div>

    <div class="footer-center">
        <div>
            <i class="fa fa-map-marker"></i>
            <p><span>Jalan Inovasi 1, Taman Teknologi Malaysia, 57000 Kuala Lumpur, </span> Wilayah Persekutuan Kuala Lumpur, Malaysia</p>
        </div>

        <div>
            <i class="fa fa-phone"></i>
            <p>+60 3-8996 1000</p>
        </div>

        <div>
            <i class="fa fa-envelope"></i>
            <p><a>livechat@apu.edu.my</a></p>
        </div>
    </div>

    <div class="footer-right">
        <p class="footer-company-about">
            <span>About the EGM</span>
            We aim to help secondary students in Malaysia to achieve education and workplace success.
        </p>

        <div class="footer-icons">
            <a href="https://www.facebook.com/"><i class="fa fa-facebook"></i></a>
            <a href="https://twitter.com/"><i class="fa fa-twitter"></i></a>
            <a href="https://www.linkedin.com/"><i class="fa fa-linkedin"></i></a>
            <a href="https://plus.google.com/"><i class="fa fa-google-plus"></i></a>
        </div>
    </div>
</div>

<footer>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <p>© 2017 - All Rights with EGM</p>
            </div>
            <div class="col-md-6">
                <ul class="pull-right">
                    <li><a href="{{ route('guest.term') }}">Term of Use</a> | </li>
                    <li><a href="{{ route('guest.privacy') }}">Privacy Policy</a></li>
                </ul>
            </div>
        </div>
    </div>
</footer>