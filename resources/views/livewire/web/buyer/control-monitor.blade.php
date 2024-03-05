<div class="container-flud card-full-cover">
    <div>
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in pe-0 controlMonitorOuter">
                <div class="tabs-container">
                    <div class="tabs-block">
                        <div id="tabs-section" class="tabs contact-form">
                            <ul class="tab-head">
                                <img src="{{ asset('web/img/buyer-dashboard-logo.png') }}" alt="buyer dashboard logo">
                                @if(in_array($user_type,['seller','seller-agent']))
                                <div class="button-grey">
                                    <a href="{{route('seller-dashboard')}}" class="text">
                                        <h6>MY DASHBOARD</h6>
                                    </a>
                                </div>
                                <li>
                                    <a href="{{route('offers')}}" class="tab-link active active-effect"> <span class="material-icons tab-icon">Buyer Offers</span> <span class="tab-label"></span></a>
                                </li>
                                <li>
                                    <a href="{{route('seller-dashboard')}}" class="tab-link"> <span class="material-icons tab-icon">Offer Deadline</span> <span class="tab-label"></span></a>
                                </li>
                                @else
                                <div class="button-grey">
                                    <a href="{{route('buyer-dashboard')}}" class="text">
                                        <h6>MY DASHBOARD</h6>
                                    </a>
                                </div>
                                <li>
                                    <a href="#" class="tab-link">
                                        <span class="material-icons tab-icon">My Offer</span>
                                        <span class="tab-label"></span>
                                    </a>
                                </li>
                                {{-- <li>
                                    <a href="#" class="tab-link"> <span class="material-icons tab-icon">Smart Pricing Strategy</span> <span class="tab-label"></span></a>
                                </li> --}}
                                <li>
                                    <a href="#" class="tab-link active active-effect">
                                        <span class="material-icons tab-icon">History</span>
                                        <span class="tab-label"></span>
                                    </a>
                                </li>
                                @endif
                            </ul>
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content card-box">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end">
                                        @include('web.common.notification-profile-icone')
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                    </div>
                                </div>
                                @if ($monitor != 'yes')
                                <div class="row represented-out">
                                    <x-web-alert wire:ignore.self>
                                    </x-web-alert>
                                    <div class="card-box text-center">
                                        <h2 class="fontWeight700 green-second-heading">Control &amp; Monitor</h2>
                                        <p class="">A simple, fair and transparent experience.</p>
                                        <form wire:submit.prevent="submitoptInOut2">
                                            <div class="row justify-content-center text-start">
                                                <div class="col-md-6">
                                                    <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                {{-- <input type="radio" id="small" class="form__radio-input" value="OPTIN" name="communication" wire:model="type">
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt in</b><br>
                                                                    @if(in_array($user_type,['seller','seller-agent']))
                                                                    Seller elects to control Qonectin "Virtual Agent App" and allow listing agent to monitor offer activities.
                                                                    @else
                                                                    Buyer elects to monitor and controll Qonectin's "Virtual Agent App".
                                                                    @endif
                                                                </label> --}}
                                                                <div class="row">
                                                                    <div class="float-start w-10 text-center">
                                                                        @if($user_type == 'seller')
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTIN" name="communication" wire:model="type">
                                                                        @else
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTOUT" name="communication" wire:model="type">
                                                                        @endif
                                                                        <label class="form__label-radio" for="small">
                                                                            <span class="form__radio-button"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="float-start w-90">
                                                                        <label class="form__label-radio" for="small">
                                                                            <b>Opt in</b><br>
                                                                            @if(in_array($user_type,['seller','seller-agent']))
                                                                            Seller elects to control Qonectin "Virtual Agent App" and allow listing agent to monitor offer activities.
                                                                            @else
                                                                            Buyer elects to monitor and controll Qonectin's "Virtual Agent App".
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" id="small" class="form__radio-input">
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt out - Mode 1</b><br>
                                                                    Buyer elects to surrender control of the app to buyer's agent and only receive/monitor offer activities.
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div> --}}
                                                    <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                {{-- <input type="radio" class="form__radio-input" id="small" value="OPTOUT" name="communication" id="" wire:model="type">
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt out</b><br>
                                                                    @if(in_array($user_type,['seller','seller-agent']))
                                                                    Seller elects to surrender control of the app to listing agent and monitor offer activities.
                                                                    @else
                                                                    Buyer elects not to be informed with offering information or updates.
                                                                    @endif
                                                                </label> --}}

                                                                <div class="row">
                                                                    <div class="float-start w-10 text-center">
                                                                        @if($user_type == 'seller')
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTOUT" name="communication" wire:model="type">
                                                                        @else
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTIN" name="communication" wire:model="type">
                                                                        @endif
                                                                        <label class="form__label-radio" for="small">
                                                                            <span class="form__radio-button"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="float-start w-90">
                                                                        <label class="form__label-radio" for="small">
                                                                            <b>Opt out</b><br>
                                                                            @if(in_array($user_type,['seller','seller-agent']))
                                                                            Seller elects to surrender control of the app to listing agent and monitor offer activities.
                                                                            @else
                                                                            Buyer elects not to be informed with offering information or updates.
                                                                            @endif
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel continue-transaction text-center">
                                    <button class="btn px-5 mx-auto tabs-submit-buttons" @if($user_type=='seller-agent'||$user_type=='buyer-agent') disabled @endif>AGREE & RETURN TO DASHBOARD</button>
                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                                </form>
                                @else
                                <div class="row represented-out">
                                    <x-web-alert wire:ignore.self>
                                    </x-web-alert>
                                    <div class="card-box text-center">
                                        <h2 class="green-second-heading fontWeight700">Control &amp; Monitor</h2>
                                        <p class="">A simple, fair and transparent experience.</p>
                                        <form wire:submit.prevent="submitoptInOut3">
                                            <div class="row justify-content-center text-start">
                                                <div class="col-lg-6 col-md-10 mxauto controlMonitorAgent">
                                                    <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                {{-- @if($user_type == 'buyer')
                                                                 <input type="radio" id="small" class="form__radio-input" value="OPTIN" name="communication" wire:model="type">
                                                                @else
                                                                 <input type="radio" id="small" class="form__radio-input" value="OPTOUT" name="communication" wire:model="type">
                                                                @endif
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt in</b><br>
                                                                    Buyer elects to control Qonectin "Virtual Agent App" and allow buyer's agent to monitor offer activities.
                                                                </label> --}}

                                                                <div class="row">
                                                                    <div class="float-start w-10 text-center">
                                                                        @if($user_type == 'buyer')
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTIN" name="communication" wire:model="type">
                                                                        @else
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTOUT" name="communication" wire:model="type">
                                                                        @endif
                                                                        <label class="form__label-radio" for="small">
                                                                            <span class="form__radio-button"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="float-start w-90">
                                                                        <label class="form__label-radio" for="small">
                                                                            <b>Opt in</b><br>
                                                                            Buyer elects to control Qonectin "Virtual Agent App" and allow buyer's agent to monitor offer activities.
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                {{-- @if($user_type == 'buyer')
                                                                <input type="radio" id="small" class="form__radio-input" value="OPTOUTMODE1" name="communication" wire:model="type">
                                                                @else
                                                                <input type="radio" id="small" class="form__radio-input" value="OPTINMODE1" name="communication" wire:model="type">
                                                                @endif
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt out - Mode 1</b><br>
                                                                    Buyer elects to surrender control of the app to buyer's agent and only receive/monitor offer activities.
                                                                </label> --}}

                                                                <div class="row">
                                                                    <div class="float-start w-10 text-center">
                                                                        @if($user_type == 'buyer')
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTOUTMODE1" name="communication" wire:model="type">
                                                                        @else
                                                                        <input type="radio" id="small" class="form__radio-input" value="OPTINMODE1" name="communication" wire:model="type">
                                                                        @endif
                                                                        <label class="form__label-radio" for="small">
                                                                            <span class="form__radio-button"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="float-start w-90">
                                                                        <label class="form__label-radio" for="small">
                                                                            <b>Opt out - Mode 1</b><br>
                                                                            Buyer elects to surrender control of the app to buyer's agent and only receive/monitor offer activities.
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="card-box">
                                                        <div class="form__group">
                                                            <div class="form__radio-group">
                                                                {{-- @if($user_type == 'buyer')
                                                                <input type="radio" class="form__radio-input" id="small" value="OPTOUTMODE2" name="communication" id="" wire:model="type">
                                                                @else
                                                                <input type="radio" class="form__radio-input" id="small" value="OPTINMODE2" name="communication" id="" wire:model="type">
                                                                @endif
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> <b>Opt out - Mode 2</b><br>
                                                                    Buyer elects not to be informed with offering information or updates.
                                                                </label> --}}
                                                                <div class="row">
                                                                    <div class="float-start w-10 text-center">
                                                                        @if($user_type == 'buyer')
                                                                        <input type="radio" class="form__radio-input" id="small" value="OPTOUTMODE2" name="communication" id="" wire:model="type">
                                                                        @else
                                                                        <input type="radio" class="form__radio-input" id="small" value="OPTINMODE2" name="communication" id="" wire:model="type">
                                                                        @endif
                                                                        <label class="form__label-radio" for="small">
                                                                            <span class="form__radio-button"></span>
                                                                        </label>
                                                                    </div>
                                                                    <div class="float-start w-90">
                                                                        <label class="form__label-radio" for="small">
                                                                            <b>Opt out - Mode 2</b><br>
                                                                            Buyer elects not to be informed with offering information or updates.
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    </div>
                                </div>
                                    <div class="bottomButtonPanel continue-transaction text-center pt-3">
                                        <button class="btn px-5 mx-auto tabs-submit-buttons" @if($user_type=='seller-agent'||$user_type=='buyer-agent') disabled @endif>AGREE & RETURN TO DASHBOARD</button>
                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </form>
                                @endif
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
