<?php

namespace App\Http\Livewire\Web;

use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Livewire\Component;

class OfferOfInterest extends Component {
	use ResponseMessages;
	public $rule = [];
	public $type;
	// public $monitor;
	public $hidden = 0;
	public $time;
	public $control_mode;

	public function mount() {
		$user = auth()->user();
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
	}
	public function render() {
		return view('livewire.web.offer-of-interest');
	}
	public function rules() {
		$rules = [
			'type' => 'required|in:text,email,phone',
			'time' => "required_if:type,==,phone",
		];
		return $rules;
	}

	public function updated($name) {
		$val = $this->type;
		if ($val == 'phone') {
			return $this->hidden = 1;
		} else {
			return $this->hidden = 0;
		}
		$this->validateOnly($name);
	}
	public function submitOfferInterest(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());
		$user = auth()->user();
		$request->merge(['type' => $this->type,
			'time' => $this->time]);
		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->offerInterest($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			return redirect()->route('buyer-dashboard');
		} else {
			// $this->dispatchBrowserEvent('error-result');
			// $this->validate($this->getRules());
			session()->flash('message', $this->getMessage(406));
		}
	}
}
