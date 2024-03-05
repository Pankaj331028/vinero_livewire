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
                                <x-web-alert wire:ignore.self>
                                </x-web-alert>
                                <div class="row represented-out">
                                    <div class="col-lg-6 col-md-10 mx-auto represented-in offerDeadline">
                                        <div class="card-box history px-3 py-4">
                                            <h6>OFFER DEADLINE EXTENSION</h6>
                                            <div class="white-box mt-2">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-7">
                                                        <label class="green-label">This is a courtesy message. The seller hereby extends the offer deadline for an additional: {{ $data_time ?? '' }}</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|">
                                                    </div>
                                                </div>
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-7">
                                                        <label class="green-label-color">Offers are now due by:</label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <input name="name" type="text" class="feedback-input" placeholder="|" value="{{ $property_end_date ?? '' }}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>My current bid</label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <input name="name" type="text" class="feedback-input seller-brokerage" placeholder="$" value="{{$this->getSetting('currency') .$this->current_bid ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>Financial qualification</label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <input name="name" type="text" class="feedback-input seller-brokerage" placeholder="$" value="{{$this->getSetting('currency') .$this->financial_qualification ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>Bid per square feet</label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <input name="name" type="text" class="feedback-input seller-brokerage" placeholder="$" value="{{$this->getSetting('currency') .$this->bid_per_sqfeet ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-lg-6 col-md-12">
                                                        <label>Est. mortgage payment (verify with your lender)</label>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <input name="name" type="text" class="feedback-input seller-brokerage" placeholder="$" value="{{$this->getSetting('currency') .$this->est_mortigage_payment ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-10 mx-auto represented-in deadlineRightSide">
                                        <div class="card-box history px-3 pb-4 cPadding">
                                            <div class="card-box history">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" wire:model="improve" name="improve" value="0" id="small" class="form__radio-input" id="improve" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> Confirm my offer
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6 col-md-12">
                                                        <input name="name" type="text" class="feedback-input seller-brokerage" placeholder="$" value="{{$this->getSetting('currency') .$this->current_bid ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center">
                                                    <div class="col-lg-6 col-md-12">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" wire:model="improve" name="improve" value="1" id="small" class="form__radio-input" id="improve" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> Improve my offer to
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- @if ($this->imp == 1) --}}
                                                    <div class="col-lg-6 col-md-12 @if ($this->imp != 1) d-none @endif">
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
                                            <div class="card-box history @error('improve') is-invalid @enderror">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
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

								<div class="continue-transaction">
									<div class="row m-0">
										<div class="col-md-6 text-end electronic-documents">
											<p>I hereby consent to use electronic documents &amp; signatures in connection with the purchase of this property.</p>
										</div>
										<div class="col-md-6 text-center">
											<button class="btn tabs-submit-buttons" type ="submit" wire:click="submitModifyOffer" @if($this->control_mode == 0) disabled @endif>SUBMIT </button>
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