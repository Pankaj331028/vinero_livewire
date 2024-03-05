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
                                            <h6>OFFER NOT APPROVED</h6>
                                            <div class="white-box">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-12">
                                                        <label class="green-label">This is a courtesy message. your offered price exceeds your financial credentials on file.<br> Please reevaluate your "financial capacity" and/or adjust your offering price.</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>My current bid</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{$this->getSetting('currency') .$this->current_bid ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Financial qualification</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{$this->getSetting('currency') .$this->financial_qualification ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Bid per square feet</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{$this->getSetting('currency') .$this->bid_per_sqfeet ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Est. mortgage payment (verify with your lender)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="$" value="{{$this->getSetting('currency') .$this->est_mortigage_payment ?? ''}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history">
                                            {{-- <div class="card-box history">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" id="small" class="form__radio-input">
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> I want to update my credentials
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" id="small" class="form__radio-input">
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> I am no longer interested, withdraw my offer and close my file.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center">
                                                    <div class="col-md-12">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" wire:model="improve" value="2" name="size" id="small" class="form__radio-input" id="improve" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span>I want to update my credentials
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($this->imp == 2)
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <input name="name" type="file" class="feedback-input @error('file') is-invalid @enderror" placeholder="$" @if($this->control_mode == 0) disabled @endif wire:model="file" >
                                                            @error('file')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            <div wire:loading wire:target="file">Uploading...</div>
                                                            @if (!empty($file))
                                                            <div class="justify-content-center mb-1">
                                                                @if(gettype($file)!='string' &&
                                                                in_array($file->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                @php
                                                                $files='';
                                                                switch($file->getClientOriginalExtension()){
                                                                case 'pdf': $files=asset('images/pdf.png');break;
                                                                case 'doc': $files=asset('images/doc.png');break;
                                                                case 'docx': $files=asset('images/doc.png');break;
                                                                }
                                                                @endphp
                                                                <img src="{{$files}}" class="file_signature" />
                                                            </div>
                                                            @elseif(gettype($file)=='string')
                                                            <div class="justify-content-center mb-1">
                                                                <img src="{{asset($file)}}" class="file_signature" />
                                                            </div>
                                                            @elseif(in_array($file->getClientOriginalExtension(),['png','jpg']))
                                                            <div class="justify-content-center mb-1">
                                                                <img src="{{$file->temporaryUrl()}}" class="file_signature" />
                                                            </div>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
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

                                            <button class="btn tabs-submit-buttons" type ="submit" wire:click="submitModifyOffer" @if($this->control_mode == 0) disabled @endif>SUBMIT</button>
                                            <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5 class="ms-3" >BACK TO MAIN DASHBOARD</h5></a>

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
