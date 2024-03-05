<div class="container-flud card-full-cover">
    <div>
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in pe-0">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <form>
                            <div id="tabs-section" class="tabs contact-form">
                                <ul class="tab-head addSeller leftNavBar">
                                    <img src="{{ asset('web/img/buyer-dashboard-logo.png') }}" alt="Seller dashboard logo">
                                    <div class="button-grey">
                                        <h6>SALE PROPOSAL</h6>
                                    </div>
                                    <li class="@if($step == 1) activeLi @endif">
                                        <a href="javascript:;" class="tab-link  tabs-offers @if( $step == 1) active @endif" wire:click="movetoStep(1)" value="my_offer"> <span class="material-icons tab-icon">My Offering</span> <span class="tab-label"></span></a>
                                    </li>
                                    <li class="@if($step == 2) activeLi @endif">
                                        <a href="javascript:;" class="tab-link tabs-offers @if($step == 2) active @elseif($step<2) disabled @endif" @if($step>= 2) wire:click="movetoStep(2)" @endif> <span class="material-icons tab-icon">My Offering (Cont.)</span> <span class="tab-label"></span></a>
                                    </li>
                                    <li class="@if($step == 3) activeLi @endif">
                                        <a href="javascript:;" class="tab-link tabs-offers @if($step == 3) active @elseif($step < 3) disabled @endif" @if($step>=3) wire:click="movetoStep(3)" @endif> <span class="material-icons tab-icon">Items Included & Excluded</span> <span class="tab-label"></span></a>
                                    </li>
                                    <img class="buyer-Progressbar" src="{{ $progressbar }}" alt="Progressbar">
                                </ul>
                                <section id="my-offering" class="tab-body entry-content card-box addProperty @if( $step == 1) active-content active show @endif">
                                    <div class="row justify-content-end">
                                        <div class="byuyer-fooer-profile text-end">
                                            @include('web.common.notification-profile-icone')
                                            {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        </div>
                                    </div>
                                    <div class="row represented-out">
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in">
                                            <div class="card-box history px-3 py-4">
                                                <h6>MY OFFERING</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>VMS property ID code<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input seller-brokerage @error('property_id') is-invalid @enderror" wire:model="property_id" readonly>
                                                            @error('property_id')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Property Address<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input  @error('address') is-invalid @enderror" placeholder="Please enter address" wire:model.debounce.500ms="address" maxlength="100">
                                                            @error('address')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Owner<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('owner') is-invalid
                                                                    @enderror" placeholder="Please enter owner name" id="owner" wire:model.debounce.500ms="owner" maxlength="50">
                                                            @error('owner')
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
                                                            <label>VMS Activation (Start Date/Time)<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date" class="feedback-input @error('activation_date') is-invalid @enderror" placeholder="Please enter activation date" data-date="" data-date-format="YYYY-MM-DD" min="{{date("Y-m-d",strtotime('+1 Day'))}}" wire:model.debounce.500ms="activation_date" id="activation_date">
                                                            @error('activation_date')
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
                                                            <label>VMS Deactivation (End Date/Time)<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date" class="feedback-input @error('deactivation_date') is-invalid @enderror" placeholder="Please enter deactivation date" min="{{$activation_date}}" data-date="" data-date-format="YYYY-MM-DD" wire:model.debounce.500ms="deactivation_date" id="deactivation_date">
                                                            @error('deactivation_date')
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
                                                            <label>Reserved price<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input numberSystem @error('reserved_price') is-invalid @enderror" placeholder="Please enter reserved price" maxlength="13" wire:model.debounce.500ms="reserved_price">
                                                            @error('reserved_price')
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
                                                            <label>Square footage<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input  @error('square_foot') is-invalid @enderror" placeholder="Please enter square footage" maxlength="13" wire:model.debounce.500ms="square_foot">
                                                            @error('square_foot')
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
                                                            <label>Minimum offer increase<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('offer_increase') is-invalid @enderror" wire:model.debounce.500ms="offer_increase">
                                                                <option value="1">1%</option>
                                                                <option value="2">2%</option>
                                                                <option value="3">3%</option>
                                                                <option value="4">4%</option>
                                                                <option value="5">5%</option>
                                                                <option value="6">6%</option>
                                                            </select>
                                                            @error('offer_increase')
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
                                                            <label>Occupancy<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('occupancy') is-invalid @enderror" wire:model.debounce.500ms="occupancy">
                                                                <option value="">Select one</option>
                                                                <option value="owner">Owner</option>
                                                                <option value="vacant">Vacant</option>
                                                                <option value="tenant">Tenant</option>
                                                            </select>
                                                            @error('occupancy')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller Financing<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('financing') is-invalid @enderror" wire:model.debounce.500ms="financing">
                                                                <option value="">Select one</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                            @error('financing')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in">
                                            <div class="card-box history px-3 py-4 realStateAgency">
                                                <h6>REAL ESTATE AGENCY</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller phone number<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="phoneNumber" placeholder="Please enter seller phone number" value="{{$seller_phone}}" onblur="changeValue('seller_phone',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('seller_phone') is-invalid @enderror" wire:model="seller_phone" id="seller_phone">
                                                            @error('seller_phone')
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
                                                            <label>Seller's brokerage name<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('brokerage_name') is-invalid @enderror" placeholder="Please enter brokerage name" wire:model.debounce.500ms="brokerage_name" maxlength="50">
                                                            @error('brokerage_name')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller's brokerage license<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('brokerage_license') is-invalid @enderror" placeholder="Please enter brokerage license" wire:model.debounce.500ms="brokerage_license">
                                                            @error('brokerage_license')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Listing agent's name<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6 mi-first-offer">
                                                            <input type="text" class="feedback-input @error('agent_name') is-invalid @enderror" placeholder="Please enter agent name" wire:model.debounce.500ms="agent_name" maxlength="50">
                                                            @error('agent_name')
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
                                                            <label>Agent phone number<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="phoneNumber" placeholder="Please enter agent number" value="{{$agent_phone}}" onblur="changeValue('agent_phone',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('agent_phone') is-invalid @enderror" wire:model="agent_phone" id="agent_phone">
                                                            @error('agent_phone')
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
                                                            <label>Listing agent's license<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('agent_license') is-invalid @enderror" placeholder="Please enter agent license" wire:model.debounce.500ms="agent_license">
                                                            @error('agent_license')
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
                                                            <label>Disclosure<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">


                                                            <input name="name" type="file" class="feedback-input upload @error('disclosure') is-invalid @enderror" wire:model.debounce.500ms="disclosure">
                                                            <div wire:loading wire:target="disclosure">Uploading...</div>
                                                            @error('disclosure')
                                                            <div class="invalid-feedback text-danger">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            @if(!empty($disclosure))
                                                            {{-- <div class="card-box history p-1 d-block">
                                                                <div class="smart-pricing-strategy text-center">
                                                                    <div class="">
                                                                        <h6 class="text-center" style="margin: 8px;">
                                                                            <label><b>Uploaded</b></label>
                                                                            <a href="javascript:;" wire:click="removeDisclosure" style="background: #0A6F5C;display: inline-block;color: #fff;font-size: 15px;padding: 2px 7px 4px;border-radius: 50%;line-height: 15px;font-weight: 300;margin-left: 10px;">x</a>
                                                                        </h6>
                                                                    </div>
                                                                </div>
                                                            </div> --}}
                                                            @if(gettype($disclosure)!='string' && in_array($disclosure->getClientOriginalExtension(),['doc','docx','pdf']))
                                                            <div class="row">
                                                                <div class="col-md-4 position-relative">
                                                                    @php
                                                                    $file='';
                                                                    switch($disclosure->getClientOriginalExtension()){
                                                                    case 'pdf': $file=asset('images/pdf.png');break;
                                                                    case 'doc': $file=asset('images/doc.png');break;
                                                                    case 'docx': $file=asset('images/doc.png');break;
                                                                    }
                                                                    @endphp
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeDisclosure"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$file}}" />
                                                                </div>
                                                            </div>
                                                            @elseif(in_array($disclosure->getClientOriginalExtension(), ['png','jpg','jpeg']))
                                                            <div class="row">
                                                                <div class="col-md-4 position-relative">
                                                                    <a href="javascript:;" class="position-absolute right-0 dltImgIcon" wire:click="removeDisclosure"><i class="fa fa-trash"></i></a>
                                                                    <img src="{{$disclosure->temporaryUrl()}}" width="100%" />
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller Credit to buyer<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('buyer_credit') is-invalid @enderror" wire:model.debounce.500ms="buyer_credit">
                                                                <option value="">Select one</option>
                                                                <option value="yes">Yes</option>
                                                                <option value="no">No</option>
                                                                <option value="will_consider">Will consider</option>
                                                            </select>
                                                            @error('buyer_credit')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Preferred Purchase agreement<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('purchase_agreement') is-invalid @enderror" wire:model.debounce.500ms="purchase_agreement">
                                                                <option value="">Select one</option>
                                                                <option value="car">CAR Purchase Agreement</option>
                                                                <option value="sfar">SFAR Purchase Agreement</option>
                                                            </select>
                                                            @error('purchase_agreement')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction pt-4">
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStep(2)">
                                            <label class="pe-3">
                                                CONTINUE My Offering
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                        </button>
                                    </div>
                                </section>
                                <section id="my-offering-cont" class="addProperty tab-body entry-content card-box @if($step == 2) active-content active show @else fade @endif">
                                    <div class="row justify-content-end">
                                        <div class="byuyer-fooer-profile text-end">
                                            @include('web.common.notification-profile-icone')
                                            {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        </div>
                                    </div>
                                    <div class="row represented-out">
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in">
                                            <div class="card-box history px-3 py-4 myOfferingCont">
                                                <h6>MY OFFERING (Cont.)</h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Possession<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('possession') is-invalid @enderror" wire:model.debounce.500ms="possession">
                                                                <option value="">Select one</option>
                                                                <option value="close_escrow">Close Of Escrow</option>
                                                                <option value="rent_back">Seller rent back</option>
                                                                <option value="tenant_rights">Tenant's rights</option>
                                                            </select>
                                                            @error('possession')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @if ($possession == 'rent_back')
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Seller Rent Back<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="date" class="feedback-input @error('rent_back_date') is-invalid @enderror" placeholder="Please enter activation date" data-date="" data-date-format="YYYY-MM-DD" wire:model.debounce.500ms="rent_back_date" min="{{date("Y-m-d")}}" id="rent_back_date">
                                                            @error('rent_back_date')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @elseif($possession == 'tenant_rights')
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Tenant rights<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form__radio-group">
                                                                <input type="radio" wire:model.debounce.500ms="tenant_rights" value="topa" id="topa" class="form__radio-input">
                                                                <label class="form__label-radio" for="topa">
                                                                    <span class="form__radio-button"></span>TOPA
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group @error('tenant_rights') feedback-input is-invalid @enderror">
                                                                <input type="radio" wire:model.debounce.500ms="tenant_rights" value="other" id="other" class="form__radio-input">
                                                                <label class="form__label-radio" for="other">
                                                                    <span class="form__radio-button"></span>Other
                                                                </label>
                                                            </div>
                                                            @error('tenant_rights')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Type of property<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('property_type') is-invalid @enderror" wire:model.debounce.500ms="property_type">
                                                                <option value="">Select one</option>
                                                                <option value="single_family">Single Family Dwelling</option>
                                                                <option value="tic">TIC</option>
                                                                <option value="condo">Condo</option>
                                                                <option value="multiunit">Multiunit</option>
                                                            </select>
                                                            @error('property_type')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>HOA fee for preparing disclosures<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('disclosure_hoa_fee') is-invalid @enderror" wire:model.debounce.500ms="disclosure_hoa_fee" @if($singleFamily) disabled @endif>
                                                                @if($singleFamily)
                                                                <option value="N/A" @if($singleFamily) selected @endif>N/A</option>
                                                                @else
                                                                <option value="">Select one</option>
                                                                <option value="N/A">N/A</option>
                                                                <option value="buyer">Buyer</option>
                                                                <option value="seller">Seller</option>
                                                                <option value="50">Seller Buyer 50-50</option>
                                                                @endif
                                                            </select>
                                                            @error('disclosure_hoa_fee')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>HOA Certification fee<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('certification_hoa_fee') is-invalid @enderror" wire:model.debounce.500ms="certification_hoa_fee" @if($singleFamily) disabled @endif>
                                                                @if($singleFamily)
                                                                <option value="N/A" @if($singleFamily) selected @endif>N/A</option>
                                                                @else
                                                                <option value="">Select one</option>
                                                                <option value="N/A">N/A</option>
                                                                <option value="buyer">Buyer</option>
                                                                <option value="seller">Seller</option>
                                                                <option value="50">Seller Buyer 50-50</option>
                                                                @endif
                                                            </select>
                                                            @error('certification_hoa_fee')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>HOA transfer fee</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('hoa_transfer_fee') is-invalid @enderror" wire:model.debounce.500ms="hoa_transfer_fee" @if($singleFamily) disabled @endif>
                                                                @if($singleFamily)
                                                                <option value="N/A" @if($singleFamily) selected @endif>N/A</option>
                                                                @else
                                                                <option value="">Select one</option>
                                                                <option value="N/A">N/A</option>
                                                                <option value="buyer">Buyer</option>
                                                                <option value="seller">Seller</option>
                                                                <option value="50">Seller Buyer 50-50</option>
                                                                @endif
                                                            </select>
                                                            @error('hoa_transfer_fee')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Private transfer fee</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('private_transfer_fee') is-invalid @enderror" wire:model.debounce.500ms="private_transfer_fee">
                                                                <option value="">Select one</option>
                                                                <option value="buyer">Buyer</option>
                                                                <option value="seller">Seller</option>
                                                                <option value="50">Seller Buyer 50-50</option>
                                                            </select>
                                                            @error('private_transfer_fee')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Other fees or costs(describe)</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <select class="feedback-input @error('other_fee') is-invalid @enderror" wire:model.debounce.500ms="other_fee">
                                                                <option value="">Select one</option>
                                                                <option value="N/A">N/A</option>
                                                                <option value="buyer">Buyer</option>
                                                                <option value="seller">Seller</option>
                                                                <option value="50">Seller Buyer 50-50</option>
                                                            </select>
                                                            @error('other_fee')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                            <textarea class="feedback-input mt-2 otherfee_des @if($otherFeeDescribe) d-none @endif @error('other_fee_describe') is-invalid @enderror" placeholder="Please describe other cost" wire:model.debounce.500ms="other_fee_describe" id="otherFeeDescribe" rows="4">{{old('other_fee_describe')}}</textarea>
                                                            @error('other_fee_describe')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in">
                                            <div class="card-box history px-3 pt-4 myOfferingRightPart">
                                                <h6></h6>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow holder<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('escrow_holder') is-invalid @enderror" wire:model.debounce.500ms="escrow_holder" placeholder="Please enter escrow holder" maxlength="50">
                                                            @error('escrow_holder')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow Number<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('escrow_number') is-invalid @enderror" wire:model.debounce.500ms="escrow_number" placeholder="Please enter escrow number" maxlength="10">
                                                            @error('escrow_number')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow officer<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('escrow_officer') is-invalid @enderror" wire:model.debounce.500ms="escrow_officer" placeholder="Please enter name" maxlength="50">
                                                            @error('escrow_officer')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow officer email<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="email" class="feedback-input @error('escrow_officer_email') is-invalid @enderror" wire:model.debounce.500ms="escrow_officer_email" placeholder="Please enter email" maxlength="50">
                                                            @error('escrow_officer_email')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Escrow officer phone number<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="phoneNumber" placeholder="Please enter phone number" value="{{$escrow_officer_phone}}" onblur="changeValue('escrow_officer_phone',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('escrow_officer_phone') is-invalid @enderror" wire:model="escrow_officer_phone" id="escrow_officer_phone">
                                                            @error('escrow_officer_phone')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Transaction coordinator<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('transaction_coordinator') is-invalid @enderror" wire:model.debounce.500ms="transaction_coordinator" placeholder="Please enter name" maxlength="50">
                                                            @error('transaction_coordinator')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Transaction coordinator email<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="feedback-input @error('transaction_coordinator_email') is-invalid @enderror" wire:model.debounce.500ms="transaction_coordinator_email" placeholder="Please enter email" maxlength="50">
                                                            @error('transaction_coordinator_email')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-6">
                                                            <label>Transaction coordinator phone number<span class="text-danger">*</span></label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <input type="text" class="phoneNumber" placeholder="Please enter phone number" value="{{$transaction_coordinator_phone}}" onblur="changeValue('transaction_coordinator_phone',this)" wire:ignore>
                                                            <input type="hidden" class="feedback-input @error('transaction_coordinator_phone') is-invalid @enderror" wire:model="transaction_coordinator_phone" id="transaction_coordinator_phone">
                                                            @error('transaction_coordinator_phone')
                                                            <div class="invalid-feedback text-danger">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction pt-3 myOfferingRightPart">
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStep(3)">
                                            <label class="pe-3">
                                                CONTINUE To Items Included & Excluded
                                            </label>
                                            <img src="{{ asset('web/img/image.png') }}" alt="buyer profile" class="buyerOfferRightArrow">
                                        </button>
                                    </div>
                                </section>
                                <section id="buyer-items-included-excluded" class="tab-body entry-content card-box @if($step == 3) active-content active show @else fade @endif">
                                    <div class="row justify-content-end">
                                        <div class="byuyer-fooer-profile text-end">
                                            @include('web.common.notification-profile-icone')
                                            {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        </div>
                                    </div>
                                    <div class="row represented-out">
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in yes-no-option">
                                            <div class="card-box history px-3 py-4">
                                                <div class="row justify-content-between">
                                                    <h6 class="items-seller-include">PERSONAL PROPERTY INCLUDED IN SALE</h6>
                                                    <span class="modify-yes-no">MODIFY <br> YES&nbsp;&nbsp;&nbsp; N/A&nbsp;&nbsp;&nbsp; NO</span>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Stove(s), oven(s), stove/oven combo(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($stove_oven == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="stove_oven" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($stove_oven == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="stove_oven" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($stove_oven == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="stove_oven" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Refrigerator(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($refrigerator == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="refrigerator" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($refrigerator == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="refrigerator" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($refrigerator == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="refrigerator" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Wine Refrigerator(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($wine_refrigerator == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="wine_refrigerator" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($wine_refrigerator == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="wine_refrigerator" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($wine_refrigerator == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="wine_refrigerator" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Washer(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($washer == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="washer" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($washer == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="washer" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($washer == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="washer" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Dryer(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($dryer == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dryer" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($dryer == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dryer" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($dryer == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dryer" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Dishwasher(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($dishwasher == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dishwasher" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($dishwasher == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dishwasher" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($dishwasher == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="dishwasher" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Microwave(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($microwave == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="microwave" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($microwave == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="microwave" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($microwave == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="microwave" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Video doorbell(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($video_doorbell == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="video_doorbell" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($video_doorbell == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="video_doorbell" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($video_doorbell == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="video_doorbell" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Security camera equipment</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($security_camera == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_camera" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($security_camera == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_camera" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($security_camera == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_camera" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Security system(s)/alarm(s), other than separate video doorbell and camera</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($security_system == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_system" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($security_system == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_system" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($security_system == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="security_system" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Smart home control devices</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($control_devices == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="control_devices" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($control_devices == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="control_devices" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($control_devices == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="control_devices" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Wall mounted brackets for video or audio equipment</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($audio_equipment == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="audio_equipment" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($audio_equipment == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="audio_equipment" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($audio_equipment == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="audio_equipment" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-10 mx-auto represented-in yes-no-option">
                                            <div class="card-box history px-3 py-4 onlyCont">
                                                <div class="row justify-content-between">
                                                    <h6 class="items-seller-include">(Cont.)</h6>
                                                    <span class="modify-yes-no">MODIFY <br> YES&nbsp;&nbsp;&nbsp; N/A&nbsp;&nbsp;&nbsp; NO</span>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Above-ground pool(s) and/or spa(s)</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($ground_pool == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="ground_pool" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($ground_pool == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="ground_pool" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($ground_pool == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="ground_pool" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Bathroom mirrors, unless excluded below</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($bathroom_mrrors == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="bathroom_mrrors" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($bathroom_mrrors == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="bathroom_mrrors" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($bathroom_mrrors == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="bathroom_mrrors" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Electric car charging systems and stations</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($car_charging_system == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="car_charging_system" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($car_charging_system == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="car_charging_system" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($car_charging_system == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="car_charging_system" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center selller-broker">
                                                        <div class="col-md-8">
                                                            <label>Potted trees/shrubs</label>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="button-three-toggle" action="" id="searchTypeToggle">
                                                                <div></div>
                                                                <label class="one @if($potted_trees == 'yes') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="potted_trees" data-location="0" value="yes">
                                                                </label>
                                                                <label class="two @if($potted_trees == 'N/A') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="potted_trees" data-location="calc(100% - 8px)" value="N/A">
                                                                </label>
                                                                <label class="three @if($potted_trees == 'no') selected @endif">
                                                                    <input type="radio" wire:model.debounce.500ms="potted_trees" data-location="calc(200% - 12px)" value="no">
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <h6>ADDITIONAL ITEMS INCLUDED IN SALE</h6>
                                                    <div class="col-md-12">
                                                        <textarea class="@error('additional_items') is-invalid  @enderror" wire:model.debounce.500ms="additional_items" rows="5"></textarea>
                                                        @error('additional_items')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <h6>ITEMS EXCLUDED IN SALE</h6>
                                                    <div class="col-md-12">
                                                        <textarea class="@error('excluded_items') is-invalid  @enderror" wire:model.debounce.500ms="excluded_items" rows="5"></textarea>
                                                        @error('excluded_items')
                                                        <div class="invalid-feedback text-danger">
                                                            {{$message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel text-center continue-transaction pt-3">
                                        <button type="button" class="btn px-5 mx-auto" wire:click="changeStep(3)">Submit</button>
                                    </div>
                                </section>
                            </div>
                        </form>
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

window.addEventListener('move-top', function(event) {
    $('html,body').animate({
        scrollTop: $('.active-content').find('.feedback-input:first').offset().top - 100
    });
})

</script>
