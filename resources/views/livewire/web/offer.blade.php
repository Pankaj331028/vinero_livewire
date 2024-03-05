<div class="container-flud card-full-cover buyerOfferSection">
    <div class="">
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in pe-0">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <div id="tabs-section" class="tabs contact-form">
                            <ul class="tab-head leftNavBar">
                                <input type="hidden" name="" value="my_offer" id="offer-steps" wire:model="steps">
                                <input type="hidden" name="" id="realState" value="{{$this->realStateAgency}}">
                                <img src="{{ asset('web/img/buyer-dashboard-logo.png') }}" alt="buyer dashboard logo">
                                <div class="text-start">
                                    <div class="button-grey text-center mb-2">
                                        <h6>SMART OFFER TERMS</h6>
                                    </div>
                                </div>
                                <li class="@if( $this->step == 1) activeLi @endif" wire:click="fetch_data({{ $s = 1 }})">
                                    <a href="#buyer-my-offer" class="tab-link  tabs-offers @if( $this->step == 1) active @endif @if( $this->step > 1) completeGreen @endif" wire:click="fetch_data({{ $s = 1 }})" value="my_offer"> <span class="material-icons tab-icon">My Offer</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 2 || $this->step_count == 2) activeLi @elseif(in_array($step, [3,4,5,6,7,8,9,10]) || $this->step_count > 1) @else disabled @endif">
                                    <a href="#buyer-transaction-overview" class="tab-link tabs-offers @if($step == 2 || $this->step_count == 2) active @elseif(in_array($step, [3,4,5,6,7,8,9,10]) || $this->step_count > 1) @else disabled @endif  @if( $this->step > 2) completeGreen @endif" wire:click="fetch_data({{ $s = 2 }})"> <span class="material-icons tab-icon">Transaction Overview</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 3 || $this->step_count == 3) activeLi @elseif(in_array($step, [4,5,6,7,8,9,10]) || $this->step_count > 2) @else disabled @endif">
                                    <a href="#buyer-acquisition-strategy" class="tab-link tabs-offers @if($step == 3 || $this->step_count == 3) active @elseif(in_array($step, [4,5,6,7,8,9,10]) || $this->step_count > 2) @else disabled @endif @if( $this->step > 3) completeGreen @endif" wire:click="fetch_data({{ $s = 3 }})"> <span class="material-icons tab-icon">Acquisition Strategy</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 4 || $this->step_count == 4) activeLi @elseif(in_array($step, [5,6,7,8,9,10]) || $this->step_count > 3) @else disabled @endif">
                                    <a href="#buyer-contact-timeline" class="tab-link tabs-offers @if($step == 4 || $this->step_count == 4) active @elseif(in_array($step, [5,6,7,8,9,10]) || $this->step_count > 3) @else disabled @endif @if( $this->step > 4) completeGreen @endif" wire:click="fetch_data({{ $s = 4 }})"> <span class="material-icons tab-icon">Contract Timeline</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 5 || $this->step_count == 5) activeLi @elseif(in_array($step, [6,7,8,9,10]) || $this->step_count > 4) @else disabled @endif">
                                    <a href="#buyer-docs-verifications-uploads" class="tab-link tabs-offers @if($step == 5 || $this->step_count == 5) active @elseif(in_array($step, [6,7,8,9,10]) || $this->step_count > 4) @else disabled @endif @if( $this->step > 5) completeGreen @endif" wire:click="fetch_data({{ $s = 5 }})"> <span class="material-icons tab-icon">Docs, Verifications & Uploads</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 6 || $this->step_count == 6) activeLi @elseif(in_array($step, [7,8,9,10]) || $this->step_count > 5) @else disabled @endif">
                                    <a href="#buyer-items-included-excluded" class="tab-link tabs-offers @if($step == 6 || $this->step_count == 6) active @elseif(in_array($step, [7,8,9,10]) || $this->step_count > 5) @else disabled @endif @if( $this->step > 6) completeGreen @endif" wire:click="fetch_data({{ $s = 6 }})"> <span class="material-icons tab-icon">Items Included & Excluded</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 7 || $this->step_count == 7) activeLi @elseif(in_array($step, [8,9,10]) || $this->step_count > 6) @else disabled @endif">
                                    <a href="#buyer-allocation-of-costs" class="tab-link tabs-offers  @if($step == 7 || $this->step_count == 7) active @elseif(in_array($step, [8,9,10]) || $this->step_count > 6) @else disabled @endif @if( $this->step > 7) completeGreen @endif" wire:click="fetch_data({{ $s = 7 }})"> <span class="material-icons tab-icon">Allocation of Costs</span> <span class="tab-label"></span></a>
                                </li>
                                <li class="@if($step == 8 || $this->step_count == 8) activeLi @elseif(in_array($step, [9,10]) || $this->step_count > 7) @else disabled @endif">
                                    <a href="#buyer-offer-summary" class="tab-link tabs-offers @if($step == 8 || $this->step_count == 8) active @elseif(in_array($step, [9,10]) || $this->step_count > 7) @else disabled @endif @if( $this->step > 8) completeGreen @endif" wire:click="fetch_data({{ $s = 8 }})"> <span class="material-icons tab-icon">Offer Summary & Approval</span> <span class="tab-label"></span></a>
                                </li>
                                <div class="pt-4">
                                    @if ($this->step == 1)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 2 || $this->step_count == 2)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-1.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 3 || $this->step_count == 3)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-2.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 4 || $this->step_count == 4)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-3.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 5 || $this->step_count == 5)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-4.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 6 || $this->step_count == 6)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-5.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 7 || $this->step_count == 7)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-6.png') }}" alt="Progressbar">
                                    @endif
                                    @if($step == 8 || $this->step_count == 8)
                                    <img class="buyer-Progressbar" src="{{ asset('web/img/progressbar-step-empty-7.png') }}" alt="Progressbar">
                                    @endif
                                </div>
                            </ul>
                            {{-- <div class="row justify-content-between">
                                <div class="smart-offer-left">
                                    <h5>Smart Offer Acceptance deadline:</h5>
                                    <div class="button-grey">
                                        <span>MM /</span>
                                        <span>DD /</span>
                                        <span>YY</span>
                                    </div>
                                    <div class="button-grey buyer-offer-time">
                                        <span>xx days, </span>
                                        <span>xx hours, </span>
                                        <span>xx minutes, </span>
                                        <span>xx seconds</span>
                                    </div>
                                </div>
                                <div class="byuyer-fooer-profile text-end">
                                    <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile">
                                </div>
                            </div> --}}
                            @php
                                $dateFromate = date_create($property_Countdown);
                                $property_end_date = date_format($dateFromate, "M/d/Y");
                            @endphp
                            <section id="buyer-my-offer" class="tab-body entry-content   card-box @if( $this->step == 1) active-content active show @endif">

                                @include('web.common.offer-profile-icon')
                                <x-web-alert></x-web-alert>
                                <form wire:submit.prevent="submit" enctype="multipart/form-data">
                                    <div class="row represented-out topMyOffer">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history">
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Represented by an agent<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form__group text-center @error('step1.buyer_representative') is-invalid
                                                                @enderror">
                                                                <div class="form__radio-group">
                                                                    <input type="radio" name="size" id="small" class="form__radio-input" wire:model="step1.buyer_representative" value="yes" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="small">
                                                                        <span class="form__radio-button"></span> YES
                                                                    </label>
                                                                </div>
                                                                <div class="form__radio-group  @error('step1.buyer_representative') is-invalid
                                                                @enderror">
                                                                    <input type="radio" name="size" id="large" class="form__radio-input" wire:model="step1.buyer_representative" value="no" @if($this->control_mode == 0) disabled @endif>
                                                                    <label class="form__label-radio" for="large">
                                                                        <span class="form__radio-button"></span> NO
                                                                    </label>
                                                                </div>
                                                                @error('step1.buyer_representative')
                                                                <div class="invalid-feedback text-danger">
                                                                    {{ $message }}
                                                                </div>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($this->realStateAgency == 1 && $this->step1['buyer_representative'] == 'no')
                                                <h6>REAL ESTATE AGENCY</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller's brokerage firm</label>
                                                            <input name="name" type="text" class="gibson-regular text-center feedback-input seller-brokerage" placeholder="Qonectin, LIC 01776125" wire:model="step1.seller_brokerage_firm" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Seller's agent</label>
                                                            <input name="name" type="text" class="gibson-regular text-center feedback-input seller-brokerage" placeholder="First, Last, LIC" wire:model="step1.seller_agent_name" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your brokerage firm @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input @error('step1.brokerage_firm') is-invalid
                                                                @enderror" placeholder="Enter brokerage firm" id="brokerage_firm" wire:model="step1.brokerage_firm" disabled>
                                                            @error('step1.brokerage_firm')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your brokerage license @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input @error('step1.brokerage_license') is-invalid @enderror" placeholder="Enter brokerage license" wire:model="step1.brokerage_license" id="brokerage_license" disabled>
                                                            @error('step1.brokerage_license')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input @error('step1.agent_name') is-invalid @enderror" placeholder="First name, Last name" wire:model="step1.agent_name" id="agent_name" disabled>
                                                            @error('step1.agent_name')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message}}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent's license @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input @error('step1.agent_license') is-invalid @enderror" placeholder="Enter agent's license" wire:model="step1.agent_license" id="agent_license" disabled>
                                                            @error('step1.agent_license')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent's phone number @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular" placeholder="Phone Number" readonly>
                                                            @error('step1.agent_phone')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Seller paid buyer's agent commission @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="@error('step1.agent_comission') is-invalid @enderror" wire:model="step1.agent_comission" disabled >
                                                                <option value="" selected>Select one</option>
                                                                <option value="0">0%</option>
                                                                <option value="0.25">0.25%</option>
                                                                <option value="0.50">0.50%</option>
                                                                <option value="0.75">0.75%</option>
                                                                <option value="1">1%</option>
                                                                <option value="1.25">1.25%</option>
                                                                <option value="1.50">1.50%</option>
                                                                <option value="1.75">1.75%</option>
                                                                <option value="2">2%</option>
                                                                <option value="2.25">2.25%</option>
                                                                <option value="2.50">2.50%</option>
                                                                <option value="2.75">2.75%</option>
                                                                <option value="3">3%</option>
                                                            </select>
                                                            {{-- <input name="name" type="number" class="gibson-regular feedback-input @error('step1.agent_comission') is-invalid @enderror" placeholder="" wire:model="step1.agent_comission" id="agent_comission" disabled> --}}
                                                            @error('step1.agent_comission')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <h6>REAL ESTATE AGENCY</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller's brokerage firm</label>
                                                            <input name="name" type="text" class="gibson-regular text-center feedback-input seller-brokerage" placeholder="Qonectin, LIC 01776125" wire:model="step1.seller_brokerage_firm" readonly>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Seller's agent</label>
                                                            <input name="name" type="text" class="gibson-regular text-center feedback-input seller-brokerage" placeholder="First, Last, LIC" wire:model="step1.seller_agent_name" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your brokerage firm @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input @error('step1.brokerage_firm') is-invalid
                                                                @enderror" placeholder="Enter brokerage firm" id="brokerage_firm" wire:model="step1.brokerage_firm" @if($this->control_mode == 0) readonly @endif>
                                                            @error('step1.brokerage_firm')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your brokerage license @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="gibson-regular feedback-input @error('step1.brokerage_license') is-invalid @enderror" placeholder="Enter brokerage license" wire:model="step1.brokerage_license" id="brokerage_license">
                                                            @error('step1.brokerage_license')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="gibson-regular feedback-input @error('step1.agent_name') is-invalid @enderror" placeholder="First name, Last name" wire:model="step1.agent_name" id="agent_name">
                                                            @error('step1.agent_name')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message}}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent's license @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="gibson-regular feedback-input @error('step1.agent_license') is-invalid @enderror" placeholder="Enter agent's license" wire:model="step1.agent_license" id="phoneNumber">
                                                            @error('step1.agent_license')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your agent's phone number @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="gibson-regular phoneNumber" value="{{$step1['agent_phone']}}" placeholder="Phone Number" onblur="changeValue('step1.agent_phone',this)">
                                                            <input type="hidden" class="feedback-input @error('step1.agent_phone') is-invalid @enderror" wire:model="step1.agent_phone" id="step1.agent_phone">
                                                            @error('step1.agent_phone')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Seller paid buyer's agent commission @if($step1['buyer_representative']=='yes') <span class="text-danger">*</span> @endif</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="@error('step1.agent_comission') is-invalid @enderror" wire:model="step1.agent_comission" @if($this->control_mode == 0) disabled @endif>
                                                                <option value="" selected>Select one</option>
                                                                <option value="0">0%</option>
                                                                <option value="0.25">0.25%</option>
                                                                <option value="0.50">0.50%</option>
                                                                <option value="0.75">0.75%</option>
                                                                <option value="1">1%</option>
                                                                <option value="1.25">1.25%</option>
                                                                <option value="1.50">1.50%</option>
                                                                <option value="1.75">1.75%</option>
                                                                <option value="2">2%</option>
                                                                <option value="2.25">2.25%</option>
                                                                <option value="2.50">2.50%</option>
                                                                <option value="2.75">2.75%</option>
                                                                <option value="3">3%</option>
                                                            </select>
                                                            @error('step1.agent_comission')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in rightPanel">
                                            <div class="card-box history cHeight">
                                                <h6 class="p-4">OFFER IDENTIFICATION</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Property Address</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input" placeholder="Street, Apartment #, City, State, Zip code" wire:model="step1.address" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Date of offer submitted</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="gibson-regular feedback-input" placeholder="MM/DD/YYY" wire:model="step1.submission_date" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Your name<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6 mi-first-offer">
                                                            {{-- <input class="mi-first" name="name" type="text" class="feedback-input" placeholder="First"> --}}
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="gibson-regular feedback-input @error('step1.buyer_name') is-invalid @enderror" placeholder="Enter your name" wire:model="step1.buyer_name">
                                                            @error('step1.buyer_name')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            {{-- <input class="mi-offer" name="name" type="text" class="feedback-input" placeholder="MI"> --}}
                                                            {{-- <input name="name" type="text" class="feedback-input" placeholder="Last"> --}}
                                                            {{-- <h6 class="add-buyer">Add buyer <a href="#">+</a></h6> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Entity<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="gibson-regular @error('step1.entity') is-invalid @enderror" wire:model="step1.entity" @if($this->control_mode == 0) disabled @endif>
                                                                <option value="" selected>Select one</option>
                                                                <option value="principal">Principal</option>
                                                                <option value="llc">LLC</option>
                                                                <option value="trust">Trust</option>
                                                                <option value="corporation">Corporation</option>
                                                                <option value="legal_entity">Legal entity</option>
                                                            </select>
                                                            @error('step1.entity')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction">
                                        @if($this->control_mode == 0)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(2,12)" value="transaction" name="offerSubmit2" value="1"> CONTINUE </button>
                                        @else
                                        @if($edit_status== false)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(2,12)" value="transaction" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                        <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                        @else
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStep(2,12)" value="transaction" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">
                                            <label class="pe-2">
                                                CONTINUE TO TRANSACTION OVERVIEW
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                        </button>
                                        <button type="button" class="btn px-5 mx-auto text bg-transparent" wire:click="changeStep(2,22)" value="transaction" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                        @endif
                                        @endif
                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <section id="buyer-transaction-overview" class="tab-body entry-content card-box @if($step == 2 || $this->step_count == 2) active-content active show @else fade @endif">

                                @include('web.common.offer-profile-icon')
                                <div class="row represented-out transactionOverview">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history">
                                            <h6 class="transaction px-3 py-4">TRANSACTION INFORMATION</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Offered price<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="hidden" name="" value="{{$this->property_rate}}" id="" wire:model="property_rate">
                                                        <input name="" type="text"maxlength="13" @if($this->control_mode == 0) readonly @endif class="feedback-input   offerPrice  numberSystem  @error('step2.offered_price1') is-invalid @enderror" placeholder="$" wire:model="step2.offered_price" id="offered_prices" >
                                                        @error('step2.offered_price1')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @if($buyer_property_type->seller_credit_buyer == 'yes') --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Seller credit, if any, to buyer</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        {{-- <input name="name" type="text" class="feedback-input" placeholder="%-$"> --}}
                                                        <select class="@error('step2.seller_credit') is-invalid @enderror" @if($this->control_mode == 0) disabled @endif wire:model="step2.seller_credit" id="seller_credit" >
                                                            <option value="" selected>Select one</option>
                                                            <option value="0">0%</option>
                                                            <option value="0.25">0.25%</option>
                                                            <option value="0.50">0.50%</option>
                                                            <option value="0.75">0.75%</option>
                                                            <option value="1">1%</option>
                                                            <option value="1.25">1.25%</option>
                                                            <option value="1.50">1.50%</option>
                                                            <option value="1.75">1.75%</option>
                                                            <option value="2">2%</option>
                                                            <option value="2.25">2.25%</option>
                                                            <option value="2.50">2.50%</option>
                                                            <option value="2.75">2.75%</option>
                                                            <option value="3">3%</option>
                                                            <option value="3.25">3.25%</option>
                                                            <option value="3.50">3.50%</option>
                                                            <option value="3.75">3.75%</option>
                                                            <option value="4">4%</option>
                                                            <option value="4.25">4.25%</option>
                                                            <option value="4.50">4.50%</option>
                                                            <option value="4.75">4.75%</option>
                                                            <option value="5">5%</option>
                                                        </select>
                                                        @error('step2.seller_credit')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- @endif --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Net price after commission & credits</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem @error('step2.net_price') is-invalid @enderror" placeholder="$" wire:model="step2.net_price" id="net_price" readonly>
                                                        @error('step2.net_price')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label>Days to close of escrow<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step2.close_escrow_days') is-invalid @enderror" wire:model="step2.close_escrow_days">
                                                            <option value="" >Select one</option>

                                                            @for ( $i=1; $i<=60; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}
                                                            </option>
                                                            @endfor
                                                        </select>
                                                        @error('step2.close_escrow_days')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="col-md-12">
                                                    <label>Expiration of offer</label>
                                                </div>
                                                <div class="col-md-12 card-box history text-center seller-brokerage">
                                                    <label class="seller-brokerage">1 day after offer due date {{date('d M -Y',strtotime($this->step2['expiry_date'])) ?? ''}} , or upon buyers withdrawal of offer - buyer can withdraw offer at will at any time prior to offer being accepted.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-box history">
                                            <div class="selller-broker">
                                                <div class="col-md-12">
                                                    <h5>TIME OF POSSESSION</h5>
                                                </div>
                                                <div class="col-md-12 card-box history">
                                                    <div class="row selller-broker align-items-center">
                                                        <div class="col-md-6">
                                                            <label>Current occupancy</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="feedback-input" placeholder="" wire:model="step2.occupancy" readonly>
                                                            {{-- <select>
                                                                <option></option>
                                                                <option value="volvo">option 1</option>
                                                                <option value="saab">option 2</option>
                                                                <option value="mercedes">option 3</option>
                                                                <option value="audi">option 4</option>
                                                            </select> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in rightPanel">
                                        <div class="card-box history cHeight">
                                            <h6 class="transaction px-3 py-4">POSSESSION</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($this->step2['possession'] == 'close_escrow')
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        @elseif($this->step2['possession'] == 'rent_back')
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @else
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @endif
                                                        {{-- <input name="name" type="text" class="feedback-input" placeholder="MM/DD/YYY"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Seller rent back</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($this->step2['possession'] == 'close_escrow')
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @elseif($this->step2['possession'] == 'rent_back')
                                                        {{$this->step2['possession_rent_back']." days" ?? ''}}
                                                        @else
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @endif
                                                        {{-- <input name="name" type="text" class="feedback-input" placeholder="# days"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="card-box history d-none">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Tenant occupied units</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="feedback-input" placeholder="#">
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>TOPA submitted by seller</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        @if ($this->step2['possession'] == 'close_escrow')
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @elseif($this->step2['possession'] == 'rent_back')
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @elseif($this->step2['possession_tenant_rights'] == 'topa')
                                                        <i class="fa fa-check" aria-hidden="true"></i>
                                                        @elseif($this->step2['possession_tenant_rights'] == 'other')
                                                        <i class="fa fa-times" aria-hidden="true"></i>
                                                        @endif
                                                        {{-- <input name="name" type="text" class="feedback-input" placeholder="#"> --}}
                                                    </div>
                                                </div>
                                            </div>
                                            <hr class="my-4">
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Final verification of condition<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step2.final_verification') is-invalid @enderror" wire:model="step2.final_verification">
                                                            <option value="" selected>Select one</option>
                                                            @for ( $i=1; $i<=10; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}} </option>
                                                                @endfor
                                                        </select>
                                                        @error('step2.final_verification')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Assignment request<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step2.assignment_request') is-invalid @enderror" wire:model="step2.assignment_request">
                                                            <option value="" selected>Select one</option>
                                                            @for ( $i=1; $i<=17; $i++) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}
                                                                </option>
                                                                @endfor
                                                        </select>
                                                        @error('step2.assignment_request')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction">
                                    @if($this->control_mode == 0)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(3,13)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                    @else
                                    @if($edit_status== false)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(3,13)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                    <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                    @else
                                    <button type="button" class="btn px-5 mx-auto" @if($this->control_mode == 0) disabled @endif wire:click="changeStep(3,13)" name="offerSubmit2" value="1">
                                        <label class="pe-2">
                                            CONTINUE TO ACQUISITION STRATEGY
                                        </label>
                                        <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">

                                    </button>
                                    <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(3,23)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                    @endif
                                    @endif
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                            <section id="buyer-acquisition-strategy" class="tab-body entry-content card-box @if($step == 3 || $this->step_count == 3) active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                                    <div class="row represented-out acquisitionStrategy">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history boxShadow">
                                                <div class="row selller-broker align-items-center">
                                                    <div class="col-md-6">
                                                        <label class="ps-3">Estimated closing costs<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step3.estimated_closing_costs') is-invalid @enderror" wire:model="step3.estimated_closing_costs" class="select-control" id="estimated_closing_costs" onKeyup="DownPayment()">
                                                            @for ( $i=0; $i<=10; $i=$i+0.25 )
                                                            <option value="{{$i}}">{{sprintf($i == intval($i) ? "%.1f" : "%.2f", $i);}}%</option>
                                                            @endfor
                                                        </select>
                                                        @error('step3.estimated_closing_costs')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history boxShadow buyerInvestment px-4 py-3">
                                                <h6 class="investment mb-2">BUYER'S INVESTMENT</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Initial deposit amount<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem  @error('step3.initial_deposit_amount') is-invalid @enderror" placeholder="|" wire:model="step3.initial_deposit_amount" id="initial_deposit_amount" maxlength="13">
                                                             {{-- onKeyup="DownPayment()" --}}
                                                            @error('step3.initial_deposit_amount')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history boxShadow">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Within days<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.within_days') is-invalid @enderror" wire:model="step3.within_days">
                                                                <option value="0">0</option>
                                                                <option value="1">1</option>
                                                                <option value="2">2</option>
                                                                <option value="3" selected>3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>
                                                                <option value="6">6</option>
                                                            </select>
                                                            @error('step3.within_days')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history boxShadow">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Deposit increase<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{-- <select>
                                                                <option></option>
                                                                <option value="volvo">option 1</option>
                                                                <option value="saab">option 2</option>
                                                                <option value="mercedes">option 3</option>
                                                                <option value="audi">option 4</option>
                                                            </select> --}}
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem @error('step3.deposit_increase') is-invalid @enderror" placeholder="$" wire:model="step3.deposit_increase" id="deposit_increase" maxlength="13">
                                                             {{-- onKeyup="DownPayment()" --}}
                                                            @error('step3.deposit_increase')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history boxShadow">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Days to deposit increase</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.deposit_increase_days') is-invalid @enderror" wire:model="step3.deposit_increase_days">
                                                                <option value="" selected>N/A</option>
                                                                <option value="inspection_removal" selected>upon removal inspection contingency</option>
                                                                @for ( $i=1; $i<=10; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                                                    @endfor
                                                            </select>
                                                            @error('step3.deposit_increase_days')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Occupancy type</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select>
                                                                <option></option>
                                                                <option value="volvo">option 1</option>
                                                                <option value="saab">option 2</option>
                                                                <option value="mercedes">option 3</option>
                                                                <option value="audi">option 4</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                                <div class="card-box history boxShadow">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Balance of down payment</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage feedback-input numberSystem @error('step3.down_payment1') is-invalid @enderror" placeholder="$" wire:model="step3.down_payment" readonly>
                                                            @error('step3.down_payment1')
                                                                <div class="invalid-feedback text-danger">
                                                                    {{$message }}
                                                                </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in rightPanel">
                                            <div class="card-box history px-4 py-3 boxShadow cHeight">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <h6 class="mb-2">PURCHASE LOAN(S)</h6>
                                                    </div>
                                                    {{-- <div class="col-md-6 mi-first-offer">
                                                        <h6 class="add-buyer m-0">Add loan <a href="#">+</a></h6>
                                                    </div> --}}
                                                </div>
                                                <div class="card-box history accordion boxShadow" id="accordionExample" style="--bs-accordion-bg: transparent;">
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button loan_item" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                                1st Loan
                                                            </button>
                                                        </h2>
                                                        <div id="collapseOne" class="accordion-collapse collapse  @if($lone_count == 1) show @endif " data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Amount</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem  @error('step3.loan_amount_1') is-invalid @enderror" placeholder="|" wire:model="step3.loan_amount_1" id="loan_amount_1" maxlength="13">
                                                                            @error('step3.loan_amount_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{$message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Interest rate</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            {{-- <input name="name" type="text" class="feedback-input" placeholder="|"> --}}
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.loan_interest_1') is-invalid @enderror" wire:model="step3.loan_interest_1">
                                                                                <option value="" selected>Select one</option>
                                                                                @for ( $i=0; $i<=15; $i=$i+0.125 ) <option value="{{$i}}">{{$i}}%</option>
                                                                                    @endfor
                                                                            </select>
                                                                            @error('step3.loan_interest_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{$message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Points </label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.loan_points_1') is-invalid @enderror" wire:model="step3.loan_points_1">
                                                                                <option value="" selected>Select one</option>
                                                                                {{-- @for ( $i=1; $i<=12; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                                                                    @endfor --}}
                                                                                @for ( $i=0; $i<=10; $i=$i+0.125 ) <option value="{{$i}}">{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                            @error('step3.loan_points_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Direct lender</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step3.direct_lender_1') is-invalid @enderror" placeholder="|" wire:model="step3.direct_lender_1">
                                                                            @error('step3.direct_lender_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Type of financing</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.financing_type_1') is-invalid @enderror" wire:model="step3.financing_type_1">
                                                                                <option value="conventional">Conventional</option>
                                                                                <option value="FHA">FHA</option>
                                                                                <option value="VA">VA</option>
                                                                                <option value="seller_financing">Seller financing</option>
                                                                                <option value="other">Other</option>
                                                                            </select>
                                                                            @error('step3.financing_type_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Additional financing terms</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step3.additional_terms_1') is-invalid @enderror" placeholder="|" wire:model="step3.additional_terms_1">
                                                                            @error('step3.additional_terms_1')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header">
                                                            <button class="accordion-button collapsed loan_item" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                                                2nd Loan
                                                            </button>
                                                        </h2>
                                                        <div id="collapseTwo" class="accordion-collapse collapse @if($lone_count == 2) show @endif" data-bs-parent="#accordionExample">
                                                            <div class="accordion-body">
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Amount</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem @error('step3.loan_amount_2') is-invalid @enderror" placeholder="|" wire:model="step3.loan_amount_2" id="loan_amount_2" maxlength="13">
                                                                            @error('step3.loan_amount_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{$message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Interest rate </label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            {{-- <input name="name" type="text" class="feedback-input" placeholder="|"> --}}
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.loan_interest_2') is-invalid @enderror" wire:model="step3.loan_interest_2">
                                                                                <option value="" selected>Select one</option>
                                                                                @for ( $i=0; $i<=18; $i=$i+0.125 ) <option value="{{$i}}">{{$i}}%</option>
                                                                                    @endfor
                                                                            </select>
                                                                            @error('step3.loan_interest_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{$message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Points</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.loan_points_2') is-invalid @enderror" wire:model="step3.loan_points_2">
                                                                                <option value="" selected>Select one</option>
                                                                                {{-- @for ( $i=1; $i<=12; $i++ ) <option value="{{$i}}">{{$i}}</option>
                                                                                    @endfor --}}
                                                                                @for ( $i=0; $i<=15; $i=$i+0.25 ) <option value="{{$i}}">{{$i}}</option>
                                                                                @endfor
                                                                            </select>
                                                                            @error('step3.loan_points_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Direct lender</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step3.direct_lender_2') is-invalid @enderror" placeholder="|" wire:model="step3.direct_lender_2">
                                                                            @error('step3.direct_lender_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Type of financing</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <select @if($this->control_mode == 0) disabled @endif class="@error('step3.financing_type_2') is-invalid @enderror" wire:model="step3.financing_type_2">
                                                                                <option value="conventional">Conventional</option>
                                                                                <option value="FHA">FHA</option>
                                                                                <option value="VA">VA</option>
                                                                                <option value="seller_financing">Seller financing</option>
                                                                                <option value="other">Other</option>
                                                                            </select>
                                                                            @error('step3.financing_type_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="card-box history boxShadow">
                                                                    <div class="row align-items-center selller-broker">
                                                                        <div class="col-md-6">
                                                                            <label>Additional financing terms</label>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step3.additional_terms_2') is-invalid @enderror" placeholder="|" wire:model="step3.additional_terms_2">
                                                                            @error('step3.additional_terms_2')
                                                                            <div class="invalid-feedback text-danger">
                                                                                {{ $message }}
                                                                            </div>
                                                                            @enderror
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history boxShadow">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Loan to value</label>
                                                        </div>
                                                        {{-- {{ dd($step3['loan_value']) }} --}}
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" class="seller-brokerage feedback-input " placeholder="%" wire:model="step3.loan_value"  disabled >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction mt-5">
                                        @if($this->control_mode == 0)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(4,14)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                        @else
                                        @if($edit_status== false)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(4,14)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                        <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif ><h5>BACK TO MAIN DASHBOARD</h5></a>
                                        @else
                                        <button type="button" class="btn px-5 mx-auto" @if($this->control_mode == 0) disabled @endif wire:click="changeStep(4,14)" name="offerSubmit2" value="1">
                                            <label class="pe-2">
                                                CONTINUE TO CONTACT TIMELINE
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow"></button>
                                        <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(4,24)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                        {{-- <a class="text" href="javascript:void(0)" wire:click="changeStep(4,24)">
                                            <h5>SAVE & CONTINUE LATER</h5>
                                        </a> --}}
                                        @endif
                                        @endif
                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <section id="buyer-contact-timeline" class="tab-body entry-content card-box @if($step == 4 || $this->step_count == 4) active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <div class="row represented-out">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4">
                                            <h6>CONTINGENCIES</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Loan contingency removal<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.loan_contingency') is-invalid @enderror" wire:model="step4.loan_contingency">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=20; $i++ ) <option value="{{$i}}" @if($step4['loan_contingency']==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.loan_contingency')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Appraisal contingency<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.appraisal_contingency') is-invalid @enderror" wire:model="step4.appraisal_contingency">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.appraisal_contingency')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Investigation of property<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.investigation_property') is-invalid @enderror" wire:model="step4.investigation_property">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.investigation_property')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Right to access the property<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.property_access') is-invalid @enderror" wire:model="step4.property_access">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.property_access')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Review of seller's documents<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.review_documents') is-invalid @enderror" wire:model="step4.review_documents">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.review_documents')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Preliminary "Title" report<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.preliminary_report') is-invalid @enderror" wire:model="step4.preliminary_report">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.preliminary_report')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Review of leased or liened items</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.review_of_leased') is-invalid @enderror" wire:model="step4.review_of_leased">
                                                            <option selected>NA</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.review_of_leased')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Common interest disclosures</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.common_interest_disclosures') is-invalid @enderror" wire:model="step4.common_interest_disclosures">
                                                            <option selected>NA</option>
                                                            @for ( $i=1; $i<=17; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.common_interest_disclosures')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Sale of buyer's property</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.sale_buyer_property') is-invalid @enderror" wire:model="step4.sale_buyer_property">
                                                            <option selected>NA</option>
                                                            @for ( $i=1; $i<=20; $i++ ) <option value="{{$i}}" @if($i==17) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.sale_buyer_property')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4">
                                            <h6>COMPLIANCES</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Seller delivery of documents<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.seller_delivery_document') is-invalid @enderror" wire:model="step4.seller_delivery_document">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}" @if($i==7) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.seller_delivery_document')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Sign & return escrow holder provisions and instructions<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.provisions_instructions') is-invalid @enderror" wire:model="step4.provisions_instructions">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}" @if($i==5) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.provisions_instructions')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Install smoke alarm(s), CO detector(s), water heater bracing<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.smoke_alarm') is-invalid @enderror" wire:model="step4.smoke_alarm">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}" @if($i==7) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.smoke_alarm')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Evidence of representative authority<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.evidence_authority') is-invalid @enderror" wire:model="step4.evidence_authority">
                                                            <option value="">Select one</option>
                                                            @for ( $i=1; $i<=3; $i++ ) <option value="{{$i}}" @if($i==1) selected @endif>{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.evidence_authority')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Time to pay for ordering HOA documents</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step4.hoa_documents') is-invalid @enderror" wire:model="step4.hoa_documents">
                                                            <option selected>NA</option>
                                                            @for ( $i=1; $i<=7; $i++ ) <option value="{{$i}}">{{$i==1? ($i.' Day') : ($i.' Days')}}</option>
                                                                @endfor
                                                        </select>
                                                        @error('step4.hoa_documents')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction">
                                    @if($this->control_mode == 0)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(5)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                    @else
                                    @if($edit_status== false)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(5)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                    <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif ><h5>BACK TO MAIN DASHBOARD</h5></a>
                                    @else
                                    <button type="button" @if($this->control_mode == 0) disabled @endif class="btn px-5 mx-auto" wire:click="changeStep(5,15)" name="offerSubmit2" value="1">
                                        <label class="pe-2">
                                            CONTINUE TO DOCS, VIEW & UPLOADS
                                        </label>
                                        <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                    </button>
                                    <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(5,25)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                    {{-- <a class="text" href="javascript:void(0)" wire:click="changeStep(5,25)">
                                        <h5>SAVE & CONTINUE LATER</h5>
                                    </a> --}}
                                    @endif
                                    @endif
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                            <section id="buyer-docs-verifications-uploads" class="tab-body entry-content card-box @if($step == 5 || $this->step_count == 5) active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <form class="" enctype="multipart/form-data" style="overflow:scroll;">
                                    <div class="row represented-out">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history px-3 py-4 verificationOfLoan">
                                                <h6>VERIFICATION OF ALL CASH </h6>
                                                <p class=" sufficient">(SUFFICIENT FUNDS)</p>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Verified amount</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input  numberSystem @error('step5.cash_verified_amount') is-invalid @enderror" placeholder="|" wire:model="step5.cash_verified_amount" @if($data_step5['cash_verification'] == 1) disabled @endif id="" maxlength="13">
                                                            @error('step5.cash_verified_amount')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Upload files</label>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <input name="name" type="file" @if($this->control_mode == 0) disabled @endif class="feedback-input upload ms-0 @error('step5.cash_verified_image') is-invalid @enderror @error('step5.cash_verified_image.*') is-invalid @enderror" placeholder="" wire:model="step5.cash_verified_image" multiple @if($data_step5['cash_verification']==1) disabled @endif>

                                                            <div wire:loading wire:target="step5.cash_verified_image">Uploading...</div>
                                                            @error('step5.cash_verified_image')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                            @error('step5.cash_verified_image.*')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="card-box history"> --}}
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-12">
                                                            @if (!empty($step5['cash_verified_image']))
                                                            <div class="row justify-content-center mb-4">
                                                                @foreach($step5['cash_verified_image'] as $key => $cert)
                                                                @if(gettype($cert)!='string' &&
                                                                in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                <div class="col-md-3 position-relative m-2">
                                                                    @php
                                                                    $file='';
                                                                    switch($cert->getClientOriginalExtension()){
                                                                    case 'pdf': $file=asset('images/pdf.png');break;
                                                                    case 'doc': $file=asset('images/doc.png');break;
                                                                    case 'docx': $file=asset('images/doc.png');break;
                                                                    }
                                                                    @endphp
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage1({{$key}})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$file}}" />
                                                                </div>
                                                                @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                                                                <div class="col-md-3 position-relative m-2">
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage1({{$key}})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$cert->temporaryUrl()}}" width="100% previewImg" />
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                            @if (!empty($cash_verified_image))
                                                            <div class="row justify-content-center mb-4">
                                                                @foreach($cash_verified_image as $key => $cert)
                                                                <div class="col-md-3 position-relative m-2">
                                                                    @if(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['doc','docx','pdf']))
                                                                    @php
                                                                    $file='';
                                                                    $extension = pathinfo($cert->name, PATHINFO_EXTENSION);
                                                                    switch($extension){
                                                                    case 'pdf': $file=asset('images/pdf.png');break;
                                                                    case 'doc': $file=asset('images/doc.png');break;
                                                                    case 'docx': $file=asset('images/doc.png');break;
                                                                    }
                                                                    @endphp
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage1({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                    <a href="{{ asset($cert->path) }}"><img src="{{$file}}" /> </a>
                                                                    {{-- <img src="{{$file}}" /> --}}
                                                                    @elseif(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['png','jpg']))
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage1({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$cert->path}}" width="100% previewImg" />
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                            </div>
                                            <div class="card-box history px-3 py-4 verificationOfLoan">
                                                <h6 class="verification">VERIFICATION OF DOWN <br>PAYMENT & CLOSING COSTS</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Verified amount<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input name="name" type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem @error('step5.downpayment_verified_amount') is-invalid @enderror" placeholder="|" wire:model="step5.downpayment_verified_amount" id="" maxlength="13" readonly>
                                                            @error('step5.downpayment_verified_amount')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Upload files</label>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <input name="name" @if($this->control_mode == 0) disabled @endif type="file" class="feedback-input upload ms-0 @error('step5.downpayment_verified_image') is-invalid @enderror @error('step5.downpayment_verified_image.*') is-invalid @enderror" placeholder="" wire:model="step5.downpayment_verified_image" @if($data_step5['cash_verification'] == 0) disabled @endif multiple>
                                                            <div wire:loading wire:target="step5.downpayment_verified_image">Uploading...</div>
                                                            @error('step5.downpayment_verified_image')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                            @error('step5.downpayment_verified_image.*')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                {{-- <div class="card-box history"> --}}
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-12">
                                                            @if (!empty($step5['downpayment_verified_image']))
                                                            <div class="row justify-content-center mb-4">
                                                                @foreach($step5['downpayment_verified_image'] as $key => $cert)
                                                                @if(gettype($cert)!='string' &&
                                                                in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                <div class="col-md-3 position-relative m-2">
                                                                    @php
                                                                    $file='';
                                                                    switch($cert->getClientOriginalExtension()){
                                                                    case 'pdf': $file=asset('images/pdf.png');break;
                                                                    case 'doc': $file=asset('images/doc.png');break;
                                                                    case 'docx': $file=asset('images/doc.png');break;
                                                                    }
                                                                    @endphp
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage2({{$key}})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$file}}" />
                                                                </div>
                                                                @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                                                                <div class="col-md-3 position-relative m-2">
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage2({{$key}})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$cert->temporaryUrl()}}" width="100% previewImg" />
                                                                </div>
                                                                @endif
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                            @if (!empty($downpayment_verified_image))
                                                            <div class="row justify-content-center mb-4">
                                                                @foreach($downpayment_verified_image as $key => $cert)
                                                                <div class="col-md-3 position-relative m-2">
                                                                    @if(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['doc','docx','pdf']))
                                                                    @php
                                                                    $file='';
                                                                    $extension = pathinfo($cert->name, PATHINFO_EXTENSION);
                                                                    switch($extension){
                                                                    case 'pdf': $file=asset('images/pdf.png');break;
                                                                    case 'doc': $file=asset('images/doc.png');break;
                                                                    case 'docx': $file=asset('images/doc.png');break;
                                                                    }
                                                                    @endphp
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage2({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                    <a href="{{ asset($cert->path) }}"><img src="{{$file}}" /> </a>
                                                                    {{-- <img src="{{$file}}" alt="ghf" /> --}}
                                                                    @elseif(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['png','jpg']))
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage2({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$cert->path}}" width="100%" alt="not_image" />
                                                                    @endif
                                                                </div>
                                                                @endforeach
                                                            </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                    {{-- </div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in verificationOfLoan">
                                            <div class="card-box history px-3 py-4">
                                                <h6>VERIFICATION OF LOAN <br>APPLICATION & PREAPPROVAL</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Status</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{-- <input name="name" type="text" class="feedback-input" placeholder="|"> --}}
                                                            <select @if($this->control_mode == 0) disabled @endif class=" @error('step5.loan_application_status') is-invalid @enderror" wire:model="step5.loan_application_status" @if($data_step5['cash_verification']== 0) disabled @endif>
                                                                <option value="" selected>Select one</option>
                                                                <option value="pre_approval">Pre approval</option>
                                                                <option value="pre_qualification">Pre qualification</option>
                                                                <option value="all_cash">all cash</option>
                                                            </select>
                                                            @error('step5.loan_application_status')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row loan-head-devide justify-content-end w-100">
                                                    <h6>1st Loan</h6>
                                                    <h6>2nd Loan</h6>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Amount</label>
                                                        </div>
                                                        <div class="col-md-6 with-two-input">
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="$" wire:model="loan_amount1" readonly>
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="$" wire:model="loan_amount2" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Interest rate</label>
                                                        </div>
                                                        <div class="col-md-6 with-two-input">
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="%" wire:model="loan_interest_rate_1" readonly>
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="%" wire:model="loan_interest_rate_2" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Direct lender</label>
                                                        </div>
                                                        <div class="col-md-6 with-two-input">
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="Lender" wire:model="direct_lender1" readonly>
                                                            <input type="text" class="feedback-input seller-brokerage" placeholder="Lender" wire:model="direct_lender2" readonly>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Upload files</label>
                                                        </div>
                                                        <div class="col-md-6 text-end">
                                                            <input type="file" @if($this->control_mode == 0) disabled @endif class="feedback-input upload ms-auto w-50 @error('step5.loan_application_image') is-invalid @enderror @error('step5.loan_application_image.*') is-invalid @enderror" placeholder="" wire:model="step5.loan_application_image" multiple @if($data_step5['cash_verification'] == 0) disabled @endif>
                                                            <div wire:loading wire:target="step5.loan_application_image">Uploading...</div>
                                                            @error('step5.loan_application_image')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                            @error('step5.loan_application_image.*')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    {{-- <div class="card-box history"> --}}
                                                        <div class="row align-items-center selller-broker">
                                                            <div class="col-md-12">
                                                                @if (!empty($step5['loan_application_image']))
                                                                <div class="row justify-content-center mb-4">
                                                                    @foreach($step5['loan_application_image'] as $key => $cert)
                                                                    @if(gettype($cert)!='string' &&
                                                                    in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        @php
                                                                        $file='';
                                                                        switch($cert->getClientOriginalExtension()){
                                                                        case 'pdf': $file=asset('images/pdf.png');break;
                                                                        case 'doc': $file=asset('images/doc.png');break;
                                                                        case 'docx': $file=asset('images/doc.png');break;
                                                                        }
                                                                        @endphp
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage3({{$key}})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$file}}" />
                                                                    </div>
                                                                    @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage3({{$key}})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$cert->temporaryUrl()}}" width="100% previewImg" />
                                                                    </div>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                                @if (!empty($loan_application_image))
                                                                <div class="row justify-content-center mb-4">
                                                                    @foreach($loan_application_image as $key => $cert)
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        @if(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['doc','docx','pdf']))
                                                                        @php
                                                                        $file='';
                                                                        $extension = pathinfo($cert->name, PATHINFO_EXTENSION);
                                                                        switch($extension){
                                                                        case 'pdf': $file=asset('images/pdf.png');break;
                                                                        case 'doc': $file=asset('images/doc.png');break;
                                                                        case 'docx': $file=asset('images/doc.png');break;
                                                                        }
                                                                        @endphp
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage3({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                        <a href="{{ asset($cert->path) }}"><img src="{{$file}}" /> </a>
                                                                        @elseif(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['png','jpg']))
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage3({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$cert->path}}" width="100%" alt="not-image" />
                                                                        @endif
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        {{-- </div> --}}
                                                </div>
                                            </div>
                                            <div class="card-box history px-3 py-4">
                                                <h6>UPLOAD OTHER DOCUMENTS</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Document type</label>
                                                        </div>
                                                        <div class="col-md-6 with-two-input">
                                                            <input type="text" @if($this->control_mode == 0) readonly @endif class="docInfo bRadius14 feedback-input me-2 @error('step5.other_documents') is-invalid @enderror" placeholder="Doc info" wire:model="step5.other_documents">
                                                            @error('step5.other_documents')
                                                            <div class="invalid-feedback text-danger">
                                                                {{$message }}
                                                            </div>
                                                            @enderror
                                                            <input type="file" @if($this->control_mode == 0) disabled @endif class="feedback-input upload w-25 ms-0 @error('step5.other_document_image') is-invalid @enderror @error('step5.other_document_image.*') is-invalid @enderror" placeholder="" wire:model="step5.other_document_image" multiple>
                                                            <div wire:loading wire:target="step5.other_document_image">Uploading...</div>
                                                            @error('step5.other_document_image')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                            @error('step5.other_document_image.*')
                                                            <em class="invalid-feedback">{{$message}}</em>
                                                            @enderror
                                                        </div>
                                                        <div class="row align-items-center selller-broker">
                                                            <div class="col-md-12">
                                                                @if (!empty($step5['other_document_image']))
                                                                <div class="row justify-content-center mb-4">
                                                                    @foreach($step5['other_document_image'] as $key => $cert)
                                                                    @if(gettype($cert)!='string' &&
                                                                    in_array($cert->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        @php
                                                                        $file='';
                                                                        switch($cert->getClientOriginalExtension()){
                                                                        case 'pdf': $file=asset('images/pdf.png');break;
                                                                        case 'doc': $file=asset('images/doc.png');break;
                                                                        case 'docx': $file=asset('images/doc.png');break;
                                                                        }
                                                                        @endphp
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage4({{$key}})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$file}}" />
                                                                    </div>
                                                                    @elseif(in_array($cert->getClientOriginalExtension(),['png','jpg']))
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeTempImage4({{$key}})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$cert->temporaryUrl()}}" width="100% previewImg" />
                                                                    </div>
                                                                    @endif
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                                @if (!empty($other_document_image))
                                                                <div class="row justify-content-center mb-4">
                                                                    @foreach($other_document_image as $key => $cert)
                                                                    <div class="col-md-3 position-relative m-2">
                                                                        @if(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['doc','docx','pdf']))
                                                                        @php
                                                                        $file='';
                                                                        $extension = pathinfo($cert->name, PATHINFO_EXTENSION);
                                                                        switch($extension){
                                                                        case 'pdf': $file=asset('images/pdf.png');break;
                                                                        case 'doc': $file=asset('images/doc.png');break;
                                                                        case 'docx': $file=asset('images/doc.png');break;
                                                                        }
                                                                        @endphp
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage4({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                        <a href="{{ asset($cert->path) }}"><img src="{{$file}}" alt="ghf" /></a>
                                                                        @elseif(in_array(pathinfo($cert->name, PATHINFO_EXTENSION),['png','jpg']))
                                                                        <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeImage4({{$key}},{{ $cert->id }})"><i class="fa fa-trash"></i></a>
                                                                        <img src="{{$cert->path}}" class="img-fluid rounded-top" alt="aa">
                                                                        @endif
                                                                    </div>
                                                                    @endforeach
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction">
                                        @if($this->control_mode == 0)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(6,16)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                        @else
                                        @if($edit_status== false)
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(6,16)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                        <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                        @else
                                        <button type="button" @if($this->control_mode == 0) disabled @endif class="btn mx-auto" wire:click="changeStep(6,16)" name="offerSubmit2" value="1">
                                            <label class="pe-2">
                                                CONTINUE TO ITEMS INCLUDED & EXLUDED
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                        </button>
                                        <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(6,26)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                        {{-- <a class="text" href="javascript:void(0)" wire:click="changeStep(6,26)">
                                            <h5>SAVE & CONTINUE LATER</h5>
                                        </a> --}}
                                        @endif
                                        @endif
                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </form>
                            </section>
                            <section id="buyer-items-included-excluded" class="tab-body entry-content card-box @if($step == 6 || $this->step_count == 6) active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <div class="row represented-out itemsIncludedExcluded">
                                    <div class="col-md-6 represented-in yes-no-option">
                                        <div class="card-box history px-3 py-4">
                                            <div class="row justify-content-between">
                                                <h6 class="items-seller-include">ITEMS SELLER HAS INCLUDED IN SALE</h6>
                                                <span class="modify-yes-no">MODIFY YES/NO</span>
                                            </div>
                                            @php
                                            $step6_item = config()->get('constants.items');
                                            $data=(array)$step6['items'];
                                            @endphp
                                            {{-- @foreach ($this->step6['items'] as $k => $i)
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8">
                                                        <label>{{ $k }}</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio">
                                                        <a class="button-grey" href="#">{{$i}}</a>
                                                        @if($i != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" name="size" id="{{ $k }}" class="form__radio-input" value="yes" wire:model="step6.{{$k}}">
                                                            <label class="form__label-radio" for="{{ $k }}">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Stove(s), oven(s), stove/oven combo(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['stove_oven'] == 'yes' ? 'YES' : ($data['stove_oven'] == 'no' ? 'NO' : $data['stove_oven'])}}</a>
                                                        @if($data['stove_oven'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.stove_oven">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Refrigerator(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['refrigerator'] == 'yes' ? 'YES' : ($data['refrigerator'] == 'no' ? 'NO' : $data['refrigerator'])}}</a>
                                                        @if($data['refrigerator'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.refrigerator">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Wine Refrigerator(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['wine_refrigerator'] == 'yes' ? 'YES' : ($data['wine_refrigerator'] == 'no' ? 'NO' : $data['wine_refrigerator'])}}</a>
                                                        @if($data['wine_refrigerator'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.wine_refrigerator">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Washer(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['washer'] == 'yes' ? 'YES' : ($data['washer'] == 'no' ? 'NO' : $data['washer'])}}</a>
                                                        @if($data['washer'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.washer">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Dryer(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['dryer'] == 'yes' ? 'YES' : ($data['dryer'] == 'no' ? 'NO' : $data['dryer'])}}</a>
                                                        @if($data['dryer'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.dryer">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Dishwasher(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['dishwasher'] == 'yes' ? 'YES' : ($data['dishwasher'] == 'no' ? 'NO' : $data['dishwasher'])}}</a>
                                                        @if($data['dishwasher'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.dishwasher">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Microwave(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['microwave'] == 'yes' ? 'YES' : ($data['microwave'] == 'no' ? 'NO' : $data['microwave'])}}</a>
                                                        @if($data['microwave'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.microwave">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Video doorbell(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['video_doorbell'] == 'yes' ? 'YES' : ($data['video_doorbell'] == 'no' ? 'NO' : $data['video_doorbell'])}}</a>
                                                        @if($data['video_doorbell'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.video_doorbell">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Security camera equipment</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['security_camera'] == 'yes' ? 'YES' : ($data['security_camera'] == 'no' ? 'NO' : $data['security_camera'])}}</a>
                                                        @if($data['security_camera'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.security_camera">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Security system(s)/alarm(s), other than separate video doorbell and camera equipment</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['security_system'] == 'yes' ? 'YES' : ($data['security_system'] == 'no' ? 'NO' : $data['security_system'])}}</a>
                                                        @if($data['security_system'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.security_system">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Smart home control devices</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['control_devices'] == 'yes' ? 'YES' : ($data['control_devices'] == 'no' ? 'NO' : $data['control_devices'])}}</a>
                                                        @if($data['control_devices'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.control_devices">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Wall mounted brackets for video or audio equipment</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['audio_equipment'] == 'yes' ? 'YES' : ($data['audio_equipment'] == 'no' ? 'NO' : $data['audio_equipment'])}}</a>
                                                        @if($data['audio_equipment'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.audio_equipment">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in yes-no-option rightPanel">
                                        <div class="card-box history cHeight px-3 py-4">
                                            <div class="row justify-content-between">
                                                <h6 class="items-seller-include">(CONT.)</h6>
                                                <span class="modify-yes-no">MODIFY YES/NO</span>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Above-ground pool(s) and/or spa(s)</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['ground_pool'] == 'yes' ? 'YES' : ($data['ground_pool'] == 'no' ? 'NO' : $data['ground_pool'])}}</a>
                                                        @if($data['ground_pool'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.ground_pool">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Bathroom mirrors, unless excluded below</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['bathroom_mrrors'] == 'yes' ? 'YES' : ($data['bathroom_mrrors'] == 'no' ? 'NO' : $data['bathroom_mrrors'])}}</a>
                                                        @if($data['bathroom_mrrors'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.bathroom_mrrors">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Electric car charging systems and stations</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['car_charging_system'] == 'yes' ? 'YES' : ($data['car_charging_system'] == 'no' ? 'NO' : $data['car_charging_system'])}}</a>
                                                        @if($data['car_charging_system'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.car_charging_system">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8 width75">
                                                        <label>Potted trees/shrubs</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio width25 px-2">
                                                        <a class="button-grey" href="#">{{ $data['potted_trees'] == 'yes' ? 'YES' : ($data['potted_trees'] == 'no' ? 'NO' : $data['potted_trees'])}}</a>
                                                        @if($data['potted_trees'] != 'N/A')
                                                        <div class="form__radio-group">
                                                            {{-- <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="Yes" id="small" class="form__radio-input" wire:model="step6.potted_trees" @if($step6['potted_trees'] == "Yes") checked @endif> --}}
                                                            <input type="checkbox" name="" id="" value="Yes" class="form__radio-input form-checkbox" wire:model="step6.potted_trees">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                        {{-- <input type="checkbox" wire:model="step6.potted_trees" value="true" @if($step6['potted_trees']=='true' ) checked @endif> --}}
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <h6 class="items-seller-include">ITEMS INCLUDED IN SALE</h6>
                                                <div class="col-md-12">
                                                    <label>Seller</label>
                                                    <textarea rows="2" readonly>{{$buyer_property_type->additional_items ?? ''}}</textarea>
                                                    <label>Buyer</label>
                                                    <textarea @if($this->control_mode == 0) readonly @endif  class="@error('step6.additional_items') is-invalid  @enderror"wire:model="step6.additional_items"></textarea>
                                                    @error('step6.additional_items')
                                                    <div class="invalid-feedback text-danger">
                                                        {{$message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <h6 class="items-seller-include">ITEMS EXCLUDED IN SALE</h6>
                                                <div class="col-md-12">
                                                    <label>Seller</label>
                                                    <textarea rows="2" readonly>{{$buyer_property_type->excluded_items ?? ''}}</textarea>
                                                    <label>Buyer</label>
                                                    <textarea @if($this->control_mode == 0) readonly @endif class="@error('step6.excluded_items') is-invalid  @enderror" wire:model="step6.excluded_items"></textarea>
                                                    @error('step6.excluded_items')
                                                    <div class="invalid-feedback text-danger">
                                                        {{$message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            {{-- <div class="mi-first-offer mb-4">
                                                <h6 class="add-buyer">Add item to be included <a href="#">+</a></h6>
                                            </div>
                                            <div class="row justify-content-between">
                                                <h6 class="items-seller-include">ITEMS SELLER HAS EXCLUDED IN SALE</h6>
                                                <span class="modify-yes-no">MODIFY</span>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-8">
                                                        <label>Chandelier</label>
                                                    </div>
                                                    <div class="col-md-4 button-with-radio">
                                                        <div class="form__radio-group">
                                                            <input type="checkbox" name="size" id="small" class="form__radio-input">
                                                            <label class="form__label-radio" for="small">
                                                                <span class="form__radio-button"></span>.
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="mi-first-offer">
                                                <h6 class="add-buyer">Add item to be excluded <a href="#">+</a></h6>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction">
                                    @if($this->control_mode == 0)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(7,17)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                    @else
                                    @if($edit_status== false)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(7,17)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                    <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif ><h5>BACK TO MAIN DASHBOARD</h5></a>
                                    @else
                                    <button type="button" @if($this->control_mode == 0) disabled @endif class="btn mx-auto" wire:click="changeStep(7,17)" name="offerSubmit2" value="1" >
                                        <label class="pe-2">
                                            CONTINUE TO ALLOCATION OF COSTS
                                        </label>
                                        <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                    </button>
                                    <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(7,27)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                    {{-- <a class="text" href="javascript:void(0)" wire:click="changeStep(7,27)">
                                        <h5>SAVE & CONTINUE LATER</h5>
                                    </a> --}}
                                    @endif
                                    @endif
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                            <section id="buyer-allocation-of-costs" class="tab-body entry-content card-box @if($step == 7 || $this->step_count == 7)active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <div class="row represented-out">
                                    <div class="col-md-6 represented-in yes-no-option">
                                        <div class="card-box history px-4 py-3">
                                            <div class="row">
                                                <h6 class="items-seller-include">ALLOCATION OF COSTS</h6>
                                            </div>
                                            {{-- <div class="row justify-content-between allocation-of-costs m-0">
                                                <div class="col-md-6 card-box text-center equil-to-section m-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Natural Hazard Zone Disclosure Report</label>
                                                        </div>
                                                        <div class="mi-first-offer">
                                                            <h6 class="add-buyer text-center"><a href="#">+</a></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 card-box text-center equil-to-section m-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Add Report</label>
                                                        </div>
                                                        <div class="mi-first-offer">
                                                            <h6 class="add-buyer text-center"><a href="#">+</a></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Natural Hazard Zone Disclosure Report<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif
                                                            class=" @error('step7.natural_hazard_zone') is-invalid @enderror"
                                                            wire:model="step7.natural_hazard_zone">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.natural_hazard_zone')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Includes environmental<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif
                                                            class="@error('step7.environmental') is-invalid @enderror" wire:model="step7.environmental">
                                                            <option value="" selected>Select one</option>
                                                            <option value="yes">Yes</option>
                                                            <option value="no">No</option>
                                                            <option value="N/A">N/A</option>
                                                        </select>
                                                        @error('step7.environmental')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Provided by<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.provided_by') is-invalid @enderror" placeholder="" wire:model="step7.provided_by">
                                                        @error('step7.provided_by')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Other</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.other') is-invalid @enderror" placeholder="|" wire:model="step7.other">
                                                        @error('step7.other')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Other report<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-12 mb-2">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.report_name') is-invalid @enderror" placeholder="|" wire:model="step7.report_name">
                                                        @error('step7.report_name')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-md-12">
                                                        <select @if($this->control_mode == 0) disabled @endif
                                                            class=" @error('step7.paid_by') is-invalid @enderror" wire:model="step7.paid_by">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.paid_by')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Smoke alarms, CO detectors, Water heater bracing<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.smoke_alarms') is-invalid @enderror" wire:model="step7.smoke_alarms">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.smoke_alarms')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Gov't req'd point of sale inspections<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.gov_reports') is-invalid @enderror" wire:model="step7.gov_reports">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.gov_reports')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Gov't req'd point of sale corrective / remedial actions<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.gov_required_point') is-invalid @enderror" wire:model="step7.gov_required_point">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.gov_required_point')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow fees<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class=" @error('step7.escrow_fees') is-invalid @enderror"wire:model="step7.escrow_fees">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                            <option value="pay_own_fee">Pay own fee</option>
                                                        </select>
                                                        @error('step7.escrow_fees')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Escrow holder<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.escrow_holder') is-invalid @enderror" placeholder="Name" wire:model="step7.escrow_holder">
                                                        @error('step7.escrow_holder')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Owner's title insurance policy<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class=" @error('step7.insurance_policy') is-invalid @enderror" wire:model="step7.insurance_policy">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.insurance_policy')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Title company (if different from escrow holder)</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.title_company') is-invalid @enderror" placeholder="Name" wire:model="step7.title_company">
                                                        @error('step7.title_company')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Buyer's lender title insurance policy<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.buyer_lender_policy') is-invalid @enderror" wire:model="step7.buyer_lender_policy">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.buyer_lender_policy')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in yes-no-option">
                                        <div class="card-box history pt-5 cHeight">
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Country transfer tax, fees<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.country_transfer_tax') is-invalid @enderror" wire:model="step7.country_transfer_tax">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.country_transfer_tax')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>City transfer tax, fees<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class=" @error('step7.city_transfer_tax') is-invalid @enderror" wire:model="step7.city_transfer_tax">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                        </select>
                                                        @error('step7.city_transfer_tax')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Home warranty plan</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class="@error('step7.warranty_plan') is-invalid @enderror" wire:model="step7.warranty_plan">
                                                            <option value="" selected>Select one</option>
                                                            <option value="buyer">Buyer</option>
                                                            <option value="seller">Seller</option>
                                                            <option value="50">50-50</option>
                                                            <option value="waives">Waives</option>
                                                        </select>
                                                        @error('step7.warranty_plan')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Issued by</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.issued_by') is-invalid @enderror" placeholder="Name" wire:model="step7.issued_by">
                                                        @error('step7.issued_by')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message}}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Cost not to exceed @if(in_array($step7['warranty_plan'],['buyer','seller','50'])) <span class="text-danger">*</span> @endif</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input numberSystem @error('step7.cost_not_exceed') is-invalid @enderror" placeholder="|" wire:model="step7.cost_not_exceed" maxlength="13">
                                                        @error('step7.cost_not_exceed')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @if($buyer_property_type->property_type == 'single_family' || $buyer_property_type->property_type == 'multiunit')
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <div class="card-box history m-0">
                                                            <div class="row align-items-center selller-broker">
                                                                <div class="col-md-7">
                                                                    <label>HOA fee for preparing disclosures</label>
                                                                </div>
                                                                <div class="col-md button-with-radio">
                                                                    {{-- <a class="button-grey" href="#">Buyer</a> --}}
                                                                    <input type="text" class="feedback-input seller-brokerage" value="N/A" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card-box history m-0">
                                                            <div class="row align-items-center selller-broker">
                                                                <div class="col-md-7">
                                                                    <label>HOA certifications fee</label>
                                                                </div>
                                                                <div class="col-md button-with-radio">
                                                                    {{-- <a class="button-grey" href="#">Buyer</a> --}}
                                                                    <input type="text" class="feedback-input seller-brokerage" value="N/A" disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>HOA transfer fees</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="feedback-input" value="N/A" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                            @else
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <div class="card-box history m-0">
                                                            <div class="row align-items-center selller-broker">
                                                                <div class="col-md-6">
                                                                    <label>HOA fee for preparing disclosures</label>
                                                                </div>
                                                                <div class="col-md-6 button-with-radio">
                                                                    {{-- <a class="button-grey" href="#">Buyer</a> --}}
                                                                    <input type="text" class="feedback-input seller-brokerage" value="{{$this->step7['disclosure_hoa_fee'] ?? ''}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="card-box history m-0">
                                                            <div class="row align-items-center selller-broker">
                                                                <div class="col-md-6">
                                                                    <label>HOA certifications fee</label>
                                                                </div>
                                                                <div class="col-md-6 button-with-radio">
                                                                    {{-- <a class="button-grey" href="#">Buyer</a> --}}
                                                                    <input type="text" class="feedback-input seller-brokerage" value="{{$this->step7['hoa_certification_fee'] ?? ''}}" readonly>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>HOA transfer fees</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="feedback-input" value="{{$this->step7['hoa_transfer_fee'] ?? ''}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Private transfer fees</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="feedback-input" value="{{$this->step7['private_transfer_fee'] ?? ''}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- <div class="row justify-content-between allocation-of-costs m-0">
                                                <div class="col-md-6 card-box text-center equil-to-section history m-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Add other fee or cost</label>
                                                        </div>
                                                        <div class="mi-first-offer">
                                                            <h6 class="add-buyer text-center"><a href="#">+</a></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 card-box text-center equil-to-section history m-0">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <label>Other terms</label>
                                                        </div>
                                                        <div class="mi-first-offer">
                                                            <h6 class="add-buyer text-center"><a href="#">+</a></h6>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Other fee</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="feedback-input" value="{{$this->step7['other_fee'] ?? ''}}" readonly>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Other terms</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" @if($this->control_mode == 0) readonly @endif class="feedback-input @error('step7.other_terms') is-invalid @enderror" placeholder="" wire:model="step7.other_terms">
                                                        @error('step7.other_terms')
                                                        <div class="invalid-feedback text-danger">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction">
                                    @if($this->control_mode == 0)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(8,18)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                    @else
                                    @if($edit_status== false)
                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(8,18)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                    <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                    @else
                                    <button class="btn px-5 mx-auto" type="button" @if($this->control_mode == 0) disabled @endif wire:click="changeStep(8,18)" name="offerSubmit2" value="1" >
                                        <label class="pe-2">
                                            REVIEW OFFER AND SUBMIT
                                        </label>
                                        <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow"></button>
                                    </button>
                                    <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(8,28)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                    @endif
                                    @endif
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                            <section id="buyer-offer-summary" class="bg-white tab-body entry-content card-box @if($step == 8 || $this->step_count == 8) active-content active show @else fade @endif">
                                @include('web.common.offer-profile-icon')
                                <div class="row represented-out offerSummary">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4">
                                            <div class="row">
                                                <h6 class="items-seller-include">OFFER SUMMARY</h6>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Offered price</label>
                                                    </div>
                                                    @if(isset($step8['offered_price']))
                                                        <div class="col-md-6">

                                                            <input type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['offered_price']) ?? ''}}"  disabled>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Closing costs</label>
                                                    </div>
                                                    @if(isset($step8['closing_cost']))
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['closing_cost']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Seller credit</label>
                                                    </div>
                                                    @if(isset($step8['seller_credit']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$" value ="{{$this->getSetting('currency') . number_format($this->step8['seller_credit']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Funds needed to close</label>
                                                    </div>
                                                    @if(isset($step8['closed_funds']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$" value ="{{$this->getSetting('currency') .number_format($this->step8['closed_funds']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>1st mortgage</label>
                                                    </div>
                                                    @if(isset($step8['mortgage_loan_1']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['mortgage_loan_1']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>2nd mortgage</label>
                                                    </div>
                                                    @if(isset($step8['mortgage_loan_2']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['mortgage_loan_2']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Initial deposit</label>
                                                    </div>
                                                    @if(isset($step8['initial_deposit']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['initial_deposit']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Deposit increase</label>
                                                    </div>
                                                    @if(isset($step8['deposit_increase']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['deposit_increase']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Balance at closing</label>
                                                    </div>
                                                    @if(isset($step8['closing_balance']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="$"  value ="{{$this->getSetting('currency') .number_format($this->step8['closing_balance']) ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Close of escrow</label>
                                                    </div>
                                                    @if(isset($step8['escrow_closing']))
                                                    <div class="col-md-6">
                                                        <input name="name" type="text" class="seller-brokerage feedback-input" placeholder="Month, day, year" value ="{{$this->step8['escrow_closing'] ?? ''}}"  disabled>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in offerApproved rightPanel">
                                        <div class="card-box history cHeight">
                                            {{-- <div class="white-box history">
                                                <div class="smart-pricing-strategy text-center">
                                                    <label><b>View Smart Pricing Strategy</b></label>
                                                    <div class="mi-first-offer">
                                                        <h6 class="add-buyer text-center"><a href="#">+</a></h6>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            <div class="offer-approved right">
                                                {{-- <label class=""><b>OFFER APPROVED!</b></label> --}}
                                                {{-- <div class="col-md-6 form__radio-group">
                                                    <input type="checkbox" @if($this->control_mode == 0) disabled @endif class="@error('step8.approve') is-invalid @enderror" value="yes" id="small" class="form__radio-input" wire:model="step8.approve">
                                                    @error('step8.approve')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <label class="form__label-radio" for="small">
                                                        <span class="form__radio-button"></span>.
                                                    </label>
                                                </div> --}}
                                                <div class="smart-pricing-checkbox d-block @error('step8.approve') is-invalid @enderror">
                                                    <div class="checkbox-alignment justify-content-between">
                                                        <span class="weight700">OFFER APPROVED!</span>
                                                        <label><input type="checkbox" class="good-arrow" value="yes" wire:model="step8.approve" @if($this->control_mode == 0) disabled @endif>
                                                            <span></span></label>
                                                    </div>
                                                    @error('step8.approve')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                                {{-- <i class="bi bi-check-circle-fill"></i> --}}
                                            </div>
                                            {{-- <div class="offer-approved right">
                                                <label class="underline" data-bs-toggle="modal" data-bs-target="#buyer_adviser">Read the buyer's advisory</label>
                                                <div class="col-md-6 form__radio-group">
                                                    <input type="checkbox" @if($this->control_mode == 0) disabled @endif value="yes" id="small" class="form__radio-input" wire:model="step8.buyer_advisory">
                                                    <label class="form__label-radio" for="small">
                                                        <span class="form__radio-button"></span>.
                                                    </label>
                                                </div>
                                                <i class="bi bi-check-circle-fill"></i>
                                            </div> --}}
                                            <div class="offerApproved offer-approved right pb-4">
                                                <div class="smart-pricing-checkbox d-block @error('step8.buyer_advisory') is-invalid @enderror">
                                                    <div class="checkbox-alignment justify-content-between">
                                                        {{-- <label class="underline" data-bs-toggle="modal" data-bs-target="#buyer_adviser">Read the buyer's advisory</label> --}}
                                                        <span class="underline" data-bs-toggle="modal" data-bs-target="#buyer_adviser">Read the buyer's advisory</span>
                                                        <label><input type="checkbox" class="good-arrow" value="yes" wire:model="step8.buyer_advisory" @if($this->control_mode == 0) disabled @endif>
                                                            <span></span></label>
                                                    </div>
                                                    @error('step8.buyer_advisory')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="white-box history humanVerifyOuter px-3 my-4">
                                                <div class="smart-pricing-checkbox verify-human-main @error('step8.verify_human') is-invalid @enderror">
                                                    <div class="checkbox-alignment">
                                                        <label><input type="checkbox" class="" @if($this->control_mode == 0) disabled @endif value="yes" wire:model="step8.verify_human">
                                                            <span></span></label>
                                                        <h6>Verify you are a human</h6>
                                                    </div>
                                                    @error('step8.verify_human')
                                                    <div class="verify-human invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                    <img src="{{ asset('web/img/captcha.png') }}" alt="captcha">
                                                </div>
                                            </div>
                                            {{-- <div class="container-md mb-3">
                                                <div class="smart-pricing-checkbox">
                                                    <div class="checkbox-alignment">
                                                        <label><input type="checkbox"><span></span></label>
                                                        <span>I need to talk to a realtor. Please have an agent call me.</span>
                                                    </div>
                                                </div>
                                            </div> --}}
                                            @if($buyer_representative_yes_no == 'no')
                                            <div class="card-box history my-4">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>I need to talk to a realtor</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <select @if($this->control_mode == 0) disabled @endif class=" @error('step8.talk_with_realtor') is-invalid @enderror" wire:model="step8.talk_with_realtor">
                                                            <option value="" selected>Select one</option>
                                                            <option value="call_with_agent">Please have an agent call me</option>
                                                            <option value="decline">Decline</option>
                                                        </select>
                                                        @error('step8.talk_with_realtor')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($talk_realtor == 'decline' && $buyer_representative_yes_no == 'no')
                                            <div class="container-md my-4 ">
                                                <div class="smart-pricing-checkbox d-block @error('step8.submit_without_assistance') is-invalid @enderror">
                                                    <div class="checkbox-alignment">
                                                        <label><input type="checkbox" class="" value="yes" wire:model="step8.submit_without_assistance" @if($this->control_mode == 0) disabled @endif>
                                                            <span></span></label>
                                                        <span>I want to submit my offer without the assistance of a realtor</span>
                                                    </div>
                                                    @error('step8.submit_without_assistance')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            @if($talk_realtor == 'call_with_agent' || $buyer_representative_yes_no == 'yes')
                                            <div class="container-md my-4">
                                                <div class="smart-pricing-checkbox d-block @error('step8.submit_without_assistance') is-invalid @enderror">
                                                    <div class="checkbox-alignment">
                                                        <label><input type="checkbox" class="" value="no" id="" wire:model="step8.submit_without_assistance" @if($this->control_mode == 0) disabled @endif>
                                                            {{-- @error('step8.submit_without_assistance')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror --}}
                                                            <span></span></label>
                                                        <span>I want to submit my offer</span>
                                                    </div>
                                                    @error('step8.submit_without_assistance')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                            @endif
                                            <div class="bottomButtonPanel text-center continue-transaction mt-3">
                                                @if($this->control_mode == 0)
                                                <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(9,19)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                                @else
                                                @if($edit_status== false)
                                                <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(9,19)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                                <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                                @else
                                                <button class="btn px-5 mx-auto w-75" type="button" @if($this->control_mode == 0) disabled @endif wire:click="changeStep(9,19)" name="offerSubmit2" value="1">SUBMIT OFFER</button>
                                                <button type="button" class="bg-transparent btn px-5 mx-auto text" wire:click="changeStep(9,29)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1">SAVE & CONTINUE LATER </button>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center continue-transaction">
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                            <section id="buyer-my-offer" class="tab-body entry-content  card-box @if($step == 9) active-content active show @else fade @endif">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        <div class="profile-pic">
                                            <img src="{{ asset('web/img/buyer-profile.svg') }}" alt="buyer profile">
                                            <div class="white-box profile-setting">
                                                <a href="{{ route('buyer-dashboard') }}">Account</a>
                                                <a href="{{ route('control-monitor') }}">Control Monitor</a>
                                                <a href="{{ route('weblogout') }}">Log Out</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row represented-out financialCredentials">
                                    <div class="col-md-6 represented-in offer_Financial">
                                        <div class="card-box history px-3 py-4 rightFinancialCred">
                                            <h6>FINANCIAL CREDENTIALS</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>My current offer</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage" disabled value="{{$this->getSetting('currency') .$this->step9['current_offer'] ?? ''}}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Value I qualify for</label>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage @error('step9.qualify_value') is-invalid @enderror" disabled value="{{$this->getSetting('currency') .number_format($this->step9['qualify_value']) ?? ''}}">
                                                        @error('step9.qualify_value')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            @if ($this->formatCurrency($this->step9['loan_amount_1']) == 0 && $this->formatCurrency($this->step9['loan_amount_2']) == 0)
                                            @else
                                            <div class="card-box history">
                                                {{-- <h6>Proof of funds</h6> --}}
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Proof of funds</label>
                                                        </div>
                                                        @if(isset($step9['proof_funds']))
                                                        <div class="col-md-6">
                                                            {{$this->getSetting('currency') .$this->step9['proof_funds'] ?? ''}}
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Load preapproval</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$this->step9['loan_amount_1'] ?? ''}} - {{$this->step9['loan_amount_2'] ?? ''}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Direct lender</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$this->step9['direct_lender_1'] ?? ''}} - {{$this->step9['direct_lender_2'] ?? ''}}
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Interest rate</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            {{$this->step9['loan_interest_1'].'%' ?? ''}} - {{$this->step9['loan_interest_2'].'%' ??''}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history cHeight px-3 py-4">
                                            <h6>UPLOAD FINANCIAL CREDENTIALS</h6>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="float-start w-50">
                                                        <label>financial credentials<span class="text-danger">*</span></label>
                                                    </div>
                                                    <div class="float-end w-50">
                                                        <input type="file" @if($this->control_mode == 0) disabled @endif class="feedback-input upload @error('step9.file') is-invalid @enderror" wire:model="step9.file">
                                                        @error('step9.file')
                                                        <div class="error-label text-danger">
                                                            {{$message}}
                                                        </div>
                                                        @enderror
                                                        <div wire:loading wire:target="step10.file">Uploading...</div>
                                                        @if (!empty($step9['file']))
                                                        <div class="justify-content-center mb-1">
                                                            @if(gettype($step9['file']) !='string' &&
                                                            in_array($step9['file']->getClientOriginalExtension(),['doc','docx','pdf']))
                                                                @php
                                                                $file='';
                                                                switch($step9['file']->getClientOriginalExtension()){
                                                                case 'pdf': $file=asset('images/pdf.png');break;
                                                                case 'doc': $file=asset('images/doc.png');break;
                                                                case 'docx': $file=asset('images/doc.png');break;
                                                                }
                                                                @endphp
                                                                <img src="{{$file}}" class="file_signature" />

                                                            @elseif(gettype($step9['file'])=='string')

                                                                @if(in_array(pathinfo($step9['file'], PATHINFO_EXTENSION),['doc','docx','pdf']))

                                                                {{-- <div class="justify-content-center mb-1"> --}}
                                                                    @php
                                                                    $file='';
                                                                    $extension = pathinfo($step9['file'], PATHINFO_EXTENSION);
                                                                    switch($extension){
                                                                        case 'pdf'  : $file=asset('images/pdf.png');    break;
                                                                        case 'doc'  : $file=asset('images/doc.png');    break;
                                                                        case 'docx' : $file=asset('images/doc.png');    break;
                                                                    }
                                                                    @endphp
                                                                    <a href="{{ asset($step9['file']) }}">   <img src="{{$file}}" class="file_signature" alt="f"/></a>

                                                                @endif
                                                                {{-- <img src="{{$file}}" class="file_signature" alt="f"/> --}}
                                                            {{-- </div> --}}
                                                            @endif
                                                        </div>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="container-md mb-4">
                                                <div class="smart-pricing-checkbox d-block @error('step9.tnc') is-invalid @enderror">
                                                    <div class="checkbox-alignment">
                                                        <label><input type="checkbox" class="" value="1" wire:model="step9.tnc" @if($this->control_mode == 0) disabled @endif>
                                                            <span></span></label>
                                                        <span class="w-100">I certify that this information is true and correct and established the maximum amount that i can offer in the purchase of this property</span>
                                                    </div>
                                                    @error('step9.tnc')
                                                    <div class="invalid-feedback text-danger">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="bottomButtonPanel text-center continue-transaction">
                                            <div class="row m-0">
                                                <div class="col-md-12 text-center pt-2">
                                                    @if($this->control_mode == 0)
                                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(10,20)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                                    @else
                                                    @if($edit_status== false)
                                                    <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(10,20)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                                    <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif ><h5>BACK TO MAIN DASHBOARD</h5></a>
                                                    @else
                                                    <button type="button" @if($this->control_mode == 0) disabled @endif class="pt-2 btn tabs-submit-buttons mx-auto" wire:click="changeStep(10,20)" name="offerSubmit2" value="1">CONTINUE TO ELECTRONIC SIGNATURE</button>
                                                    @endif
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            </section>
                            <section id="buyer-my-offer" class="tab-body entry-content card-box @if($step == 10) active-content  active show @else fade @endif">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
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
                                <div class="row represented-out electronicSignature">
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history px-3 py-4">
                                            <h6>Buyer-Electronic signature</h6>
                                            <div class="row property-address px-3">
                                                <div class="w-100 card-box text-center property-address-icon mb-1 py-3">
                                                    <h5>{{$step1['address']}}</h5>
                                                    <i class="bi bi-geo-alt-fill"></i>
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>My current bid</label>
                                                    </div>
                                                    @if(isset($step10['current_bid']))
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage" disabled value="{{$this->getSetting('currency') .$step10['current_bid'] ?? ''}}">
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Financial qualification</label>
                                                    </div>
                                                    @if(isset($step10['financial_qulification']))
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage" disabled value="{{$this->getSetting('currency') .$this->step10['financial_qulification'] ?? ''}}">
                                                        {{-- {{$this->getSetting('currency') .$this->step10['financial_qulification'] ?? ''}} --}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Bid per square feet</label>
                                                    </div>
                                                    @if(isset($step10['bid_per_sqfeet']))
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage" disabled value="{{$this->getSetting('currency') .number_format($this->step10['bid_per_sqfeet']) ?? ''}}">
                                                        {{-- {{$this->getSetting('currency') .$this->step10['bid_per_sqfeet'] ?? ''}} --}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="card-box history">
                                                <div class="row align-items-center selller-broker">
                                                    <div class="col-md-6">
                                                        <label>Est. mortgage payment (verify with your lender)</label>
                                                    </div>
                                                    @if(isset($step10['est_morgage']))
                                                    <div class="col-md-6">
                                                        <input type="text" class="seller-brokerage" disabled value="{{$this->getSetting('currency') .$this->step10['est_morgage'] ?? ''}}">
                                                        {{-- {{$this->getSetting('currency') .$this->step10['est_morgage'] ?? ''}} --}}
                                                        {{-- <input name="name" type="text" class="feedback-input" placeholder="$"> --}}
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 represented-in">
                                        <div class="card-box history cTopPadding px-4">
                                            <label>Please review and sign the "Property Disclosures" and your offer. The purchase terms you submitted have been populated in the CAR PPA (Property Purchase Agreement) attached. Click below to review.</label>
                                            <div class="white-box text-center mt-3 p-2 bRadius20">
                                                <div class="boxInnerBorder p-4 bRadius20">
                                                    {{-- <label wire:click="PropertyPurchaseAgreement"> <b>Property Purchase Agreement</b></label> --}}
                                                    <a href="{{ $pdf_re }}" class="text" target="_blank" wire:click="PropertyPurchaseAgreement"><label > <b>Property Purchase Agreement</b></label></a>
                                                </div>
                                            </div>
                                        </div>

                                        @if($Property_Purchase_Agreement == 2 || (gettype($this->step10['file']) == 'string' && $this->step10['file'] != ""))

                                        {{-- <div class="card-box history">
                                            <div class="row align-items-center selller-broker">
                                                <div class="col-md-6 float-start w-50">
                                                    <label>Upload signature<span class="text-danger">*</span></label>
                                                </div>
                                                <div class="col-md-6 float-end w-50">
                                                    <input type="file" class="feedback-input upload @error('step10.file') is-invalid @enderror" wire:model="step10.file" @if($this->control_mode == 0) disabled @endif >
                                                    @error('step10.file')
                                                    <em class="invalid-feedback">{{$message}}</em>
                                                    @enderror
                                                    <div wire:loading wire:target="step10.file">Uploading...</div>
                                                    @if (!empty($step10['file']))
                                                    <div class="justify-content-center mb-1">
                                                        @if(gettype($step10['file'])!='string' &&
                                                        in_array($step10['file']->getClientOriginalExtension(),['doc','docx','pdf']))
                                                        @php
                                                        $file='';
                                                        switch($step10['file']->getClientOriginalExtension()){
                                                        case 'pdf': $file=asset('images/pdf.png');break;
                                                        case 'doc': $file=asset('images/doc.png');break;
                                                        case 'docx': $file=asset('images/doc.png');break;
                                                        }
                                                        @endphp
                                                        <img src="{{$file}}" class="file_signature" />
                                                    </div>
                                                    @elseif(gettype($step10['file'])=='string')
                                                    <div class="justify-content-center mb-1">
                                                        <img src="{{asset($step10['file'])}}" class="file_signature" />
                                                    </div>
                                                    @elseif(in_array($step10['file']->getClientOriginalExtension(),['png','jpg']))
                                                    <div class="justify-content-center mb-1">
                                                        <img src="{{$step10['file']->temporaryUrl()}}" class="file_signature" />
                                                    </div>
                                                    @endif
                                                    @endif
                                                    @if(!empty($step10['file_signature']))
                                                    <img src="{{asset($step10['file_signature'])}}" class="file_signature" />
                                                    @endif
                                                </div>
                                            </div>
                                        </div> --}}
                                        @endif
                                        {{-- <div class="row justify-content-end selller-broker">
                                            <div class="col-md-12 text-end">
                                                <a class="text underline @if($this->control_mode == 0) disabled @endif" href="{{ $pdf_re }}" target="_blank">Review</a>
                                            </div>
                                        </div> --}}
                                        <div class="card-box history">
                                            <div class="row align-items-center selller-broker">
                                                <label>I hereby consent to use electronic documents &amp; signatures in connection with the purchase of this property.</label>
                                                <div class="col-md-6">
                                                    {{-- <label>Bid per square foot</label> --}}
                                                </div>
                                                <div class="col-md-6">
                                                    {{-- {{$this->step10['bid_per_sqfeet'] ?? ''}} --}}
                                                    {{-- <input name="name" type="text" class="feedback-input" placeholder="$"> --}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction">
                                    <div class="row m-0">
                                        <div class="col-md-12 text-center">
                                            @if($this->control_mode == 0)
                                            <button type="button" class="btn px-5 mx-auto" wire:click="changeStepcontinu(11,21)" value="1" name="offerSubmit2" value="1"> CONTINUE </button>
                                            @else
                                            @if($edit_status== false)
                                            <button type="button" class="btn mx-auto px-5" wire:click="changeStepcontinu(11,21)" value="1" name="offerSubmit2" @if($this->control_mode == 0) disabled @endif value="1"> CONTINUE </button>
                                            <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif><h5>BACK TO MAIN DASHBOARD</h5></a>
                                            @else
                                            @if($is_reviewed)
                                            <button class="btn mx-auto px-5 tabs-submit-buttons" type="button" @if($this->control_mode == 0) disabled @endif wire:click="changeStep(11,21)" name="offerSubmit2" value="1" >Approve And Sign</button>
                                            @endif
                                            {{-- <h5 class="ms-3">BACK TO MAIN DASHBOARD</h5> --}}
                                            <a class="text" href="{{ route('buyer-dashboard') }}" @if($this->control_mode == 0) disabled @endif ><h5>BACK TO MAIN DASHBOARD</h5></a>
                                            @endif
                                            @endif
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
        <!-- Modal -->
        <div class="modal fade" id="buyer_adviser" tabindex="-1" aria-labelledby="buyer_adviserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        {!! $buyer_advisory_content !!}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    {{-- <script src="{{asset('web/js/jquery.inputmask.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('web/js/bindings/inputmask.binding.js')}}" type="text/javascript"></script> --}}
<script>

    @if(Session::has('signed') && Session::get('signed'))
        @php
        session()->flash('message', $this->getMessage(212));
        Session::forget('signed');
        @endphp

        window.location="{{route('buyer-dashboard')}}";

    @endif

    function changeValue(field,element){
        var str = $(element).val();
        str = str.replaceAll(/-/g,'');

        @this.set(field, str);
    }
    $(document).ready(function() {
        $('.tabs-offers').on('click', function(e) {
            var steps = $(this).text();
            if (steps == 'Transaction Overview') {
                $('#offer-steps').val('transaction');
            } else if (steps == 'Acquisition Strategy') {
                $('#offer-steps').val('strategy');
            } else if (steps == 'Contract Timeline') {
                $('#offer-steps').val('contract_timings');
            } else if (steps == 'Docs, Verifications & Uploads') {
                $('#offer-steps').val('doc_verification');
            } else if (steps == 'Items Included & Excluded') {
                $('#offer-steps').val('items_include_exclude');
            } else if (steps == 'Allocation of Costs') {
                $('#offer-steps').val('allocation_cost');
            } else if (steps == 'Offer Summary & Approval') {
                $('#offer-steps').val('summary');
            }

        });
    });
</script>
<script>
    data_time = '{{ $property_Countdown }}';

    var countDownDate = new Date(data_time).getTime();

    var x = setInterval(function() {

        var now = new Date().getTime();
        var distance = countDownDate - now;

        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
        var class_name = document.getElementsByClassName("demo");
        // console.log(class_name.length);
        for (var i = 0; i < class_name.length; i++) {
            class_name[i].innerHTML = days + " days, " + hours + " hours, " +
                minutes + " minutes, " + seconds + " seconds ";
        }
    }, 1000);
</script>
<script>
     $(document).ready(function() {
    //     $("#phoneNumber").on("click", function(){
    //         console.log('fds');
    //     $("#phoneNumber").inputmask({"mask": "999 999 9999"});
    // });

    // var im = new Inputmask("999 999 9999"); im.mask('input');
    // $("input").inputmask("99-9999999");

    });
</script>
</div>
