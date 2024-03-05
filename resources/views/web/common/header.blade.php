<!-- ======= Header ======= -->
<header id="header" class="fixed-top">
    <div class="container d-flex align-items-center justify-content-between">
        <a href="{{ route('web') }}" class="logo"><img src="{{ asset('web/img/logo-1.png') }}" alt="Qonectin" class="img-fluid"></a>
        <nav id="navbar" class="navbar">
            <button type="" class="menu-btn close"><i class="bi bi-x-lg"></i></button>
            <ul id="nav">
                <!-- <li><a class="nav-link scrollto active" href="#">Sell</a></li> -->
                <li class="dropdown"><a class=" " href="{{ route('web-seller') }}"><span>Sell</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li><a href="{{ route('web-seller') }}">COMMISSION</a></li>
                        <li><a href="{{ route('web-seller') }}#qonectin-system">QONECTIN SYSTEM</a></li>
                        <li><a href="{{ route('web-seller') }}#our-services">OUR SERVICES</a></li>
                        <li><a href="{{ route('web-seller') }}#industry-bulletin">INDUSTRY BULLETIN</a></li>
                    </ul>
                </li>
                <!-- <li><a class="nav-link scrollto" href="#">Buy</a></li> -->
                <li class="dropdown"><a href="{{ route('web-buyer') }}"><span>Buy</span> <i class="bi bi-chevron-down"></i></a>
                    <ul>
                        <li class="dropdown dropdown-inside"><a href="#"><span>PROPERTY SEARCH</span> <i class="bi bi-chevron-right"></i></a>
                            <ul>
                                <li>
                                    <form action="#">
                                        <label>PROPERTY TYPE</label>
                                        <input name="property type" type="text" class="feedback-input" placeholder="" />
                                        <label>CITY</label>
                                        <input name="city" type="text" class="feedback-input" placeholder="" />
                                        <div class="col-md-12">
                                            <div class="row justify-content-between">
                                                <div class="form-input-group">
                                                    <label>MIN PRICE</label>
                                                    <input name="min price" type="text" class="feedback-input" placeholder="" />
                                                </div>
                                                <div class="form-input-group">
                                                    <label>MAX PRICE</label>
                                                    <input name="max price" type="text" class="feedback-input" placeholder="" />
                                                </div>
                                                <div class="form-input-group">
                                                    <label>MIN BEDS</label>
                                                    <input name="min beds" type="text" class="feedback-input" placeholder="" />
                                                </div>
                                                <div class="form-input-group">
                                                    <label>MIN BATHS</label>
                                                    <input name="min baths" type="text" class="feedback-input" placeholder="" />
                                                </div>
                                            </div>
                                        </div>
                                        <button class="btn contact-form-submit" type="submit">SEARCH</button>
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li><a href="{{ route('web-buyer') }}">COMMISSION OPTIONS</a></li>
                        <li><a href="{{ route('web-buyer') }}#our-services">OUR SERVICES</a></li>
                        <li><a href="{{ route('web-buyer') }}#qonectin-system">QONECTIN SYSTEM</a></li>
                        <li><a href="{{ route('web-buyer') }}#industry-bulletin">INDUSTRY BULLETIN</a></li>
                    </ul>
                </li>
                <li><a class="nav-link scrollto" href="{{ route('web-resources') }}">Resources</a></li>
                <li><a class="nav-link scrollto" href="{{ route('web-contact-us') }}">Contact Us</a></li>
                <li class="download-app"><a class="btn primery" href="#contact">Download App</a></li>
                <li class="login"><a class="btn primery" href="{{ route('create-account') }}">Login/Register</a></li>
            </ul>
        </nav><!-- .navbar -->
        
        <div class="right-button">
            <li class="virtual-market arpona-thin">Virtual Market Space</li>
            <div class="virtual-market-out">
                <li class="me-2"><a class="btn primery" href="#contact">Download App</a></li>
                @if(Auth::guard('accounts')->check())
                @if(Auth::check())
                @php
                if (Auth::user()->user_type == 'seller-agent') {
                $link= route('seller-dashboard');
                } elseif (Auth::user()->user_type == 'buyer-agent') {
                $link= route('buyer-dashboard');
                } elseif (Auth::user()->user_type == 'buyer') {
                $link= route('buyer-dashboard');
                } elseif (Auth::user()->user_type == 'seller') {
                $link= route('seller-dashboard');
                } elseif (Auth::user()->user_type == 'agent') {
                $link= route('buyer-dashboard');
                }
                @endphp
                <li><a class="btn primery" href="{{ $link }}">Account</a></li>
                @else
                <li>
                    <div class="profile-pic w-auto">
                        <a class="btn primery" href="javascript:;">Account</a>
                        <div class="white-box profile-setting">
                            <a href="{{ route('weblogin') }}">Login to VMS</a>
                            <a href="{{route('weblogout')}}">Log Out</a>
                        </div>
                    </div>
                </li>
                @endif
                @else
                <li><a class="btn primery" href="{{ route('create-account') }}">Login/Register</a></li>
                @endif
            </div>
        </div>
        <button type="" class="menu-btn open"><i class="bi bi-list"></i></button>
    </div>
</header><!-- End Header -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
function setActive() {
    aObj = document.getElementById('nav').getElementsByTagName('a');
    for (i = 0; i < aObj.length; i++) {
        if (document.location.href.indexOf(aObj[i].href) >= 0) {
            aObj[i].className = 'active';
        }
    }
}

window.onload = setActive;

</script>
