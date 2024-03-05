<div class="container-flud card-full-cover">
    <div class="container">
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <div id="tabs-section" class="tabs contact-form">
                            <ul class="tab-head">
                                <img src="{{ asset('web/img/buyer-dashboard-logo.png') }}" alt="buyer dashboard logo">
                                <div class="button-grey">
                                    <a href="{{route('buyer-dashboard')}}" class="text">
                                        <h6>MY DASHBOARD</h6>
                                    </a>
                                </div>
                                <li>
                                    <a href="#" class="tab-link"> <span class="material-icons tab-icon">My Offer</span> <span class="tab-label"></span></a>
                                </li>
                                {{-- <li>
                                    <a href="#" class="tab-link"> <span class="material-icons tab-icon">Smart Pricing Strategy</span> <span class="tab-label"></span></a>
                                </li> --}}
                                <li>
                                    <a href="#" class="tab-link active active-effect"> <span class="material-icons tab-icon">History</span> <span class="tab-label"></span></a>
                                </li>
                            </ul>
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        @include('web.common.notification-profile-icone')
                                    </div>
                                </div>
                                <div class="row represented-out">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history">
                                            <h6>MY OFFER SUMMARY</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Offered price</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$offered_price ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Closing costs</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$closing_costs ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Seller credit</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$seller_credit ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Funds needed to close</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$funds_needed_close ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>1st mortgage</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$mortgage_loan1 ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>2nd mortgage</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$mortgage_loan2 ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Initial deposit</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$initial_deposit ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Deposit increase</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$deposit_increase ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Balance at closing</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$balance_at_closing ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="Month, day, year" value="{{ $close_escrow ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history">
                                            <h6>SELLER'S COUNTER OFFER</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Price</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$price ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $close_of_escrow ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Inspection & property condition (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $inspection_property ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Loan contingency (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $loan_contingency ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow company</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $escrow_company ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow number</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $escrow_number ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Escrow officer</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $escrow_officer ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Contact information</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $contact_information ? Helper::formatNumber($contact_information) : ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Other terms</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $other_terms ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="continue-transaction">
                                            <div class="row m-0">
                                                <div class="col-md-6 text-end electronic-documents">
                                                    <p>I hereby consent to use electronic documents & signatures in connection with the purchase of this property.</p>
                                                </div>
                                                <div class="col-md-6 text-center">
                                                    <button class="btn tabs-submit-buttons" type="submit" wire:click="acceptCounterOffer" @if($this->control_mode == 0) disabled @endif>ACCEPT COUNTER OFFER</button>

                                                    <a href="Javascript:void(0)" class="text @if($this->control_mode == 0) disabled @endif" wire:click="withdrawMyOffer" ><h5>WITHDRAW MY OFFER</h5></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="continue-transaction">
                                            <div class="row">
                                            <div class="col-md-6 text-center">
                                                {{-- <button class="btn tabs-submit-buttons">COUNTER SELLER'S COUNTER OFFER</button> --}}
                                                <a href="{{ route('counter-to-counter') }}" class=" btn tabs-submit-buttons mb-2 @if($this->control_mode == 0) disabled @endif" ><h5>COUNTER SELLER'S COUNTER OFFER</h5></a>
                                                <a href="{{ route('buyer-dashboard') }}" class="text mt-5 @if($this->control_mode == 0) disabled @endif" ><h5>BACK TO MAIN DASHBOARD</h5></a>

                                            </div>
                                            <div class="col-md-6">
                                                <div class="agent-mode-help">
                                                    <a class="button-grey" href="#">Help</a>
                                                </div>
                                            </div>
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
