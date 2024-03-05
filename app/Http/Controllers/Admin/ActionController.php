<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Buyer;
use App\Models\Offers;
use App\Models\Property;
use App\Models\Seller;
use App\Traits\Helper;
use Auth;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;
use Session;

class ActionController extends Controller {
	use Helper;

	public function dashboard(Request $request) {

		$admin = Admin::find(Auth::guard('admin')->id());
		if ($request->method() == 'POST') {
			$admin->comments = $request->comments;
			$admin->save();

			session()->flash('message', 'Comments saved successfully');
			return redirect()->route('index');
		}

		//filter
		if ($request->month) {
			$current_month_date = Carbon::parse('01-' . $request->month);
			$last_month_date = Carbon::parse('01-' . $request->month)->subMonth(1);
		} else {
			$current_month_date = now();
			$last_month_date = Carbon::now()->subMonth(1);
		}

		$current_month = Carbon::parse($current_month_date)->format('F');
		$last_month = Carbon::parse($last_month_date)->format('F');
		$properties = $bids = $agents = [];

		$properties['New Listings']['current'] = Property::whereStatus('NL')->whereMonth('created_at', $current_month_date)->count();
		$properties['New Listings']['month'] = Property::whereStatus('NL')->whereMonth('created_at', $last_month_date)->count();
		$properties['New Listings']['year'] = Property::whereStatus('NL')->count();

		$properties['In Process']['current'] = Property::whereStatus('IP')->whereMonth('created_at', $current_month_date)->count();
		$properties['In Process']['month'] = Property::whereStatus('IP')->whereMonth('created_at', $last_month_date)->count();
		$properties['In Process']['year'] = Property::whereStatus('IP')->count();

		$properties['Rejected']['current'] = Property::whereStatus('RJ')->whereMonth('created_at', $current_month_date)->count();
		$properties['Rejected']['month'] = Property::whereStatus('RJ')->whereMonth('created_at', $last_month_date)->count();
		$properties['Rejected']['year'] = Property::whereStatus('RJ')->count();

		$properties['VMS Active']['current'] = Property::whereStatus('AC')->whereMonth('created_at', $current_month_date)->count();
		$properties['VMS Active']['month'] = Property::whereStatus('AC')->whereMonth('created_at', $last_month_date)->count();
		$properties['VMS Active']['year'] = Property::whereStatus('AC')->count();

		$properties['Flagged']['current'] = Property::whereStatus('FA')->whereMonth('created_at', $current_month_date)->count();
		$properties['Flagged']['month'] = Property::whereStatus('FA')->whereMonth('created_at', $last_month_date)->count();
		$properties['Flagged']['year'] = Property::whereStatus('FA')->count();

		$properties['No Sale']['current'] = Property::whereStatus('EP')->doesntHave('sold_offer')->whereMonth('created_at', $current_month_date)->count();
		$properties['No Sale']['month'] = Property::whereStatus('EP')->doesntHave('sold_offer')->whereMonth('created_at', $last_month_date)->count();
		$properties['No Sale']['year'] = Property::whereStatus('EP')->doesntHave('sold_offer')->count();

		$bids['Total Bids']['current'] = Offers::whereNotIn('status', ['DL', 'IN'])->whereMonth('created_at', $current_month_date)->count();
		$bids['Total Bids']['month'] = Offers::whereNotIn('status', ['DL', 'IN'])->whereMonth('created_at', $last_month_date)->count();
		$bids['Total Bids']['year'] = Offers::whereNotIn('status', ['DL', 'IN'])->count();

		$bids['In Contract']['current'] = Offers::where('status', 'SO')->whereMonth('created_at', $current_month_date)->count();
		$bids['In Contract']['month'] = Offers::where('status', 'SO')->whereMonth('created_at', $last_month_date)->count();
		$bids['In Contract']['year'] = Offers::where('status', 'SO')->count();

		$bids['Closed Escrow']['current'] = Offers::where('status', 'CM')->whereMonth('created_at', $current_month_date)->count();
		$bids['Closed Escrow']['month'] = Offers::where('status', 'CM')->whereMonth('created_at', $last_month_date)->count();
		$bids['Closed Escrow']['year'] = Offers::where('status', 'CM')->count();

		$agents['Qonectin Agents']['current'] = Offers::where('buyer_brokerage_firm', 'like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->whereMonth('created_at', $current_month_date)->count();
		$agents['Qonectin Agents']['month'] = Offers::where('buyer_brokerage_firm', 'like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->whereMonth('created_at', $last_month_date)->count();
		$agents['Qonectin Agents']['year'] = Offers::where('buyer_brokerage_firm', 'like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->count();

		$agents['Cooperating Agents']['current'] = Offers::where('buyer_brokerage_firm', 'not like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->whereMonth('created_at', $current_month_date)->count();
		$agents['Cooperating Agents']['month'] = Offers::where('buyer_brokerage_firm', 'not like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->whereMonth('created_at', $last_month_date)->count();
		$agents['Cooperating Agents']['year'] = Offers::where('buyer_brokerage_firm', 'not like', '%qonectin%')->select(DB::Raw('distinct buyer_agent_phone'))->where('status', '!=', 'DL')->count();

		$agents['Total Active Sellers']['current'] = Seller::whereUserType('seller')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->whereMonth('created_at', $current_month_date)->count();
		$agents['Total Active Sellers']['month'] = Seller::whereUserType('seller')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->whereMonth('created_at', $last_month_date)->count();
		$agents['Total Active Sellers']['year'] = Seller::whereUserType('seller')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->count();

		$agents['Total Active Buyers']['current'] = Buyer::whereUserType('buyer')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->whereMonth('created_at', $current_month_date)->count();
		$agents['Total Active Buyers']['month'] = Buyer::whereUserType('buyer')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->whereMonth('created_at', $last_month_date)->count();
		$agents['Total Active Buyers']['year'] = Buyer::whereUserType('buyer')->select(DB::Raw('distinct phone_no'))->whereStatus('AC')->count();

		return view('admin.index', compact('properties', 'bids', 'agents', 'current_month', 'last_month', 'admin'));
	}
	public function updateStatus(Request $request) {
		$buyer = Buyer::find($request->id);
		$seller = Seller::find($request->id);
		if ($buyer) {
			$buyer->status = $request->status;
			$buyer->save();

		} elseif ($seller) {
			$seller->status = $request->status;
			$seller->save();

		} else {

		}

		return response()->json(['success' => 'Status change successfully.']);
		session()->flash('success', 'Status updated successfully!');
		return redirect()->back();
	}

}
