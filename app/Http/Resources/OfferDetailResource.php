<?php

namespace App\Http\Resources;

use App\Traits\Helper;
use Illuminate\Http\Resources\Json\JsonResource;

class OfferDetailResource extends JsonResource {
	use Helper;
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */

	public function toArray($request) {
		$notificaiton = '';
		if ($request->notification) {
			$notificaiton = '';
		}

		$currency = $this->getSetting('currency');

		$mortgage_1 = 0;
		$mortgage_2 = 0;

		if ($this->first_mortgage_loan_amount && $this->second_loan_interest_rate) {
			$mortgage_1 = $this->calPMT($this->first_loan_interest_rate, 30, $this->first_mortgage_loan_amount);
			$mortgage_2 = $this->calPMT($this->second_loan_interest_rate, 30, $this->second_mortgage_loan_amount);
		}

		$final_est_mortgage = $mortgage_1 + $mortgage_2;
		// dd($this->first_mortgage_loan_amount, $this->second_mortgage_loan_amount, $this->balance_down_payment, ($this->offer_price * $this->estimated_closing_costs / 100), $this->seller_credit_amount);

		return [
			'buyer_name' => $this->buyer_name,
			'agent_name' => $this->buyer_agent ?? '',
			'submitted_on' => $this->status != 'IN' ? $this->submitted_date : '',
			'offered_price' => $this->offer_price,
			'improved_price' => $this->improved_price,
			'counter_price' => $this->counter_price,
			'email_sent' => 1,
			'deadline' => \Carbon\Carbon::parse($this->vms_end_date)->format('Y-m-d H:i:s'),
			'agent_commission' => $this->buyer_agent_commission ?? '',
			'net_price' => $this->net_price,
			'money_deposit' => $this->initial_deposit_amount ?? 0,
			'down_payment' => $this->balance_down_payment ?? 0,
			'est_mortgage' => $final_est_mortgage,
			'mortgage_loan' => $this->first_mortgage_loan_amount + $this->second_mortgage_loan_amount,
			//'proof_funds' => $this->first_mortgage_loan_amount ? $this->first_mortgage_loan_amount + $this->second_mortgage_loan_amount + ($this->offer_price * $this->estimated_closing_costs / 100) - $this->seller_credit_amount : 0,
			'proof_funds' => $this->downpayment_verified_amount,
			// 'proof_funds' => $this->balance_down_payment + ($this->offer_price * $this->estimated_closing_costs / 100) - $this->seller_credit_amount,
			'preapproval_amount' => $this->first_mortgage_loan_amount ? $currency . number_format($this->first_mortgage_loan_amount) . ' - ' . $currency . number_format($this->second_mortgage_loan_amount) : '',
			//'qualify_for' => $this->first_mortgage_loan_amount + $this->second_mortgage_loan_amount + $this->loan_application_amount + $this->loan_application_amount,
			// 'qualify_for' => $this->first_mortgage_loan_amount + $this->second_mortgage_loan_amount + $this->downpayment_verified_amount,
			'qualify_for' => $this->first_mortgage_loan_amount + $this->second_mortgage_loan_amount + $this->downpayment_verified_amount - ($this->offer_price * $this->estimated_closing_costs / 100) + $this->seller_credit_amount,
			'lender' => $this->first_direct_lender_name ? $this->first_direct_lender_name . ' - ' . $this->second_direct_lender_name : '',
			'interest' => $this->first_loan_interest_rate ? $this->first_loan_interest_rate . '% - ' . $this->second_loan_interest_rate . '%' : '',
			'bid_per_sqfeet' => sprintf('%0.2f', round($this->offer_price / $this->square_foot_rate, 2)),
			'purchase_contract' => $this->pdf ?? asset('uploads/purchase_contract/purchase-agreement.pdf'), //TODO
			// 'purchase_contract' => asset('uploads/purchase_contract/purchase-agreement.pdf'), //TODO
			'is_reviewed' => $this->is_reviewed,
			'financial_credentials' => count($this->financials) > 0 ? 1 : 0,
			'disclosure' => $this->disclosure ? asset($this->disclosure) : '',
			'offer_increase' => $this->offer_increase,
			'status' => in_array($this->status, ['IN', 'PN', 'DCIN', 'FCIN']) ? true : false,
			'notification' => $this->notification->data['details'] ?? '',
			'minimum_offer_price' => sprintf('%0.2f', round($this->offer_price - ($this->offer_price * $this->offer_increase / 100))),
			'highest_bid_amount' => $this->highest_bid,
			'reserved_price' => $this->reserved_price,
			'property_address' => $this->property_address,
			'dashboard_dates' => [
				'email_recevied' => isset($this->approved_on) ? \Carbon\Carbon::parse($this->approved_on)->format('Y-m-d H:i:s') : '',
				'improved_on' => isset($this->price_improved_on) ? \Carbon\Carbon::parse($this->price_improved_on)->format('Y-m-d H:i:s') : '',
				'withdrawan_on' => isset($this->cancelled_at) ? \Carbon\Carbon::parse($this->cancelled_at)->format('Y-m-d H:i:s') : '',
				'notified_on' => isset($this->notification->created_at) ? \Carbon\Carbon::parse($this->notification->created_at)->format('Y-m-d H:i:s') : '',
				'offer_accepted' => isset($this->approved_on) ? \Carbon\Carbon::parse($this->approved_on)->format('Y-m-d H:i:s') : '',
				'financial_improved' => !empty($this->financial_improved_on) ? \Carbon\Carbon::parse($this->financial_improved_on)->format('Y-m-d H:i:s') : '',
				'counter_on' => !empty($this->counter_on) ? \Carbon\Carbon::parse($this->counter_on)->format('Y-m-d H:i:s') : '',
			],
			'is_offer_accepted' => $this->is_offer_accepted ?? false,
		];
	}
}
