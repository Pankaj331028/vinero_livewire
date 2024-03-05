<div class="row justify-content-between">
    <div class="smart-offer-left">
        <h5 class="font17">Smart Offer Acceptance deadline:</h5>
        <div class="button-grey">
            <span>{{ $property_end_date }}</span>
        </div>
        <div class="button-grey buyer-offer-time">
            <span class="demo"> </span>
        </div>
    </div>
    <div class="byuyer-fooer-profile text-end">
        {{-- <img src="{{ asset('web/img/buyer-profile.png') }}" alt="buyer profile"> --}}
        <div class="profile-pic">
            <img src="{{ asset('web/img/buyer-profile.svg') }}" alt="buyer profile">
            <div class="white-box profile-setting">
                @if(Auth::check())
                @if(Auth::user()->user_type=='seller')
                <a href="{{ route('seller-dashboard') }}">Account</a>
                @else
                <a href="{{ route('buyer-dashboard') }}">Account</a>
                @endif
                <a href="{{ route('control-monitor') }}">Control Monitor</a>
                @endif
                <a href="{{ route('weblogout') }}">Log Out</a>
            </div>
        </div>
    </div>
</div>