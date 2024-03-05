<?php

namespace App\Http\Livewire\Web;

use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Livewire\Component;

class ControlMonitor extends Component {
	use ResponseMessages;

	public $rule = [];
	public $type;

	public function mount() {
		$user = auth()->user();
		$this->type = $user->optin_out;
	}

	public function rules() {
		$rules = [
			'type' => 'required|in:OPTIN,OPTOUT',
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.control-monitor');
	}

	public function submitoptInOut(Request $request) {
		$user = auth()->user();
		$request->merge(['type' => $this->type]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->optinOut($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			return redirect()->route('seller-dashboard');
		} else {
			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->getRules());
			session()->flash('message', $this->getMessage(406));
		}
	}
}
