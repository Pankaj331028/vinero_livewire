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
                                {{-- <li>
                                    <a href="#" class="tab-link"> <span class="material-icons tab-icon">My Offer</span> <span class="tab-label"></span></a>
                                </li> --}}
                                <li>
                                    <a href="#" class="tab-link"> <span class="material-icons tab-icon">Smart Pricing Strategy</span> <span class="tab-label"></span></a>
                                </li>
                                <li>
                                    <a href="#" class="tab-link active active-effect"> <span class="material-icons tab-icon">History</span> <span class="tab-label"></span></a>
                                </li>
                            </ul>
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        @include('web.common.notification-profile-icone')
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                    </div>
                                </div>
                                <div class="row represented-out ">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4 sellersCounter">
                                            <h6>SELLER'S COUNTER OFFER</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Price</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$" value="{{  $this->getSetting('currency') .$price ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $close_of_escrow ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Inspection & property condition (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $inspection_property ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Loan contingency (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $loan_contingency ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow company</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $escrow_company ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow number</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $price ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Escrow officer</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $escrow_officer ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Contact information</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage phoneNumber feedback-input" placeholder="|" value="{{ $contact_information ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Other terms</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="|" value="{{ $other_terms ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4">
                                            <h6>MY COUNTER TO SELLER’S COUNTER OFFER</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Price</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" maxlength="13" class="feedback-input numberSystem @error('buyer_price1') is-invalid @enderror" placeholder="$" wire:model="buyer_price" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_price1')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" maxlength="3" class="feedback-input  numberInput  @error('buyer_close_of_escrow') is-invalid @enderror" placeholder="Enter Close of escrow (days)" wire:model="buyer_close_of_escrow" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_close_of_escrow')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Inspection & property condition (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" maxlength="3" class="feedback-input  numberInput @error('buyer_inspection_property') is-invalid @enderror" placeholder="Enter Inspection & property condition (days)" wire:model="buyer_inspection_property" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_inspection_property')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Loan contingency (days)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" maxlength="3" class="feedback-input  numberInput @error('buyer_loan_contingency') is-invalid @enderror" placeholder="Enter Loan contingency (days)" wire:model="buyer_loan_contingency" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_loan_contingency')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow company</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" maxlength="100" class="feedback-input  @error('buyer_escrow_company') is-invalid @enderror" placeholder="Enter Escrow company" wire:model="buyer_escrow_company" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_escrow_company')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow number</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text"  class="phoneNumber" placeholder="Enter Escrow number" @if($this->control_mode == 0) disabled @endif onblur="changeValue('buyer_escrow_number',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('buyer_escrow_number') is-invalid @enderror" wire:model="buyer_escrow_number" id="buyer_escrow_number">
                                                        @error('buyer_escrow_number')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Escrow officer</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input  @error('buyer_escrow_officer') is-invalid @enderror" placeholder="Enter Escrow officer" wire:model="buyer_escrow_officer" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_escrow_officer')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Contact information</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text"   class="phoneNumber" placeholder="Enter Contact information" @if($this->control_mode == 0) disabled @endif onblur="changeValue('buyer_contact_information',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('buyer_contact_information') is-invalid @enderror" wire:model="buyer_contact_information" id="buyer_contact_information">
                                                        @error('buyer_contact_information')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Other terms</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input  @error('buyer_other_terms') is-invalid @enderror" placeholder="Enter Other terms" wire:model="buyer_other_terms" @if($this->control_mode == 0) disabled @endif>
                                                        @error('buyer_other_terms')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="continue-transaction">
                                    <div class="row m-0">
                                        <div class="col-lg-6 text-end electronic-documents">
                                            <p>I hereby consent to use electronic documents & signatures in connection with the purchase of this property.</p>
                                        </div>
                                        <div class="col-lg-6 text-center">
                                            <button class="btn tabs-submit-buttons" type="submit" wire:click="counterOffer" @if($this->control_mode == 0) disabled @endif>
                                                <label class="pe-2">
                                                    SUBMIT COUNTER OFFER
                                                </label>
                                                <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow pt-1">
                                            </button>

                                            <a href="{{ route('buyer-view-sellers-counter') }}" class="text @if($this->control_mode == 0) disabled @endif " ><h5 class="ms-3">GO BACK</h5></a>
                                            <br>
                                            <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5 class="ms-3">BACK TO MAIN DASHBOARD</h5></a>

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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>

    function changeValue(field,element){
        var str = $(element).val();
        str = str.replaceAll(/-/g,'');

        @this.set(field, str);
    }
</script>