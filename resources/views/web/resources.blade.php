@extends('web.master')
@section('page_title',$page->page_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)
@section('web.main')
<!-- -- Banner -- -->
{{-- {{ dd(auth()->user()); }} --}}

<div class="container-flud banner-main">
    <div class="container width-boxed unlimited-res">
        <h1 class="main-heading z95 text-center">{!! $page->getChild('acce-buye-and-selle-reso-heading') !!}</h1>
        @if($user == null)
        <p class="description text-center z95">Looking for unlimited resources? <a href="{{ route('create-account') }}">Click here</a></p>
        @else 
        <p class="description text-center z95">Looking for unlimited resources? <a href="{{ route('web-resources') }}#loginuser">Click here</a></p>
        @endif
        
    </div>
</div>

@if($user != null)
<!-- -- Banner End -- -->
<!-- better-way -->
<div class="container-flud unlimited-res-main" id="loginuser">
    <div class="container width-boxed unlimited-res">
        <div class="row">
            @foreach($resource as $key => $resource_data)
            @if($loop->last)
            <div class="row align-items-center mx-auto">
                <div class="col-md-12 px-0">
                    <div class="toggle-button-cover p-0 text-center w-100 queryFAQ mb-4">
                        <img src="{{ asset($resource_data->file) }}">
                        <div class="seller-card-inside text-center">
                            <div class="card-in-alert">
                                <div class="sub-heading cHeight">{{ $resource_data->name }}</div>
                                <p>{!! $resource_data->short_description ?? '' !!}</p>
                                <a class="btn primery" href="{{ route('web-resources') }}#{{ $resource_data->id }}">Read More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="col-md-6">
                <div class="toggle-button-cover p-0 text-center w-100 queryFAQ mb-4">
                    {{-- <img src="{{ asset('web/img/recourses.jpg') }}"> --}}
                    <img src="{{ asset($resource_data->file) }}">
                    <div class="seller-card-inside text-center">
                        <div class="card-in-alert">
                            <div class="sub-heading">{{ $resource_data->name }}</div>
                            {{-- <p>...and the answers most real estate agents don’t want you to know.</p> --}}
                            <p>{!! $resource_data->short_description ?? '' !!}</p>
                            <a class="btn primery" href="{{ route('web-resources') }}#{{ $resource_data->id }}">Read More</a>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</div>
<!-- better-way End -->
@foreach($resource as $key => $resource_data)
@if($loop->last)
<!-- Defining new standards -->
<div id="{{ $resource_data->id }}" class="container-flud z95 trick-questions">
    <div class="container width-boxed z95">
        <h2 class="second-heading">{{ $resource_data->name }}</h2>
        {!! $resource_data->content ?? '' !!}
    </div>
</div>
<!-- Defining new standards End -->
@else
<!-- Defining new standards -->
<div id="{{ $resource_data->id }}" class="container-flud z95 trick-questions">
    <div class="container width-boxed z95">
        <h2 class="second-heading">{{ $resource_data->name }}</h2>
        {!! $resource_data->content ?? '' !!}
    </div>
</div>
<!-- Defining new standards End -->
<!-- Defining new standards -->
<div class="container-flud z95 ">
    <div class="container heading-fix-width resources">
        <h3 class="">{!! $page->getChild('inco-tran-and-fair-Heading') !!}</h2>
            <p class="z95">{!! $page->getChild('inco-tran-and-fair-text') !!}</p>
    </div>
</div>
<!-- Defining new standards End -->
@endif
@endforeach

@endif
@endsection