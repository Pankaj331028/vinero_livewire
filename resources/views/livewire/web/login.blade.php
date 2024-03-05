<div class="loginPanel">
    @if ($step == 1)
    <h2 class="second-heading mb-0">Sign in</h2>
    <p class="contact-alert py-2">Don't have an account? <a href="{{ route('create-account') }}"> Register</a></p>
    <div class="account-button">
        <a href="{{ route('auth.google') }}">
            <div class="socialBtn google p-2 row mb-3">
                <div class="float-start w-20 px-0">
                    <i class="bi bi-google"></i>
                </div>
                <div class="float-end w-80 px-0 text-start">
                    <label>Sign in with Google</label>
                </div>
            </div>
        </a>
        <a href="{{ route('auth.facebook') }}">
            <div class="socialBtn facebook p-2 row mb-3">
                <div class="float-start w-20 px-0">
                    {{-- <i class="bi bi-facebook"></i> --}}
                    <img src="{{ asset('web/img/fb-img.png') }}">
                </div>
                <div class="float-end w-80 px-0 text-start">
                    <label>Sign in with Facebook</label>
                </div>
            </div>
        </a>
        <a href="{{ route('auth.apple') }}">
            <div class="socialBtn apple p-2 row mb-3">
                <div class="float-start w-20 px-0">
                    <i class="bi bi-apple"></i>
                </div>
                <div class="float-end w-80 px-0 text-start">
                    <label>Sign in with Apple</label>
                </div>
            </div>
        </a>
    </div>
    <img src="{{ asset('web/img/contact-details-bottom.png') }}">
    <form action="" wire:submit.prevent="step_continue">
        <x-web-alert wire:ignore.self>
        </x-web-alert>
        <div class="form-group create-account position-relative mb-0 pb-1 loginPanel">
            {{-- <label class="greenText position-absolute labelText dNone">Email</label>
            <input name="email" type="text" class="feedback-input inputOutline @error('email') is-invalid @enderror" placeholder="Email*" wire:model="email" /> --}}
            <div class="searchformfld my-0 px-0">
                <input type="text" class="candidateName @error('email') is-invalid @enderror" id="candidateName" name="candidateName" placeholder=" " wire:model.debounce.500ms="email"/>
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
        {{-- <div class="passwordField row bg-white position-relative">
            <div class="float-start w-80 ps-0">
                <label class="greenText position-absolute labelText dNone">Email</label>
                <input name="password" type="password" id="Pass" class="feedback-input inputOutline @error('password') is-invalid @enderror" placeholder="Password*" wire:model="password" />
                <label class="position-absolute regExpIcon dNone @error('password') is-valid @else  @enderror">
                    <img src="{{ asset('web/img/invalid.png') }}" alt="">
                </label>
                <label class="position-absolute regExpIcon dNone @error('password')  @else @if(!empty($password)) is-valid  @endif @enderror">
                    <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                </label>
                @error('password')
                <div class="invalid-feedback position-absolute errorMsg text-start">{{$message}}</div>
                @enderror
            </div>
            <div class="float-end w-20 text-end">
                <img src="web/img/visible.png" alt="" class="eyeImg" id="cPass" onclick="viewPassword('Pass', 'cPass')">
            </div>
        </div> --}}
        <div class="passwordField row bg-white position-relative searchformfld px-0">
            <div class="float-start w-80 ps-0">
                <input name="password" type="password" id="Pass" class="feedback-input inputOutline @error('password') is-invalid @enderror" placeholder=" " wire:model.debounce.500ms="password" />
                <label for="Pass">Password<span class="text-danger">*</span></label>

                <label class="position-absolute regExpIconPassword  dNone @error('password') is-valid @else  @enderror">
                    <img src="{{ asset('web/img/invalid.png') }}" alt="">
                </label>
                <label class="position-absolute regExpIconPassword dNone @error('password')  @else @if(!empty($password)) is-valid  @endif @enderror">
                    <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                </label>
                @error('password')
                <div class="invalid-feedback position-absolute errorMsg text-start">{{$message}}</div>
                @enderror
            </div>
            <div class="float-end w-20 text-end">
                <img src="web/img/visible.png" alt="" class="eyeImg" id="cPass" onclick="viewPassword('Pass', 'cPass')">
            </div>
        </div>
        <div class="row justify-content-between radio-contact pb-4 pt-2">
            <div class="form__radio-group">
                <input type="radio" name="size" id="large" class="form__radio-input" value="1" wire:model="remember_me">
                <label class="form__label-radio" for="large" class="form__radio-label">
                    <span class="form__radio-button"></span> Remember me
                </label>
            </div>
            <p class="contact-alert fPassword">
                <a href="{{ route('forgot-password') }}">Forgot password?</a>
            </p>
        </div>
        <button class="btn contact-form-submit" type="submit">Continue</button>
    </form>
    @endif
    @if($step=='verify')
    <h2 class="second-heading">Verify Email</h2>
    <p class="contact-alert">Type in the validation code we sent you on {{$email}}. Didn't get one? We'll <a href="JavaScript:void(0);" wire:click="resendOtp">resend</a>.</p>
    <form wire:submit.prevent="verifyOTP">
        <x-web-alert></x-web-alert>
        <div class="input-otp">
            <input type="text" wire:model.defer="otp_verify.1" autocomplete="off" id="first" class="form-control otp otp-input numberInput " maxlength="1" autofocus="" required>
            <input type="text" wire:model.defer="otp_verify.2" autocomplete="off" id="second" class="form-control otp otp-input numberInput" maxlength="1" required>
            <input type="text" wire:model.defer="otp_verify.3" autocomplete="off" id="fourth" class="form-control otp otp-input numberInput" maxlength="1" required>
            <input type="text" wire:model="otp_verify.4" autocomplete="off" id="fifth" class="form-control otp otp-input numberInput" maxlength="1" required>
        </div>
        <button class="btn contact-form-submit" type="submit">Verify</button>
    </form>
    @endif
    @if ($step == 2)
    <p class="contact-alert"><em>Welcome {{Auth::guard('accounts')->user()->email}},</em></p>
    <h2 class="second-heading">Provide More Details to Continue</h2>
    <x-web-alert wire:ignore.self>
    </x-web-alert>
    <form wire:submit.prevent="login">
        <div class="form-group searchformfld lPropertyID mb-0">
            <input type="text" class="feedback-input @error('property_id') is-invalid @enderror" placeholder=" " wire:model.debounce.500ms="property_id" id="propid"/>
            <label for="propid">Property ID<span class="text-danger">*</span></label>
            @error('property_id')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group searchformfld lPropertyID">
            <input type="text" class="phoneNumber" placeholder=" "  onblur="changeValue('mobile_number',this)" value="{{$mobile_number}}"  id="mobile">
            <label for="mobile">Phone Number<span class="text-danger">*</span></label>
            <input type="hidden" class="feedback-input @error('mobile_number') is-invalid @enderror" wire:model="mobile_number" id="mobile_number">
            @error('mobile_number')
            <div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="user_types" style="padding: 0 15px;">
            <div class="form__radio-group mx-auto">
                <input type="radio" name="size" id="a" class="form__radio-input valid" value="buyer" wire:model.debounce.500ms="user_type">
                <label class="form__label-radio" for="a" class="form__radio-label">
                    <span class="form__radio-button"></span> Buyer
                </label>
            </div>
            <div class="form__radio-group mx-auto">
                <input type="radio" name="size" id="b" class="form__radio-input valid" value="seller" wire:model.debounce.500ms="user_type">
                <label class="form__label-radio" for="b" class="form__radio-label">
                    <span class="form__radio-button"></span> Owner
                </label>
            </div>
            <div class="form__radio-group mx-auto">
                <input type="radio" name="size" id="c" class="form__radio-input valid" value="agent" wire:model.debounce.500ms="user_type">
                <label class="form__label-radio" for="c" class="form__radio-label">
                    <span class="form__radio-button"></span> Agent
                </label>
            </div>
        </div>
        @error('user_type')
        <div class="invalid-feedback">{{$message}}</div>
        @enderror
        @if ($hidden == 1)
        @else
        <div class="mx-auto my-2 col-md-6">
            <button type="button" id="otp_timer" class="btn btn-dark submitContact mt-3" wire:click.privent="sendOtp">Send OTP</button>
            @if ($property_button == true)
            <button type="button" class="btn btn-dark submitContact mt-3" onclick="location.href='{{route('property')}}'" id="list_property">List Property</button>
            @endif
        </div>
        @endif
        <input type="hidden" id="hidden" name="hidden" value="{{$hidden}}">
        @if ($hidden == 1)
        <div id="after_otp" class="searchformfld py-0">
            <div class="col-md-12 my-2">
                <input type="text" class="form-control @error('otp') is-invalid @enderror" wire:model.debounce.500ms="otp" id="exampleInputEmail28" placeholder="Enter access code from your cell">
                @error('otp') <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>
        <div>
            <div class="px-2">
                <div class="form-group resendcode txtgray text-center" style="float: left; margin-left: 10px;">
                    <span id="seconds" class="themetxt fweight8" wire:ignore></span>
                </div>
                <div class="form-group resendcode txtgray text-center" style="float: right; margin-right: 10px;">
                    <p wire:ignore><a href="javascript:;" id="resend" class="txtpink" wire:click.prevent="sendOtp" style="color: red;">{{ __('Resend OTP') }}</a></p>
                </div>
            </div>
            @csrf
            <button class="btn contact-form-submit" type="submit">SIGN IN</button>
            <p class="subaccounp">By submitting I accept the QONECTIN <a class=" text-reset tdecor" style="cursor: pointer;">term's of use</a></p>
        </div>
        @endif
    </form>
    @endif
</div>
{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script> --}}
<script>

    function changeValue(field,element){
        var str = $(element).val();
        str = str.replaceAll(/-/g,'');

        @this.set(field, str);
    }
$(document).ready(function() {
    $(document).on("keyup", ".otp", function(e) {
        if ((e.which >= 48 && e.which <= 57) || (e.which >= 96 && e.which <= 105)) {
            $(e.target).next('.otp').focus();
        } else if (e.which == 8) {
            $(e.target).prev('.otp').focus();
        }
    });

    window.addEventListener('move-top', function(event) {
        $('html,body').animate({
            scrollTop: $('.z95').offset().top - 100
        }, 500);
    })

    window.addEventListener('startTimer', function(event) {
        var remaining = parseInt("{{$timer}}");
        // console.log(remaining);
        let timerOn = true;

        function timer(remaining) {
            $("#resend").css("display", "none");
            var m = Math.floor(remaining / 60);
            var s = remaining % 60;

            m = m < 10 ? '0' + m : m;
            s = s < 10 ? '0' + s : s;
            document.getElementById('seconds').innerHTML = m + ':' + s;
            remaining -= 1;
            if (remaining >= 0 && timerOn) {
                $('#seconds').css("display", "");
                setTimeout(function() {
                    timer(remaining);
                }, 1000);
                return;
            }

            if (!timerOn) {
                // Do validate stuff here
                return;
            }

            // Do timeout stuff here
            $('#seconds').css("display", "none");
            $("#resend").css("display", "");
        }

        timer(remaining)
    });

})

</script>
<script>
$(document).ready(function() {
    var counter = 0
    $(".valid").on("click", function() {
        counter++
        if (counter != 1) {
            @this.set('mobile_number', '');
            // @this.set('email_id', '');
            @this.set('property_id', '');
        }
    })
});

</script>
