<?php

namespace App\Http\Livewire\Web;

use App\Models\Agent;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class BuyerViewSellersCounter extends Component {
	use Helper, ResponseMessages;

	public $price;
	public $close_of_escrow;
	public $inspection_property;
	public $loan_contingency;
	public $escrow_company;
	public $escrow_number;
	public $escrow_officer;
	public $contact_information;
	public $other_terms;

	public $offered_price;
	public $closing_costs;
	public $seller_credit;
	public $funds_needed_close;
	public $mortgage_loan1;
	public $mortgage_loan2;
	public $initial_deposit;
	public $deposit_increase;
	public $balance_at_closing;
	public $close_escrow;

	public function mount(Request $request) {
		$user = auth()->user();

		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
			$offer = $user->offer;

		} else {
			$offer = $user->active_offer;
		}
		// dd($user);
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$counter_details = app('App\Http\Controllers\Api\Buyer\ApiController')->counterDetails($request);

		// $counter_detail = $counter_details->getData();
		if ($counter_details->getData()->status == 200) {
			$counter_detail = $counter_details->getData()->data;
			$this->price = number_format($counter_detail->amount);
			$this->close_of_escrow = $counter_detail->close_of_escrow;
			$this->inspection_property = $counter_detail->inspection_prop;
			$this->loan_contingency = $counter_detail->loan_contingency;
			$this->escrow_company = $counter_detail->escrow_company;
			$this->escrow_officer = $counter_detail->escrow_officer;
			// $this->escrow_number = $counter_detail->escrow_number;
			$this->contact_information = $counter_detail->escrow_contact;
			$this->other_terms = $counter_detail->other_terms;
		}

		// $user =auth()->user();
		// $offer = $user->active_offer;
		// dd($offer);
		if (isset($offer)) {
			$this->offered_price = number_format($offer->transaction->offer_price);
			$this->closing_costs = number_format($offer->transaction->offer_price * ($offer->strategy->estimated_closing_costs ?? 0) / 100);
			$this->seller_credit = number_format($offer->transaction->seller_credit_amount);
			$this->funds_needed_close = number_format($offer->document->downpayment_verified_amount) ?? '';
			$this->mortgage_loan1 = number_format($offer->strategy->first_mortgage_loan_amount);
			$this->mortgage_loan2 = number_format($offer->strategy->second_mortgage_loan_amount);
			$this->initial_deposit = number_format($offer->strategy->initial_deposit_amount);
			$this->deposit_increase = number_format($offer->strategy->deposit_increase);
			$this->balance_at_closing = number_format($offer->strategy->balance_down_payment);
			$this->close_escrow = Carbon::parse($user->property->end_date)->addDay($offer->transaction->days_of_escrow + 1)->format('Y-m-d');
		}

	}

	public function render() {
		return view('livewire.web.buyer-view-sellers-counter');
	}

	public function withdrawMyOffer(Request $request) {
		$user = auth()->user();
		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->cancelOffer($request);
		$data = $result->getData();

		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();

			return redirect()->route('buyer-offer-cancellation');
		}
	}

	public function acceptCounterOffer(Request $request) {
		$user = auth()->user();
		$request->merge([
			'type' => 'counter_offer',
			'improve' => 1,
			'amount' => $this->formatCurrency($this->price),
		]);

		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->updateOfferStatus($request);
		$data = $result->getData();

		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $this->getMessage(215));
			return redirect()->route('buyer-dashboard');
		}

	}
}
