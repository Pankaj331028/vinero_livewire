<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SellerResource extends JsonResource
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
            'monitoring_control' => $this->optin_out,
        ];
    }
}