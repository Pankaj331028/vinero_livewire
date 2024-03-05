<div class="profile-pic">
<img src="{{ asset('web/img/buyer-profile.svg') }}" alt="buyer profile">
<div class="white-box profile-setting">
	@if(Auth::check())
    @php

        $usertype = Auth::user()->user_type;

        if ($usertype == 'agent') {
            $user=App\Models\Agent::find(Auth::id());
            $u = $user->head;

            $usertype = ($u->user_type == 'buyer') ? 'buyer-agent' : 'seller-agent';
        }

    @endphp
                @if($usertype=='seller'||$usertype=='seller-agent')
                <a href="{{ route('seller-dashboard') }}">Account</a>
                @else
                <a href="{{ route('buyer-dashboard') }}">Account</a>
                @endif
                <a href="{{ route('control-monitor') }}">Control Monitor</a>
                @endif
<a href="{{ route('weblogout') }}">Log Out</a>
</div>
</div>