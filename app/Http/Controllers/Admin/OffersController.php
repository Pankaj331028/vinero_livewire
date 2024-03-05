<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\DocumentVerification;
use App\Models\FinancialCredential;
use App\Models\Offers;
use App\Notifications\InformBuyerHigherOffer;
use App\Notifications\InformBuyerIncompleteOffer;
use App\Notifications\InformSellerNewOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Session;

class OffersController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Offers  $offers
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id) {
		$title = 'View Bids/Offer';

		if (empty($request->sortby)) {
			$request->merge(['sortby' => 'net_price']);
		}

		$sortby = $request->sortby ?? null;

		$offers = DB::select("CALL GetProperyOffer(?,?)", [$id, $sortby]);
		return view('admin.offer.view', array('offers' => $offers, 'title' => 'View Bids/Offer'));
	}

	// offer view
	public function offer_view($id) {
		$offer = DB::select("CALL GetOfferDetail($id)")[0];
		// dd($offer);

		$downnpaymentFiles = [];
		$otherFiles = [];
		$cashFiles = [];
		$loanApplicationFiles = [];
		$financial = '';

		if ($offer) {
			$downnpaymentFiles = DocumentVerification::find($offer->doc_id)->documents()->where(['type' => 'downpayment_verified_image', 'status' => 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc')->get();

			$otherFiles = DocumentVerification::find($offer->doc_id)->documents()->where(['type' => 'other_document_image', 'status' => 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc')->get();

			$cashFiles = DocumentVerification::find($offer->doc_id)->documents()->where(['type' => 'cash_verified_image', 'status' => 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc')->get();

			$loanApplicationFiles = DocumentVerification::find($offer->doc_id)->documents()->where(['type' => 'loan_application_image', 'status' => 'AC'])->select('id', 'name', \DB::raw("CONCAT('" . asset("") . "', path) image"))->orderBy('created_at', 'desc')->get();

			$financial = FinancialCredential::whereOfferId($id)->whereIn('status', ['PN', 'AC'])->first();
		} else {
			session()->flash('error', 'Invalid Request');
			return redirect()->back();
		}

		return view('admin.offer.detail', array('offer' => $offer, 'title' => 'Offer Details', 'downnpaymentFiles' => $downnpaymentFiles, 'otherFiles' => $otherFiles, 'cashFiles' => $cashFiles, 'loanApplicationFiles' => $loanApplicationFiles, 'financial' => $financial));
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Offers  $offers
	 * @return \Illuminate\Http\Response
	 */
	public function edit(Offers $offers) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Offers  $offers
	 * @return \Illuminate\Http\Response
	 */
	public function updateDocStatus(Request $request) {
		$offer = Offers::find($request->id);

		if ($offer) {
			$doc = DocumentVerification::where('offer_id', $request->id)->update(['status' => $request->status]);
			$fcstatus = FinancialCredential::where('offer_id', $request->id)->where('status', 'PN')->count();

			if ($request->status == 'AC') {
				if ($fcstatus <= 0) {
					$seller = $offer->property->seller()->get();
					$agent = Agent::where('id', $offer->property->seller->agent_id)->get();
					$notified_user = $seller->concat($agent);

					foreach ($notified_user as $notify_user) {
						$notify_user->notify(new InformSellerNewOffer($offer, $notify_user));
					}

					// send notify other buyers with lower offer price about higher price bid by logged in buyer

					$offers = Offers::where('property_id', $offer->property->id)->whereHas('transaction', function ($q) use ($offer) {
						$q->where('offer_price', '<', $offer->transaction->offer_price);
					})->where('user_id', '!=', $offer->user_id)->get();

					foreach ($offers as $offer1) {
						$diff = $offer->transaction->offer_price - $offer1->transaction->offer_price;

						//notify
						$buyer = $offer1->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
						$agent = Agent::where('id', $offer1->agent_id)->get();

						$notified_users = $buyer->concat($agent);

						foreach ($notified_users as $notify_user) {
							$notify_user->notify(new InformBuyerHigherOffer($offer1, $diff, $notify_user));
						}
					}

					// send notification to this buyer if the price is lower than other buyer price

					$off = Offers::where('property_id', $offer->property->id)->whereHas('transaction', function ($q) use ($offer) {
						$q->where('offer_price', '>', $offer->transaction->offer_price);
					})->where('user_id', '!=', $offer->user_id)->get()->sortByDesc(function($offer) { 
						return $offer->transaction->offer_price;
				   });
					// ->orderBy('transaction.offer_price', 'desc')->first();
					// dd($off);
					if($off->count()>0){
						$off=$off[0];
					

					$diff = $off->transaction->offer_price - $offer->transaction->offer_price;

					//notify
					$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
					$agent = Agent::where('id', $offer->agent_id)->get();

					$notified_users = $buyer->concat($agent);

					foreach ($notified_users as $notify_user) {
						$notify_user->notify(new InformBuyerHigherOffer($offer, $diff, $notify_user));
					}
					}
				}

			} else {
				$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
				$agent = Agent::where('id', $offer->agent_id)->get();
				$notified_user = $buyer->concat($agent);

				foreach ($notified_user as $notify_user) {
					$notify_user->notify(new InformBuyerIncompleteOffer($offer, 1, 'proof_funds', $notify_user));
				}
			}

			if ($request->status == 'AC') {
				if ($fcstatus <= 0) {
					$offer->status = $request->status;
					$offer->approved_on = date('Y-m-d H:i:s');
				} else {
					$offer->status = 'PN';
				}

			} else {
				$offer->status = 'DCIN';
			}

			$offer->save();

			session()->flash('success', 'Status updated succesfully');
			return redirect()->back();
		} else {
			session()->flash('error', 'Invalid Offer');
			return redirect()->back();
		}
	}

	public function updateFcStatus(Request $request) {
		$offer = Offers::find($request->id);

		if ($offer) {
			$doc = FinancialCredential::where('offer_id', $request->id)->update(['status' => $request->status]);

			$dstatus = DocumentVerification::where('offer_id', $request->id)->where('status', 'PN')->count();

			if ($request->status == 'AC') {
				if ($dstatus <= 0) {
					$seller = $offer->property->seller()->get();
					$agent = Agent::where('id', $offer->property->seller->agent_id)->get();
					$notified_user = $seller->concat($agent);

					foreach ($notified_user as $notify_user) {
						$notify_user->notify(new InformSellerNewOffer($offer, $notify_user));
					}

					// send notify other buyers with lower offer price about higher price bid by logged in buyer

					$offers = Offers::where('property_id', $offer->property->id)->whereHas('transaction', function ($q) use ($offer) {
						$q->where('offer_price', '<', $offer->transaction->offer_price);
					})->where('user_id', '!=', $offer->user_id)->get();

					foreach ($offers as $offer1) {
						$diff = $offer->transaction->offer_price - $offer1->transaction->offer_price;

						//notify
						$buyer = $offer1->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
						$agent = Agent::where('id', $offer1->agent_id)->get();

						$notified_users = $buyer->concat($agent);

						foreach ($notified_users as $notify_user) {
							$notify_user->notify(new InformBuyerHigherOffer($offer1, $diff, $notify_user));
						}
					}

					// send notification to this buyer if the price is lower than other buyer price

					$off = Offers::where('property_id', $offer->property->id)->whereHas('transaction', function ($q) use ($offer) {
						$q->where('offer_price', '>', $offer->transaction->offer_price);
					})->where('user_id', '!=', $offer->user_id)->get()->sortByDesc(function($offer) { 
						return $offer->transaction->offer_price;
				   });
				   if($off->count()>0){
					$off=$off[0];
					
					$diff = $off->transaction->offer_price - $offer->transaction->offer_price;

					//notify
					$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
					$agent = Agent::where('id', $offer->agent_id)->get();

					$notified_users = $buyer->concat($agent);

					foreach ($notified_users as $notify_user) {
						$notify_user->notify(new InformBuyerHigherOffer($offer, $diff, $notify_user));
					}
					}
				}

			} else {
				$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
				$agent = Agent::where('id', $offer->agent_id)->get();
				$notified_user = $buyer->concat($agent);

				foreach ($notified_user as $notify_user) {
					$notify_user->notify(new InformBuyerIncompleteOffer($offer, 1, 'fc', $notify_user));
				}
			}

			if ($request->status == 'AC') {
				if ($dstatus <= 0) {
					$offer->status = $request->status;
					$offer->approved_on = date('Y-m-d H:i:s');
				} else {
					$offer->status = 'PN';
				}

			} else {
				$offer->status = 'FCIN';
			}
			$offer->save();

			session()->flash('success', 'Status updated succesfully');
			return redirect()->back();
		} else {
			session()->flash('error', 'Invalid Offer');
			return redirect()->back();
		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Offers  $offers
	 * @return \Illuminate\Http\Response
	 */
	public function destroy(Offers $offers) {
		//
	}
}
