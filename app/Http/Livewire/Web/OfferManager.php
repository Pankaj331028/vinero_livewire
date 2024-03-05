<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Buyer as User;
use App\Models\Property;
use Illuminate\Http\Request;
use Livewire\Component;

class OfferManager extends Component {

	public $rules = [];
	public $extended_date;
	public $extended_hours;
	public $additional_hours;
	public $offer_due_deadline;
	public $loguser;

	public function rules() {
		$rules = [
			'extended_date' => 'required|date_format:Y-m-d|after:today',
			'extended_hours' => 'required',
			'additional_hours' => 'required|min:1',
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.offer-manager');
	}

	public function mount(Request $request, $id) {
		$user = auth()->user();
		$loguser = User::find($user->id);
		if (User::where('agent_id', $loguser->id)->whereUserType('seller')->exists()) {
			$loguser->user_type = 'seller-agent';
		} else {
			$loguser->user_type = 'seller';
		}
		$this->loguser = $loguser;
		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$property = Property::where('vms_property_id', $user->property_id)->first();
		$this->property = $property;
		$request->merge(['id' => $id]);
		$offer = app('App\Http\Controllers\Api\Seller\ApiController')->viewOffer($request);
		$offer_details = $offer->getData()->data;
		$this->offer_due_deadline = $offer_details->deadline;

	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function submitOfferManagement(Request $request) {

		$request->merge(['extended_date' => $this->extended_date,
			'extended_hours' => $this->extended_hours,
			'additional_hours' => $this->additional_hours]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->updateProperty($request);
		$data = $result->getData();

		$this->new_offer = $data->data;
		if ($result->getData()->status == 200) {
			return redirect()->route('seller-dashboard');
			session()->flash('message', $this->getMessage(203));
		} else {
			session()->flash('message', $data->message);
			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->getRules());
		}
	}

}
