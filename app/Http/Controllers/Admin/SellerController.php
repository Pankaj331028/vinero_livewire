<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PropertyDataTable;
use App\DataTables\SellerDataTable;
use App\Http\Controllers\Controller;
use App\Models\Seller;
use Illuminate\Http\Request;
use Session;
use URL;

class SellerController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, SellerDataTable $dt) {
		$opt_mode = config()->get('constants.buyer_opt_modes');

		$active_count = Seller::where('user_type', '=', 'seller')->whereHas('properties', function ($q) {
			$q->whereNotIn('property.status', ['SO', 'EP']);
		}, '>', 0)->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		$inactive_count = Seller::where('user_type', '=', 'seller')->where(function ($q) {
			$q->doesntHave('properties')->orWhereHas('properties', function ($q) {
				$q->where('property.status', '!=', 'EP');
			}, '<=', 0);
		})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		$past_count = Seller::where('user_type', '=', 'seller')->whereHas('properties', function ($q) {
			$q->whereNotIn('property.status', ['SO', 'EP']);
		}, '<=', 0)->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

		return $dt->render('admin.seller.list', ['title' => 'Seller', 'opt_mode' => $opt_mode, 'active_count' => $active_count, 'inactive_count' => $inactive_count, 'past_count' => $past_count]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {

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
	 * @param  \App\Models\Seller  $seller
	 * @return \Illuminate\Http\Response
	 */

	public function show($id, PropertyDataTable $pt) {
		$previous_url = URL::previous();
		$seller = Seller::find($id);

		return view('admin.seller.view', [
			'seller' => $seller,
			'properties' => $pt->with('user_id', $id)->html(),
			'title' => 'View Seller',
			'previous_url' => $previous_url,
		]);
	}

	public function getProperties($id = null, PropertyDataTable $pt) {
		return $pt->with('user_id', $id)->render('admin.seller.view');
	}

	// return view('admin.seller.view', array('seller' => $seller, 'total_bids'=>$total_bids, 'approved_bids' =>$approved_bids, 'rejected_bids' =>$rejected_bids ,'title' => 'View Seller'));
	// }

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Seller  $seller
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id, $status) {
		$previous_url = URL::previous();
		$url = "update-seller";
		$seller = Seller::find($id);

		return view('admin.seller.edit', array('seller' => $seller, 'title' => 'Edit Seller', 'url' => $url, 'status' => $status, 'previous_url' => $previous_url));
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Seller  $seller
	 * @return \Illuminate\Http\Response
	 */

	public function update(Request $request, $id) {

		$seller = Seller::findOrFail($id);
	
		$this->validate($request, array(
			// 'first_name' => 'required',
			// 'last_name' => 'required',
			'comment_note' => 'required',
		)
		);

		$input = $request->all();
		//$seller->fill($input)->save();
		$seller = Seller::find($id);
		$seller->comment_note = $request->comment_note;
		$seller->status = $request->status;
		$seller->optin_out = $request->optin_out;
		$seller->save();

		session()->flash('success', 'Seller details updated successfully!');
		return redirect(url($request->previous_url));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Seller  $seller
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$previous_url = URL::previous();
		Seller::find($id)->delete();
		session()->flash('success', 'Seller deleted successfully!');
		return redirect(url($previous_url));
	}

	public function block($id) {
		$previous_url = URL::previous();
		$url = "block-seller";
		$seller = Seller::find($id);
		return view('admin.seller.block', array('seller' => $seller, 'title' => 'Block/Unblock Seller', 'url' => $url, 'previous_url' => $previous_url));

	}

	/**
	 * Block the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Seller  $seller
	 * @return \Illuminate\Http\Response
	 */
	public function update_block(Request $request, $id) {
		
		$seller = Seller::findOrFail($id);
		$this->validate($request, array(
			'status' => 'required',
		)
		);
		try {
			$input = $request->all();

			$seller->fill($input)->save();
			session()->flash('success', 'Block/unblock updated successfully!');
			return redirect(url($request->previous_url));
		} catch (\Exception $e) {
			// do task when error
			echo $e->getMessage(); // insert query
		}

	}
}
