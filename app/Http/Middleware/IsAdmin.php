<?php

namespace App\Http\Middleware;

use Auth;
use Closure;
use Illuminate\Http\Request;

class IsAdmin {
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle(Request $request, Closure $next) {
		if (Auth::guard('admin')->check()) {
			if (in_array(Auth::guard('admin')->user()->user_role->name, ['admin', 'subadmin'])) {

				return $next($request);
			} else {
				session()->flash('error', "You don't have access to this section");
				return redirect()->route('index');
			}
		} else {
			session()->flash('error', 'Please login to continue');
			return redirect()->route('login');
		}
	}
}
