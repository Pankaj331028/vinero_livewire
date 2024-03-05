<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Notification extends Model {

	use Notifiable;

	protected $casts = [
		'data' => 'array',
		'id' => 'string',
	];

	protected $fillable = [
		'type', 'notifiable_id', 'notifiable_type', 'data',
	];

	protected $table = "notifications";

	public function user() {
		return $this->belongsTo(User::class, 'notifiable_id', 'id')->withTrashed();
	}

	public function getSenderAttribute() {
		if (isset($this->data['sender_id'])) {

			return User::where('id', $this->data['sender_id'])->first();
		} else {
			return '';
		}
	}

	public function getReceiverAttribute() {
		return User::where('id', $this->notifiable_id)->first();
	}

	public function fetchNotifications($request, $columns) {
		$query = Notification::where('data', '!=', '');
		if (isset($request->from_date)) {
			$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date("Y-m-d", strtotime($request->from_date)) . '"');
		}
		if (isset($request->end_date)) {
			$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") <= "' . date("Y-m-d", strtotime($request->end_date)) . '"');
		}
		if (isset($request->search)) {
			$query->where(function ($q) use ($request) {
				$q->where('data', 'like', '%' . $request->search . '%');

			});
		}
		if (isset($request->order_column)) {
			$plans = $query->orderBy($columns[$request->order_column], $request->order_dir);
		} else {
			$plans = $query->orderBy('created_at', 'desc');
		}
		return $plans;
	}

}