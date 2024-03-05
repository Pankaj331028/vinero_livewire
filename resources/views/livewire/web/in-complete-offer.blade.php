<div class="container-flud card-full-cover">
    <div class="">
        <div class="">
            <section class="tabs-wrapper buyer-offer-dashboard-in">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <div id="tabs-section" class="tabs contact-form">
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box w-100">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        @include('web.common.notification-profile-icone')
                                    </div>
                                </div>
                                <div class="container inCompleteOffer">
                                    <div class="row represented-out">
                                        <div class="card-box text-center">
                                            <h2 class="green-second-heading mb-4 gibson-medium">Incomplete Offer</h2>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="white-box">
                                                        <div class="row">
                                                            <div class="col-md-12 text-start">
                                                                <label class="green-label">Your offer is important to us, please take a few minutes to complete.</label>
                                                            </div>
                                                        </div>
                                                        <div class="box-inner-listing boxShadowBottom mt-5 py-3">
                                                            <ol>
                                                                <li>Buyer's offer terms</li>
                                                                <li>
                                                                    Buyer's financial credentials
                                                                    <ul type="a">
                                                                        <li id="fc" class="@if($incompletetype == 2) text-danger @endif">Proof of funds to close the transaction: bank statements, etc.</li>
                                                                        <li id="proof_funds" class="@if($incompletetype == 3) text-danger @endif">Direct lender pre-approval letter</li>
                                                                    </ul>
                                                                </li>
                                                            </ol>
                                                        </div>
                                                        <div class="white-box text-center boxShadowBottom mt-4">
                                                            <label><b>We received your offer and noticed missing information. Please complete and resubmit.</b></label>
                                                        </div>
                                                    </div>
                                                    <label class="text-center">We enjoy working with you!</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel continue-transaction text-center">

                                    <button class="btn tabs-submit-buttons px-5 mx-auto" type="submit" wire:click="reviseOffer" @if($this->control_mode == 0) disabled @endif >
                                        <label class="pe-2">
                                            REVISE OFFER
                                        </label>
                                        <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow pt-1">
                                    </button>
                                    
                                    <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5 class="ms-3">BACK TO MAIN DASHBOARD</h5></a>
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
