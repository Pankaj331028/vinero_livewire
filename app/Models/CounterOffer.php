<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CounterOffer extends Model {
	use HasFactory;

	protected $fillable = ['status'];

	public function offer() {
		return $this->belongsTo(Offers::class, 'offer_id', 'id');
	}

	//counter_by Seller/Buyer
	public function user() {
		return $this->belongsTo(Buyer::class, 'user_id', 'id')->withTrashed();
	}
}
