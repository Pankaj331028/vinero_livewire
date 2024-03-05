<?php

namespace App\Http\Livewire\Web;

use App\Traits\Helper;
use Illuminate\Http\Request;
use Livewire\Component;

class Congratulations extends Component {
	use Helper;

	public $purchase_price;
	public $transaction_coordinator;
	public $emd_deposit;
	public $escrow_number;
	public $escrow_officer;
	public $initial_deposit_escrow_days;
	public $initial_deposit_escrow_date;
	public $contractual_disclosures_days;
	public $contractual_disclosures_date;
	public $inspections_contingency_days;
	public $inspections_contingency_date;
	public $loan_contingency_days;
	public $loan_contingency_date;
	// public $inspections_contingency_days;
	// public $inspections_contingency_date;
	public $title_review_days;
	public $title_review_date;
	public $close_of_escrow_days;
	public $close_of_escrow_date;

	public function mount(Request $request) {
		$user = auth()->user();
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$offerAcceptance = app('App\Http\Controllers\Api\Buyer\ApiController')->offerAcceptance($request);

		$offer_acceptance = $offerAcceptance->getData()->data;

		$this->purchase_price = $offer_acceptance->purchase_price;
		$this->transaction_coordinator = $offer_acceptance->transaction_coordinator;
		$this->emd_deposit = $offer_acceptance->emd_deposit;
		$this->escrow_number = $offer_acceptance->escrow_no;
		$this->escrow_officer = $offer_acceptance->escrow_officer;
		$this->initial_deposit_escrow_days = $offer_acceptance->initial_deposit_escrow->days;
		$this->initial_deposit_escrow_date = $offer_acceptance->initial_deposit_escrow->date;
		$this->contractual_disclosures_days = $offer_acceptance->contractual_disclosure->days;
		$this->contractual_disclosures_date = $offer_acceptance->contractual_disclosure->date;
		$this->inspections_contingency_days = $offer_acceptance->inspections_contingency->days;
		$this->inspections_contingency_date = $offer_acceptance->inspections_contingency->date;
		$this->loan_contingency_days = $offer_acceptance->loan_contingency->days;
		$this->loan_contingency_date = $offer_acceptance->loan_contingency->date;
		$this->title_review_days = $offer_acceptance->title_review->days;
		$this->title_review_date = $offer_acceptance->title_review->date;
		$this->close_of_escrow_days = $offer_acceptance->close_of_escrow->days;
		$this->close_of_escrow_date = $offer_acceptance->close_of_escrow->date;

	}
	public function render() {
		return view('livewire.web.congratulations');
	}
}
