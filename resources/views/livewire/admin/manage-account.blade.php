<div>
    <link rel="stylesheet" type="text/css" href="{{asset('css/wizard/wizard-2.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/intlTelInput.css')}}">
    <x-alert>
    </x-alert>
    <div class="row">
        <div class="col-md-3">
            <div class="kt-portlet border-right border-secondary h-100">
                <div class="kt-portlet__body p-0">
                    <!--begin::Section-->
                    <div class="kt-section mb-0 listing-wizard">
                        <div class="kt-section__content kt-section__content--fit">
                            <ul class="kt-nav kt-nav--bold kt-nav--md-space kt-nav--v3 p-0" role="tablist">
                                <li class="kt-nav__item @if($screen == 'personal') active @endif">
                                    <a class="kt-nav__link @if($screen == 'personal') active @endif" data-toggle="tab" href="javascript:;" wire:click="openTab('personal',1)">
                                        <span class="kt-nav__link-text">Add Personal Details
                                            @if(isset($user->name))
                                            <br>
                                            <span class="text-theme font-10">{{ucwords($user->name)}}</span>
                                            @endif
                                        </span> @if($steps_completed>1) <i class="fa fa-check-circle text-theme"></i> @endif
                                    </a>
                                </li>
                                <li class="kt-nav__item @if($screen == 'permission') active @endif">
                                    <a class="kt-nav__link @if($screen == 'permission') active @endif" data-toggle="tab" href="javascript:;" wire:click="openTab('permission',2)">
                                        <span class="kt-nav__link-text">Add Permissions
                                            @if(isset($user->permissions) && count($user->permissions)>0)
                                            <br>
                                            <span class="text-theme font-10">{{ucwords(str_replace('_', ' ', implode(', ', $user->permissions()->select(DB::Raw('distinct vms_model_has_permissions.module'))->pluck('module')->toArray())))}}</span>
                                            @endif
                                        </span> @if($steps_completed>2) <i class="fa fa-check-circle text-theme"></i> @endif
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!--end::Section-->
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="tab-content">
                <div class="tab-pane @if($screen == 'personal') active @endif" role="tabpanel">
                    <form class="kt-form kt-form--label-right" wire:submit.prevent="moveToNextStep(2)">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Name
                                        </label>
                                        <div class="col-lg-6 col-xl-6">
                                            <input class="form-control @error('step1.name') is-invalid @enderror" placeholder="Name"
                                                type="text" wire:model="step1.name" maxlength="100"/>
                                            @error('step1.name')
                                                <em class="error invalid-feedback" id="{{ 'step1.name' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Mobile Number
                                        </label>
                                        <div class="col-lg-6 col-xl-6 @error('step1.mobile_number') is-invalid-div @enderror">
                                            <div wire:ignore>
                                                <input class="form-control numberInput @error('step1.mobile_number') is-invalid @enderror" placeholder="Mobile Number" type="text" maxlength="15" minlength="8" id="phone"/>
                                            </div>
                                            <input type="hidden" class="form-control @error('step1.mobile_number') is-invalid @enderror" id="mobile" wire:model="step1.mobile_number">
                                            @error('step1.mobile_number')
                                                <em class="error invalid-feedback" id="{{ 'step1.mobile_number' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Email Address
                                        </label>
                                        <div class="col-lg-6 col-xl-6">
                                            <input class="form-control @error('step1.email') is-invalid @enderror" placeholder="Email Address"
                                                type="email" wire:model="step1.email" maxlength="200"/>
                                            @error('step1.email')
                                                <em class="error invalid-feedback" id="{{ 'step1.email' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Password
                                        </label>
                                        <div class="col-lg-6 col-xl-6">
                                            <input class="form-control @error('step1.password') is-invalid @enderror" placeholder="*********"
                                                type="password" wire:model="step1.password" maxlength="200"/>
                                            @error('step1.password')
                                                <em class="error invalid-feedback" id="{{ 'step1.password' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Confirm Password
                                        </label>
                                        <div class="col-lg-6 col-xl-6">
                                            <input class="form-control @error('step1.password_confirmation') is-invalid @enderror" placeholder="*********"
                                                type="password" wire:model="step1.password_confirmation" maxlength="200"/>
                                            @error('step1.password_confirmation')
                                                <em class="error invalid-feedback" id="{{ 'step1.password_confirmation' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label">
                                            Description
                                        </label>
                                        <div class="col-lg-6 col-xl-6">
                                            <textarea class="form-control @error('step1.description') is-invalid @enderror"  wire:model="step1.description" rows="5">{{old('step1.description')}}</textarea>
                                            @error('step1.description')
                                                <em class="error invalid-feedback" id="{{ 'step1.description' }}-error">
                                                    {{ $message }}
                                                </em>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="text-right">
                                    <button class="btn btn-primary btn-bold" type="submit">
                                        Next
                                    </button>
                                    <a class="btn btn-secondary" type="reset" href="{{ url(URL::previous()) }}">
                                        Cancel
                                    </a>
                                </div>
                            </div>
                        </div>
                    </fo    rm>
                </div>
                <div class="tab-pane @if($screen == 'permission') active @endif" role="tabpanel">
                    <form class="kt-form kt-form--label-right" wire:submit.prevent="saveUpdates">
                        <div class="kt-portlet__body">
                            <div class="kt-section kt-section--first">
                                <div class="kt-section__body">
                                    <div class="form-group row">
                                        <label class="col-xl-3 col-lg-3 col-form-label required">
                                            Assign Modules
                                        </label>
                                        <div class="col-lg-8 col-xl-8 m-3 p-1">
                                            @foreach(config()->get('constants.modules') as $key => $value)
                                                <h5>{{$value['name']}}</h5>
                                                <div class="kt-checkbox-inline mb-3">
                                                    @foreach($value['actions'] as $action)
                                                        <label class="kt-checkbox">
                                                            <input type="checkbox" wire:model="step2.permissions.{{$key}}.{{$action}}" value="1" data-val="{{$key}}.{{$action}}" class="@if($action=='list') listaction @else otheraction @endif" @if($action=='list' && isset($step2['permissions'][$key]) && count($step2['permissions'][$key]) > 1)  onclick="return false" @endif> {{ucwords($action)}}
                                                            <span></span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                        <input type="hidden" wire:model="step2.permissions" class="form-control">
                                        @error('step2.permissions')
                                            <em class="error invalid-feedback" id="{{ 'step2.name' }}-error">
                                                {{ $message }}
                                            </em>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="kt-portlet__foot">
                            <div class="kt-form__actions">
                                <div class="text-right">
                                    <button class="btn btn-primary btn-bold" type="submit">
                                        Submit
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="{{asset('js/intlTelInput.js')}}"></script>
<script type="text/javascript">
    window.addEventListener('checkMobile', function(event){

        if($('#mobile').hasClass('is-invalid'))
            $('#phone').addClass('is-invalid');
        else
            $('#phone').removeClass('is-invalid');
    })

    $(document).ready(function(){

        var input = document.querySelector("#phone");

        var iti = window.intlTelInput(input);

        @if($type=='edit')
        iti.setCountry(iti._getCountryDataCode("{{$step1['country_code']}}").iso2);
        @endif

        input.addEventListener("countrychange", function() {
            @this.set('step1.country_code',iti.getSelectedCountryData().dialCode)
            @this.set('step1.country_iso',iti.getSelectedCountryData().iso2)
        });

        $(document).on('input','#phone',function(){
            @this.set('step1.mobile_number',$(this).val());
        })

        $(document).find("#phone").val(@this.get('step1.mobile_number'));

    });

</script>
