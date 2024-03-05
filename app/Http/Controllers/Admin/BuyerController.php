<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BuyerDataTable;
use App\DataTables\OfferDataTable;
use App\Http\Controllers\Controller;
use App\Models\Buyer;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Session;
use URL;

class BuyerController extends Controller {
	use Helper;
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, BuyerDataTable $dt) {
		Helper::saveLog('View Buyers Listing', 'buyer');
		$opt_mode = config()->get('constants.buyer_opt_modes');

		$active_count = Buyer::where('user_type', '=', 'buyer')->whereHas('offer', function ($q) {
			$q->whereIn('status', ['IN', 'PN', 'AC', 'DCIN', 'FCIN']);
		})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		$inactive_count = Buyer::where('user_type', '=', 'buyer')->where(function ($q) {
			$q->whereNull('last_activity')->orWhereDate('last_activity', '<=', date('Y-m-d H:i:s', strtotime('-5 days')));
		})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		$past_count = Buyer::where('user_type', '=', 'buyer')->whereHas('offer', function ($q) {
			$q->whereNotIn('status', ['SO', 'RJ', 'CL']);
		}, '<=', 0)->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		return $dt->render('admin.buyer.list', ['title' => 'Buyer', 'opt_mode' => $opt_mode, 'active_count' => $active_count, 'inactive_count' => $inactive_count, 'past_count' => $past_count]);
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
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function show($id, OfferDataTable $ot) {

		$previous_url = URL::previous();
		$buyer = Buyer::find($id);

		Helper::saveLog('View Buyer Detail - ' . $buyer->phone_no, 'buyer', $buyer);
		$ids = Buyer::where('phone_no', $buyer->phone_no)->pluck('id')->toArray();

		return $ot->with(['user_id' => $ids, 'type' => 'buyer'])->render('admin.buyer.view', [
			'buyer' => $buyer,
			'title' => 'View Buyer',
			'previous_url' => $previous_url,
		]);
	}

	public function getOffers($id, OfferDataTable $ot) {
		$ids = explode(',', $id);
		return $ot->with('user_id', $ids)->with('type', 'buyer')->render('admin.agent.view');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, $status) {
		//
		$previous_url = URL::previous();

		$url = "update-buyer";
		$buyer = Buyer::find($id);
		Helper::saveLog('Visit Edit Buyer Page - ' . $buyer->phone_no, 'buyer', $buyer);
		return view('admin.buyer.edit', array('buyer' => $buyer, 'title' => 'Edit Buyer', 'url' => $url, 'status' => $status, 'previous_url' => $previous_url));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {

		$previous_url = URL::previous();
		$buyer = Buyer::findOrFail($id);
		$this->validate($request, array(
			// 'first_name' => 'required',
			// 'last_name' => 'required',
			'comment_note' => 'required',
		)
		);
		try {
			$input = $request->all();
			//$buyer->fill($input)->save();
			$buyer = Buyer::find($id);
			$buyer->comment_note = $request->comment_note;
			$buyer->status = $request->status;
			$buyer->optin_out = $request->optin_out;
			$buyer->save();

			Helper::saveLog('Update Buyer - ' . $buyer->phone_no, 'buyer', $buyer);
			session()->flash('success', 'Buyer details updated successfully!');
			return redirect(url($request->previous_url));
		} catch (\Exception $e) {
			// do task when error
			echo $e->getMessage(); // insert query
		}

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function block($id) {

		$privious_url = URL::previous();
		$url = "block-buyer";
		$buyer = Buyer::find($id);
		Helper::saveLog('Visit Block/Unblock Buyer Page- ' . $buyer->phone_no, 'buyer', $buyer);
		return view('admin.buyer.block', array('buyer' => $buyer, 'title' => 'Block/Unblock Buyer', 'url' => $url, 'privious_url' => $privious_url));

	}

	/**
	 * Block the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function update_block(Request $request, $id) {

		$buyer = Buyer::findOrFail($id);
		$this->validate($request, array(
			'status' => 'required',
		)
		);
		try {
			$input = $request->all();
			$buyer->fill($input)->save();
			Helper::saveLog('Block/Unblock Buyer - ' . $buyer->phone_no, 'buyer', $buyer);
			session()->flash('success', 'Block/unblock updated successfully!');
			return redirect(url($request->privious_url));
		} catch (\Exception $e) {
			// do task when error
			echo $e->getMessage(); // insert query
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Buyer  $buyer
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$previous_url = URL::previous();
		$buyer = Buyer::find($id);
		$ids = $buyer->users()->pluck('id');

		Buyer::whereIn('id', $ids)->delete();
		Helper::saveLog('Delete Buyer - ' . $buyer->phone_no, 'buyer', $buyer);
		session()->flash('success', 'Buyer deleted successfully!');
		return redirect(url($previous_url));
	}
}
