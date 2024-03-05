<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Offers extends Model {
	use HasFactory, SoftDeletes;
	protected $table = 'offers';
	// protected $appends = ['highest_bid'];

	public function owner() {
		return $this->belongsTo(Buyer::class, 'user_id', 'id')->withTrashed();
	}

	public function property() {
		return $this->belongsTo(Property::class, 'property_id', 'id');
	}

	public function transaction() {
		return $this->belongsTo(TransactionOverview::class, 'id', 'offer_id');
	}

	public function strategy() {
		return $this->belongsTo(AcquisitionStrategy::class, 'id', 'offer_id');
	}

	public function contract() {
		return $this->belongsTo(ContractTimings::class, 'id', 'offer_id');
	}

	public function financial() {
		return $this->belongsTo(FinancialCredential::class, 'id', 'offer_id')->whereIn('status', ['AC', 'PN']);
	}

	//document verification
	public function document() {
		return $this->belongsTo(DocumentVerification::class, 'id', 'offer_id');
	}

	public function include_exclude() {
		return $this->belongsTo(ItemsIncludeExclude::class, 'id', 'offer_id');
	}

	public function cost_allocation() {
		return $this->belongsTo(AllocationCost::class, 'id', 'offer_id');
	}

	public function financials() {
		return $this->hasMany(FinancialCredential::class, 'offer_id', 'id')->whereIn('status', ['AC', 'PN']);
	}

	public function getHighestBidAttribute() {
		$offers = $this->property->offers;
		return $offers->max('transaction.offer_price');
	}

	public function counter() {
		return $this->hasOne(CounterOffer::class, 'offer_id', 'id')->where('user_id', $this->property->seller->id)->where('status', 'AC');
	}
}
