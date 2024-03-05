<div>
    <div class="container-flud create-account banner-main">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 z95">
                    <h2 class="second-heading">Confirm Your email</h2>
                    {{-- <p class="contact-alert">We got you. We'll send an email with a validation code.</p> --}}
                    <form wire:submit.prevent="ConfirmEmail">
                        {{-- @if(Session::has('error'))
                        <div class="error">{{Session::get('error')}}</div>
                        @endif --}}
                        <div class="searchformfld form-group">
                            <input name="email" type="text" class="feedback-input @error('email') is-invalid @enderror " placeholder=" " wire:model.debounce.500ms="email" id="candidateName"/>
                            <label for="candidateName">Email<span class="text-danger">*</span></label>
                            @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <button class="btn contact-form-submit" type="submit">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
