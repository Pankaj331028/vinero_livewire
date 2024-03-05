<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\Offers;
use App\Models\Property;
use App\Models\Seller;
use App\Traits\Helper;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReportController extends Controller {
	use Helper;

	public function index(Request $request) {
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

		$offers = Offers::whereStatus('AC')->whereMonth('created_at', $current_month_date)->get();
		$monthly_offers = Offers::whereStatus('AC')->whereMonth('created_at', $last_month_date)->get();
		$yearly_offers = Offers::whereStatus('AC')->whereYear('created_at', $current_month_date)->get();

		$qc_commission = $this->getSetting('commission');

		$all_offer_price = 0;
		$buyer_commission = 0;
		$buyer_commission_submonth = 0;
		$all_offer_price_submonth = 0;
		$buyer_commission_ytd = 0;
		$all_offer_price_ytd = 0;

		foreach ($offers as $offer) {
			$buyer_commission = $offer->sum('buyer_agent_commission');
			$all_offer_price = $offer->transaction->sum('offer_price');
		}

		foreach ($monthly_offers as $monthly_offer) {
			$buyer_commission_submonth = $monthly_offer->sum('buyer_agent_commission');
			$all_offer_price_submonth = $monthly_offer->transaction->sum('offer_price');
		}

		foreach ($yearly_offers as $yearly_offer) {
			$buyer_commission_ytd = $yearly_offer->sum('buyer_agent_commission');
			$all_offer_price_ytd = $yearly_offer->transaction->sum('offer_price');
		}

		$dollar_sales = $avg_transaction = $qonection_commission = $house_sold = $no_agent = $commission = $avg_commission = $avg_buyer_commission = $buyer_agent_commission = $buyer_commission_savings = $seller_count = $buyer_count = $agent_count = $property_count = $offer_count = $approved_offer_count = $rejected_offer_count = $house_sold_submonth = $no_agent_submonth = $dollar_sales_submonth = $avg_transaction_submonth = $qonection_commission_submonth = $commission_submonth = $avg_commission_submonth = $avg_buyer_commission_submonth = $buyer_agent_commission_submonth = $buyer_commission_savings_submonth = $seller_count_submonth = $buyer_count_submonth = $agent_count_submonth = $property_count_submonth = $offer_count_submonth = $approved_offer_count_submonth = $rejected_offer_count_submonth = $house_sold_ytd = $no_agent_ytd = $dollar_sales_ytd = $avg_transaction_ytd = $qonection_commission_ytd = $commission_ytd = $avg_commission_ytd = $avg_buyer_commission_ytd = $buyer_agent_commission_ytd = $buyer_commission_savings_ytd = $seller_count_ytd = $buyer_count_ytd = $agent_count_ytd = $property_count_ytd = $offer_count_ytd = $approved_offer_count_ytd = $rejected_offer_count_ytd = 0;

		//current month
		$total_properties = Property::where('status', '!=', 'RJ')->whereMonth('created_at', $current_month_date)->count();
		$house_sold = Property::whereStatus('SO')->whereMonth('created_at', $current_month_date)->count();
		$no_agent = Offers::whereStatus('AC')->where('buyer_agent', null)->whereMonth('created_at', $current_month_date)->count();
		$dollar_sales = Property::whereStatus('SO')->whereMonth('sold_on', $current_month_date)->sum('selling_price');
		$avg_transaction = $total_properties > 0 ? $dollar_sales / $total_properties : 0;
		$qonection_commission = ($all_offer_price * $qc_commission) / 100;
		$commission = $qonection_commission + $buyer_commission;
		$avg_commission = $all_offer_price ? $commission / $all_offer_price * 100 : 0;
		$avg_buyer_commission = $all_offer_price ? $buyer_commission / $all_offer_price * 100 : 0;
		$buyer_agent_commission = $all_offer_price ? ($all_offer_price * 3) / 100 : 0;
		$buyer_commission_savings = $buyer_agent_commission - $buyer_commission;

		$seller_count = Seller::where('user_type', 'seller')->whereMonth('created_at', $current_month_date)->count();
		$buyer_count = Buyer::where('user_type', 'buyer')->whereMonth('created_at', $current_month_date)->count();
		$agent_count = Agent::where('user_type', 'agent')->whereMonth('created_at', $current_month_date)->count();
		$property_count = Property::whereMonth('created_at', $current_month_date)->count();
		$offer_count = Offers::whereMonth('created_at', $current_month_date)->count();
		$approved_offer_count = Offers::whereStatus('AC')->whereMonth('created_at', $current_month_date)->count();
		$rejected_offer_count = Offers::whereStatus('IN')->whereMonth('created_at', $current_month_date)->count();

		//monthly
		$total_properties_submonth = Property::where('status', '!=', 'RJ')->whereMonth('created_at', $last_month_date)->count();
		$house_sold_submonth = Offers::whereStatus('AC')->whereMonth('created_at', $last_month_date)->count();
		$no_agent_submonth = Offers::whereStatus('AC')->where('buyer_agent', null)->whereMonth('created_at', $last_month_date)->count();
		$dollar_sales_submonth = Property::whereStatus('SO')->whereMonth('sold_on', $last_month_date)->sum('selling_price');
		$avg_transaction_submonth = $total_properties_submonth > 0 ? $dollar_sales_submonth / $total_properties_submonth : 0;
		$qonection_commission_submonth = $all_offer_price_submonth ? ($all_offer_price_submonth * $qc_commission) / 100 : 0;
		$commission_submonth = $qonection_commission_submonth + $buyer_commission_submonth;
		$avg_commission_submonth = $all_offer_price_submonth ? $commission_submonth / $all_offer_price_submonth * 100 : 0;
		$avg_buyer_commission_submonth = $all_offer_price_submonth ? $buyer_commission_submonth / $all_offer_price_submonth * 100 : 0;
		$buyer_agent_commission_submonth = $all_offer_price_submonth ? ($all_offer_price_submonth * 3) / 100 : 0;
		$buyer_commission_savings_submonth = $buyer_agent_commission_submonth - $buyer_commission_submonth;

		//yearly
		$total_properties_ytd = Property::where('status', '!=', 'RJ')->whereYear('created_at', $current_month_date)->count();
		$house_sold_ytd = Offers::whereStatus('AC')->whereYear('created_at', $current_month_date)->count();
		$no_agent_ytd = Offers::whereStatus('AC')->where('buyer_agent', null)->whereYear('created_at', $current_month_date)->count();
		$dollar_sales_ytd = Property::whereStatus('SO')->whereYear('sold_on', $current_month_date)->sum('selling_price');
		$avg_transaction_ytd = $total_properties_ytd > 0 ? $dollar_sales_ytd / $total_properties_ytd : 0;
		$qonection_commission_ytd = ($all_offer_price_ytd * $qc_commission) / 100;
		$commission_ytd = $qonection_commission_ytd + $buyer_commission_ytd;
		$avg_commission_ytd = $all_offer_price_ytd != 0 ? $commission_ytd / $all_offer_price_ytd * 100 : 0;
		$avg_buyer_commission_ytd = $all_offer_price_ytd != 0 ? $buyer_commission_ytd / $all_offer_price_ytd * 100 : 0;
		$buyer_agent_commission_ytd = ($all_offer_price_ytd * 3) / 100;
		$buyer_commission_savings_ytd = $buyer_agent_commission_ytd - $buyer_commission_ytd;

		return view('admin.report', compact('house_sold', 'no_agent', 'dollar_sales', 'avg_transaction', 'commission', 'buyer_commission', 'avg_buyer_commission', 'qonection_commission', 'avg_commission', 'buyer_commission_savings', 'current_month', 'last_month', 'seller_count', 'buyer_count', 'agent_count', 'property_count', 'offer_count', 'approved_offer_count', 'rejected_offer_count', 'house_sold_submonth', 'no_agent_submonth', 'dollar_sales_submonth', 'avg_transaction_submonth', 'buyer_commission_submonth', 'qonection_commission_submonth', 'commission_submonth', 'avg_commission_submonth', 'avg_buyer_commission_submonth', 'buyer_agent_commission_submonth', 'buyer_commission_savings_submonth', 'house_sold_ytd', 'no_agent_ytd', 'dollar_sales_ytd', 'avg_transaction_ytd', 'buyer_commission_ytd', 'qonection_commission_ytd', 'commission_ytd', 'avg_commission_ytd', 'avg_buyer_commission_ytd', 'buyer_agent_commission_ytd', 'buyer_commission_savings_ytd'));
	}
}
