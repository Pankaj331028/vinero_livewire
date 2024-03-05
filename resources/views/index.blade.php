<!DOCTYPE html>
<html lang="en">
    <!-- begin::Head -->
    <head>
        <!--begin::Base Path (base relative path for assets of this page) -->
        <base href="{{URL::to('/')}}"/>
        <!--end::Base Path -->
        <meta charset="utf-8"/>
        <title>
            Home | {{env('APP_NAME')}}
        </title>
        <meta content="Updates and statistics" name="description"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js">
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        </script>
        <script>
            WebFont.load({
                google: {
                    "families": ["Poppins:300,400,500,600,700", "Roboto:300,400,500,600,700"]
                },
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
        <!--begin::Global Theme Styles(used by all pages) -->
        <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles -->
        <!--begin::Layout Skins(used by all pages) -->
        <link href="{{asset('css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/brand/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/aside/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/animate.css/animate.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Layout Skins -->
        <link href="{{asset('images/favicon.png')}}" rel="shortcut icon"/>
        @livewireStyles
    </head>
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        <div class="kt-grid kt-grid--ver kt-grid--root">
            <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v1" id="kt_login">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
                    <!--begin::Aside-->
                    <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{asset('images/misc/bg-2.jpg')}});width:100%">
                        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--hor">
                            <div class="kt-grid__item kt-grid__item--middle m-auto">
                                <a class="kt-login__logo" href="javscript:;">
                                    <img src="{{asset('images/logo.png')}}">
                                    </img>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end::Scrolltop -->
        <!-- begin::Global Config(global config for global JS sciprts) -->
        <script>
            var KTAppOptions = {
                "colors": {
                    "state": {
                        "brand": "#5d78ff",
                        "dark": "#282a3c",
                        "light": "#ffffff",
                        "primary": "#5867dd",
                        "success": "#34bfa3",
                        "info": "#36a3f7",
                        "warning": "#ffb822",
                        "danger": "#fd3995"
                    },
                    "base": {
                        "label": ["#c5cbe3", "#a1a8c3", "#3d4465", "#3e4466"],
                        "shape": ["#f0f3ff", "#d9dffa", "#afb4d4", "#646c9a"]
                    }
                }
            };
        </script>
    </body>
</html>