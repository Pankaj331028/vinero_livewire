<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Agent extends Authenticatable {
	use HasFactory, SoftDeletes, HasApiTokens, Notifiable;
	protected $table = 'users';

	protected $fillable = ['first_name', 'last_name', 'comment_note', 'block_comment', 'status'];

	protected $dates = ['deleted_at'];

	public function routeNotificationForMail($notification) {
		return $this->email_id;
	}

	public function vms_property_id() {
		return $this->belongsTo(Property::class, 'user_id', 'id');
	}

	public function property() {
		return $this->belongsTo(Property::class, 'property_id', 'vms_property_id');
	}
	public function agent_properties() {
		return $this->hasMany(Property::class, 'agent_id', 'id');
	}

	//get agent data with same number
	public function users() {
		return $this->hasMany(Agent::class, 'phone_no', 'phone_no')->withTrashed();
	}

	public function getAgentTypeAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		$role = Buyer::whereIn('agent_id', $ids)->pluck('user_type')->first();
		if ($role) {
			if ($role == 'seller') {
				$type = "Seller's agent";
			} else {
				$type = "Buyer's agent";
			}
		} else {
			$type = '';
		}

		return $type;

	}

	public function getWebIdAttribute() {
		$query = $this->users();
		$web_id = $this->users()->wherePlatform('web')->pluck('id')->first();
		$phone_id = $this->users()->wherePlatform('phone')->pluck('id')->first();

		return $web_id ?? $phone_id;
	}

	public function getNameAttribute() {
		$user = $this->users()->whereNotNull('first_name')->first();
		$name = isset($user->first_name) ? $user->first_name . ' ' . $user->last_name : '';
		return $name;
	}

	public function getTotalBidsAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Offers::whereIn('updated_by', $ids)->count();
	}

	public function getApprovedBidsAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Offers::whereIn('updated_by', $ids)->whereStatus('AC')->count();
	}

	public function getUnapprovedBidsAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Offers::whereIn('updated_by', $ids)->whereStatus('RJ')->count();
	}

	public function devices() {
		return $this->hasMany(UserDevice::class, 'user_id')->where('status', 'AC');
	}

	public function offers() {
		return $this->hasMany(Offers::class, 'agent_id');
	}

	public function offer() {
		return $this->hasOne(Offers::class, 'agent_id')->orderBy('id', 'desc');
	}

	public function head() {
		return $this->hasOne(Buyer::class, 'agent_id');
	}

}
