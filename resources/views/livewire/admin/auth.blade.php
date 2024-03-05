<div>
	<x-alert>
	</x-alert>
    @if($type == 'login')
    <form wire:submit.prevent="login">
        <div class="form-group">
            <input autocomplete="off" class="form-control @error('email') is-invalid @enderror" placeholder="Email" type="text" wire:model="email">
            </input>
            @error('email')
            	<div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group">
            <input class="form-control @error('password') is-invalid @enderror" placeholder="Password" type="password" wire:model="password">
            </input>
            @error('password')
            	<div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <div class="form-group mt-4">
            <label class="kt-checkbox">
                <input type="checkbox" value="1" wire:model='remember' />
                Remember Me
                <span>
                </span>
            </label>
        </div>
        <!--begin::Action-->
        <div class="kt-login__actions">
            <a class="kt-link kt-login__link-forgot" href="{{route('forgot')}}">
                Forgot Password ?
            </a>
            <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary" id="kt_login_signin_submit">
                Sign In
            </button>
        </div>
        <!--end::Action-->
    </form>
    @elseif($type == 'forgot')
    <form wire:submit.prevent="forgotPassword">
        <div class="form-group">
            <input autocomplete="off" class="form-control @error('email') is-invalid @enderror" placeholder="Email" type="text" wire:model="email">
            </input>
            @error('email')
            	<div class="invalid-feedback">{{$message}}</div>
            @enderror
        </div>
        <!--begin::Action-->
        <div class="kt-login__actions">
            <a class="kt-link kt-login__link-forgot" href="{{route('login')}}">
                Return to Login
            </a>
            <button type="submit" class="btn btn-primary btn-elevate kt-login__btn-primary" id="kt_login_signin_submit">
                Send Mail
            </button>
        </div>
        <!--end::Action-->
    </form>
    @endif
</div>
