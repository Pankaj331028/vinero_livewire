@extends('web.master')
@section('page_title',$page->page_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)
@section('web.main')
<!-- -- Banner -- -->
<div class="container-flud seller-banner-main banner-main">
    <div class="heading-before">
      <h1 class="main-heading heading-fix-width">{!! $page->getChild('own-commission-heading-h1') !!}
        <div class="link">!
          <div class="arrow">
            <div class="drop">
              Dedicated listing agent Dedicated listing agent
            </div>
          </div>
        </div>
      </h1>
    </div>
    <div class="container">
      <div class="row align-items-center">
        <div class="col-md-12 text-center seller-banner-left">
          <div class="toggle-button-cover">
            <div class="button-type-card">
              Commission*
            </div>
            <div class="seller-card-inside commissionBox">
              <div class="button-type-sellers cFont">
                Sellers:
                <span class="button-type-card cFont" href="#"> {{ Helper::getBladeSetting('commission') }}%</span>
              </div>
              <div class="button-type-buyers cFont">
                Buyers: 
                <span class="button-type-card cFont" href="#">Starting at {{ Helper::getBladeSetting('buyer_commission') }}%</span>
              </div>
              <div class="card-in-alert">
                {!! $page->getChild('own-commission-short-Desc') !!}
              </div>
            </div>
          </div>
          <a class="btn primery starting-button mt-4 px-5" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
      </div>
    </div>
  </div>
  <!-- -- Banner End -- -->


  <!-- better-way -->
  <div id="qonectin-system" class="container-flud better-way-main">
    <div class="heading-before pb-4">
      <h2 class="second-heading heading-fix-width">
        {!! $page->getChild('sell-qonectin-system-heading-h1') !!}
      </h2>
    </div>
    <div class="container width-boxed better-way sellerBetterWay">
      <div class="row align-items-center">
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
              {!! $page->getChild('sell-qonectin-system-control') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
               {!!  $page->getChild('sell-qonectin-system-content-section-1') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
              {!! $page->getChild('sell-qonectin system-setion-2') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('sell-qonectin-system-content-section-2') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
              {!! $page->getChild('sell-qonectin-system-setion-2') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('sell-qonectin-system-content-section-3') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
              {!! $page->getChild('sell-qonectin-system-setion-4') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('sell-qonectin-system-content-section-4') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
              {!! $page->getChild('sell-qonectin-system-setion-5') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
               {!!  $page->getChild('sell-qonectin-system-content-section-5') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="toggle-button-cover p-0 text-center w-100 mb-5">
            <div class="button-type-card">
             {!!  $page->getChild('sell-qonectin-system-setion-6') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('sell-qonectin-system-content-section-6') !!}
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-12 text-center">
          <a class="btn primery starting-button" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
      </div>
    </div>
  </div>
  <!-- better-way End -->


  <!-- Defining new standards -->
  <div id="our-services" class="our-services container-flud defining-standards-main">
    <div class="heading-before pb-4">
      <h2 class="second-heading heading-fix-width" style="max-width: 740px">{!! $page->getChild('sell-our-services-heading-h2') !!}</h2>
    </div>
    <div class="container width-boxed defining-standards">
      {{-- <div class="row brokerageService mb-5">
        <div class="col-lg-4 mb-4 px-4">
          <div class="content">
            <div class="head text-center">
              Product or service
            </div>
            
            <ul class="ps-0 py-3">
              @foreach ($services as $service) 
              <li class="ps-3 py-2">{{ $service->service ?? '' }}</li>
              @endforeach
            </ul>
            
          </div>
        </div>
        <div class="col-lg-4 mb-4 px-4">
          <div class="content">
            <div class="head text-center">
              Qonectin
            </div>
            <ul class="ps-0 py-3">
              @foreach ($services as $service) 
              @if ($service->qonectin == 'no')
                  <li class="cross text-center p-2"><i class="bi bi-x-circle-fill"></i></li>
                @else
                  @if($service->qonectin == 'yes')
                    <li class="right text-center p-2"><i class="bi bi-check-circle-fill"></i></li>
                  @else
                    <li class="cross text-center p-2">{{ $service->qonectin ?? '' }}</li>
                  @endif
                @endif
              @endforeach
            </ul>
          </div>
        </div><div class="col-lg-4 mb-4 px-4">
          <div class="content">
            <div class="head text-center position-relative">
              Traditional realtor
              <div class="position-absolute vsStart">
                <img src="{{ asset('web/img/vs.png') }}" alt="">
              </div>
            </div>
            <ul class="ps-0 py-3">
              @foreach ($services as $service) 
              @if ($service->traditional_realtor == 'no')
                  <li class="cross text-center ps-3 py-2"><i class="bi bi-x-circle-fill"></i></li>
                @else
                  @if($service->traditional_realtor == 'yes')
                    <li class="right text-center ps-3 py-2"><i class="bi bi-check-circle-fill"></i></li>
                  @else
                    <li class="cross text-center ps-3 py-2">{{ $service->traditional_realtor ?? '' }}</li>
                  @endif
                @endif
                @endforeach
            </ul>
          </div>
        </div>
      </div> --}}


      <div class="row justify-content-between list-card-head">
          <div class="toggle-button-cover p-0 text-center">
            <div class="button-type-card">
              Product or service
            </div>
          </div>
          <div class="toggle-button-cover p-0 text-center">
            <div class="button-type-card">
              Qonectin
            </div>
          </div>
          <div class="toggle-button-cover p-0 text-center">
            <div class="button-type-card">
              Traditional realtor
            </div>
        </div>
      </div>

      <div class="">
        @foreach ($services as $service)  
        <div class="row justify-content-between list-card-body childLast">
            <div class="toggle-button-cover p-0 text-center">
              <div class="seller-card-inside">
                <div class="card-in-alert">
                  <ul>
                    <li>{{ $service->service ?? '' }} </li>
                  </ul>
                </div>
              </div>
            </div>

            <div class="toggle-button-cover p-0 text-center rightIcon">
              <div class="seller-card-inside">
                <div class="card-in-alert">
                  @if ($service->qonectin == 'no')
                    <ul>
                      <li class="cross"><i class="bi bi-x-circle-fill"></i></li>
                    </ul>
                  @else
                    @if($service->qonectin == 'yes')
                    <ul>
                      <li class="right"><i class="bi bi-check-circle-fill"></i></li>
                    </ul>
                    @else
                      <ul>
                          <li class="cross">{{ $service->qonectin ?? '' }}</li>
                      </ul>
                    @endif
                  @endif
                </div>
              </div>
            </div>

            <div class="toggle-button-cover p-0 text-center wrongIcon">
              <div class="seller-card-inside">
                <div class="card-in-alert">
                  @if ($service->traditional_realtor == 'no')
                    <ul>
                      <li class="cross"><i class="bi bi-x-circle-fill"></i></li>
                    </ul>
                  @else
                    @if($service->traditional_realtor == 'yes')
                    <ul>
                      <li class="right"><i class="bi bi-check-circle-fill"></i></li>
                    </ul>
                    @else
                      <ul>
                          <li class="cross">{{ $service->traditional_realtor ?? '' }}</li>
                      </ul>
                    @endif
                  @endif
                </div>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    
     
      <div class="col-md-12 text-center my-5">
        <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
      </div>
    </div>
  </div>
  <!-- Defining new standards End -->

    <!-- Selling -->
  <div class="container-flud selling-main selling-page pt-5">
    <div class="container width-boxed">
      <div class="row">
        <div class="col-md-6 selling-left listing">
          <h2 class="second-heading mb-4">{!! $page->getChild('selling-heading-h1') !!}</h2>
          {!! $page->getChild('seller-selling-content') !!}
          <a class="btn primery mt-4 px-5" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
        <div class="col-md-6 selling-right">
          <img src="{{ asset('web/img/sellers_deshboard.png') }}" alt="Sellers Deshboard">
        </div>
      </div>
    </div>
  </div>
  <!-- Selling End -->


  <!-- were-listing -->
  <div id="industry-bulletin" class="container-flud were-listing-main">
    <div class="heading-before text-center pb-2">
      <h2 class="second-heading heading-fix-width mb-0">{!!  $page->getChild('industry-bulletin-heading-h1') !!}</h2>
    </div>
    <p class="description text-center z95 pb-4">{!! $page->getChild('industry-bulletin-short-desc') !!}</p>
    <div class="container width-boxed were-listing">
      <div class="row justify-content-between">
          <div class="toggle-button-cover p-0 text-center mb-5">
            <div class="button-type-card">
              {!! $page->getChild('industry-bulletin-section-1') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('industry-bulletin-content-section-1') !!}
              </div>
            </div>
          </div>
          <div class="toggle-button-cover p-0 text-center mb-5">
            <div class="button-type-card">
              {!! $page->getChild('industry-bulletin-section-2') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
               {!! $page->getChild('industry-bulletin-content-section-2') !!}
              </div>
            </div>
          </div>
          <div class="toggle-button-cover p-0 text-center mb-5">
            <div class="button-type-card">
              {!! $page->getChild('industry-bulletin-section-3') !!}
            </div>
            <div class="seller-card-inside">
              <div class="card-in-alert">
                {!! $page->getChild('industry-bulletin-content-section-3') !!}
              </div>
            </div>
          </div>
      </div>
      <div class="col-md-12 text-center">
        <p class="description pb-4">{!! $page->getChild('industry-bulletin-short-desc-2') !!}</p>
        <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
      </div>
    </div>
  </div>
  <!-- were-listing End -->

  <!-- Our solution -->
  <div class="container-flud our-solution-main">
    <div class="sub-heading text-center z95">{!! $page->getChild('our-solution-title') !!}</div>
    <h2 class="second-heading heading-fix-width mb-0">{!! $page->getChild('our-solution-heading-h1') !!}</h2>
    <p class="description text-center z95 pt-3">{!! $page->getChild('our-solution-short-desc') !!}</p>
    <div class="container width-boxed our-solution">
      <div class="row">
        <div class="col-md-12 heading-fix-width pt-3">
          <p class="text-justify  z95">{!! $page->getChild('our-solution-content') !!}</p>          
        </div>
      </div>
      <div class="col-md-12 text-center">
        <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
      </div>
    </div>
  </div>
  <!-- Our solution End -->

@endsection