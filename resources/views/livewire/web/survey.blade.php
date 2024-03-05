<div class="container-flud card-full-cover surveyPage">
    <div class="container">
        <div class="row card-box buyer-offer-dashboard">
            <section class="tabs-wrapper buyer-offer-dashboard-in">
                <div class="tabs-container">
                    <div class="tabs-block">
                            <section id="buyer-my-offer" class="tab-body entry-content active active-content pb-4">
                                <div class="row justify-content-end">
                                    <div class="byuyer-fooer-profile text-end p-3 ">
                                        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
                                        {{-- @include('web.common.notification-profile-icone') --}}
                                    </div>
                                </div>
                                <!-- for desktop view -->
                                <div class="d-none d-md-block">
                                    <div class="row represented-out">
                                        <div class="col-lg-6 col-md-8 mx-auto represented-in">
                                            <div class="card-box history px-4 py-3">
                                                <h6 class="weight700">SURVEY</h6>
                                                <div class="white-box py-1 px-3">
                                                    <label class="green-label">We enjoyed working with you and appreciate your feedback to help us improve and serve you better. Tell us about your experience.</label>
                                                </div>
                                                <div class="row action-head m-0 justify-content-end">
                                                    <div class="survey-feed-head text-center">
                                                        <h3>STRONGLY DISAGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center ">
                                                        <h3>DISAGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>NEUTRAL</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>AGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>STRONGLY AGREE</h3>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">User friendly</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center px-0">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly1" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="1" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center px-0">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly2" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="2" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center px-0">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly3" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="3" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly3" value="">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center px-0">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly4" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="4" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly5" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="5" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('user_friendly')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Enjoyed the experience</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience1" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="1" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience2" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="2" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience3" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="3" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience4" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="4" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience5" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="5" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('enjoyed_experience')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Convenient</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience1" class="form__radio-input @error('convenience') is-invalid @enderror" value="1" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience2" class="form__radio-input @error('convenience') is-invalid @enderror" value="2" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience3" class="form__radio-input @error('convenience') is-invalid @enderror" value="3" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience4" class="form__radio-input @error('convenience') is-invalid @enderror" value="4" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience5" class="form__radio-input @error('convenience') is-invalid @enderror" value="5" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('convenience')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Complicated</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated1" class="form__radio-input @error('complicated') is-invalid @enderror" value="1" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated2" class="form__radio-input @error('complicated') is-invalid @enderror" value="2" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated3" class="form__radio-input @error('complicated') is-invalid @enderror" value="3" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated4" class="form__radio-input @error('complicated') is-invalid @enderror" value="4" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated5" class="form__radio-input @error('complicated') is-invalid @enderror" value="5" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('complicated')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Exciting</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting1" class="form__radio-input @error('exiting') is-invalid @enderror" value="1" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting2" class="form__radio-input @error('exiting') is-invalid @enderror" value="2" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting3" class="form__radio-input @error('exiting') is-invalid @enderror" value="3" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting4" class="form__radio-input @error('exiting') is-invalid @enderror" value="4" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting5" class="form__radio-input @error('exiting') is-invalid @enderror" value="5" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('exiting')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Intrusive</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive1" class="form__radio-input @error('intrusive') is-invalid @enderror" value="1" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive2" class="form__radio-input @error('intrusive') is-invalid @enderror" value="2" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive3" class="form__radio-input @error('intrusive') is-invalid @enderror" value="3" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive4" class="form__radio-input @error('intrusive') is-invalid @enderror" value="4" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive5" class="form__radio-input @error('intrusive') is-invalid @enderror" value="5" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('intrusive')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Kept me informed</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed1" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="1" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed2" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="2" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed3" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="3" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed4" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="4" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed5" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="5" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_informed')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Kept me in control</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control1" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="1" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control2" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="2" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control3" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="3" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control4" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="4" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control5" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="5" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_control')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Kept me focused</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused1" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="1" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused2" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="2" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused3" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="3" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused4" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="4" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused5" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="5" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_focused')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-8 mx-auto represented-in">
                                            <div class="card-box history cHeight p-3">
                                                <div class="row action-head m-0 justify-content-end pt-5">
                                                    <div class="survey-feed-head text-center">
                                                        <h3>STRONGLY DISAGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>DISAGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>NEUTRAL</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>AGREE</h3>
                                                    </div>
                                                    <div class="survey-feed-head text-center">
                                                        <h3>STRONGLY AGREE</h3>
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Found value</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value1" class="form__radio-input @error('found_value') is-invalid @enderror" value="1" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value2" class="form__radio-input @error('found_value') is-invalid @enderror" value="2" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value3" class="form__radio-input @error('found_value') is-invalid @enderror" value="3" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value4" class="form__radio-input @error('found_value') is-invalid @enderror" value="4" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value5" class="form__radio-input @error('found_value') is-invalid @enderror" value="5" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('found_value')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Would use again</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again1" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="1" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again2" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="2" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again3" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="3" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again4" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="4" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again5" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="5" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('will_use_it_again')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Would recommend</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend1" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="1" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend2" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="2" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend3" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="3" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend4" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="4" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend5" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="5" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('will_recommend')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Transparent</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency1" class="form__radio-input @error('transparency') is-invalid @enderror" value="1" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency2" class="form__radio-input @error('transparency') is-invalid @enderror" value="2" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency3" class="form__radio-input @error('transparency') is-invalid @enderror" value="3" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency4" class="form__radio-input @error('transparency') is-invalid @enderror" value="4" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency5" class="form__radio-input @error('transparency') is-invalid @enderror" value="5" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('transparency')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Fair</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness1" class="form__radio-input @error('fairness') is-invalid @enderror" value="1" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness2" class="form__radio-input @error('fairness') is-invalid @enderror" value="2" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness3" class="form__radio-input @error('fairness') is-invalid @enderror" value="3" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness4" class="form__radio-input @error('fairness') is-invalid @enderror" value="4" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness5" class="form__radio-input @error('fairness') is-invalid @enderror" value="5" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('fairness')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Inclusive</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness1" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="1" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness2" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="2" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness3" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="3" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness4" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="4" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness5" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="5" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('inclusiveness')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">A better way</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way1" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="1" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way2" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="2" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way3" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="3" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way4" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="4" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way5" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="5" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('a_better_way')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-3">
                                                            <label class="weight700">Reduces frictions</label>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions1" class="form__radio-input @error('frictions') is-invalid @enderror" value="1" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions1">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions2" class="form__radio-input @error('frictions') is-invalid @enderror" value="2" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions2">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions3" class="form__radio-input @error('frictions') is-invalid @enderror" value="3" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions3">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions4" class="form__radio-input @error('frictions') is-invalid @enderror" value="4" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions4">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        <div class="survey-feed-head text-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions5" class="form__radio-input @error('frictions') is-invalid @enderror" value="5" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions5">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                        @error('frictions')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- for mobile view -->
                                <div class="d-md-none d-sm-block">
                                    <div class="row represented-out">
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history">
                                                <h6>SURVEY</h6>
                                                <div class="white-box">
                                                    <label class="green-label">We enjoyed working with you and appreciate your feedback to help us improve and serve you better. Tell us about your experience.</label>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>User friendly</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly1m" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="1" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly2m" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="2" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly3m" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="3" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly4m" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="4" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="user_friendly5m" class="form__radio-input @error('user_friendly') is-invalid @enderror" value="5" wire:model="user_friendly" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="user_friendly5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('user_friendly')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 represented-in">
                                            <div class="card-box history">
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Enjoyed the experience</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience1m" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="1" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience2m" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="2" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience3m" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="3" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience4m" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="4" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="enjoyed_experience5m" class="form__radio-input @error('enjoyed_experience') is-invalid @enderror" value="5" wire:model="enjoyed_experience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="enjoyed_experience5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('enjoyed_experience')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Convenient</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience1m" class="form__radio-input @error('convenience') is-invalid @enderror" value="1" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience2m" class="form__radio-input @error('convenience') is-invalid @enderror" value="2" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience3m" class="form__radio-input @error('convenience') is-invalid @enderror" value="3" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience4m" class="form__radio-input @error('convenience') is-invalid @enderror" value="4" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="convenience5m" class="form__radio-input @error('convenience') is-invalid @enderror" value="5" wire:model="convenience" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="convenience5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('convenience')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Complicated </label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated1m" class="form__radio-input @error('complicated') is-invalid @enderror" value="1" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated2m" class="form__radio-input @error('complicated') is-invalid @enderror" value="2" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated3m" class="form__radio-input @error('complicated') is-invalid @enderror" value="3" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated4m" class="form__radio-input @error('complicated') is-invalid @enderror" value="4" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="complicated5m" class="form__radio-input @error('complicated') is-invalid @enderror" value="5" wire:model="complicated" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="complicated5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('complicated')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Exciting</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting1m" class="form__radio-input @error('exiting') is-invalid @enderror" value="1" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting2m" class="form__radio-input @error('exiting') is-invalid @enderror" value="2" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting3m" class="form__radio-input @error('exiting') is-invalid @enderror" value="3" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting4m" class="form__radio-input @error('exiting') is-invalid @enderror" value="4" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="exiting5m" class="form__radio-input @error('exiting') is-invalid @enderror" value="5" wire:model="exiting" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="exiting5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('exiting')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Intrusive</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive1m" class="form__radio-input @error('intrusive') is-invalid @enderror" value="1" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive2m" class="form__radio-input @error('intrusive') is-invalid @enderror" value="2" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive3m" class="form__radio-input @error('intrusive') is-invalid @enderror" value="3" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive4m" class="form__radio-input @error('intrusive') is-invalid @enderror" value="4" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="intrusive5m" class="form__radio-input @error('intrusive') is-invalid @enderror" value="5" wire:model="intrusive" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="intrusive5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('intrusive')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Kept me informed</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed1m" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="1" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed2m" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="2" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed3m" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="3" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed4m" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="4" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_informed5m" class="form__radio-input @error('kept_me_informed') is-invalid @enderror" value="5" wire:model="kept_me_informed" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_informed5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_informed')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Kept me in control</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control1m" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="1" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control2m" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="2" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control3m" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="3" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control4m" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="4" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_control5m" class="form__radio-input @error('kept_me_control') is-invalid @enderror" value="5" wire:model="kept_me_control" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_control5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_control')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Kept me focused</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused1m" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="1" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused2m" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="2" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused3m" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="3" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused4m" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="4" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="kept_me_focused5m" class="form__radio-input @error('kept_me_focused') is-invalid @enderror" value="5" wire:model="kept_me_focused" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="kept_me_focused5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('kept_me_focused')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Found value</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value1m" class="form__radio-input @error('found_value') is-invalid @enderror" value="1" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value2m" class="form__radio-input @error('found_value') is-invalid @enderror" value="2" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value3m" class="form__radio-input @error('found_value') is-invalid @enderror" value="3" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value4m" class="form__radio-input @error('found_value') is-invalid @enderror" value="4" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="found_value5m" class="form__radio-input @error('found_value') is-invalid @enderror" value="5" wire:model="found_value" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="found_value5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('found_value')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Would use again</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again1m" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="1" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again2m" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="2" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again3m" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="3" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again4m" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="4" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_use_it_again5m" class="form__radio-input @error('will_use_it_again') is-invalid @enderror" value="5" wire:model="will_use_it_again" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_use_it_again5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('will_use_it_again')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Would recommend</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend1m" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="1" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend2m" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="2" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend3m" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="3" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend4m" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="4" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="will_recommend5m" class="form__radio-input @error('will_recommend') is-invalid @enderror" value="5" wire:model="will_recommend" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="will_recommend5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('will_recommend')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Transparent</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency1m" class="form__radio-input @error('transparency') is-invalid @enderror" value="1" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency2m" class="form__radio-input @error('transparency') is-invalid @enderror" value="2" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency3m" class="form__radio-input @error('transparency') is-invalid @enderror" value="3" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency4m" class="form__radio-input @error('transparency') is-invalid @enderror" value="4" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="transparency5m" class="form__radio-input @error('transparency') is-invalid @enderror" value="5" wire:model="transparency" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="transparency5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('transparency')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Fair</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness1m" class="form__radio-input @error('fairness') is-invalid @enderror" value="1" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness2m" class="form__radio-input @error('fairness') is-invalid @enderror" value="2" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness3m" class="form__radio-input @error('fairness') is-invalid @enderror" value="3" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness4m" class="form__radio-input @error('fairness') is-invalid @enderror" value="4" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="fairness5m" class="form__radio-input @error('fairness') is-invalid @enderror" value="5" wire:model="fairness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="fairness5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('fairness')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Inclusive</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness1m" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="1" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness2m" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="2" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness3m" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="3" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness4m" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="4" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="inclusiveness5m" class="form__radio-input @error('inclusiveness') is-invalid @enderror" value="5" wire:model="inclusiveness" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="inclusiveness5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('inclusiveness')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>A better way</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way1m" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="1" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way2m" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="2" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way3m" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="3" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way4m" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="4" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="a_better_way5m" class="form__radio-input @error('a_better_way') is-invalid @enderror" value="5" wire:model="a_better_way" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="a_better_way5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('a_better_way')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="card-box history">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-12">
                                                            <label>Reduces frictions</label>
                                                        </div>
                                                        <div class="row align-items-center">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions1m" class="form__radio-input @error('frictions') is-invalid @enderror" value="1" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions1m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions2m" class="form__radio-input @error('frictions') is-invalid @enderror" value="2" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions2m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">DISAGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions3m" class="form__radio-input @error('frictions') is-invalid @enderror" value="3" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions3m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">NEUTRAL</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions4m" class="form__radio-input @error('frictions') is-invalid @enderror" value="4" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions4m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">AGREE</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="form__radio-group">
                                                                <input type="radio" id="frictions5m" class="form__radio-input @error('frictions') is-invalid @enderror" value="5" wire:model="frictions" @if($this->control_mode == 0) disabled @endif>
                                                                <label class="form__label-radio" for="frictions5m">
                                                                    <span class="form__radio-button"></span>
                                                                </label>
                                                                <label class="survey-feed-dis">STRONGLY AGREE</label>
                                                            </div>
                                                        </div>
                                                        @error('frictions')
                                                        <div class="invalid-feedback text-danger d-block">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="bottomButtonPanel text-center continue-transaction pt-2">
                                    <button class="btn tabs-submit-buttons px-5 mx-auto" type="submit" wire:click="submitSurvey" @if($this->control_mode == 0) disabled @endif>SUBMIT</button>

                                    {{-- <a href="{{ route('buyer-dashboard') }}" class="text @if($this->control_mode == 0) disabled @endif "><h5 class="ms-3" >BACK TO MAIN DASHBOARD</h5></a> --}}

                                    <div class="agent-mode-help">
                                        <a class="button-grey" href="#">Help</a>
                                    </div>
                                </div>
                            </section>
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
