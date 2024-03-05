<div class="container-flud card-full-cover">
    <div class="row card-box buyer-offer-dashboard">
        <section class="tabs-wrapper buyer-offer-dashboard-in pe-0">
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
                            <x-web-alert wire:ignore.self>
                            </x-web-alert>
                            <div class="row represented-out">
                                <div class="col-md-6 represented-in higherOfferRecived">
                                    <div class="card-box history px-3 py-4">
                                        <h6 class="mb-2">HIGHER OFFER RECEIVED</h6>
                                        <div class="white-box history mt-2">
                                            <div class="row align-items-center selller-broker">
                                                <div class="col-md-12">
                                                    <label class="green-label">This is a courtesy message. A higher offer has been received. Do you want to improve your bid by a minimum of {{ $data_diff ?? '' }}</label>
                                                </div>
                                                <div class="col-md-4">
                                                    {{-- <input name="name" type="text" class="feedback-input" placeholder="$"> --}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="white-box history">
                                            <h6 class="pt-2">MY OFFER HIGHLIGHTS</h6>
                                            <div class="card-box history p-0 m-0">
                                                <div class="row align-items-center selller-broker px-4 py-3">
                                                    <div class="col-md-7">
                                                        <label>My current bid</label>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <label><b>{{$this->getSetting('currency') .$this->current_bid ?? ''}}</b></label>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center selller-broker px-4 pb-3">
                                                    <div class="col-md-7">
                                                        <label>Financial qualification</label>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <label><b>{{$this->getSetting('currency') .$this->financial_qualification ?? ''}}</b></label>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center selller-broker px-4 pb-3">
                                                    <div class="col-md-7">
                                                        <label>Bid per square feet</label>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <label><b>{{$this->getSetting('currency') .$this->bid_per_sqfeet ?? ''}}</b></label>
                                                    </div>
                                                </div>
                                                <div class="row align-items-center selller-broker px-4 pb-3">
                                                    <div class="col-md-7">
                                                        <label>Est. mortgage payment</label>
                                                    </div>
                                                    <div class="col-md-5 text-end">
                                                        <label><b>{{$this->getSetting('currency') .$this->est_mortigage_payment ?? ''}}</b></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- <form wire:submit.prevent="submitModifyOffer"> --}}
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4 improveOffer">
                                            <h6>IMPROVE MY OFFER</h6>
                                            <div class="setPosition">
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="form__group">
                                                                <div class="form__radio-group">
                                                                    <input type="radio" wire:model="improve" name="improve" value="0" id="small" class="form__radio-input" id="improve" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="small">
                                                                        <span class="form__radio-button"></span> Confirm my offer
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$" value="{{$this->getSetting('currency') .$this->current_bid ?? ''}}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-6">
                                                            <div class="form__group">
                                                                <div class="form__radio-group">
                                                                    <input type="radio" wire:model="improve" name="improve" value="1" id="small" class="form__radio-input  " id="improve" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="small">
                                                                        <span class="form__radio-button"></span> Improve my offer to
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        {{-- @if ($this->imp == 1) --}}
                                                        <div class="col-lg-6 @if ($this->imp != 1) d-none @endif">
                                                            <input name="name" type="text" class="feedback-input numberSystem @error('amount1') is-invalid @enderror" placeholder="$" wire:model="amount" @if($this->control_mode == 0) disabled @endif maxlength="13">
                                                            @error('amount1')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                        {{-- @endif --}}
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-12">
                                                            <div class="form__group">
                                                                <div class="form__radio-group">
                                                                    <input type="radio" name="size" id="smalla" class="form__radio-input" wire:model="improve" value="2" id="small" class="form__radio-input" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="smalla">
                                                                        <span class="form__radio-button"></span> No Action
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history @error('improve') is-invalid @enderror">
                                                    <div class="row align-items-center">
                                                        <div class="col-lg-12">
                                                            <div class="form__group">
                                                                <div class="form__radio-group">
                                                                    <input type="radio" name="sizeee" wire:model="improve" value="3" id="small" class="form__radio-input" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="small">
                                                                        <span class="form__radio-button"></span> I am no longer interested, withdraw my offer and close my file.
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @error('improve')
                                                    <div class="p-2 invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                            </div>
                            <div class="bottomButtonPanel continue-transaction">
                                <div class="row m-0">
                                    <div class="col text-end electronic-documents">
                                        <p>I hereby consent to use electronic documents & signatures in connection with the purchase of this property.</p>
                                    </div>
                                    <div class="cWidth text-start pt-2 mx-auto">
                                        {{-- <button class="btn tabs-submit-buttons" type="button" wire:click="changeStep(11,21)" name="offerSubmit2" value="1">Approve And Sign</button> --}}
                                        <button class="btn tabs-submit-buttons px-4 me-auto" type ="submit" wire:click="submitModifyOffer" @if($this->control_mode == 0) disabled @endif>
                                            <label class="px-5">
                                                SUBMIT
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow pt-1">
                                        </button>
                                        <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5 class="ms-3" >BACK TO MAIN DASHBOARD</h5></a>

                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- </form> --}}
                        </section>
                    </div>
                </div>
            </div>
        </section>
    </div>
</div>
