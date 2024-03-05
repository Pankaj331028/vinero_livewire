<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model {
	use HasFactory;

	protected $table = 'surveys';

	public function user() {
		return $this->belongsTo(Buyer::class, 'user_id', 'id')->withTrashed();
	}

	/**
	 * Get all of the property for the Survey
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function property(): HasManyThrough {
		return $this->hasManyThrough(Survey::class, Buyer::class, 'property_id', 'user_id');
	}

}
