<?php

namespace App\Http\Controllers;

use App\Models\Buyer as User;
use App\Models\UserDevice;
use Illuminate\Http\Request;
use Session;

class WebNotificationController extends Controller {
	public function __construct() {
		$this->middleware('auth');
	}

	public function storeToken(Request $request) {
		$user_id = auth()->user()->id;
		UserDevice::where('user_id', $user_id)->where('device_type', '=', 'pc/laptop')->update(['device_token' => $request->token]);
		Session::put('current_token', $request->token);
		return response()->json(['Token successfully stored.']);
	}
}
