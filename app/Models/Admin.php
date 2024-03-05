<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Activitylog\Traits\CausesActivity;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable {
	use HasFactory, Notifiable, SoftDeletes, HasRoles, CausesActivity;
	protected $guard = 'admin';
	protected $table = 'admin';

	public function routeNotificationForMail($notification) {
		return $this->email_id;
	}
	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [
		'name',
		'email',
		'password',
	];

	/**
	 * The attributes that should be hidden for arrays.
	 *
	 * @var array
	 */
	protected $hidden = [
		'password',
		'remember_token',
	];

	/**
	 * The attributes that should be cast to native types.
	 *
	 * @var array
	 */
	protected $casts = [
		'email_verified_at' => 'datetime',
	];

	public function user_role() {
		return $this->belongsTo(Role::class, 'role', 'id');
	}

	public function permissions() {
		return $this->hasMany(ModelPermission::class, 'model_id');
	}
}
