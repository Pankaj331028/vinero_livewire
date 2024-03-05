<html lang="en">
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale= 1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="shortcut icon" type="image/jpg" href="{{asset('web_old/images/favicon.png')}}" />
    <link href="{{asset('css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('web_old/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('css/custom.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('css/website.css')}}" rel="stylesheet" type="text/css"/>
    <link href="{{asset('web_old/css/all.min.css')}}" rel="stylesheet" >
    <link href="{{asset('web_old/css/owl.carousel.min.css')}}" rel="stylesheet" >
    <link href="{{asset('web_old/css/style.css')}}" rel="stylesheet" >
    <link href="{{asset('web_old/css/responsive.css')}}" rel="stylesheet" >
    <style>
        .modal-header.web {
    background-color: #131415;
    color: #d1b820;
        }
        button.btn.btn-primary.web-button{
    color: black;
    background: #cdb51f;
    border-color: #cdb51f;
        }
    </style>
    <style>
        .bs-example{
            margin: 100px 60px;
        }

    </style>

    @livewireStyles
    <title>FUTURA - Real Estate Redefined</title>
    </head>
    <body>
    @include('web.common.header_old')
    @yield('web.main')
    @include('web.common.footer_old')
    <script src="{{asset('js/jquery-mask-as-number.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/jquery.masknumber.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('js/alert.js')}}" type="text/javascript"></script>
    <script src="{{asset('web_old/js/all.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web_old/js/bootstrap.bundle.min.js')}}" type="text/javascript"></script>

    {{-- <script src="{{asset('web_old/js/bootstrap.min.js')}}" type="text/javascript"></script> --}}
    <script src="{{asset('web_old/js/jquery-3.6.0.slim.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web_old/js/owl.carousel.min.js')}}" type="text/javascript"></script>
    {{-- <script src="{{asset('web_old/js/popper.min.js')}}" type="text/javascript"></script> --}}
    <script type="text/javascript" src="{{asset('web_old/js/jquery-1.12.0.min.js')}}"></script>
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    @livewireScripts
        {{-- --comma in price/amount input field-- --}}

        <script>
            $(function () {


            $('#phonecall').keydown(function (e) {
            var key = e.charCode || e.keyCode || 0;
            $text = $(this);
            if (key !== 8 && key !== 9) {
                if ($text.val().length === 3) {
                    $text.val($text.val() + '-');
                }
                if ($text.val().length === 7) {
                    $text.val($text.val() + '-');
                }

            }

            return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
            })
            });
        </script>
    <script>
        $(document).ready(function(){
            $('[data-bs-toggle="tooltip"]').tooltip();
        });
        </script>
    <script>
    (function () {
            var qs, j, q, s, d = document, gi = d.getElementById, ce = d.createElement, gt = d.getElementsByTagName, id = "calconic_", b = "https://cdn.calconic.com/static/js/";
            if (!gi.call(d, id)) {
                j = ce.call(d, "script");
                j.id = id;
                j.type = "text/javascript";
                j.async = true;
                j.dataset.calconic = true;
                j.src = b + "calconic.min.js";
                q = gt.call(d, "script")[0];
                q.parentNode.insertBefore(j, q)
            }
        })();
        </script>
    <script>
        // Header Sticky
        var HeaderSticky = function () {
            'use strict';
            // Handle Header Sticky
            var handleHeaderSticky = function () {
                // On loading, check to see if more than 15px, then add the class
                if ($('.topheader').offset().top > 80) {
                    $('.topheader').addClass('shrink');
                }
                // On scrolling, check to see if more than 15px, then add the class
                $(window).on('scroll', function () {
                    if ($('.topheader').offset().top > 80) {
                        $('.topheader').addClass('shrink');
                    } else {
                        $('.topheader').removeClass('shrink');
                    }
                });
            }
            return {
                init: function () {
                    handleHeaderSticky(); // initial setup for header sticky
                }
            }
        }();
        HeaderSticky.init();
        </script>
        <script>
        function setActive() {

            aObj = document.getElementById('nav').getElementsByTagName('a');
            for(i=0;i<aObj.length;i++) {

                if(aObj[i].href.substr(0, aObj[i].href.length - 1)=="{{URL::to('/')}}"){
                    if(aObj[i].href == document.location.href)
                        aObj[i].className='active';
                }
                else if(document.location.href.indexOf(aObj[i].href)>=0) {
                    aObj[i].className='active';
                }
            }
        }
        window.onload = setActive;
        </script>
        <script>
            $(document).ready(function(){
        $(".menu-btn").click(function(){
            $(".menu-btn").toggleClass("addclass");
        });
        });
    </script>
    </body>
    </html>
