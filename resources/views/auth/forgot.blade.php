@extends('layouts.app_noauth')
@section('title','Forgot Password')
@section('content')
<div class="kt-grid kt-grid--ver kt-grid--root">
    <div class="kt-grid kt-grid--hor kt-grid--root kt-login kt-login--v1" id="kt_login">
        <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--desktop kt-grid--ver-desktop kt-grid--hor-tablet-and-mobile">
            <!--begin::Aside-->
            <div class="kt-grid__item kt-grid__item--order-tablet-and-mobile-2 kt-grid kt-grid--hor kt-login__aside" style="background-image: url({{asset('images/misc/bg-5.jpg')}});">
                <div class="kt-grid__item kt-grid__item--fluid kt-grid kt-grid--ver kt-grid--hor justify-content-center">
                    <div class="kt-grid__item kt-grid__item--middle">
                        <a class="kt-login__logo" href="javscript:;">
                            <img src="{{asset('images/logo.png')}}">
                            </img>
                        </a>
                    </div>
                </div>
            </div>
            <!--begin::Aside-->
            <!--begin::Content-->
            <div class="kt-grid__item kt-grid__item--fluid kt-grid__item--order-tablet-and-mobile-1 kt-login__wrapper">
                <!--begin::Body-->
                <div class="kt-login__body">
                    <!--begin::Signin-->
                    <div class="kt-login__form">
                        <div class="kt-login__title">
                            <h3>
                                Forgot Password?
                            </h3>
                        </div>
                        @livewire('admin.auth', ['type'=>'forgot'])
                    </div>
                    <!--end::Signin-->
                </div>
                <!--end::Body-->
            </div>
            <!--end::Content-->
        </div>
    </div>
</div>
@endsection
