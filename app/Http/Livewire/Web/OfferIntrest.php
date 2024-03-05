<?php

namespace App\Http\Livewire\Web;

use App\Models\Buyer as User;
use Auth;
use Illuminate\Http\Request;
use Livewire\Component;
use Session;

class OfferIntrest extends Component {

	public $hidden = false;
	public $rules = [];
	public $type;
	public $time;
	public $offer_id;

	public function rules() {
		$rules = [
			'type' => 'required|in:text,email,phone',
			'time' => "required_if:type,==,phone",
			'offer_id' => "required",
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.offer-intrest');
	}
	public function mount($id) {
		$user = User::find(Auth::id());
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 0;
		}
		$loguser = User::find($user->id);
		if (User::where('agent_id', $loguser->id)->whereUserType('seller')->exists()) {
			$loguser->user_type = 'seller-agent';
		} else {
			$loguser->user_type = 'seller';
		}
		$this->loguser = $loguser;

		$this->offer_id = $id;
	}

	public function updated($name, $value) {
		$val = $this->type;
		if ($val == 'phone') {
			$this->hidden = true;
		} else {
			$this->hidden = false;
		}
		$this->validateOnly($name);
	}

	public function submitOfferInterest(Request $request) {

		$request->merge(['type' => $this->type,
			'offer_id' => $this->offer_id,
			'time' => $this->time]);

		$result = app('App\Http\Controllers\Api\Seller\ApiController')->notifyOfferInterest($request);
		$data = $result->getData();
		dd($data);
		$this->new_offer = $data->data;
		if ($result->getData()->status == 200) {
		} else {
			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->getRules());
			session()->flash('message', $this->getMessage(104));
		}
	}

}
