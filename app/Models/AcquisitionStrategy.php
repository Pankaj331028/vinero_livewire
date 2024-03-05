<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcquisitionStrategy extends Model
{
    use HasFactory;
    protected $table = 'acquisition_strategy';

    public function offers()
    {
        return $this->belongsTo('App\AcquisitionStrategy', 'offer_id','id');
    }
}
