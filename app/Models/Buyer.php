<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Buyer extends Authenticatable {
	use HasFactory, SoftDeletes, HasApiTokens, Notifiable;

	protected $table = 'users';

	protected $fillable = ['first_name', 'last_name', 'comment_note', 'block_comment', 'status', 'agent_id','device_key'];
	protected $dates = ['deleted_at'];

	public function routeNotificationForMail($notification)
    {
        return $this->email_id;
    }
	
	public function property() {
		return $this->belongsTo(Property::class, 'property_id', 'vms_property_id');
	}

	public function offer() {
		return $this->hasOne(Offers::class, 'user_id');
	}

	public function all_properties() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('property_id')->toArray();
		return Property::select(DB::Raw('group_concat(property_address) as address'))->whereIn('vms_property_id', $ids)->first()->address;
	}

	public function survey() {
		return $this->hasMany(Survey::class, 'user_id', 'id');
	}

	public function active_offer() {
		return $this->offer()->where('status', 'AC');
	}

	public function agent() {
		return $this->hasMany(Buyer::class, 'agent_id')->withTrashed();
	}

	//get buyer data with same number
	public function users() {
		return $this->hasMany(Buyer::class, 'phone_no', 'phone_no')->where('user_type','buyer')->withTrashed();
	}

	public function getWebIdAttribute() {
		$query = $this->users()->whereNull('deleted_at');
		$web_id = $this->users()->whereNull('deleted_at')->wherePlatform('web')->pluck('id')->first();
		$phone_id = $this->users()->whereNull('deleted_at')->wherePlatform('phone')->pluck('id')->first();

		return $web_id ?? $phone_id;
	}

	public function getNameAttribute() {
		$user = $this->users()->whereNull('deleted_at')->whereNotNull('first_name')->first();
		$name = isset($user->first_name) ? $user->first_name . ' ' . $user->last_name : '';
		return $name;
	}

	public function getTotalBidsAttribute() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('id')->toArray();
		return $bids = Offers::whereIn('user_id', $ids)->where('status', '!=', 'IN')->count();
	}

	public function getApprovedBidsAttribute() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('id')->toArray();
		return $bids = Offers::whereIn('user_id', $ids)->whereStatus('AC')->count();
	}

	public function getUnapprovedBidsAttribute() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('id')->toArray();
		return $bids = Offers::whereIn('user_id', $ids)->whereStatus('RJ')->count();
	}

	public function getWithdrawnBidsAttribute() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('id')->toArray();
		return $bids = Offers::whereIn('user_id', $ids)->whereStatus('CL')->count();
	}

	public function devices() {
		return $this->hasMany(UserDevice::class, 'user_id')->where('status', 'AC');
	}
}
