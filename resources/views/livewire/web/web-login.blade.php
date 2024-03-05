<div>

        <h3 class="contacttextForm">LOGIN TO YOUR ACCOUNT</h3>
        <hr class="h-line text-center conttacthr mb-3">
        <x-alert wire:ignore.self>
        </x-alert>
    <form wire:submit.prevent="login">
        <div class="row">
            <div class="col-md-12 my-2">
                <input type="text" class="form-control propertyid @error('property_id') is-invalid @enderror"
                    wire:model="property_id" id="exampleInputEmai105" placeholder="Enter property id" >
                @error('property_id') <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 my-2">
                <input type="email" class="form-control email @error('email_id') is-invalid @enderror" wire:model="email_id"
                    id="exampleInputEmai105" placeholder="Enter your email address" >
                @error('email_id') <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-md-12 my-2">
                <input type="number" class="form-control mobilenumber @error('mobile_number') is-invalid @enderror" wire:model="mobile_number"
                    id="" placeholder="Enter your Phone number" >
                @error('mobile_number') <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <strong class="iamana">I am a:</strong>
        <div class="radiochecktypebutton ">
            <ul class="nav nav-pills tabsmoreinfoto" id="pills-tab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link buood" id="pills-home-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home"
                        aria-selected="true">
                        <div class="form-check form-check-inline d-flex">
                            <input class="form-check-input valid" type="radio" id="inlineCheckbox1" name="user_type" wire:model="user_type"
                                value="buyer">
                            <label class="form-check-label tbselect" for="inlineCheckbox1">Buyer</label>
                        </div>
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link buood" id="pills-profile-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-profile" type="button" role="tab" aria-controls="pills-profile"
                        aria-selected="true">
                        <div class="form-check form-check-inline d-flex">
                            <input class="form-check-input valid" type="radio" id="inlineCheckbox9" name="user_type" wire:model="user_type"
                                value="seller">
                            <label class="form-check-label tbselect" for="inlineCheckbox9">Owner</label>
                        </div>
                    </button>
                </li>

                <li class="nav-item" role="presentation">
                    <button class="nav-link buood" id="pills-contactu-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-contactu" type="button" role="tab" aria-controls="pills-contactu"
                        aria-selected="true">
                        <div class="form-check form-check-inline d-flex">
                            <input class="form-check-input valid" type="radio" id="inlineCheckbox4" name="user_type" wire:model="user_type"
                                value="agent">
                            <label class="form-check-label tbselect" for="inlineCheckbox4">Agent </label>
                        </div>
                    </button>
                </li>
            </ul>
        </div>
            @error('user_type')
                <div class="error-label text-danger">
                    {{ $message }}
                </div>
            @enderror
            @if ($hidden == 1)

            @else
            <div class="col-md-4 my-2">
                <button type="button" id="otp_timer" class="btn btn-dark submitContact mt-3" wire:click.privent="sendOtp">Send OTP</button>
            </div>
            @endif

            @if ($property_button == true)
            <button type="button" class="btn btn-dark submitContact mt-3" onclick="location.href='{{route('property')}}'" id="list_property">List Property</button>
            @endif
            <input type="hidden" id="hidden" name="hidden" value="{{$hidden}}">
            @if ($hidden == 1)
            <div id="after_otp">
            <div class="col-md-12 my-2">
                <input type="text" class="form-control @error('otp') is-invalid @enderror" wire:model="otp"
                    id="exampleInputEmail28" placeholder="Enter access code from your cell">
                @error('otp') <div class="invalid-feedback text-danger">{{ $message }}</div>
                @enderror
            </div>
            </div>
            <div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group resendcode txtgray text-center" style="float: left; margin-left: 10px;">
                        <span id="seconds" class="themetxt fweight8" wire:ignore></span>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group resendcode txtgray text-center" style="float: right; margin-right: 10px;">
                        <p wire:ignore><a href="javascript:;" id="resend" class="txtpink"
                                wire:click.prevent="sendOtp" style="color: red;">{{ __('Resend OTP') }}</a></p>
                    </div>
                </div>
            </div>
            @csrf
            <button type="submit" class="btn btn-dark submitContact mt-3" >LOGIN</button><br>
            <p class="subaccounp">By submitting i accept the FUTURA <a class=" text-reset tdecor"
                    style="cursor: pointer;">term's of use</a></p>
            </div>
            @endif

    </form>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>

<script>
	$(document).ready(function () {

		window.addEventListener('startTimer', function (event) {
			var remaining = 10;
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
					setTimeout(function () {
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
    $(document).ready(function(){
        var counter = 0
    $(".valid").on("click", function () {
        counter++
    if (counter != 1) {
        @this.set('mobile_number', '');
        @this.set('email_id', '');
        @this.set('property_id', '');
    }
    })
    });
</script>
</div>