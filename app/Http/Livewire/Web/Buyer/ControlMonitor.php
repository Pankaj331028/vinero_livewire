<?php

namespace App\Http\Livewire\Web\Buyer;

use App\Models\Agent;
use App\Models\Buyer as User;
use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Livewire\Component;

class ControlMonitor extends Component {
	use ResponseMessages;

	public $rule = [];
	public $type;
	public $monitor;
	public $user_type;
	public $hidden = 0;
	public $time;
	public $control_mode;

	public function rules() {
		$rules = [
			'type' => 'required|in:OPTIN,OPTOUT,OPTOUTMODE1,OPTOUTMODE2',
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.buyer.control-monitor');
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

	public function mount() {
		$user = auth()->user();

		$user_type = $user->user_type;
		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		if (User::where('agent_id', $user->id)->whereUserType('seller')->exists()) {
			$user_type = 'seller-agent';
		} elseif (User::where('agent_id', $user->id)->whereUserType('buyer')->exists()) {
			$user_type = 'buyer-agent';
		}
		$this->user_type = $user_type;
		// dd($this->user_type);
		if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
			$this->monitor = $user->offer->represented_by;
		}

		$this->type = $user->optin_out;
	}

	public function submitoptInOut3(Request $request) {
		// dd($request->all());
		$user = auth()->user();
		$this->dispatchBrowserEvent('error-result');
		// dd($this->getRules());
		$this->validate($this->getRules());
		$request->merge(['type' => $this->type]);
		if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
			$result = app('App\Http\Controllers\Api\Buyer\ApiController')->optinOut($request);
		} else {
			$result = app('App\Http\Controllers\Api\Seller\ApiController')->optinOut($request);
		}

		$data = $result->getData();
		if ($result->getData()->status == 200) {
			session()->flash('message', $this->getMessage(204));
			$user->last_activity = now();
			$user->save();
			if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
				return redirect()->route('buyer-dashboard');
			} else {
				return redirect()->route('seller-dashboard');
			}

		} else {

			session()->flash('error', $this->getMessage(406));

		}
	}

	public function submitoptInOut2(Request $request) {

		$user = auth()->user();
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());

		$request->merge(['type' => $this->type]);
		if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
			$result = app('App\Http\Controllers\Api\Buyer\ApiController')->optinOut($request);
		} else {
			$result = app('App\Http\Controllers\Api\Seller\ApiController')->optinOut($request);
		}
		$data = $result->getData();

		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $this->getMessage(204));

			if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
				return redirect()->route('buyer-dashboard');
			} else {
				return redirect()->route('seller-dashboard');
			}

		} else {
			session()->flash('error', $this->getMessage(406));
		}
	}

	public function submitOfferInterest(Request $request) {
		$user = auth()->user();
		$validatedData = $this->validate([
			'type' => 'required|in:text,email,phone',
			'time' => "required_if:type,==,phone",
		]);

		$request->merge(['type' => $this->type,
			'time' => $this->time]);
		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->offerInterest($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			if (!in_array($this->user_type, ['seller', 'seller-agent'])) {
				return redirect()->route('buyer-dashboard');
			} else {
				return redirect()->route('seller-dashboard');
			}
		} else {
			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->getRules());
			session()->flash('message', $this->getMessage(406));
		}
	}
}
