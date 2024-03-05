<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\Api\BaseController;
use App\Models\Agent;
use App\Models\Buyer as User;
use App\Models\FinancialCredential;
use App\Traits\Helper;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;
use Livewire\WithFileUploads;

class UpdateCredentials extends Component {
	use WithFileUploads, Helper;

	public $improve;
	public $file;
	public $amount;
	public $imp;
	public $val;
	public $bid;
	public $open_model = 0;
	public $control_mode;
	public $current_bid;
	public $financial_qualification;
	public $bid_per_sqfeet;
	public $est_mortigage_payment;

	public function rules() {

		if ($this->improve == '2') {
			$rules = [
				'improve' => "required",
				'file' => [new RequiredIf($this->improve == '2'), 'mimes:docx,pdf', 'max:10000'],

			];

		} else {
			$rules = [
				'improve' => "required",
				'file' => new RequiredIf($this->improve == '2'),

			];

		}

		return $rules;
	}

	public function render() {
		return view('livewire.web.update-credentials');
	}

	public function mount(Request $request) {
		$user = User::find(Auth::id());
		// dd($user);
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
		//    dd($offer_details);
		$bid = $offer_details->getData()->data;
		$this->current_bid = number_format($bid->offered_price);
		$this->financial_qualification = number_format($bid->qualify_for);
		$this->bid_per_sqfeet = number_format($bid->bid_per_sqfeet);
		$this->est_mortigage_payment = number_format($bid->est_mortgage);
		//$this->bid = $bid;

	}

	public function updated($name) {

		$val = $this->improve;
		$imp = $this->improve;
		if (isset($val)) {
			if ($val == 3) {
				$imp = 3;
			} elseif ($val == 2) {
				$imp = 2;
			} elseif ($val == 1) {
				$imp = 1;
			}
		}
		$this->imp = $imp;
		if ($this->improve == '3') {
			$this->reset('file');
		}

		$this->validateOnly($name);

	}

	public function submitModifyOffer(Request $request) {

		$this->dispatchBrowserEvent('error-result');

		$this->validate($this->getRules(), [
			'improve.required' => 'Please make your choice',
		]);
		$user = User::find(Auth::id());

		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		$offer = $user->offer;

		if ($this->improve == 2) {
			if ($this->file) {
				if (!isset($offer->financial)) {
					$financial = new FinancialCredential;
				} else {
					$financial = $offer->financial;
				}
				$path = $this->file->store('uploads/offers/' . $offer->id);

				$financial->offer_id = $offer->id;
				$financial->tnc = 1;
				$financial->file = $path;
				$financial->save();
				$user->last_activity = now();
				$user->save();
				return redirect()->route('buyer-dashboard');
			}

		} elseif ($this->improve == 3) {
			$result = app('App\Http\Controllers\Api\Buyer\ApiController')->cancelOffer($request);

			$data = $result->getData();

			if ($result->getData()->status == 200) {
				$user->last_activity = now();
				$user->save();
				return redirect()->route('buyer-offer-cancellation');
			}
		}

	}
}
