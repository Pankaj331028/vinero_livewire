<?php

namespace App\Http\Livewire\Web;

use App\Models\Buyer as User;
use App\Models\Offers;
use App\Traits\ResponseMessages;
use Auth;
use Illuminate\Http\Request;
use Livewire\Component;

class SellerOffer extends Component {
	use ResponseMessages;

	public $rule = [];
	public $offers;
	public $property;
	public $user;
	public $selected_offer = 0;
	public $user_control;
	public $offer_id;
	public $type = 'all';
	protected $listeners = ['scrollDiv' => 'scrollDiv'];

	public function mount($id = null) {
		$user = auth()->user();

		if (!empty($id)) {
			$this->offer_id = $id;
			$this->type = 'single';
		}

		$this->offers = Offers::whereIn('status', ['AC', 'SO'])->whereNull('cancelled_at')->where('property_id', $user->property->id)->get();

		if (count($this->offers) <= 0) {
			session()->flash('error', 'No Offers for this property');
			return redirect('/seller-dashboard');
		}
		$this->property = $user->property;
		$this->user = $user;

		if (Auth::check()) {
			$user = User::find(Auth::id());
			if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer') || (($user->optin_out == 'OPTOUT') && $user->user_type == 'seller')) {
				$this->user_control = 0;
			} else {
				$this->user_control = 1;
			}
		}
	}

	public function scrollDiv() {

		$this->dispatchBrowserEvent('move-scroll', ['offer_id' => $this->offer_id, 'type' => $this->type]);
	}

	public function rules() {
		return ['selected_offer' => 'required'];
	}

	public function render() {
		return view('livewire.web.seller-offer');
	}

	public function updated($new) {
		if ($new == 'extended_hours') {
			$this->newhr = $this->extended_hours . ' PM';
		}
		$this->validateOnly($new);

	}

	public function notifyOfferInterest(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());

		$request->merge([
			'offer_id' => $this->selected_offer,
		]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->notifyOfferInterest($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$this->dispatchBrowserEvent('show-success');
			session()->flash('message', 'We have shared your request with the buyer.');
			// return redirect()->route('seller-dashboard');
		} else {
			session()->flash('error', $result->getData()->message);
		}
	}

	public function updateOffer(Request $request, $status) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());
		$user = auth()->user();
		$request->merge([
			'status' => $status,
			'offer_id' => $this->selected_offer,
		]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->updateOfferStatus($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $result->getData()->message);

			$this->offers = Offers::whereIn('status', ['AC', 'SO'])->whereNull('cancelled_at')->where('property_id', $this->user->property->id)->get();

			if (count($this->offers) <= 0) {
				return redirect('/seller-dashboard');
			}
			if ($status == 'accept') {
				return redirect()->route('weblogout');
			}
			return redirect()->route('offers');
		} else {
			session()->flash('error', $result->getData()->message);
		}
	}
}
