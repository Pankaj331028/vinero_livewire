@extends('web.master')
@section('page_title',$page->page_title)
@section('description',$page->meta_description)
@section('keywords',$page->meta_keywords)
@section('web.main')
<!-- -- Banner -- -->
<div class="container-flud seller-banner-main banner-main buyerMPage">
    <div class="heading-before">
        <h1 class="main-heading heading-fix-width">{!! $page->getChild('buyer-commission-heading-h1') !!}
            <div class="link">!
                <div class="arrow">
                    <div class="drop">
                        {!! $page->getChild('vms-buyers-negotiate-short-description') !!}
                    </div>
                </div>
            </div>
        </h1>
        <p class="description text-center mb-3 z95">VMS buyers negotiate their own commission</p>
    </div>
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-12 text-center seller-banner-left">
                <div class="toggle-button-cover buyer-cover">
                    <span class="buyer-commission-options">{!! $page->getChild('commission-options-content') !!}</span>
                    <div class="toggle-button-buyer-cover">
                        <div class="toggle-button-cover otp-out">
                            <div class="button-type-card">
                                Opt out
                            </div>
                            <div class="seller-card-inside">
                                <div class="card-in-alert pb-4">
                                    {!! $page->getChild('commission-opt-out') !!}
                                </div>
                                <div class="card-in-number pt-4">
                                    0%
                                </div>
                            </div>
                        </div>
                        <div class="toggle-button-cover otp-in">
                            <div class="button-type-card">
                                Opt in
                            </div>
                            <div class="toggle-button-otpin mx-auto row">
                                <div class="seller-card-inside col-lg-7 cBorder">
                                    <div class="card-in-alert w-75 mx-auto mt-0">
                                        {!! $page->getChild('commission-opt-in-content-1') !!}
                                    </div>
                                    <form action="">
                                        <div class="button-type-sellers">
                                            <input class="form-control decimalInput innerShadow" id="userInputID" type="text" name="" placeholder="Enter commission" required>
                                            <span>%</span>
                                            <a href="JavaScript:void(0);" class="button-type-card buyerCommission px-3" type="submit">Go</a>
                                            {{-- <a href="JavaScript:void(0);" class="buyerCommission"><button class="button-type-card "> Go</button></a> --}}
                                        </div>
                                    </form>
                                </div>
                                <div class="seller-card-inside col-lg-5">
                                    <div class="card-in-alert">
                                        {!! $page->getChild("commission-opt-in-content-2") !!}
                                    </div>
                                    <div class="card-in-number">
                                        ?%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">CONTACT US FOR DETAILS</a>
            </div>
        </div>
    </div>
</div>
<!-- -- Banner End -- -->
<!-- Defining new standards -->
<div id="our-services" class="container-flud defining-standards-main buyers virtualMarketingSpace">
    <div class="heading-before">
        <h2 class="second-heading heading-fix-width mb-3 cWidth" style="max-width: 650px;">
            {!! $page->getChild('sell-Our-Services-heading-h1') !!}
            <div class="link">!
                <div class="arrow">
                    <div class="drop">
                        VMS buyers negotiate their own commission
                    </div>
                </div>
            </div>
        </h2>
    </div>
    <div class="container width-boxed defining-standards">
        <p class="description text-center mb-5 z95">{!! $page->getChild('sell-our-services-content') !!}</p>
        <div class="row justify-content-between list-card-head">
            <div class="toggle-button-cover p-0 text-center">
                <div class="button-type-card">
                    Service
                </div>
            </div>
            <div class="toggle-button-cover p-0 text-center">
                <div class="button-type-card gibson-regular">
                    Qonectin
                </div>
            </div>
            <div class="toggle-button-cover p-0 text-center">
                <div class="button-type-card">
                    Traditional brokerage
                </div>
            </div>
        </div>
        <div class="">
            <div class="row justify-content-between list-card-body childLast">
                <div class="toggle-button-cover p-0">
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            
                            @foreach ($buyer_service as $bservic)
                                @if($bservic->status == 'HD')
                                </ul>
                                <ul class="p-3 mb-2">
                                <li>{!! $bservic->service ?? '' !!}</li>
                                @else
                                <li>&nbsp;&nbsp;&nbsp;{{ $bservic->service ?? '' }} </li>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="toggle-button-cover p-0 text-center">
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            @foreach ($buyer_service as $bservic)
                            @if($bservic->status=='HD')
                                </ul><ul class="p-3 mb-2">
                                <li>&nbsp;</li>
                            @else
                                @switch($bservic->qonectin)
                                    @case('no')
                                        <li class="cross"><i class="bi bi-x-circle-fill"></i></li>
                                        @break
                                    @case('yes')
                                        <li class="right"><i class="bi bi-check-circle-fill"></i></li>
                                        @break
                                    @default
                                        <li>{{ $bservic->qonectin ?? '' }}</li>
                                        @break
                                @endswitch
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="toggle-button-cover p-0 text-center">
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            @foreach ($buyer_service as $bservic)
                            @if($bservic->status=='HD')
                                </ul><ul class="p-3 mb-2">
                                <li>&nbsp;</li>
                            @else
                                @switch($bservic->traditional_realtor)
                                    @case('no')
                                        <li class="cross"><i class="bi bi-x-circle-fill"></i></li>
                                        @break
                                    @case('yes')
                                        <li class="right"><i class="bi bi-check-circle-fill"></i></li>
                                        @break
                                    @default
                                        <li>{{ $bservic->traditional_realtor ?? '' }}</li>
                                        @break
                                @endswitch
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {{-- <div class="row justify-content-between list-card-body end">
            <div class="toggle-button-cover p-0">
                <div class="seller-card-inside">
                    <div class="card-in-alert">
                        <ul>
                            <li>Low commission fees </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="toggle-button-cover p-0 text-center">
                <div class="seller-card-inside">
                    <div class="card-in-alert">
                        <ul>
                            <li class="right"><i class="bi bi-check-circle-fill"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="toggle-button-cover p-0 text-center">
                <div class="seller-card-inside">
                    <div class="card-in-alert">
                        <ul>
                            <li class="cross"><i class="bi bi-x-circle-fill"></i></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="col-md-12 text-center mt-5">
            <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
    </div>
</div>
<!-- Defining new standards End -->
<!-- better-way -->
<div id="qonectin-system" class="container-flud better-way-main">
    <div class="heading-before">
        <h2 class="second-heading heading-fix-width">{!! $page->getChild('sell-qonectin-system-handing-h1') !!}</h2>
    </div>
    <div class="container width-boxed better-way">
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="toggle-button-cover p-0 text-center w-100 mb-4">
                    <div class="button-type-card">
                        {!! $page->getChild('sell-qonectin-system-section-1') !!}
                    </div>
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            {!! $page->getChild('sell-qonectin-system-content-section-1') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="toggle-button-cover p-0 text-center w-100 mb-4">
                    <div class="button-type-card">
                        {!! $page->getChild('sell-qonectin-system-section-2') !!}
                    </div>
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            {!! $page->getChild('sell-qonectin-system-content-section-2') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="toggle-button-cover p-0 text-center w-100 mb-4">
                    <div class="button-type-card">
                        {!! $page->getChild('sell-qonectin-system-section-3') !!}
                    </div>
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            {!! $page->getChild('sell-qonectin-system-content-section-3') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="toggle-button-cover p-0 text-center w-100 mb-4">
                    <div class="button-type-card">
                        {!! $page->getChild('sell-qonectin-system-section-4') !!}
                    </div>
                    <div class="seller-card-inside">
                        <div class="card-in-alert">
                            {!! $page->getChild('sell-qonectin-system-content-section-4') !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12 text-center">
                <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
            </div>
        </div>
    </div>
</div>
<!-- better-way End -->
<!-- Selling -->
<div class="container-flud selling-main selling-page buyers">
    <div class="container width-boxed">
        <div class="row">
            <div class="col-md-6 selling-right">
                <img src="{{ asset('web/img/sellers_deshboard.png') }}" alt="Sellers Deshboard">
            </div>
            <div class="col-md-6 selling-left listing">
                <h2 class="second-heading">{!! $page->getChild('sell-qonectin-system-heading-2') !!}</h2>
                {!! $page->getChild('qonectin-system-content-edtior') !!}
                <a class="btn primery mt-4 px-5" href="{{ route('buyer-dashboard') }}">Get Started</a>
            </div>
        </div>
    </div>
</div>
<!-- Selling End -->
<!-- were-listing -->
<div id="industry-bulletin" class="container-flud were-listing-main in-buyer">
    <div class="heading-before text-center">
        <h2 class="second-heading heading-fix-width mb-0">{!! $page->getChild('Sell-Indu-Bull-Head-h1') !!}</h2>
    </div>
    <p class="description text-center z95 py-3">{!! $page->getChild('Indu-bull-short-desc') !!}</p>
    <div class="container width-boxed were-listing pt-4">
        <div class="row justify-content-between">
            <div class="toggle-button-cover p-0 mb-5">
                <div class="button-type-card text-center">
                    {!! $page->getChild('sell-indu-bull-sect-1') !!}
                </div>
                <div class="seller-card-inside">
                    <div class="card-in-alert">
                        {!! $page->getChild('sell-industary-bulletin-content-section-1') !!}
                    </div>
                </div>
            </div>
            <div class="toggle-button-cover p-0 mb-5 listing">
                <div class="button-type-card text-center">
                    {!! $page->getChild('sell-industary-bulletin-section-2') !!}
                </div>
                <div class="seller-card-inside">
                    <div class="card-in-alert">
                        {!! $page->getChild('sell-industary-bulletin-short-desc-section-2') !!}
                        {!! $page->getchild('sell-industary-bulletin-content-section-2') !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <p class="description">{!! $page->getChild('sell-indus-bull-short-desc-2-sect-2') !!}</p>
            <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
    </div>
</div>
<!-- were-listing End -->
<!-- Our solution -->
<div class="container-flud our-solution-main">
    <div class="sub-heading text-center z95">{!! $page->getChild('our-solution-title') !!}</div>
    <h2 class="second-heading heading-fix-width mb-0">{!! $page->getChild('our-solution-heading-h1') !!}</h2>
    <p class="description text-center z95">{!! $page->getChild('our-solution-short-desc') !!}</p>
    <div class="container width-boxed our-solution">
        <div class="row">
            <div class="col-md-12 heading-fix-width py-5 mb-0">
                <p class="text-justify z95">{!! $page->getChild('our-solution-long-desc') !!}</p>
            </div>
        </div>
        <div class="col-md-12 text-center">
            <a class="btn primery starting-button px-5" href="{{ route('web-contact-us') }}">Get Started</a>
        </div>
    </div>
</div>
<!-- Our solution End -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $(".buyerCommission").click(function() {
        var buyer = $("#userInputID").val();

        const date = new Date();
        date.setTime(date.getTime() + (360 * 24 * 60 * 60 * 1000));
        let expires = "expires=" + date.toUTCString();
        document.cookie = "BuyerCommission=" + buyer + ";" + expires + ";path=/";

        if (buyer != '') {
            window.location.href = "{{ route('web-contact-us')}}";
        }

    });
});

</script>
@endsection
