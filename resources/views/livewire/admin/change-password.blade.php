<div>
    <x-alert>
    </x-alert>
    <form class="kt-form kt-form--label-right" wire:submit.prevent="submitChanges">
        <div class="kt-portlet__body">
            <div class="kt-section kt-section--first">
                <div class="kt-section__body">
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">
                            Current Password
                        </label>
                        <div class="col-lg-6 col-xl-6">
                            <input class="form-control @error('current_password') is-invalid @enderror" placeholder="Current password" type="password" wire:model="current_password">
                                <a class="kt-link kt-font-sm kt-font-bold kt-margin-t-5" href="{{route('forgot')}}">
                                    Forgot password ?
                                </a>
                            </input>
                            @error('current_password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-xl-3 col-lg-3 col-form-label">
                            New Password
                        </label>
                        <div class="col-lg-6 col-xl-6">
                            <input class="form-control @error('password') is-invalid @enderror" placeholder="New password" type="password" wire:model="password">
                            </input>
                            @error('password')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group form-group-last row">
                        <label class="col-xl-3 col-lg-3 col-form-label">
                            Verify Password
                        </label>
                        <div class="col-lg-6 col-xl-6">
                            <input class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Verify password" type="password" wire:model="password_confirmation">
                            </input>
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="kt-portlet__foot">
            <div class="kt-form__actions">
                <div class="row">
                    <div class="col-lg-3 col-xl-3">
                    </div>
                    <div class="col-lg-6 col-xl-6">
                        <button class="btn btn-brand btn-bold" type="submit">
                            Change Password
                        </button>
                        <a class="btn btn-secondary" href="{{route('index')}}" type="reset">
                            Cancel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
