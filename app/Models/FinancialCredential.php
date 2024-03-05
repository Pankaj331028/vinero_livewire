<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialCredential extends Model
{
    use HasFactory;

    public function offer() {
		return $this->belongsTo(Offers::class, 'offer_id', 'id');
	}
    
}
