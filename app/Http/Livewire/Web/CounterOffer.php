<?php

namespace App\Http\Livewire\Web;

use App\Models\Offers;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;

class CounterOffer extends Component {

	use ResponseMessages, Helper;
	public $rules = [];
	public $price;
	public $offer_id;
	public $close_of_escrow;
	public $inspection_property;
	public $loan_contingency;
	public $escrow_company;
	public $escrow_number;
	public $escrow_officer;
	public $contact_information;
	public $other_terms;
	public $tnc = 1;
	public $multiple_counter = '0';

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
	public $buyer_name;

	public function rules() {
		$rules = [
			'price' => "required",
			'offer_id' => "required",
			'close_of_escrow' => "required",
			'inspection_property' => "required",
			'loan_contingency' => "required",
			'escrow_company' => "required",
			'contact_information' => "required|digits:10",
			'escrow_officer' => "required",
			'other_terms' => "required",
			'tnc' => "required",
			'multiple_counter' => "required",
		];
		return $rules;
	}

	public function render() {
		return view('livewire.web.counter-offer');
	}

	public function mount(Request $request, $id) {

		$this->offer_id = $id;

		$offer = Offers::find($this->offer_id);
		if (isset($offer)) {
			$this->offered_price = number_format($offer->transaction->offer_price);
			$this->buyer_name = $offer->buyer_name;
			$this->closing_costs = number_format($offer->transaction->offer_price * ($offer->strategy->estimated_closing_costs ?? 0) / 100);
			$this->seller_credit = number_format($offer->transaction->seller_credit_amount);
			$this->funds_needed_close = number_format($offer->document->downpayment_verified_amount ) ?? '';
			$this->mortgage_loan1 = number_format($offer->strategy->first_mortgage_loan_amount);
			$this->mortgage_loan2 = number_format($offer->strategy->second_mortgage_loan_amount);
			$this->initial_deposit = number_format($offer->strategy->initial_deposit_amount);
			$this->deposit_increase = number_format($offer->strategy->deposit_increase);
			$this->balance_at_closing = number_format($offer->strategy->balance_down_payment);
			$this->close_escrow = Carbon::parse($offer->property->end_date)->addDay($offer->transaction->days_of_escrow + 1)->format('Y-m-d');
		} else {
			session()->flash('error', $this->getMessage(415));
			return redirect()->back();
		}

	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function submitCounter(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());
		$user = auth()->user();
		$request->merge(['amount' =>$this->formatCurrency($this->price),
			'offer_id' => $this->offer_id,
			'close_of_escrow' => $this->close_of_escrow,
			'inspection' => $this->inspection_property,
			'loan_contingency' => $this->loan_contingency,
			'escrow_company' => $this->escrow_company,
			'escrow_number' => $this->contact_information,
			'contact_info' => $this->contact_information,
			'escrow_officer' => $this->escrow_officer,
			'other_terms' => $this->other_terms,
			'tnc' => $this->tnc,
			'multiple_counter' => $this->multiple_counter]);

		$result = app('App\Http\Controllers\Api\Seller\ApiController')->counterOfferUpdate($request);
		$data = $result->getData();

		if ($data->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $data->message);
		} else {
			session()->flash('error', $data->message);
		}
		return redirect('/offers');
	}
}
