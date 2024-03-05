<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>{{env('APP_NAME')}} - @yield('page_title')</title>
    <meta name="description" content="@yield('description')" />
    <meta name="keywords" content="@yield('keywords')" />
    <!-- Favicons -->
    <link href="{{asset('images/favicon.png')}}" rel="icon">
    <link href="{{asset('images/apple-touch-icon.png')}}" rel="apple-touch-icon">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Dosis:300,400,500,,600,700,700i|Lato:300,300i,400,400i,700,700i" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
    <link href="{{ asset('vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{asset('web/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('web/css/responsive.css')}}" rel="stylesheet">
    <link href="{{asset('css/website.css')}}" rel="stylesheet">
    @livewireStyles
</head>

<body>
    @include('web.common.header')
    @yield('web.main')
    @if(Auth::check())
    <input type="hidden" name="" id="control_monitor" value="{{Auth::user()->optin_out}}">
    @endif
    @include('web.common.footer')
    <!-- Vendor JS Files -->

    <script src="{{ asset('vendor/purecounter/purecounter_vanilla.js') }}"></script>
    <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('vendor/php-email-form/validate.js') }}"></script>
    <!-- Template Main JS File -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    {{-- <script src="{{asset('web/js/inputmask.min.js')}}" type="text/javascript"></script> --}}
    <script src="{{asset('js/jquery-mask-as-number.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('js/jquery.masknumber.min.js')}}" type="text/javascript"></script> --}}
    <script src="{{asset('web/js/jquery.inputmask.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web/js/bindings/inputmask.binding.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/alert.js')}}" type="text/javascript"></script>
    <script src="{{asset('web/js/main.js')}}" type="text/javascript"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
    @include('web.common.notification')
    @livewireScripts
    <script type="text/javascript">
    $(document).ready(function() {
        $(".navbar-collapse").click(function(e) {
            e.stopPropagation();
            if ($(this).hasClass("show")) {
                $(this).removeClass("show");
            } else {
                $(".navbar-collapse").removeClass("show");
                $(this).addClass("show");
            }
        });
        $(document).on('click', function(e) {
            e.stopPropagation();
            $('.navbar-collapse').removeClass("show");
        });
    });

    </script>
    <script>
    $(document).ready(function() {
        $(".menu-btn").click(function() {
            $(".navbar").toggleClass("mobile");
        });
    });

    </script>
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

    var url = window.location.href.replace('#_=_', '');
    window.history.pushState('', '', url);

    @if(Auth::check())
    startFCM();
    @endif

    </script>
</body>

</html>
