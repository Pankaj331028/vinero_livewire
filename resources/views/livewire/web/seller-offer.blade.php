<div id="tabs-section" class="tabs contact-form">
    <ul class="tab-head">
        <img src="{{asset('web/img/buyer-dashboard-logo.png')}}" alt="Dashboard logo">
        <div class="button-grey">
            <a href="{{route('seller-dashboard')}}" class="text">
                <h6>MY DASHBOARD</h6>
            </a>
        </div>
        <li>
            <a href="#" class="tab-link active active-effect"> <span class="material-icons tab-icon">Buyer Offers</span> <span class="tab-label"></span></a>
        </li>
        <li>
            <a href="{{route('seller-dashboard')}}" class="tab-link"> <span class="material-icons tab-icon">Offer Deadline</span> <span class="tab-label"></span></a>
        </li>
    </ul>
    <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box">
        <div class="row justify-content-end">
            <div class="byuyer-fooer-profile text-end">
                <div class="profile-pic">
                    <img src="{{ asset('web/img/buyer-profile.png') }}" alt="seller profile">
                    <div class="white-box profile-setting">
                        <a href="{{route('seller-dashboard')}}">Account</a>
                        <a href="{{ route('control-monitor') }}">Control Monitor</a>
                        <a href="{{ route('weblogout') }}">Log Out</a>
                    </div>
                </div>
            </div>
        </div>
        <x-web-alert wire:ignore.self>
        </x-web-alert>
        <div class="represented-out seller-offer-outed card-box">
            <h5>BUYER OFFERS</h5>
            <div class="row scroll-box" id="offersDiv">
                @foreach($offers as $offer)
                <div class="col-lg-4 col-md-6 col-sm-8 mx-auto represented-in px-2" id="offer_{{$offer->id}}">
                    <div class="card-box whiteShadow">
                        <div class="col-md-12 text-center mb-3">
                            <label>{{date('M d, Y h:i A',strtotime($offer->created_at))}}</label>
                        </div>
                        <div class="col-md-12 mb-4">
                            <h6>{{ucfirst($offer->buyer_name)}}</h6>
                        </div>
                        <div class="col-md-12">
                            <label>Offered price</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6 class="offered-price">{{Helper::getBladeSetting('currency')}} {{number_format($offer->transaction->offer_price)}}</h6>
                        </div>
                        <div class="col-md-12">
                            <label>Buyer's agent commission</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6 class="offered-price">{{Helper::getBladeSetting('currency')}} {{number_format($offer->buyer_agent_commission)}}</h6>
                        </div>
                        <div class="col-md-12">
                            <label>Net price after commission & credits</label>
                        </div>
                        <div class="col-md-12 mb-3 text-center">
                            <div class="card-box price-with-image history">
                                <img src="{{asset('web/img/buyer-offers-icons.png')}}" alt="">
                                @php
                                $credit = ($offer->transaction->offer_price * $offer->transaction->seller_credit / 100);
                                $commission = ($offer->transaction->offer_price * $offer->buyer_agent_commission_percentage / 100);
                                $net_price = $offer->transaction->offer_price - (0 + $credit);
                                @endphp
                                <h6 class="">{{number_format($offer->transaction->net_price)}}</h6>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label>Initial deposit</label>
                        </div>
                        <div class="col-md-12 mb-3">
                            <h6 class="offered-price">{{Helper::getBladeSetting('currency')}}{{$offer->strategy->initial_deposit_amount}} - {{sprintf('%.1f',($offer->strategy->initial_deposit_amount*100)/$offer->transaction->offer_price)}}%</h6>
                        </div>
                        <div class="col-md-12 text-center">
                            <a class="btn white-box card-box px-3" style="font-family: arpona-thin; background: #fff !important;" target="__blank" href="{{asset('uploads/offers/agreements/Purchase-Agreement-' . $offer->property->vms_property_id . '-' . $offer->id . '.pdf')}}">VIEW PURCHASE CONTRACT</a>
                        </div>
                        <div class="col-md-12">
                            <div class="smart-pricing-checkbox justify-content-center">
                                <div class="checkbox-alignment text-center">
                                    @if($offer->status=='SO')
                                    <h4 class="bgGreen">ACCEPTED</h4>
                                    @else
                                    <label><input type="radio" wire:model="selected_offer" value="{{$offer->id}}" @if($user_control==0) disabled @endif><span></span></label>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @if($user_control&&$property->status!='SO')
        {{-- <div class="row">
            <div class="col-md-6">
                <div class="continue-transaction">
                    <div class="row m-0">
                        <div class="col-md-6 text-end electronic-documents">
                        </div>
                        <div class="col-md-6 text-center">
                            <button class="btn tabs-submit-buttons" type="submit" wire:click="updateOffer('accept')" @if(empty($selected_offer)) disabled @endif>ACCEPT OFFER</button>
                            <button class="btn tabs-submit-buttons" type="submit" wire:click="updateOffer('reject')" @if(empty($selected_offer)) disabled @endif>REJECT OFFER</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="continue-transaction">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <button onclick="location.href='{{ route('counter-offer',['id'=>$selected_offer]) }}';" class=" btn tabs-submit-buttons mb-2" @if(empty($selected_offer)) disabled @endif>
                                <h5>COUNTER OFFER</h5>
                            </button>
                            <button wire:click="notifyOfferInterest" class=" btn tabs-submit-buttons mb-2" @if(empty($selected_offer)) disabled @endif>
                                <h5>OFFER OF INTEREST</h5>
                            </button>
                        </div>
                        <div class="col-md-6">
                            <div class="agent-mode-help">
                                <a class="button-grey" href="#">Help</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}
        <div class="row m-0">
            <div class="col-lg-3 col-md-6 col-sm-12">
                <button class="btn w-100 mx-auto tabs-submit-buttons" type="submit" wire:click="updateOffer('accept')" @if(empty($selected_offer)) disabled @endif>ACCEPT OFFER</button>                            
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <button class="btn w-100 mx-auto tabs-submit-buttons" type="submit" wire:click="updateOffer('reject')" @if(empty($selected_offer)) disabled @endif>REJECT OFFER</button>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <button onclick="location.href='{{ route('counter-offer',['id'=>$selected_offer]) }}';" class="btn w-100 mx-auto tabs-submit-buttons" @if(empty($selected_offer)) disabled @endif>
                    COUNTER OFFER
                </button>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-12">
                <button wire:click="notifyOfferInterest" class="btn w-100 mx-auto tabs-submit-buttons" @if(empty($selected_offer)) disabled @endif>
                    OFFER OF INTEREST
                </button>
            </div>
        </div>
        <div class="agent-mode-help text-end pt-2">
            <a class="button-grey" href="#">Help</a>
        </div>
        @endif
    </section>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
    Livewire.emit('scrollDiv');
})

window.addEventListener('move-scroll', function(event) {
    if (event.detail.type == 'single') {
        var left = $('#offer_' + event.detail.offer_id).offset().left - $('.seller-offer-outed').offset().left - 20;
        $('#offersDiv').scrollLeft(left - $('#offer_' + event.detail.offer_id).width());
    }
})

</script>
