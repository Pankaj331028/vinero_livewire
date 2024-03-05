<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class webAuth {
	//add an array of Routes to skip login check
	//protected $except_urls = ['/', '/forgot-password', '/reset-password'];
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next) {
		if (!Auth::guard('front')->check()) {
			return redirect(route('weblogin'));
		}

		return $next($request);
	}
}
