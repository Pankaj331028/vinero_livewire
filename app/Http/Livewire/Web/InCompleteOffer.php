<?php

namespace App\Http\Livewire\Web;

use App\Models\Buyer as User;
use Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class InCompleteOffer extends Component {
	public $incompletetype = 1;
	public $qreq;

	public function mount(Request $request) {
		$this->qreq = $request->q;
		if ($request->q == "fc") {
			$this->incompletetype = 2;
			$user = User::find(Auth::id());
			if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
				$this->control_mode = 0;
			} else {
				$this->control_mode = 1;
			}

		} elseif ($request->q == 'proof_funds') {

			$this->incompletetype = 3;
			$user = User::find(Auth::id());
			if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
				$this->control_mode = 0;
			} else {
				$this->control_mode = 1;
			}
		}
		if (empty($this->qreq)) {
			session()->flash('error', 'Invalid Request');
			return redirect()->route('buyer-dashboard');
		}
	}

	public function render() {
		return view('livewire.web.in-complete-offer');
	}

	public function reviseOffer() {

		if ($this->incompletetype == 2) {
			return redirect()->route('update-credentials');
		} else {
			return redirect()->route('offer-not-accepted');
		}
	}

}
