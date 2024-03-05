<div>
    <div class="container-flud create-account banner-main {{ $forgetPassword }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 z95">
                    <h2 class="second-heading mb-1 forgotpasswordHead ">Forgot your password?</h2>
                    <p class="contact-alert mb-4">We got you. We'll send an email with a validation code.</p>
                    <form wire:submit.prevent="submitForgetPasswordForm">
                        <x-web-alert>
                        </x-web-alert>
                        <div class="form-group forgotpassword create-account position-relative mb-0">
                            {{-- <label class="greenText position-absolute labelText dNone">Email</label>
                            <input name="email" type="text" class="feedback-input @error('email') is-invalid @enderror " placeholder="Email*" wire:model="email" />
                            <label class="position-absolute regExpIcon dNone @error('email') is-valid @else  @enderror">
                                <img src="{{ asset('web/img/invalid.png') }}" alt="">
                            </label>
                            <label class="position-absolute regExpIcon dNone @error('email')  @else @if(!empty($email)) is-valid  @endif @enderror">
                                <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                            </label>
                            @error('email')
                            <div class="invalid-feedback position-absolute errorMsg text-start">{{$message}}</div>
                            @enderror --}}

                            <div class="searchformfld my-3 px-0">
                                <input type="text" class="candidateName @error('email') is-invalid @enderror" id="candidateName" name="candidateName" placeholder=" " wire:model="email"/>
                                <label for="candidateName">Email<span class="text-danger">*</span></label>

                                @error('email')
                                <p class="invalid-feedback errorMsg text-start">{{$message}}</p>
                                @enderror
                            </div>
                            <label class="position-absolute regExpIconEmail dNone @error('email') is-valid @else  @enderror">
                                <img src="{{ asset('web/img/invalid.png') }}" alt="">
                            </label>
                            <label class="position-absolute regExpIconEmail dNone @error('email')  @else @if(!empty($email)) is-valid  @endif @enderror">
                                <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                            </label>
                        </div>
                        <button class="btn btnmargin contact-form-submit " type="submit">SEND CODE</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-flud create-account welcome-main banner-main {{ $verifyOtp }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 z95">
                    <h2 class="second-heading">Welcome back!</h2>
                    <p class="contact-alert">Type in the validation code we sent you. Didn't get one? We'll <a href="JavaScript:void(0);" wire:click="resendOtp">resend</a>.</p>
                    <form wire:submit.prevent="verifyOTP">
                        <x-web-alert>
                        </x-web-alert>
                        <div class="input-otp">
                            <input type="text" wire:model.defer="otp.1" autocomplete="off" id="first" class="form-control otp otp-input numberInput " maxlength="1" autofocus="" required>
                            <input type="text" wire:model.defer="otp.2" autocomplete="off" id="second" class="form-control otp otp-input numberInput" maxlength="1" required>
                            <input type="text" wire:model.defer="otp.3" autocomplete="off" id="fourth" class="form-control otp otp-input numberInput" maxlength="1" required>
                            <input type="text" wire:model="otp.4" autocomplete="off" id="fifth" class="form-control otp otp-input numberInput" maxlength="1" required>
                        </div>
                        <button class="btn contact-form-submit" type="submit">Enter Now</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container-flud create-account banner-main {{ $verifyPassword }}">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-4 z95 newPassword">
                    <h2 class="second-heading">Create your new password !</h2>
                    <form wire:submit.prevent="newPassword">
                        <div class="searchformfld form-group">
                            <input name="" type="password" class="feedback-input @error('password') is-invalid @enderror " placeholder=" " wire:model="password" autocomplete="current-password" id="pwd" />
                            <label for="pwd">New password<span class="text-danger">*</span></label>
                            @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="searchformfld form-group">
                            <input name="password_confirmation" type="password" class="feedback-input @error('confirmpassword') is-invalid @enderror " placeholder=" " wire:model="confirmpassword" autocomplete="current-password" id="cfrm" required />
                            <label for="cfrm">Confirm password<span class="text-danger">*</span></label>
                            @error('confirmpassword')
                            <div class="invalid-feedback">{{$message}}</div>
                            @enderror
                        </div>
                        <button class="btn contact-form-submit" type="submit">Reset</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).on("keyup", ".otp", function(e) {
    if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
        $(e.target).next('.otp').focus();
    } else if (e.which == 8) {
        $(e.target).prev('.otp').focus();
    }
});

</script>
