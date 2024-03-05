<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\Api\BaseController;
use App\Models\Buyer as User;
use App\Models\Agent;
use App\Traits\Helper;
use App\Models\Property;
use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class OfferNotAccept extends Component {

	use WithFileUploads, Helper, ResponseMessages;
	public $improve;
	public $file;
	public $amount;
	public $amount1;
	public $imp;
	public $val;
	public $bid;
	public $open_model = 0;
	public $control_mode;
	public $current_bid;
	public $financial_qualification;
	public $bid_per_sqfeet;
	public $est_mortigage_payment;
	public $data_diff;

	public function rules() {
		$user = User::find(Auth::id());
		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property_rate = $list->reserved_price;
		if($this->improve == '1'){
			$rules = [
				'improve' => "required",
				// 'amount' => new RequiredIf($this->improve == '1'),
				'amount1' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
			];
		}else{
			$rules = [
				'improve' => "required",
				// 'amount' => new RequiredIf($this->improve == '1'),
				// 'amount1' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
			];
		}
		
		return $rules;
	}

	public function mount(Request $request) {
		$user = auth()->user();

		$this->data_diff = $request->q;
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
		$bid = $offer_details->getData()->data;
		$this->current_bid = number_format($bid->offered_price);
		$this->financial_qualification = number_format($bid->qualify_for);
		$this->bid_per_sqfeet = number_format($bid->bid_per_sqfeet);
		$this->est_mortigage_payment = number_format($bid->est_mortgage);

	}
	public function render() {
		return view('livewire.web.offer-not-accept');
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

		if ($this->improve == '0' || $this->improve == '2' || $this->improve == '3') {
			$this->reset('amount');
		}

		$this->amount1 =$this->formatCurrency($this->amount);
		if ($name == 'amount') {
			$this->validateOnly('amount1');
		}
		else{
		$this->validateOnly($name);
		}

	}

	public function submitModifyOffer(Request $request) {

		$this->dispatchBrowserEvent('error-result');

		$this->validate($this->getRules(), [
			'improve.required' => 'Please make your choice',
			'amount1.gte' => 'The amount must be greater than or equal reserved price',
		]);
		$user = auth()->user();

		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		$offer = $user->offer;
		if ($this->improve == 0) {
			$user->last_activity = now();
			$user->save();
			return redirect()->route('buyer-dashboard');
		} elseif ($this->improve == 1) {
			$offer->transaction->offer_price = $this->formatCurrency($this->amount);
			$offer->transaction->save();

			$commission = ($offer->transaction->offer_price * $offer->buyer_agent_commission_percentage / 100);
			$credit = ($offer->transaction->offer_price * $offer->transaction->seller_credit / 100);
			$net_price = $offer->transaction->offer_price - ($commission + $credit);

			$offer->transaction->seller_credit_amount = $credit;
			$offer->transaction->net_price = $net_price;
			$offer->transaction->save();

			$offer->buyer_agent_commission = $commission;
			$offer->save();

			$total_loan_amount = $offer->strategy->first_mortgage_loan_amount + $offer->strategy->second_mortgage_loan_amount;
			$offer->strategy->combined_loan_value = $total_loan_amount / $offer->transaction->offer_price;
			$balance = $offer->transaction->offer_price - ($offer->strategy->initial_deposit_amount + $offer->strategy->deposit_increase + $total_loan_amount);
			$offer->strategy->balance_down_payment = $balance;
			$user->last_activity = now();
			$user->save();
			return redirect()->route('buyer-dashboard');

		} elseif ($this->improve == 2) {
			$user->last_activity = now();
			$user->save();
			return redirect()->route('buyer-dashboard');

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
