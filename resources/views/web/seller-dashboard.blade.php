@extends('web.master-no-header')
@section('page_title','Dashboard')
@section('web.main')
<div class="container-flud card-full-cover seller-dashboard">
    <div class="">
        <div class="row dashboard-header align-items-center">
            <div class="col-md-6 dashboard-head-left">
                <img class="dashboard-logo" src="{{asset('web/img/vms.png')}}" alt="VMS">
                <h4>MY DASHBOARD</h4>
            </div>
            <div class="col-md-6 dashboard-head-right text-end">
                <div class="profile-pic">
                    <img src="{{asset('web/img/buyer-profile.png')}}" alt="seller profile">
                    <div class="white-box profile-setting">
                        <a href="{{route('seller-dashboard')}}">Account</a>
                        <a href="{{route('control-monitor')}}">Control & Monitor</a>
                        <a href="{{route('weblogout')}}">Log Out</a>
                    </div>
                </div>
            </div>
            <div class="row property-address buyerLocation">
                <div class="card-box text-center property-address-icon">
                    <h5>{{Auth::user()->property->property_address}}</h5>
                    <i class="bi bi-geo-alt-fill"></i>
                </div>
            </div>
            <div class="row card-box mx-auto buyerOffer sellerDashboard">
                <x-web-alert></x-web-alert>
                <div class="col-lg-6 col-md-8 mx-auto seller-dashboard-left">
                    <div class="card-box history">
                        <div class="read-more-doats-main text-center py-2">
                            <h4 class="text-center">BUYER OFFERS</h4>
                            <div class="view-more-offer">
                                <a class="read-more-doats pt-1">...</a>
                                @if($data->status!=404)
                                <ul>
                                    <li><a class="text" href="{{ route('offers') }}">View All</a></li>
                                </ul>
                                @endif
                            </div>
                        </div>
                        <div class="scroll-box">
                            <div class="row justify-content-between m-0">
                                @if($data->status==200)
                                @forelse($data->data as $offer)
                                <div class="equil-to-section card-box history text-center">
                                    <span class="font14">{{date('M d, Y h:i A',strtotime($offer->start_date))}}</span>
                                    <a class="button-grey mt-2" href="javascript:;"><img src="{{asset('web/img/buyer-offers-icons.png')}}">{{number_format($offer->amount)}}</a>
                                    <div class="read-more-doats-main position-relative pt-2">
                                        <span class="gibson-regular">{{ucfirst($offer->buyer_name)}}</span>
                                        <div class="view-more-offer pt-2">
                                            <a class="read-more-doats pt-3" href="javascript:;">...</a>
                                            <ul>
                                                <li><a class="text" href="{{ route('offer-detail',['id'=>$offer->id]) }}">View More</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <a class="button-grey text-danger mt-3 w-100" href="javascript:;">No Offers Received</a>
                                @endforelse
                                @else
                                <a class="button-grey text-danger mt-3 w-100" href="javascript:;">No Offers Received</a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-8 mx-auto text-center ">
                    <div class="row justify-content-between ms-1 card-box history pt-3 cHeight">
                        <h4 class="mb-4 mt-1">OFFER MANAGEMENT</h4>
                        <div class="col-md-6">
                            <div class="pt-3">
                                {{-- <div class="offer-deadline-main">
                                    <div class="read-more-doats-main w-100">
                                        <h4 class="countdowns px-0">OFFER DEADLINE</h4>
                                        <h4 class="addcountdown px-0">COUNTDOWN</h4>
                                        <a class="read-more-doats countdown" href="#">...</a>
                                    </div>
                                    <a class="button-grey offer-deadline propertdate" href="javascript:;">{{ date('M, d, Y',strtotime($property->vms_end_date))}} <a class="button-grey offer-deadline timecount text-danger" href="javascript:;" id="demo"> </a>
                                </div> --}}
                                <div class="white-box history offerManagement mb-3">
                                    <div class="read-more-doats-main mb-1">
                                        <span class="px-2 countdowns">OFFER DEADLINE</span>
                                        <span class=" addcountdown px-2">COUNTDOWN</span>
                                        <div class="view-more-offer">
                                            <a class="read-more-doats countdown" href="javascript:;">...</a>

                                        </div>
                                    </div>
                                    <div class="py-2">
                                        <a class="button-grey offer-deadline propertdate mb-2" href="javascript:;">{{ date('M, d, Y',strtotime($property->vms_end_date))}} <a class="py-2 offer-deadline timecount text-danger" href="javascript:;" id="demo"> </a>
                                    </div>
                                </div>
                            </div>

                            <button class="btn primery w-100" href="#extend-deadline" data-bs-toggle="modal" @if(!$data2->can_extend || $user_control==0) disabled @endif>EXTEND DEADLINE</button>
                        </div>
                        <div class="col-md-6 contact-form offerManagement">
                            <div class="card-box history">
                                <div class="row selller-broker align-items-center">
                                    <div class="col-md-6 cWidth">
                                        <label class="greenText gibson-regular">Reserved price</label>
                                    </div>
                                    <div class="col-md-6 cWidth">
                                        <input name="name" type="text" class="feedback-input m-0 innerShadow bg-white" placeholder="$" value="{{Helper::getBladeSetting('currency').number_format($property->reserved_price)}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box history">
                                <div class="row selller-broker align-items-center">
                                    <div class="col-md-6 cWidth">
                                        <label class="greenText gibson-regular">Offer's Due Deadline</label>
                                    </div>
                                    <div class="col-md-6 cWidth">
                                        <input name="name" class="feedback-input m-0 innerShadow bg-white" value="{{date('M d, Y',strtotime($data2->due_date))}}" disabled>
                                    </div>
                                </div>
                            </div>
                            <div class="card-box history">
                                <div class="row selller-broker align-items-center">
                                    <div class="col-md-6 cWidth">
                                        <label class="greenText gibson-regular">Offer increase minimum</label>
                                    </div>
                                    <div class="col-md-6 cWidth">
                                        <select class="m-0 innerShadow" disabled>
                                            <option></option>
                                            <option value="1" @if($data2->offer_increase==1) selected @endif>1%</option>
                                            <option value="2" @if($data2->offer_increase==2) selected @endif>2%</option>
                                            <option value="3" @if($data2->offer_increase==3) selected @endif>3%</option>
                                            <option value="4" @if($data2->offer_increase==4) selected @endif>4%</option>
                                            <option value="5" @if($data2->offer_increase==5) selected @endif>5%</option>
                                            <option value="6" @if($data2->offer_increase==6) selected @endif>6%</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div wire:ignore.self class="modal fade" id="extend-deadline" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        @livewire('web.extend-deadline')
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
data_time = '{{ $property->vms_end_date }}';

var countDownDate = new Date(data_time).getTime();

$(document).ready(function() {
    $(".read-more-doats").click(function() {
        $(this).closest(".view-more-offer").toggleClass("active");
    });
});
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
