<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\NotificationDataTable;
use App\Http\Controllers\Controller;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationController extends Controller {
	public function index(Request $request, NotificationDataTable $at) {
		if (request()->get('start_date') && request()->get('end_date')) {
			$total = Notification::count();
			$vms_open = Notification::whereJsonContains('data->notification_type', 'new_property')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date("Y-m-d", strtotime(request()->get('start_date'))) . '"')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") <= "' . date("Y-m-d", strtotime(request()->get('end_date'))) . '"')->count(); //new property submitted by buyer
			$new_offers = Notification::whereJsonContains('data->notification_type', 'new_offer')->count(); //new offer submitted by buyer
			$improved_offers = Notification::whereJsonContains('data->notification_type', 'offer_improve')->count();
			$counter_offers = Notification::whereJsonContains('data->notification_type', 'counter_offer')->count();
			$in_contract = Notification::whereJsonContains('data->notification_type', 'in_contract')->count();
			$no_sale = Notification::whereJsonContains('data->notification_type', 'no_sale')->count();
		} else {
			$total = Notification::count();
			$vms_open = Notification::whereJsonContains('data->notification_type', 'new_property')->count(); //new property submitted by buyer
			$new_offers = Notification::whereJsonContains('data->notification_type', 'new_offer')->count(); //new offer submitted by buyer
			$improved_offers = Notification::whereJsonContains('data->notification_type', 'offer_improve')->count();
			$counter_offers = Notification::whereJsonContains('data->notification_type', 'counter_offer')->count();
			$in_contract = Notification::whereJsonContains('data->notification_type', 'in_contract')->count();
			$no_sale = Notification::whereJsonContains('data->notification_type', 'no_sale')->count();
		}

		// $notifications = ->html();

		return $at->with('type', $request->type ?? 'all')->render('admin.notifications', [
			// 'notifications' => $notifications,
			'total' => $total, 'open' => $vms_open, 'new_offers' => $new_offers, 'improved_offers' => $improved_offers, 'counter_offers' => $counter_offers, 'in_contract' => $in_contract, 'no_sale' => $no_sale,
		]);

		// return $dt->render('admin.notifications', []);
	}

	public function getNotifications(NotificationDataTable $pt, $type) {
		return $pt->with('type', $type)->render('admin.notifications');
	}

	public function readNotifications(Request $request, $id) {
		// parse_str(urldecode($array), $output);
		$notify = Notification::find($id);
		$notify->read_at = Carbon::now();
		$notify->save();

		return redirect()->to($notify->data['action']);
	}

	public function new_index(Request $request) {
		$today_vms_open = Notification::whereJsonContains('data->notification_type', 'new_property')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer
		$today_new_offers = Notification::whereJsonContains('data->notification_type', 'new_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer
		$today_improved_offers = Notification::whereJsonContains('data->notification_type', 'offer_improve')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer
		$today_counter_offers = Notification::whereJsonContains('data->notification_type', 'counter_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer
		$today_in_contract = Notification::whereJsonContains('data->notification_type', 'in_contract')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer
		$today_no_sale = Notification::whereJsonContains('data->notification_type', 'no_sale')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d') . '"')->count(); //new property submitted by buyer

		
		$yesterday_vms_open = Notification::whereJsonContains('data->notification_type', 'new_property')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer
		$yesterday_new_offers = Notification::whereJsonContains('data->notification_type', 'new_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer
		$yesterday_improved_offers = Notification::whereJsonContains('data->notification_type', 'offer_improve')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer
		$yesterday_counter_offers = Notification::whereJsonContains('data->notification_type', 'counter_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer
		$yesterday_in_contract = Notification::whereJsonContains('data->notification_type', 'in_contract')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer
		$yesterday_no_sale = Notification::whereJsonContains('data->notification_type', 'no_sale')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") = "' . date('Y-m-d', strtotime("-1 days")) . '"')->count(); //new property submitted by buyer

		$lastWeek_vms_open = round(Notification::whereJsonContains('data->notification_type', 'new_property')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer
		$lastWeek_new_offers = round(Notification::whereJsonContains('data->notification_type', 'new_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer
		$lastWeek_improved_offers = round(Notification::whereJsonContains('data->notification_type', 'offer_improve')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer
		$lastWeek_counter_offers = round(Notification::whereJsonContains('data->notification_type', 'counter_offer')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer
		$lastWeek_in_contract = round(Notification::whereJsonContains('data->notification_type', 'in_contract')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer
		$lastWeek_no_sale = round(Notification::whereJsonContains('data->notification_type', 'no_sale')->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date('Y-m-d', strtotime("-7 days")) . '"')->count() / 7); //new property submitted by buyer

		return view('admin.notification.index', compact('today_vms_open',
			'today_new_offers',
			'today_improved_offers',
			'today_counter_offers',
			'today_in_contract',
			'today_no_sale',
			'yesterday_vms_open',
			'yesterday_new_offers',
			'yesterday_improved_offers',
			'yesterday_counter_offers',
			'yesterday_in_contract',
			'yesterday_no_sale',
			'lastWeek_vms_open',
			'lastWeek_new_offers',
			'lastWeek_improved_offers',
			'lastWeek_counter_offers',
			'lastWeek_in_contract',
			'lastWeek_no_sale'));
	}

	public function show_notification(Request $request, NotificationDataTable $dt) {

		return $dt->with('type', $request->type)->render('admin.notification.show');
	}

}