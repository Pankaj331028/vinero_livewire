<?php
namespace App\Traits;

use App\Models\Notification;
use App\Models\Otp;
use App\Models\Setting;
use Auth;
use Mail;
use Twilio\Rest\Client;
use URL;

trait Helper {

	public function sendMail($view, $data) {
		return Mail::send($view, $data, function ($message) use ($data) {
			$message->to($data['email'], $data['name'])->subject($data['subject']);
		});

	}

	public function generateOtp($id, $mobile) {
		Otp::where('user_id', $id)->where('mobile_number', $mobile)->update(['status' => 'IN']);
		$otp = new Otp;
		$otp->user_id = $id;
		$otp->mobile_number = $mobile;
		$otp->otp = rand(1000, 9999);
		$otp->created_by = $id ?? 1;
		$otp->save();
		$message = "Thank you for using " . env('APP_NAME') . '. Please enter OTP: ' . $otp->otp . ' to verify your mobile number.';

		// send otp to mobile number for verification.
		$response = $this->sendSMS($mobile, $message);
		return $otp;

		if (isset($response->id)) {
			return $otp;
		} else {
			return false;
		}

	}

	public function getSetting($rule) {
		return Setting::whereRule($rule)->first()->value;
	}

	public static function getBladeSetting($rule) {
		return Setting::whereRule($rule)->first()->value;
	}

	public function calPMT($interest_rate, $term, $loan) {
		//duration in years
		$duration = $term * 12;
		$interest = $interest_rate / 1200;

		if ($interest_rate > 0) {
			$amount = ($interest * -$loan * pow((1 + $interest), $duration) / (1 - pow((1 + $interest), $duration)));
		} else {
			$amount = 0;
		}
		return round($amount);
	}

	public function sendNotification($device_token, $device_type, $data, $datapayload = []) {
		try {
			$url = 'https://fcm.googleapis.com/fcm/send';
			$fcmApiKey = $this->getSetting('fcm_key');

			$msg = $data['description'];

			$url = URL::to('/');

			switch ($data['notification_type']) {
			case 'offer_interest':$url = route('offer-of-interest');
				break;
			case 'in_contract':$url = route('congratulations');
				break;
			case 'offer_deadline_extend':$url = "/offer-deadline-extension?p=" . $data['time'] ?? '';
				break;
			case 'counter_offer':
				if ($data['type'] == 'buyer') {
					/*if ($data['multiple_counter'] == 1) {
						$url = route('buyer-view-sellers-counter');
					}*/

					$url = "/offer-detail/" . $data['action_id'] ?? 0;
				} else {
					$url = route('buyer-view-sellers-counter');
				}

				break;
			case 'highest_bid':$url = route('bid-final-best');
				break;
			case 'incomplete_offer':$url = "/incomplete-offer?q=" . $data['incomplete'] ?? '';
				break;
			case 'offer_improve':
			case 'seller_new_offer':$url = "/offer-detail/" . $data['action_id'] ?? 0;
				break;
			case 'highest_bid':$url = "/offer-detail/" . $data['action_id'] ?? 0;
				break;
			case 'higher_offer_received':$url = "/higher-offer-received?q=" . $data['diff'] ?? '';
				break;
			case 'offer_rejected':$url = route('buyer-dashboard', ['q' => 'offer_rejected']);
				// Session::put('type', 'offer_rejected');
				break;
			case 'no_sale':$url = route('seller-dashboard', ['q' => 'no_sale']);
				break;
			case 'offer_withdrawn':$url = route('seller-dashboard', ['q' => 'offer_withdrawn']);
				break;
			case 'offer_interest_received':$url = route('seller-dashboard', ['q' => 'offer_interest_received', 'msg' => $msg]);
				// Session::put('desc', $msg);
				break;
			case 'sold_out':$url = route('seller-dashboard', ['q' => 'sold_out']);
				break;
			}

			$data = array(
				'title' => $data['title'],
				'type' => $data['notification_type'],
				'sound' => "default",
				'msg' => $msg,
				'body' => $msg,
				'incomplete' => $data['incomplete'] ?? '',
				'time' => $data['time'] ?? '',
				'date_time' => $data['date_time'] ?? '',
				'diff' => $data['diff'] ?? '',
				'action_id' => $data['action_id'] ?? 0,
				'multiple_counter' => $data['multiple_counter'] ?? 0,
				'usertype' => $data['type'] ?? '',
				'click_action' => $url,
			);

			if (count($datapayload) > 0) {
				$data['data'] = $datapayload;
			}

			if ($device_type == "ios") {
				$fcmFields = array(
					'to' => $device_token,
					'priority' => 'high',
					'notification' => $data,
					'data' => $data,
					'incomplete' => $data['incomplete'] ?? '',
					'action_id' => $data['action_id'] ?? 0,
					'multiple_counter' => $data['multiple_counter'] ?? 0,
					'time' => $data['time'] ?? '',
					'date_time' => $data['date_time'] ?? '',
					'diff' => $data['diff'] ?? '',
					'usertype' => $data['type'] ?? '',
				);
			} elseif ($device_type == "android") {
				$fcmFields = [
					'to' => $device_token,
					"notification" => $data,
					'data' => $data,
					"priority" => "high",
					'incomplete' => $data['incomplete'] ?? '',
					'action_id' => $data['action_id'] ?? 0,
					'multiple_counter' => $data['multiple_counter'] ?? 0,
					'time' => $data['time'] ?? '',
					'date_time' => $data['date_time'] ?? '',
					'diff' => $data['diff'] ?? '',
					'usertype' => $data['type'] ?? '',
				];
			} else {
				$fcmFields = [
					"registration_ids" => array($device_token),
					"notification" => $data,
					'data' => $data,
					'time' => $data['time'] ?? '',
					'date_time' => $data['date_time'] ?? '',
					'diff' => $data['diff'] ?? '',
					'priority' => 'high',
					"image" => asset('web/img/logo-1.png'),
					'click_action' => $url,
					'usertype' => $data['type'] ?? '',
					'usertype' => $data['type'] ?? '',
					'multiple_counter' => $data['multiple_counter'] ?? '',

					/*[
						"title" => $data['title'],
						"body" => $msg,
						'type' => $data['type'],
					],*/
				];
			}

			$headers = array(
				'Authorization: key=' . $fcmApiKey,
				'Content-Type: application/json',
			);

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
			$result = curl_exec($ch);

			if ($result === FALSE) {
				die('Curl failed: ' . curl_error($ch));
			}

			curl_close($ch);
			return $result;

		} catch (\Exception $ex) {
			dd($ex);
		}
	}

	public static function saveLog($description, $module, $model = null) {

		if (!empty($model)) {
			activity()
				->causedBy(Auth::guard('admin')->user())
				->performedOn($model)
				->useLog($module)
				->withProperties(['url' => URL::current()])
				->log($description);
		} else {
			activity()
				->causedBy(Auth::guard('admin')->user())
				->useLog($module)
				->withProperties(['url' => URL::current()])
				->log($description);
		}

	}

	public static function checkAccess($perm) {
		if (Auth::guard('admin')->user()->user_role->name == 'admin') {
			return true;
		} else {
			if (gettype($perm) == 'string') {
				return Auth::guard('admin')->user()->user_role->name == 'admin' || Auth::guard('admin')->user()->hasPermissionTo($perm, 'admin');
			} elseif (gettype($perm) == 'array') {
				return Auth::guard('admin')->user()->user_role->name == 'admin' || Auth::guard('admin')->user()->hasAnyPermission($perm, 'admin');
			}
		}

	}

	public function sendSMS($mobile, $message) {
		try {
			$mobile = "+1$mobile";
			// $mobile = '+14155773700';
			$account_sid = $this->getSetting('TWILIO_SID');
			$auth_token = $this->getSetting('TWILIO_TOKEN');
			$twilio_number = $this->getSetting('TWILIO_FROM_NUMBER');
			//dd("twillio number: $twilio_number,  auth_token :$auth_token, number:$twilio_number, to_number: $mobile ");
			$client = new Client($account_sid, $auth_token);
			$msg = $client->messages->create($mobile, [
				'from' => $twilio_number,
				'body' => $message]);
			return true;

		} catch (\Exception $e) {
			return false;
		}
	}

	public static function notifications_type($notification, $incomplete = null) {

		$user = auth()->user();
		$data = Notification::where(['notifiable_id' => $user->id, 'type' => $notification])->where(function ($q) use ($incomplete) {
			if (!empty($incomplete)) {
				$q->whereJsonContains('data->incomplete', $incomplete);
			}
		})->first();

		return $data == null ? 0 : $data->created_at;
	}
	public function formatCurrency($price) {
		$data = ['$', ','];
		$price_data = str_replace($data, '', $price);
		return $price_data == '' ? 0 : $price_data;
	}

	public static function formatNumber($number) {
		return preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1-$2-$3', $number);
	}
}
