<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionOverview extends Model {
	use HasFactory;

	protected $table = 'transaction_overview';

	public function offer() {
		return $this->belongsTo(Offers::class);
	}
}
