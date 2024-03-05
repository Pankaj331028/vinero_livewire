<!DOCTYPE html>
<html lang="en">
    <!-- begin::Head -->
    <head>
        <!--begin::Base Path (base relative path for assets of this page) -->
        <base href="{{URL::to('/')}}"/>
        <!--end::Base Path -->
        <meta charset="utf-8"/>
        <title>
            @yield('title') | {{env('APP_NAME')}}
        </title>
        <meta content="Updates and statistics" name="description"/>
        <meta content="width=device-width, initial-scale=1, shrink-to-fit=no" name="viewport"/>
        <!--begin::Fonts -->
        <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.6.16/webfont.js">
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
        <!--end::Global Theme Styles -->
        <!--begin::Page Custom Styles(used by this page) -->
        <link href="{{asset('css/pages/login.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Page Custom Styles -->
        <!--begin:: Global Mandatory Vendors -->
        <link href="{{asset('vendors/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet" type="text/css"/>
        <!--end:: Global Mandatory Vendors -->
        <!--begin::Layout Skins(used by all pages) -->
        <link href="{{asset('css/skins/header/base/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/header/menu/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/brand/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('css/skins/aside/light.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/animate.css/animate.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/flaticon/flaticon.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('vendors/line-awesome/css/line-awesome.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Layout Skins -->
        <link href="{{asset('images/favicon.ico')}}" rel="shortcut icon"/>
        @livewireStyles
    </head>
    <body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--fixed kt-subheader--enabled kt-subheader--solid kt-aside--enabled kt-aside--fixed kt-page--loading">
        @yield('content')
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
        <!-- end::Global Config -->
        <!--begin:: Global Mandatory Vendors -->
        <script src="{{asset('vendors/jquery/dist/jquery.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/popper.js/dist/umd/popper.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/bootstrap/dist/js/bootstrap.min.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/js-cookie/src/js.cookie.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/moment/min/moment.min.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/tooltip.js/dist/umd/tooltip.min.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/perfect-scrollbar/dist/perfect-scrollbar.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/sticky-js/dist/sticky.min.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('vendors/wnumb/wNumb.js')}}" type="text/javascript">
        </script>
        <script src="{{asset('js/alert.js')}}" type="text/javascript">
        </script>
        <!--end:: Global Mandatory Vendors -->
        <!--begin::Global Theme Bundle(used by all pages) -->
        <script src="{{asset('js/scripts.bundle.js')}}" type="text/javascript">
        </script>
        @livewireScripts
        <!--end::Global Theme Bundle -->
    </body>
</html>