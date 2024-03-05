<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\DocumentVerification;
use App\Models\NotificationHistory;
use App\Models\Offers;
use App\Models\Otp;
use App\Models\Property;
use App\Models\Seller;
use App\Models\Setting;
use App\Models\TransactionOverview;
use App\Notifications\HighestBidAlert;
use App\Notifications\InformBuyerIncompleteOffer;
use App\Notifications\NoSaleAlert;
use App\Traits\Helper;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class CronJobController extends Controller {
	use Helper;

	//notify buyer for incompletion of offer
	public function incompleteOffer(Request $request) {
		date_default_timezone_set('Asia/Kolkata');
		DB::select('insert into cron_entries(cron) value("incomplete offer")');
		$docs = DocumentVerification::where('status', 'IN')->get();
		$notify = false;

		if ($docs) {
			foreach ($docs as $doc) {
				$data = NotificationHistory::where(['user_id' => $doc->offer->user_id, 'offer_id' => $doc->offer_id])->latest()->first();

				if ($data && $data->revision_count < 4) {
					$to = Carbon::parse($data->created_at);
					$from = Carbon::now();
					$hours = $to->diffInHours($from);
					//notify if hours == 4
					if ($hours == 4) {
						$notify = true;
						$data->revision_count += 1;
					}
				} elseif (empty($data)) {
					$data = new NotificationHistory;
					$to = Carbon::parse($doc->offer->created_at);
					$from = Carbon::now();
					$hours = $to->diffInHours($from);

					if ($hours == 8) {
						$notify = true;
						$data->revision_count = 1;
					}
				} else {
					$to = Carbon::parse($doc->offer->created_at);
					$from = Carbon::now();
					$hours = $to->diffInHours($from);
					//reject offer
					if ($hours == 24) {
						$doc->offer->status = 'IN';
						$doc->offer->save();
						$doc->offer->owner->notify(new InformBuyerIncompleteOffer($doc->offer, $data->revision_count));
					}
				}

				if ($notify == true) {
					$data->type = 'incomplete_offer';
					$data->user_id = $doc->offer->user_id;
					$data->offer_id = $doc->offer->id;
					$data->created_at = now();
					$data->save();

					//notify buyer
					$doc->offer->owner->notify(new InformBuyerIncompleteOffer($doc->offer, $data->revision_count));
				}
			}
		}
	}

	//inform buyer at the end of 48hrs
	public function highestBidAlert() {
		date_default_timezone_set('Asia/Kolkata');
		$properties = Property::whereIn('status', ['AC', 'FL', 'FA'])->where(DB::raw("(DATE_FORMAT(vms_end_date,'%Y-%m-%d %H:%i'))"), date('Y-m-d H:i', strtotime('+ ' . $this->getSetting('highest_bid_hrs') . ' hours')))->get();

		// \DB::select('SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');

		foreach ($properties as $property) {
			$offer_ids = $property->offers()->pluck('id')->toArray();
			$max_price = TransactionOverview::whereIn('offer_id', $offer_ids)->max('offer_price');

			/*$exclude_id = TransactionOverview::whereHas('offer', function ($query) use ($offer_ids) {
				$query->whereIn('id', $offer_ids);
			})->where('offer_price', $max_price)->pluck('offer_id')->toArray();*/
			//send notification to all lowest bidders
			// $lowest_offers = array_values(array_diff($offer_ids, $exclude_id));
			// $lowest_bidersd = Offers::whereIn('id', $lowest_offers)->pluck('user_id')->toArray();

			if (!empty($max_price)) {
				$lowest_bidders = Offers::whereHas('transaction', function ($q) use ($max_price) {
					$q->where('offer_price', '<', $max_price);
				})->whereStatus('AC')->where('property_id', $property->id)->pluck('user_id')->toArray();

				$users = Buyer::where('status', '1')->where('optin_out', '!=', 'OPTOUTMODE2')->whereIn('id', $lowest_bidders)->get();
				$agentids = Buyer::whereStatus('1')->whereIn('id', $lowest_bidders)->pluck('agent_id')->toArray();
				$agents = Agent::whereIn('id', $agentids)->get();

				$users = $users->concat($agents);

				foreach ($users as $user) {

					$user->notify(new HighestBidAlert($property->vms_property_id, $max_price, $user->offer, $user));
				}
			}
		}
	}

	//inform seller for no sale
	public function notifyNoSale() {
		date_default_timezone_set('Asia/Kolkata');
		$properties = Property::whereIn('status', ['AC', 'FL', 'FA', 'VC'])->where('vms_end_date', '<=', date('Y-m-d H:i:s'))->get();
		// \DB::select('SET sql_mode=(SELECT REPLACE(@@sql_mode,"ONLY_FULL_GROUP_BY",""))');

		foreach ($properties as $property) {
			$property->status = 'EP';
			$property->save();

			if ($property->offers->where('status', 'SO')->count() <= 0) {
				$users = Seller::whereId($property->seller->id)->get();
				$agent = Agent::whereId($property->agent_id)->get();

				$users = $users->concat($agent);

				foreach ($users as $user) {
					$user->notify(new NoSaleAlert($property, $user));
				}

			}

		}
	}

	public function movePropertyToFarm(Request $request) {
		$properties = Property::whereIn('status', ['RJ'])->update(['status' => 'FA']);
	}

	//otp  at the end of 10sec
	public function otptimeLimit() {
		date_default_timezone_set('Asia/Kolkata');
		$otps = Otp::where('status', 'AC')->get();

		foreach ($otps as $otp) {
			$to = Carbon::parse($otp->created_at);
			$from = Carbon::now();
			$second = $to->diffInSeconds($from);
			$timer = Setting::where('rule', 'otp_timer')->first();

			if ($second >= $timer->value) {
				$otp->status = 'IN';
				$otp->save();
			}
		}
	}
}
