<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BuyerService extends Model
{
    use HasFactory; 

    protected $guarded = [];

	protected $table = 'buyer_services';
}
