<header class="topheader sticky-top">
    <div class="container alignheader">
    <div class="brandlogo"><img src="{{asset('web_old/images/logo.jpg')}}" alt="logo of futura" class="logoImg" onclick="location.href='{{route('web')}}'"></div>
    <nav>
    <div class="logo"></div>
    <input type="checkbox" name="" value="" id="click">
    <label for="click" class="menu-btn">
    <img src="{{asset('web_old/images/headerbars3.png')}}" alt="img of header bars" class="headerbars3">
    <img src="{{asset('web_old/images/headerbars2.png')}}" alt="img of header cross" class="headerbars2">
    </label>
    <ul id="nav">
    @php
        $url = URL::to('/');

    @endphp
    <li><a href="{{route('web')}}" @if(URL::current()==URL::to('/')) class="decor" @endif>HOME</a></li>
    <li><a href="{{route('sell')}}" @if(stripos(URL::current(), 'sell') !== false) class="decor" @endif>SELL</a></li>
    <li><a href="{{route('moreinfo')}}" @if(stripos(URL::current(), 'more-information') !== false) class="decor" @endif>MORE INFORMATION</a></li>
    <li><a href="{{route('buy')}}" @if(stripos(URL::current(), 'buy') !== false) class="decor" @endif>BUY</a></li>
    <li><a href="{{route('contactus')}}" @if(stripos(URL::current(), 'contactus') !== false) class="decor" @endif>CONTACT US</a></li>
    @auth
    <li>
        <a href="{{route('weblogout')}}" @if(stripos(URL::current(), 'login') !== false) class="decor" @endif>LOGOUT</a>
    </li>
    @else
    <li>
        <a href="{{route('weblogin')}}" @if(stripos(URL::current(), 'login') !== false) class="decor" @endif>LOGIN</a>
    </li>
    @endauth

    </ul>
    </nav>
    <button type="button" class="btn btn-tops" data-bs-toggle="modal" data-bs-target="#exampleModal">
    <img src="{{asset('web_old/images/search.png')}}" alt="images of search icon" class="search icon">
    </button>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    <div class="modal-body">
    <div class="row">
    <div class="col-md-9">
    <form action="">
    <input type="search" class="form-control" id="serchinputbox" aria-describedby="emailHelp" placeholder="Search">
    </form>
    </div>
    <div class="col-md-3">
    <button type="search" name="button" class="btn btn-dark" aria-label="go button"><b>GO</b></button>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>

    {{-- ----------- --}}



    </div>
    </header>