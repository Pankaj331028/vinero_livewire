@extends('web.master')
@section('page_title','User Agreement')
@section('web.main')
<div class="container-flud create-account banner-main">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 z95">
                <div class="loginPanel">
                    <h2 class="second-heading">{{$page->title}}</h2>
                    <div style="max-height: 470px;overflow-y: auto;margin: 50px 0">{!! $page->content !!}</div>
                    <a class="btn contact-form-submit" href="{{$url}}">I Agree</a>
                    <a class="btn-red btn ml-3" href="{{route('weblogout')}}">Don't Agree</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
