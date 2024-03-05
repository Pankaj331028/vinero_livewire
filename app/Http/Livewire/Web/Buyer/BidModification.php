<?php

namespace App\Http\Livewire\Web\Buyer;

use App\Http\Controllers\Api\BaseController;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Buyer as User;
use App\Models\FinancialCredential;
use App\Models\Offers;
use App\Models\Property;
use App\Notifications\InformBuyerHigherOffer;
use App\Notifications\InformOfferImprove;
use App\Traits\Helper;
use Auth;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\RequiredIf;
use Livewire\Component;
use Livewire\WithFileUploads;

class BidModification extends Component {
	use WithFileUploads, Helper;
	public $improve;
	public $file;
	public $amount;
	public $amount1;
	public $imp;
	public $val;
	public $bid;
	public $open_model = 0;
	public $control_mode;
	public $current_bid;
	public $financial_qualification;
	public $bid_per_sqfeet;
	public $est_mortigage_payment;
	public $message = 1;

	// public function rules() {
	// 	$user = User::find(Auth::id());
	// 	$list = Property::where('vms_property_id', $user->property_id)->first();
	// 	$property_rate = $list->reserved_price;
		
	// 	if ($this->improve == '3') { 
	// 		$rules = [
	// 			'improve' => "required",
	// 			// 'file' => new RequiredIf($this->improve == '2'),
	// 			// 'amount' => new RequiredIf($this->improve == '1'),
	// 			// 'amount' => new RequiredIf($this->improve == '1'),'gte:' . $property_rate,
	// 		];
	// 	} else { 
	// 		if ($this->improve == '2') {
	// 			$rules = [
	// 				'improve' => "required",
	// 				'file' => [new RequiredIf($this->improve == '2'), 'mimes:docx,pdf', 'max:10000'],
	// 				// 'amount' => new RequiredIf($this->improve == '1'),
	// 				// 'amount' => new RequiredIf($this->improve == '1'),'gte:' . $property_rate,
	// 			];
	// 		} else {
	// 			if($this->improve == '1'){
	// 				$rules = [
	// 					'improve' => "required",
	// 					// 'file' => new RequiredIf($this->improve == '2'),
	// 					// 'amount' => new RequiredIf($this->improve == '1'), 
	// 					// 'amount' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
	// 					'amount1' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
	// 				];
	// 			}else{
	// 				$rules = [
	// 					'improve' => "required",
	// 					// 'file' => new RequiredIf($this->improve == '2'),
	// 					// 'amount' => new RequiredIf($this->improve == '1'), 
	// 					// 'amount' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
	// 					// 'amount1' => [new RequiredIf($this->improve == '1'),'gte:' . $property_rate],
	// 				];
	// 			}
				
	// 		}

	// 	}

	// 	return $rules;

	// }
	
	public function rules()
	{
		$user = User::find(Auth::id());
		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property_rate = $list->reserved_price;
	
		$rules = [
			'improve' => 'required',
		];
	
		if ($this->improve == '2') {
			$rules['file'] = [new RequiredIf($this->improve == '2'), 'mimes:docx,pdf', 'max:10000'];
		} elseif ($this->improve == '1') {
			$rules['amount1'] = [new RequiredIf($this->improve == '1'), 'gte:' . $property_rate];
		}
	
		return $rules;
	}
	

	public function render() {
		return view('livewire.web.buyer.bid-modification');
	}

	public function mount(Request $request) {
		$user = User::find(Auth::id());

		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
		//    dd($offer_details);
		$bid = $offer_details->getData()->data;
		$this->current_bid = number_format($bid->offered_price);
		$this->financial_qualification = number_format($bid->qualify_for);
		$this->bid_per_sqfeet = number_format($bid->bid_per_sqfeet);
		$this->est_mortigage_payment = number_format($bid->est_mortgage);
		//$this->bid = $bid;

	}

	public function updated($name) {

		$val = $this->improve;
		$imp = $this->improve;
		if (isset($val)) {
			if ($val == 3) {
				$imp = 3;
			} elseif ($val == 2) {
				$imp = 2;
			} elseif ($val == 1) {
				$imp = 1;
			}
		}
		$this->imp = $imp;

		if ($this->improve == '2' || $this->improve == '3') {
			$this->reset('amount');
			$this->reset('amount1');
		}
		if ($this->improve == '1' || $this->improve == '3') {
			$this->reset('file');
		}


		$this->amount1 =$this->formatCurrency($this->amount);
		if ($name == 'amount') {
			$this->validateOnly('amount1');
		}
		else{
			
		$this->validateOnly($name);
		}
	}

	public function submitModifyOffer(Request $request) {
		
		$this->dispatchBrowserEvent('error-result');

		$this->validate($this->getRules(), [
			'improve.required' => 'Please make your choice',
			'amount1.gte' => 'The amount must be greater than or equal reserved price',
		]);
		// $this->amount1 =$this->formatCurrency($this->amount);
		$user = User::find(Auth::id());

		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		$offer = $user->offer;
		// dd($user->offer);
		$admin = Admin::whereRole(1)->get();

		if ($this->improve == 1) {
			// dd( $this->formatCurrency($this->amount));
			$offer->transaction->improved_price = $this->formatCurrency($this->amount) - $offer->transaction->offer_price;
			$offer->transaction->offer_price = $this->formatCurrency($this->amount);
			$offer->transaction->price_improved_on = now();

			//notify
			$notified_users = $admin->concat($offer->property->seller()->get());
			$notified_users = $notified_users->concat($offer->property->active_agent()->get());
			foreach ($notified_users as $notified_user) {
				$notified_user->notify(new InformOfferImprove($offer, $notified_user));
			}

			$offer->transaction->save();

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
			if($off->count()>0){
				$off=$off[0];
			
			// dd($off->count());
			$diff = $off->transaction->offer_price - $offer->transaction->offer_price;

			//notify
			$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
			$agent = Agent::where('id', $offer->agent_id)->get();

			$notified_users = $buyer->concat($agent);
			// dd($notified_users);
			foreach ($notified_users as $notify_user) {
				$notify_user->notify(new InformBuyerHigherOffer($offer, $diff, $notify_user));
			}
			}
			$commission = ($offer->transaction->offer_price * $offer->buyer_agent_commission_percentage / 100);
			$credit = ($offer->transaction->offer_price * $offer->transaction->seller_credit / 100);
			$net_price = $offer->transaction->offer_price - ($commission + $credit);

			$offer->transaction->seller_credit_amount = $credit;
			$offer->transaction->net_price = $net_price;
			$offer->transaction->save();

			$offer->buyer_agent_commission = $commission;
			$offer->save();

			$total_loan_amount = $offer->strategy->first_mortgage_loan_amount + $offer->strategy->second_mortgage_loan_amount;
			$offer->strategy->combined_loan_value = $total_loan_amount / $offer->transaction->offer_price;
			$balance = $offer->transaction->offer_price - ($offer->strategy->initial_deposit_amount + $offer->strategy->deposit_increase + $total_loan_amount);
			$offer->strategy->balance_down_payment = $balance;
			
			$user->last_activity = now();
			$user->save();

			return redirect()->route('buyer-dashboard');

		} elseif ($this->improve == 2) {
			if ($this->file) {
				if (!isset($offer->financial)) {
					$financial = new FinancialCredential;
				} else {
					$financial = $offer->financial;
				}

				// $filename = str_replace('.jpeg', '.jpg', $this->file);
				// $path = 'uploads/offers/' . $offer->id . '/' . $filename;
				// $destinationPath = public_path('uploads/offers/' . $offer->id);
				// if (!File::isDirectory($destinationPath)) {
				// 	File::makeDirectory($destinationPath, 0777, true, true);
				// }

				$path = $this->file->store('uploads/offers/' . $offer->id);

				$financial->offer_id = $offer->id;
				$financial->tnc = 1;
				$financial->file = $path;
				$financial->save();

				$user->last_activity = now();
				$user->save();
				return redirect()->route('buyer-dashboard');
			}

		} elseif ($this->improve == 3) {
			$result = app('App\Http\Controllers\Api\Buyer\ApiController')->cancelOffer($request);

			$data = $result->getData();

			if ($result->getData()->status == 200) {
				
				$user->last_activity = now();
				$user->save();
				// return redirect()->route('survey');
				return redirect()->route('buyer-offer-cancellation');

			}
		}

		//return $this->sendResponse("", $this->getMessage(200));
	}
}
