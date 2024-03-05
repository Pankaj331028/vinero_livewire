@extends('web.master')
@section('page_title','Sign In')
@section('web.main')
<div class="container-flud create-account banner-main">
   
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4 z95">
                {{-- <h2 class="second-heading">Sign in</h2>
                <p class="contact-alert">Don't have an account? <a href="{{ route('create-account') }}"> Register</a></p>
                <div class="account-button">
                    <a href="{{ route('auth.google') }}"><button class="btn google"><i class="bi bi-google"></i>Sign in with Google</button></a>
                    <a href="{{ route('auth.facebook') }}"><button class="btn facebook"><i class="bi bi-facebook"></i>Sign in with Facebook</button></a>
                    <a href="{{ route('auth.apple') }}"><button class="btn apple"><i class="bi bi-apple"></i>Sign in with Apple</button></a>
                </div>
                <img src="{{ asset('web/img/contact-details-bottom.png') }}"> --}}
                @livewire('web.login')
            </div>
        </div>
    </div>
</div>
@endsection
