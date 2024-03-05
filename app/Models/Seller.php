<?php

namespace App\Models;

use DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Seller extends Authenticatable {
	use HasFactory, SoftDeletes, HasApiTokens, Notifiable;
	protected $table = 'users';
	protected $fillable = ['first_name', 'last_name', 'comment_note', 'block_comment', 'status'];
	protected $dates = ['deleted_at'];

	public function routeNotificationForMail($notification) {
		return $this->email_id;
	}

	public function property() {
		return $this->belongsTo(Property::class, 'property_id', 'vms_property_id');
	}

	//get seller data with same number
	public function users() {
		return $this->hasMany(Seller::class, 'phone_no', 'phone_no')->withTrashed();
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

	public function getTotalPropertiesAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Property::whereIn('user_id', $ids)->count();
	}

	public function getTotalBidsAcceptedAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Offers::whereHas('property', function ($query) use ($ids) {
			$query->whereIn('user_id', $ids)->whereStatus('AC');
		})->whereStatus('AC')->count();
	}

	public function getTotalRejectedBidsAttribute() {
		$ids = $this->users()->pluck('id')->toArray();
		return $bids = Offers::whereHas('property', function ($query) use ($ids) {
			$query->whereIn('user_id', $ids)->whereStatus('AC');
		})->where('status', 'RJ')->count();
	}

	//function to fetch counter offer details
	public function counter() {
		return $this->belongsTo(CounterOffer::class, 'id', 'user_id')->whereStatus('AC');
	}

	public function devices() {
		return $this->hasMany(UserDevice::class, 'user_id')->where('status', 'AC');
	}

	public function offers() {
		return $this->hasManyThrough(Offers::class, Property::class, 'user_id', 'property_id');
	}

	public function properties() {
		return $this->belongsToMany(Property::class, 'users', 'phone_no', 'property_id', 'phone_no', 'vms_property_id');
	}

	public function all_properties() {
		$ids = $this->users()->whereNull('deleted_at')->pluck('property_id')->toArray();
		return Property::select(DB::Raw('group_concat(property_address) as address'))->whereIn('vms_property_id', $ids)->first()->address;
	}
}
