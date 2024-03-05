<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Document extends Model
{
   
    use SoftDeletes;
    
    protected $table = 'documentables';

    // Primary key
    public $primaryKey = 'id';
    protected $keyType = 'string';

    public function documentable()
    {
        return $this->morphTo();
    }

    public function getPathAttribute($value)
    {
        return asset($value);
    }

}
