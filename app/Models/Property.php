<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model {
	use HasFactory;

	protected $table = 'property';
	protected $fillable = ['comment_note', 'status'];
	protected $casts = [
		'itmes_include_exclude' => 'array',
	];

	public function seller() {
		return $this->belongsTo(Seller::class, 'user_id')->withTrashed();
	}

	public function history() {
		return $this->belongsTo(PropertyHistory::class, 'id', 'property_id');
	}

	//assigned to agent
	public function agent() {
		return $this->belongsTo(Agent::class, 'agent_id')->withTrashed();
	}
	//assigned to agent
	public function active_agent() {
		return $this->belongsTo(Agent::class, 'agent_id');
	}

	/**
	 * Get all of the survey for the Property
	 *
	 * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
	 */
	public function survey(): HasManyThrough {
		return $this->hasManyThrough(Survey::class, Buyer::class);
	}

	public function offers() {
		return $this->hasMany(Offers::class, 'property_id', 'id');
	}

	public function offers_status() {
		return $this->hasMany(Offers::class, 'property_id', 'id')->select('status');
	}

	public function sold_offer() {
		return $this->hasOne(Offers::class, 'property_id', 'id')->where('status', 'SO');
	}

	public function cl_offer() {
		return $this->hasOne(Offers::class, 'property_id', 'id')->where('status', 'CL');
	}
}
