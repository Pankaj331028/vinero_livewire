@extends('web.master')
@section('page_title',$page->page_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)
@section('web.main')
<div class="container-flud contact-banner banner-main">
  <div class="container">
    <x-web-alert wire:ignore.self>
    </x-web-alert>
    
    <div class="row">
      <div class="col-md-6">
        <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            
          <div class="button-type-card">
            {!! $page->getChild('contact-us-tilte-heading-h1') !!}
          </div>    
                
          @livewire('web.contact-us')
        </div>
      </div>
      <div class="col-md-6 z95 contact-desc">
        <p class="description text-center">{!! $page->getChild('contact-us-our-founder') !!}</p>
        <p>{!! $page->getChild('contact-us-long-description') !!}</p>

        <p> {!! $page->getChild('contact-us-short-description') !!}</p>
        <img src="{{ asset('web/img/Jorel.png')}}" alt="Jorel" class="text-center">
      </div>
    </div>
  </div>
</div>

@endsection