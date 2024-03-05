<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class BuyerResource extends JsonResource
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
            'id' => $this->id,
            'mobile_verified' => $this->mobile_verified_at ? 1 : 0,
            'property_id' => $this->property_id,
            'property_status' => $this->property->status,
            'first_name' => $this->first_name ?? '',
            'last_name' => $this->last_name ?? '',
            'email' => $this->email_id ?? '',
            'mobile' => $this->phone_no ?? '',
            'status' => $this->status ?? '',
            'user_type' => $this->user_type,
            'access_token' => $this->logtoken ?? '',
            'my_offer' => $this->offer()->exists(),
            'transaction' => $this->offer ? $this->offer->transaction()->exists() : false,
            'strategy' => $this->offer ? $this->offer->strategy()->exists() : false,
            'timings' => $this->offer ? $this->offer->contract()->exists() : false,
            'doc_verification' => $this->offer ? $this->offer->document()->exists() : false,
            'items_include_exclude' => $this->offer ? isset($this->offer->additional_items) || isset($this->offer->excluded_items) : false,
            'cost_allocation' => $this->offer ? $this->offer->cost_allocation()->exists() : false,
            'summary' => $this->offer ? isset($this->offer->buyer_advisory) : false,
            'monitoring_control' => $this->optin_out,
            'financial_credentials' => isset($this->offer->financials) ? 1 : 0,
        ];
    }
}