<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OfferStepResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request) {
		if (isset($this->status)) {
			$financial = $this->financials;
			//dd(count($financial));
			return [
				'status' => in_array($this->status, ['IN', 'PN', 'DCIN', 'FCIN']) ? true : false,
				'my_offer' => true,
				'transaction' => $this->transaction()->exists(),
				'strategy' => $this->strategy()->exists(),
				'timings' => $this->contract()->exists(),
				'doc_verification' => $this->document()->exists(),
				'items_include_exclude' => $this->include_exclude()->exists(),
				'cost_allocation' => $this->cost_allocation()->exists(),
				'summary' => $this->buyer_advisory ? true : false,
				'financial_credentials' => count($financial) > 0 ? 1 : 0,
				'details' => [
					'property_address' => "If this is not the correct address, please contact us. info@Qonectin.com",
					'buyer_name' => "Enter all Buyers separated by semi-colon ;",
					'real_estate' => "Contact us if you need assistance info@Qonectin.com",
					'possession' => "Terms can be negotiated under “Other Terms and Conditions",
					'doc_verification' => "You must upload documentation that supports your financial capacity to complete the transaction",
					'include_exclude' => "Items Seller included and exclude in the sale.  Buyers can negotiate items in this section. N/A is not applicable",
					'cost_allocation' => "Buyers can negotiate items in this section.",
					'offer_summary' => "Verify your Offer Summary. Go back to Smart Offer Terms Manager to edit your offer.",
				],
			];
		} else {
			return [
				'status' => false,
				'my_offer' => false,
				'transaction' => false,
				'strategy' => false,
				'timings' => false,
				'doc_verification' => false,
				'items_include_exclude' => false,
				'cost_allocation' => false,
				'summary' => false,
				'financial_credentials' => 0,
				'details' => [
					'property_address' => "If this is not the correct address, please contact us. info@Qonectin.com",
					'buyer_name' => "Enter all Buyers separated by semi-colon ;",
					'real_estate' => "Contact us if you need assistance info@Qonectin.com",
					'possession' => "Terms can be negotiated under “Other Terms and Conditions",
					'doc_verification' => "You must upload documentation that supports your financial capacity to complete the transaction",
					'include_exclude' => "Items Seller included and exclude in the sale.  Buyers can negotiate items in this section. N/A is not applicable",
					'cost_allocation' => "Buyers can negotiate items in this section.",
					'offer_summary' => "Verify your Offer Summary. Go back to Smart Offer Terms Manager to edit your offer.",
				],
			];
		}
	}
}
