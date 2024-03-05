<?php

namespace App\Http\Middleware;
use App\Models\Buyer;
use App\Models\Offers;
use Auth;
use Closure;
use Illuminate\Support\Facades\Request;
use URL;

class loginAuth {
	//add an array of Routes to skip login check
	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, ...$guards) {
		// dd(Auth::check());
		if (count($guards) > 0) {
			foreach ($guards as $guard) {
				if (!Auth::guard($guard)->check()) {
					switch ($guard) {
					case 'accounts':
						return redirect('login');
						break;
					case 'api':
						if (!$request->expectsJson()) {
							if (stripos(URL::current(), 'api') !== false) {
								echo json_encode(['success' => false, 'message' => 'Unauthenticated', 'status' => 400]);
								exit;
							} else {
								return route('weblogin');
							}
						}
						break;

					default:
						return redirect('login');
						break;
					}
				}
			}
		} else {
			// dd(Auth::check());
			if (!Auth::check()) {
				return redirect('login');
			}

		}

		$usertype = '';

		if (Auth::check()) {
			// check for usertype according to uri segments and redirect if not accessed
			$usertype = Auth::user()->user_type;

			if ($usertype == 'agent') {
				$u = Buyer::whereAgentId(Auth::id())->first();
				$usertype = ($u->user_type == 'buyer') ? 'buyer-agent' : 'seller-agent';
			}
			if (in_array($usertype, ['buyer', 'buyer-agent'])) {

				switch (Request::segment(1)) {
				case 'add-property':
				case 'seller-dashboard':
				case 'offers':
				case 'offer-detail':
				case 'offer-status':
				case 'notify-offerIntrest':
				case 'counter-offer':
					session()->flash('error', 'You don\'t have access to this panel. Login to Seller Account for further access.');
					return redirect()->route('buyer-dashboard');
					break;

				}
				$offer = Auth::user()->offer;

				if ($usertype == 'buyer-agent') {
					$offer = Offers::whereAgentId(Auth::id())->first();
				}

				if (isset($offer->id) && in_array($offer->status, ['CL', 'RJ'])) {
					return redirect()->route('weblogout');
				}

			} elseif (in_array($usertype, ['seller', 'seller-agent'])) {
				switch (Request::segment(1)) {

				case 'offer':
				case 'my-offer':
				case 'bid-final-best':
				case 'buyer-dashboard':
				case 'download-pdf':
				case 'bid-modification':
				case 'offer-of-interest':
				case 'incomplete-offer':
				case 'offer-cancellation':
				case 'view-seller-counter':
				case 'counter-to-counter':
				case 'higher-offer-received':
				case 'offer-not-approved':
				case 'offer-deadline-extension':
				case 'update-credentials':
				case 'survey':
				case 'congratulations':
					session()->flash('error', 'You don\'t have access to this panel. Login to Buyer Account for further access.');
					return redirect()->route('seller-dashboard');
					break;
				}
			}
		}
		\View::share('global_user_type', $usertype);

		return $next($request);
	}
}
