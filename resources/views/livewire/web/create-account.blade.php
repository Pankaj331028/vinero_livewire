<div class="row justify-content-center createAccount">
    <div class="col-md-4 z95 {{ $createAcc }}">

        <h2 class="second-heading mb-0">Create a VMS account</h2>
        <p class="description mb-0">to own your smart offer</p>
        <p class="contact-alert py-2">Already have an account? <a href="{{ route('weblogin') }}"> Sign in</a></p>

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

            {{-- <a href="{{ route('auth.google') }}"><button class="btn google"><i class="bi bi-google"></i>Sign in with Google</button></a>
            <a href="{{ route('auth.facebook') }}"><button class="btn facebook"><i class="bi bi-facebook"></i>Sign in with Facebook</button></a>
            <a href="{{ route('auth.apple') }}"><button class="btn apple"><i class="bi bi-apple"></i>Sign in with Apple</button></a> --}}
            {{-- <a href="">@signInWithApple("black", false, "sign-in", 5)</a> --}}
        </div>
        <div class="py-3">
            <img src="{{ asset('web/img/contact-details-bottom.png') }}" class="w-100">
        </div>
        <form wire:submit.prevent="store">
            <x-web-alert></x-web-alert>

            <div class="form-group create-account position-relative mb-3">
                <div class="searchformfld px-0 my-0">
                    <input type="text" class="candidateName  @error('email') is-invalid @else is-valid @enderror" id="candidateName" name="candidateName" placeholder=" " wire:model.debounce.500ms="email"/>
                    <label for="candidateName">Email<span class="text-danger">*</span></label>
                    @error('email')
                    <div class="invalid-feedback" style="text-align:left;"> <p class="contact-alert" style="color:red">{{$message}}</p></div>
                    @enderror
                </div>
                {{-- <input name="email" type="text" class="feedback-input inputOutline  createEmail @error('email') is-invalid @else is-valid @enderror" placeholder="Email" wire:model="email" /> --}}
                {{-- <label class="position-absolute regExpIcon  @error('email') d-none @else is-valid @enderror">
                    <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                </label> --}}
                <label class="position-absolute regExpIconEmail dNone @error('email') is-valid @else  @enderror">
                    <img src="{{ asset('web/img/invalid.png') }}" alt="">
                </label>
                <label class="position-absolute regExpIconEmail dNone @error('email')  @else @if(!empty($email)) is-valid  @endif @enderror">
                    <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                </label>
            </div>
            {{-- <div class="form-group">
                <input name="password" type="password" class="feedback-input inputOutline @error('password') is-invalid @enderror" placeholder="Password" wire:model="password" />
                @error('password')
                <p class="contact-alert" style="color:red">Password must be at least 8 characters and contain at least one number and one special character.</p>
                @enderror
                @if(!$errors->any('password'))
                <p class="contact-alert">Password must be at least 8 characters and contain at least one number and one special character.</p>
                @endif

            </div> --}}

            <div class="passwordField row bg-white position-relative searchformfld px-0 my-0">
                <div class="float-start w-80 ps-0">
                    {{-- <label class="greenText position-absolute labelText dNone Pass">Password</label>
                    <input name="password" type="password" id="Pass" onClick="slidePlaceholder('Pass')" class="h-100 w-100 border-0 bg-transparent px-0 feedback-input inputOutline @error('password') is-invalid @enderror" placeholder="Password" wire:model="password" /> --}}
                    <input type="password" class="Pass @error('password') is-invalid @enderror" id="Pass" name="Pass" placeholder=" " wire:model.debounce.500ms="password"/>
                    <label for="Pass">Password<span class="text-danger">*</span></label>


                    <label class="position-absolute regExpIconPassword dNone @error('password') is-valid @else  @enderror">
                        <img src="{{ asset('web/img/invalid.png') }}" alt="">
                    </label>
                    <label class="position-absolute regExpIconPassword dNone @error('password')  @else @if(!empty($password)) is-valid  @endif @enderror">
                        <img src="{{ asset('web/img/valid.png') }}" class="" alt="">
                    </label>
                    @error('password')
                    <p class="contact-alert" style="color:red">Password must be at least 8 characters and contain at least one number and one special character.</p>
                    @else
                    @enderror
                    @if(!$errors->any('password'))
                    <p class="contact-alert">Password must be at least 8 characters and contain at least one number and one special character.</p>
                    @endif
                </div>
                <div class="float-end w-20 text-end">
                    <img src="web/img/visible.png" alt="" class="eyeImg" id="cPass" onclick="viewPassword('Pass', 'cPass')">
                </div>
            </div>
            <button class="btn contact-form-submit mt-3" type="submit">CREATE ACCOUNT</button>
        </form>
    </div>
    <div class="col-md-4 z95 {{ $verifyOtp }}">
        <h2 class="second-heading">Verify Email</h2>
        <p class="contact-alert">Type in the validation code we sent you. Didn't get one? We'll <a href="JavaScript:void(0);" wire:click="resendOtp">resend</a>.</p>
        <form wire:submit.prevent="verifyOTP">
            <x-web-alert></x-web-alert>
            <div class="input-otp">
                <input type="text" wire:model.defer="otp.1" autocomplete="off" id="first" class="form-control otp otp-input numberInput " maxlength="1" autofocus="" required>
                <input type="text" wire:model.defer="otp.2" autocomplete="off" id="second" class="form-control otp otp-input numberInput" maxlength="1" required>
                <input type="text" wire:model.defer="otp.3" autocomplete="off" id="fourth" class="form-control otp otp-input numberInput" maxlength="1" required>
                <input type="text" wire:model="otp.4" autocomplete="off" id="fifth" class="form-control otp otp-input numberInput" maxlength="1" required>
            </div>
            <button class="btn contact-form-submit" type="submit">Verify</button>
        </form>
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

    window.addEventListener('move-top', function(event) {
        $('html,body').animate({
            scrollTop: $('.z95').offset().top - 100
        }, 500);
    })
</script>
<script>
    // $(document).ready(function(){
    //     $("p").click(function(){
    //         alert("The paragraph was clicked.");
    //     });
    // });

    function slidePlaceholder(id){
        $('#'+id).attr('placeholder','');
        $('.'+id).show();

        $( '#'+id).on( "input", function() {
            $('.'+id).show();
        });

        $('#'+id).focusout(function(){
            var iputValue = $( '#'+id).val();
            if(iputValue!=""){
                // alert(iputValue);
                $('#'+id).attr('placeholder','');
                $('.'+id).show();
            }else{
                $('#'+id).attr('placeholder','Email');
                $('.'+id).hide();
            }
        });



        // if(id=="Pass"){
        //     placeholder = "Password";
        // }else{
        //     placeholder = "Email";
        // }

        // var iputValue = $( '#'+id).val();

        // $('#'+id).attr('placeholder','');
        // $('.'+id).show();

        // $('#'+id).focusout(function(){
        //     if(id){
        //         $('#'+id).attr('placeholder','');
        //         $('.'+id).show();
        //     }else{
        //         $(this).attr('placeholder',placeholder);
        //         $('.'+id).hide();
        //     }
        // });

    }
</script>
