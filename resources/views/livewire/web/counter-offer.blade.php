<div class="container-flud card-full-cover">
    <div>
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in pe-0">
                <div class="tabs-container">
                    <div class="tabs-block">
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
                            <form wire:submit.prevent="submitCounter">
                                <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box w-100">
                                    <div class="row justify-content-end">
                                        <div class="byuyer-fooer-profile text-end">
                                            <div class="profile-pic">
                                                <img src="{{ asset('web/img/buyer-profile.svg') }}" alt="seller profile">
                                                <div class="white-box profile-setting">
                                                    <a href="{{route('seller-dashboard')}}">Account</a>
                                                    <a href="{{ route('control-monitor') }}">Control Monitor</a>
                                                    <a href="{{ route('weblogout') }}">Log Out</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row represented-out buyersOfferSummary">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history px-3 py-4">
                                                <h6>BUYER'S OFFER SUMMARY ({{$buyer_name}})</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Offered price</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$offered_price ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Closing costs</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$closing_costs ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller credit</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$seller_credit ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Funds needed to close</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$funds_needed_close ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>1st mortgage</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$mortgage_loan1 ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>2nd mortgage</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$mortgage_loan2 ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Initial deposit</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$initial_deposit ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Deposit increase</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$deposit_increase ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Balance at closing</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="$" value="{{ $this->getSetting('currency') .$balance_at_closing ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history mb-4">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Close of escrow</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage gibson-regular text-dark feedback-input" placeholder="Month, day, year" value="{{ $close_escrow ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history px-3 py-4 cHeight">
                                                <h6>SELLER'S COUNTER OFFER</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Price<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="gibson-regular text-dark feedback-input numberSystem @error('price') is-invalid @enderror" placeholder="$" wire:model="price" maxlength="13">
                                                            @error('price')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Close of escrow (days)<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="gibson-regular text-dark feedback-input numberInput @error('close_of_escrow') is-invalid @enderror" placeholder="|" wire:model="close_of_escrow" maxlength="3">
                                                            @error('close_of_escrow')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Inspection & property condition (days)<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="gibson-regular text-dark feedback-input numberInput @error('inspection_property') is-invalid @enderror" placeholder="|" wire:model="inspection_property" maxlength="3">
                                                            @error('inspection_property')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Loan contingency (days)<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="gibson-regular text-dark feedback-input numberInput @error('loan_contingency') is-invalid @enderror" placeholder="|" wire:model="loan_contingency" maxlength="3">
                                                            @error('loan_contingency')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow company<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input gibson-regular text-dark @error('escrow_company') is-invalid @enderror" placeholder="|" wire:model="escrow_company" maxlength="100">
                                                            @error('escrow_company')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow number</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('price') is-invalid @enderror" placeholder="|" wire:model="escrow_number ?? ''}}">
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Escrow officer<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('escrow_officer') is-invalid @enderror" placeholder="|" wire:model="escrow_officer">
                                                            @error('escrow_officer')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Contact information<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input phoneNumber" placeholder="|"  onblur="changeValue('contact_information',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('contact_information') is-invalid @enderror" wire:model="contact_information" id="contact_information">
                                                            @error('contact_information')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Other terms<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <textarea type="text" class="feedback-input @error('other_terms') is-invalid @enderror" placeholder="|" wire:model="other_terms">{{old('other_terms')}}</textarea>
                                                            @error('other_terms')
                                                            <div class="invalid-feedback">{{$message}}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Multiple Counter Offer<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" id="a" class="form__radio-input valid" value="1" wire:model="multiple_counter">
                                                                <label class="form__label-radio" for="a" class="form__radio-label">
                                                                    <span class="form__radio-button"></span>
                                                                    Yes
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" id="b" class="form__radio-input valid" value="0" wire:model="multiple_counter">
                                                                <label class="form__label-radio" for="b" class="form__radio-label">
                                                                    <span class="form__radio-button"></span> No
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('price')
                                                        <div class="invalid-feedback">{{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                {{-- <div class="text-end electronic-documents">
                                                    <p>I hereby consent to use electronic documents & signatures in connection with the purchase of this property.</p>
                                                </div> --}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="bottomButtonPanel continue-transaction">
                                            <div class="row">
                                                <div class="text-center pt-3">
                                                    {{-- <button class="btn tabs-submit-buttons">COUNTER SELLER'S COUNTER OFFER</button> --}}
                                                    <button type="submit" class="btn px-5 mx-auto tabs-submit-buttons mb-2">
                                                        <h5>COUNTER OFFER</h5>
                                                    </button>
                                                    <a href="{{ URL::previous() }}" class="text me-3">
                                                        <h5>
                                                            <img src="{{ asset('web/img/left-arrow.png') }}" alt="" class="leftArrowImg">
                                                            &nbsp;&nbsp;&nbsp;&nbsp;GO BACK
                                                        </h5>
                                                    </a>
                                                    <a href="{{ route('seller-dashboard') }}" class="text ms-3">
                                                        <h5>BACK TO MAIN DASHBOARD</h5>
                                                    </a>
                                                    <div class="agent-mode-help">
                                                        <a class="button-grey" href="#">Help</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </form>
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