
<div class="container-flud card-full-cover">
    <div class="">
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
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png ')}}" alt="buyer profile"> --}}
                                        @include('web.common.notification-profile-icone')
                                    </div>
                                </div>
                                <form wire:submit.prevent="submitOfferInterest">
                                    <div class="row represented-out">
                                        <div class="card-box text-center OfferOfInterest">
                                            <h2 class="green-second-heading mb-4">Offer of Interest</h2>
                                            <div class="row justify-content-center">
                                                <div class="col-md-6">
                                                    <div class="white-box p-3 bRadius20">
                                                        <label class="green-label">Your offer is important to us. The seller has placed your offer in a preferred category and requires more information to process. The seller's agent wants to contact you or your agent.</label>
                                                    </div>
                                                    <div class="innerShadow card-box bg-white">
                                                        <label class="mb-2">My preferred method of communication<span class="text-danger">*</span>:</label>
                                                        <div class="form__group text-center represented-in">
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" id="small" value="phone" class="form__radio-input @error('type') is-invalid @enderror" name="communication" id="" wire:model="type" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="small">
                                                                    <span class="form__radio-button"></span> Call
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" id="large" value="text" class="form__radio-input @error('type') is-invalid @enderror" name="communication" id="" wire:model="type" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="large">
                                                                    <span class="form__radio-button"></span> Text
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="large1" value="email" class="form__radio-input @error('type') is-invalid @enderror" name="communication" id="" wire:model="type" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="large1">
                                                                    <span class="form__radio-button"></span> Email
                                                                </label>
                                                            </div>
                                                            @error('type') <div class="invalid-feedback text-danger d-block">{{ $message }}</div>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    @if($hidden == 1)
                                                    <div class="innerShadow card-box bg-white">
                                                        <label class="mb-2">My preferred time of communication<span class="text-danger">*</span>:</label>
                                                        <div class="form__group text-start represented-in">
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" name="size" value="9-12" id="small1" class="form__radio-input" wire:model="time" >
                                                                <label class="form__label-radio" for="small1">
                                                                    <span class="form__radio-button"></span> 9am-12pm
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" name="size" value="12-3" id="large4" class="form__radio-input @error('time') is-invalid @enderror" wire:model="time" >
                                                                <label class="form__label-radio" for="large4">
                                                                    <span class="form__radio-button"></span> 12-3 PM
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" name="size" value="3-6" id="large5" class="form__radio-input @error('time') is-invalid @enderror" wire:model="time" >
                                                                <label class="form__label-radio" for="large5">
                                                                    <span class="form__radio-button"></span> 3-6 PM
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group pe-2">
                                                                <input type="radio" name="size" value="anytime" id="large6" class="form__radio-input @error('time') is-invalid @enderror" wire:model="time" >
                                                                <label class="form__label-radio" for="large6">
                                                                    <span class="form__radio-button"></span> Anytime
                                                                </label>
                                                            </div>
                                                            @error('time')
                                                            <div class="invalid-feedback text-danger d-block">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror
                                                            {{-- <div class="form__radio-group">
                                                                <input type="radio" name="size" value="3-6" id="large5" class="form__radio-input @error('time') is-invalid @enderror" wire:model="time">
                                                                <label class="form__label-radio" for="large5">
                                                                    <span class="form__radio-button"></span> 3-6 PM
                                                                </label>
                                                            </div>
                                                            <div class="form__radio-group">
                                                                <input type="radio" name="size" value="anytime" id="large6" class="form__radio-input @error('time') is-invalid @enderror" wire:model="time">
                                                                <label class="form__label-radio" for="large6">
                                                                    <span class="form__radio-button"></span> Anytime
                                                                </label>
                                                            </div> --}}
                                                            {{-- @error('time')
                                                            <div class="invalid-feedback text-danger d-block">
                                                                {{ $message }}
                                                            </div>
                                                            @enderror --}}
                                                        </div>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bottomButtonPanel continue-transaction text-center">
                                        <button class="btn  px-5 mx-auto" @if($this->control_mode == 0) disabled @endif>CONTACT ME</button>
                                        <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5>BACK TO MAIN DASHBOARD</h5></a>
                                        <div class="agent-mode-help">
                                            <a class="button-grey" href="#">Help</a>
                                        </div>
                                    </div>
                                </form>
                            </section>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
