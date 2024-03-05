<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CounterOfferDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'amount'           => $this->amount,
            'close_of_escrow'  => $this->close_of_escrow,
            'inspection_prop'  => $this->inspection,
            'loan_contingency' => $this->loan_contingency,
            'escrow_number'    => $this->escrow_number,
            'escrow_company'   => $this->escrow_company,
            'escrow_officer'   => $this->escrow_officer,
            'escrow_contact'   => $this->escrow_number,
            'multiple_counter' => $this->multiple_counter,
            'other_terms'      => $this->other_terms,
        ];
    }
}
