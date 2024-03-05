<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Account extends Authenticatable
{
    use HasFactory, SoftDeletes, HasApiTokens;

    protected $guarded = [];

	protected $table = 'accounts';
}
