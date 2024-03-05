<!-- Footer -->
<div class="container-flud footer-main">
    <div class="container">
        <div class="row align-items-end">
            <div class="col-md-4 footer-left text-left">
                <img src="{{ asset('web/img/equal-housing.png') }}" alt="equal housing">
                <span>CALDRE: 1776125</span>
            </div>
            <div class="col-md-4 footer-center text-center">
                <img src="{{ asset('web/img/footer-logo.svg') }}" alt="logo">
                <ul>
                    <li>
                        <a href="{{ Helper::getBladeSetting('twitter_link') }}"><i class="bi bi-twitter"></i></a>
                    </li>
                    <li>
                        <a href="{{ Helper::getBladeSetting('you_link') }}"><i class="bi bi-youtube"></i></a>
                    </li>
                    <li>
                        <a href="{{ Helper::getBladeSetting('ins_link') }}"><i class="bi bi-instagram"></i></a>
                    </li>
                    <li>
                        <a href="{{ Helper::getBladeSetting('fb_link') }}"><i class="bi bi-facebook"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-md-4 footer-right text-right">
                <ul>
                    <li>
                        <a href="{{ route('privacy-policy') }}">Privacy policy</a>
                    </li>
                    <li>
                        <a href="{{ route('user-agreement') }}">End‐user license agreement</a>
                    </li>
                    <li class="list-card">
                        <a href="tel:{{ Helper::getBladeSetting('contact_number') }}"><i class="bi bi-telephone-fill"></i>{{ Helper::getBladeSetting('contact_number') }}</a>
                    </li>
                    <li class="list-card">
                        <a href="mailto:{{ Helper::getBladeSetting('contact_email') }}"><i class="bi bi-envelope-fill"></i>{{ Helper::getBladeSetting('contact_email') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="container-flud footer-main-end">
    <div class="container">
        <div class="row align-items-end text-center">
            <span class="text-white py-2">@ {{strtoupper(env('APP_NAME'))}} {{date('Y')}}</span>
        </div>
    </div>
</div>
<!-- Footer End -->
