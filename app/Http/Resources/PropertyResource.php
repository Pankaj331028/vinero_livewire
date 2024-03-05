<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource {
	/**
	 * Transform the resource into an array.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
	 */
	public function toArray($request) {
		return
			[
			'due_date' => $this->vms_end_date,
			'reserved_price' => $this->reserved_price,
			'offer_increase' => $this->offer_increase,
			'can_extend' => $this->history()->count() > 1 ? 0 : 1,
		];
	}
}
