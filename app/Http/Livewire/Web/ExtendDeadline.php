<?php

namespace App\Http\Livewire\Web;

use App\Models\Buyer as User;
use App\Traits\ResponseMessages;
use Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class ExtendDeadline extends Component {
	use ResponseMessages;

	public $rule = [];
	public $extended_date;
	public $user_control;
	public $extended_hours = 1;
	public $additional_hours = 1;
	public $newhr;

	public function mount() {
		$user = auth()->user();
		if (Auth::check()) {
			$user = User::find(Auth::id());
			if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer') || (($user->optin_out == 'OPTOUT') && $user->user_type == 'seller')) {
				$this->user_control = 0;
			} else {
				$this->user_control = 1;
			}
		}
	}

	public function rules() {
		$rules = [
			'extended_date' => 'required|date_format:Y-m-d|after:today',
			'extended_hours' => 'required',
			'additional_hours' => 'required|min:1',
		];
		return $rules;
	}

	public function messages() {
		$rules = [
			'extended_date.required' => 'Please provide extended deadline date for the property',
			'extended_hours.required' => 'Please provide extended hours',
			'additional_hours.required' => 'Please provide additional hours to receive highest and best offer',
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.extend-deadline');
	}

	public function updated($new) {
		if ($new == 'extended_hours') {
			$this->newhr = $this->extended_hours . ' PM';
		}
		$this->validateOnly($new);

	}

	public function submit(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), $this->getMessages());
		$user = auth()->user();
		$request->merge([
			'extended_date' => $this->extended_date,
			'extended_hours' => $this->extended_hours,
			'additional_hours' => $this->additional_hours,
		]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->updateProperty($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $result->getData()->message);
			return redirect()->route('seller-dashboard');
		} else {
			session()->flash('error', $result->getData()->message);
		}
	}
}
