@extends('web.master-no-header')
@section('page_title','Dashboard')
@section('web.main')
<div class="container-flud card-full-cover">
    <div class="buyerDashboard">
        {{-- <div class="row dashboard-header align-items-center">
            <div class="col-md-6 dashboard-head-left">
                <img class="dashboard-logo" src="{{ asset('web/img/vms.png') }}" alt="VMS">
                <h4>MY DASHBOARD</h4>
            </div>
            <div class="col-md-6 dashboard-head-right text-end">
                <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile">
            </div>
        </div> --}}
        <div class="row dashboard-header align-items-center">
            <div class="col-md-6 dashboard-head-left">
                <img class="dashboard-logo" src="{{ asset('web/img/vms.png') }}" alt="VMS">
                <h4>MY DASHBOARD</h4>
            </div>
            <div class="col-md-6 dashboard-head-right text-end">
                <div class="profile-pic">
                    <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile">
                    <div class="white-box profile-setting">
                        <a href="{{ route('buyer-dashboard') }}">Account</a>
                        <a href="{{ route('control-monitor') }}">Control Monitor</a>
                        <a href="{{ route('weblogout') }}">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row property-address">
            <div class="card-box text-center property-address-icon">
                <h5>{{ $property->property_address }}</h5>
                <i class="bi bi-geo-alt-fill"></i>
            </div>
        </div>
        <div class="row card-box">
            <x-web-alert wire:ignore.self>
            </x-web-alert>
            <div class="col-md-6 text-center">
                {{-- <div class="card-box history">
                    <h4>SMART PRICING STRATEGY</h4>
                    <div class="read-more-doats-main">
                        <textarea></textarea>
                        <a class="read-more-doats" href="#">...</a>
                    </div>
                    <a class="btn primery" href="#">View</a>
                </div> --}}
                <div class="row justify-content-between m-0">
                    <div class="card-box history">
                        <h4>MY OFFER</h4>
                        <div class="row mx-auto">
                            <div class="equil-to-section history">
                                @if($dashboard->offered_price != null)
                                <div class="white-box history">
                                    <div class="read-more-doats-main">
                                        <span class="px-2">Current Offer Price</span>
                                        <div class="view-more-offer">
                                            <a class="read-more-doats">...</a>
                                            <ul>
                                                <li><a class="text" href="{{ route('my-offer') }}">View More</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <a class="button-grey" href="javascript:void(0)">{{ Helper::getBladeSetting('currency').number_format($dashboard->offered_price) }}</a>
                                </div>
                                @endif
                                @if ($offer->status == 'IN')
                                <a class="btn primery w-100" href="{{ route('offer') }}">Complete Offer</a>
                                @else
                                <a class="btn primery w-100" href="{{ route('bid-modification') }}">Modify Offer</a>
                                @endif
                            </div>
                            <?php
$dateFromate = date_create($property->vms_end_date);
$property_end_date = date_format($dateFromate, "M d,Y");
?>
                            <div class="equil-to-section card-box bg-white white-box history offerdeadline">
                                <div class="offer-deadline-main">
                                    <div class="read-more-doats-main w-100">
                                        <span class="countdowns px-2">Offer deadline</span>
                                        <span class="addcountdown px-2">Countdown</span>
                                        {{-- <h4 class="countdowns ">OFFER DEADLINE</h4>
                                        <h4 class="addcountdown">COUNTDOWN</h4> --}}
                                        <a class="read-more-doats countdown" href="javascript:void(0)">...</a>
                                    </div>
                                    <a class="button-grey offer-deadline propertdate propertyEndDate" href="javascript:void(0)"> <span class="property">{{ $property_end_date }}</span></a>
                                    <a class="button-grey offer-deadline timecount  propertyEndDate " href="javascript:void(0)" ><span id="demo"  class="property text-danger"></span> </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <div class="equil-to-section card-box history">
                    <h4>MY OFFER</h4>
                    @if($dashboard->offered_price != null)
                    <div class="white-box history">
                    <div class="read-more-doats-main">
                    <span>Current Offer Price</span>
                    <div class="view-more-offer">
                    <a class="read-more-doats">...</a>
                    <ul>
                    <li><a class="text" href="{{ route('my-offer') }}">View More</a></li>
                    </ul>
                    </div>
                    </div>
                    <a class="button-grey" href="#">{{ '$ '.$dashboard->offered_price }}</a>
                    </div>
                    @endif
                    @if ($offer->status == 'IN')
                    <a class="btn primery" href="{{ route('offer') }}">Complete Offer</a>
                    @else
                    <a class="btn primery w-100" href="{{ route('bid-modification') }}">Modify Offer</a>
                    @endif
                    </div>
                    <?php
$dateFromate = date_create($property->vms_end_date);
$property_end_date = date_format($dateFromate, "M d,Y");
?>
                    <div class="equil-to-section card-box history">
                    <div class="offer-deadline-main">
                    <div class="read-more-doats-main w-100">
                    <h4 class="countdowns ">OFFER DEADLINE</h4>
                    <h4 class="addcountdown">COUNTDOWN</h4>
                    <a class="read-more-doats countdown" href="#">...</a>
                    </div>
                    <a class="button-grey offer-deadline propertdate" href="#">{{ $property_end_date }}</a>
                    <a class="button-grey offer-deadline timecount text-danger" href="#" id="demo"> </a>
                    </div>
                    </div> --}}

                </div>
            </div>
            <div class="col-md-6">
                <div class="card-box history text-start">
                    <h4 class="text-start ps-4">HISTORY</h4>
                    <div class="scroll-box">
                        @if($survey)
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ $survey->created_at->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Survey</h6>
                                        <a class="read-more-doats" href="{{ route('buyer-survey') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerOfferAcceptance'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerOfferAcceptance')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Congratulations!</h6>
                                        <a class="read-more-doats" href="{{ route('congratulations') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($dashboard->dashboard_dates->withdrawan_on != "")
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{date('M d,Y h:i A', strtotime($dashboard->dashboard_dates->withdrawan_on ?? ''->Fecha))}}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer Cancellation</h6>
                                        <a class="read-more-doats" href="{{ route('buyer-offer-cancellation') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($counter_to_counter)
                        <div class="white-box history">
                            <div class="row align-items-center">

                                <div class="col-md-4">

                                    <h5> {{ $counter_to_counter->created_at->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>My Counter to Seller’s Counter Offer</h6>
                                        <a class="read-more-doats" href="{{ route('counter-to-counter') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($dashboard->dashboard_dates->counter_on != "")
                        <div class="white-box history mb-2">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>
                                        {{ date('M d,Y h:i A', strtotime($dashboard->dashboard_dates->counter_on ?? ''->Fecha)) }}
                                    </h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Seller Counter Offer</h6>
                                        <a class="read-more-doats" href="{{ route('buyer-view-sellers-counter') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerOfferInterest'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerOfferInterest')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer of Interest</h6>
                                        <a class="read-more-doats" href="{{ route('offer-of-interest') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerOfferAcceptance'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerOfferAcceptance')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer Deadline Extended</h6>
                                        <a class="read-more-doats" href="{{ route('offer-deadline-extension') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerHigherOffer'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerHigherOffer')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Higher Offer Received</h6>
                                        <a class="read-more-doats" href="{{ route('higher-offer-received') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer','proof_funds'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer','proof_funds')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer not Approved</h6>
                                        <a class="read-more-doats" href="{{ route('offer-not-accepted') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer','fc'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer','fc')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Limit Exceeded</h6>
                                        <a class="read-more-doats" href="{{ route('update-credentials') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($dashboard->dashboard_dates->offer_accepted != "")
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{date('M d,Y h:i A', strtotime($dashboard->dashboard_dates->offer_accepted ?? ''->Fecha))}}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer emailed to seller and agent </h6>
                                        <a class="read-more-doats" href="{{ route('my-offer') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if(Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer'))
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{ Helper::notifications_type('App\Notifications\InformBuyerIncompleteOffer')->format('M d,Y h:i A') }}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Incomplete Offer</h6>
                                        <a class="read-more-doats" href="{{ route('buyer-incomplete-offer') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        @if($dashboard->submitted_on != "")
                        <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-4">
                                    <h5>{{date('M d,Y h:i A', strtotime($dashboard->submitted_on ?? ''->Fecha))}}</h5>
                                </div>
                                <div class="col-md-8 text-end">
                                    <div class="button-grey">
                                        <h6>Offer uploaded</h6>
                                        <a class="read-more-doats" href="{{ route('my-offer') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        {{-- <div class="white-box history">
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h5>Date, Time</h5>
                                </div>
                                <div class="col-md-7">
                                    <div class="button-grey">
                                        <h6>Agent Mode</h6>
                                        <a class="read-more-doats" href="{{ route('control-monitor') }}">...</a>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
        <div class="row agent-mode-out justify-content-between align-items-center">
            <div class="agent-mode-help ms-auto">
                <a class="button-grey" href="#">Help</a>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
$(document).ready(function() {

    $(".addcountdown").hide();
    $(".timecount").hide();
    $(".countdown").click(function() {
        if ($(".countdowns").is(":visible")) {
            $(".addcountdown").show();
            $(".timecount").show();
            $(".countdowns").hide();
            $(".propertdate").hide();

        } else {
            $(".addcountdown").hide();
            $(".timecount").hide();
            $(".countdowns").show();
            $(".propertdate").show();
        }
    });
});

</script>
<script>
$(document).ready(function() {
    $(".read-more-doats").click(function() {
        $(this).closest(".view-more-offer").toggleClass("active");
        // $(".view-more-offer").toggleClass("active");
    });
});

</script>
<script>
data_time = '{{ $property->vms_end_date }}';

var countDownDate = new Date(data_time).getTime();

var x = setInterval(function() {
    var now = new Date().getTime();
    var distance = countDownDate - now;

    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

    document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
        minutes + "m " + seconds + "s ";

}, 1000);

</script>
@endsection
