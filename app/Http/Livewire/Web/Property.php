<?php

namespace App\Http\Livewire\Web;

use App\Models\Admin;
use App\Models\Agent;
use App\Models\Property as MProperty;
use App\Models\PropertyHistory;
use App\Models\Seller;
use App\Models\Setting;
use App\Notifications\InformAdminNewProperty;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithFileUploads;

class Property extends Component {
	use ResponseMessages, WithFileUploads, Helper;

	public $step = 1;
	public $progressbar;
	protected $messages = [];
	public $property_id;
	public $address;
	public $owner;
	public $seller_phone;
	public $activation_date;
	public $deactivation_date;
	public $reserved_price;
	public $square_foot;
	public $offer_increase = 1;
	public $occupancy;
	public $possession;
	public $tenant_rights;
	public $rent_back_date;
	public $property_type;
	public $financing;
	public $buyer_credit;
	public $purchase_agreement;
	public $brokerage_name;
	public $brokerage_license;
	public $agent_name;
	public $agent_phone;
	public $agent_license;
	public $escrow_holder;
	public $escrow_number;
	public $disclosure;
	public $items_include_exclude = [];
	public $escrow_officer;
	public $escrow_officer_email;
	public $escrow_officer_phone;
	public $transaction_coordinator;
	public $transaction_coordinator_email;
	public $transaction_coordinator_phone;
	public $disclosure_hoa_fee;
	public $certification_hoa_fee;
	public $hoa_transfer_fee;
	public $private_transfer_fee;
	public $other_fee;
	public $other_fee_describe;

	public $seller_rent_back;
	public $stove_oven = 'yes';
	public $refrigerator = 'yes';
	public $wine_refrigerator = 'N/A';
	public $washer = 'N/A';
	public $dryer = 'N/A';
	public $dishwasher = 'N/A';
	public $microwave = 'yes';
	public $video_doorbell = 'yes';
	public $security_camera = 'yes';
	public $security_system = 'yes';
	public $control_devices = 'yes';
	public $audio_equipment = 'yes';
	public $ground_pool = 'yes';
	public $bathroom_mrrors = 'yes';
	public $car_charging_system = 'yes';
	public $potted_trees = 'yes';
	public $additional_items;
	public $excluded_items;
	public $singleFamily;
	public $otherFeeDescribe = true;
	public $rules = [];

	public $rules1 = [
		'property_id' => 'required',
		'address' => 'required|string|min:3|max:100',
		'owner' => 'required|max:50',
		'seller_phone' => 'required|digits:10',
		'activation_date' => 'required|date_format:Y-m-d|after_or_equal:today',
		'deactivation_date' => 'required|date_format:Y-m-d|after:activation_date',
		'brokerage_name' => 'required|max:50',
		'brokerage_license' => 'required|max:50',
		'agent_name' => 'required|max:50',
		'agent_phone' => 'required|digits:10',
		'agent_license' => 'required|max:15',
		'reserved_price' => 'required',
		'square_foot' => 'required',
		'disclosure' => 'required|mimes:jpeg,jpg,png,pdf|max:5000',
		'offer_increase' => 'required|numeric|min:0|max:100',
		'occupancy' => 'required|in:owner,vacant,tenant',
		'financing' => 'required|in:yes,no',
		'buyer_credit' => 'required|in:yes,no,will_consider',
		'purchase_agreement' => 'required|in:car,sfar',
	];

	public $rules2 = [
		'possession' => 'required|in:close_escrow,month_day,rent_back,tenant_rights',
		'rent_back_date' => 'required_if:possession,rent_back|',
		'tenant_rights' => 'required_if:possession,tenant_rights',
		'property_type' => 'required|in:single_family,tic,condo,multiunit',
		'escrow_holder' => 'required|max:50',
		'escrow_number' => 'required|max:15',
		'escrow_officer' => 'required|max:50',
		'escrow_officer_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50|email',
		'escrow_officer_phone' => 'required|digits:10',
		'transaction_coordinator' => 'required|max:50',
		'transaction_coordinator_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50|email',
		'transaction_coordinator_phone' => 'required|digits:10',
		'disclosure_hoa_fee' => 'required|in:buyer,seller,50,N/A',
		'certification_hoa_fee' => 'required|in:buyer,seller,50,N/A',
		'hoa_transfer_fee' => 'nullable|max:10',
		'private_transfer_fee' => 'nullable|max:10',
		'other_fee' => 'nullable|max:10',
		'other_fee_describe' => 'nullable|max:10',
	];

	public $rules3 = [
		'stove_oven' => 'required',
		'refrigerator' => 'required',
		'wine_refrigerator' => 'required',
		'washer' => 'required',
		'dryer' => 'required',
		'dishwasher' => 'required',
		'microwave' => 'required',
		'video_doorbell' => 'required',
		'security_camera' => 'required',
		'security_system' => 'required',
		'control_devices' => 'required',
		'audio_equipment' => 'required',
		'ground_pool' => 'required',
		'bathroom_mrrors' => 'required',
		'car_charging_system' => 'required',
		'potted_trees' => 'required',
		//'items_include_exclude' => 'required|array',
	];

	protected function messages() {
		return [
			'tenant_rights.required_if' => 'Please select one of the options',
			'rent_back_date.required_if' => 'Please select rent back date',
		];
	}

	protected function rules() {
		return array_merge($this->rules1, $this->rules2, $this->rules3);
	}

	public function mount() {

		$this->rules = array_merge($this->rules1, $this->rules2, $this->rules3);
		$this->progressbar = asset('web/img/progressbar-step-empty.png');

		$code = 1;
		$code += $this->getSetting('property_code');
		Setting::whereRule('property_code')->update(['value' => $code]);
		$this->property_id = 'VMS' . $code;
		$this->activation_date = Carbon::now()->format('Y-m-d');
		// $this->activation_date = Carbon::tomorrow()->format('Y-m-d');
	}

	public function render() {

		return view('livewire.web.property');
	}

	public function removeDisclosure() {
		$this->disclosure = null;
	}

	public function updated($name) {

		$this->validateOnly($name);
		$singleFamily = 0;
		if ($this->property_type == 'single_family') {
			$this->singleFamily = 1;
			$this->disclosure_hoa_fee = 'N/A';
			$this->certification_hoa_fee = 'N/A';
			$this->hoa_transfer_fee = 'N/A';

			$this->validateOnly('disclosure_hoa_fee');
			$this->validateOnly('certification_hoa_fee');
			$this->validateOnly('hoa_transfer_fee');
		} else {
			$this->singleFamily = 0;
			// $this->disclosure_hoa_fee = '';
			// $this->certification_hoa_fee = '';
			// $this->hoa_transfer_fee = '';
			$this->validateOnly('disclosure_hoa_fee');
			$this->validateOnly('certification_hoa_fee');
			$this->validateOnly('hoa_transfer_fee');
		}

		if ($name == 'agent_phone') {

			$request = new Request;
			$request->merge(['mobile_number' => $this->agent_phone]);
			$result = app('App\Http\Controllers\Api\ApiController')->getLicense($request);
			$data = $result->getData();

			if ($data->status == 200) {
				$this->agent_license = $data->data;
			} else {
				$this->agent_license = '';
			}
			$this->validateOnly('agent_license');
		}

		if ($this->other_fee == 'N/A' || $this->other_fee == '') {
			$this->otherFeeDescribe = true;
		} else {
			$this->otherFeeDescribe = false;
		}

		if ($name == 'activation_date' && $this->deactivation_date <= $this->activation_date) {
			$this->deactivation_date = '';
		}

	}

	public function movetoStep($new) {

		if ($new <= $this->step || $this->step != 3) {
			$this->step = $new;
		}

	}

	public function changeStep($new) {
		switch ($this->step) {
		case 1:

			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->rules1, $this->getMessages());

			$this->step = $new;
			$this->dispatchBrowserEvent('move-top');
			break;

		case 2:

			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->rules2, $this->getMessages());

			$this->step = $new;
			$this->dispatchBrowserEvent('move-top');
			break;

		case 3:

			$this->dispatchBrowserEvent('error-result');
			$this->validate($this->rules3, $this->getMessages());

			$this->step = $new;
			$items_include_exclude = [
				'stove_oven' => $this->stove_oven,
				'refrigerator' => $this->refrigerator,
				'wine_refrigerator' => $this->wine_refrigerator,
				'washer' => $this->washer,
				'dryer' => $this->dryer,
				'dishwasher' => $this->dishwasher,
				'microwave' => $this->microwave,
				'video_doorbell' => $this->video_doorbell,
				'security_camera' => $this->security_camera,
				'security_system' => $this->security_system,
				'control_devices' => $this->control_devices,
				'audio_equipment' => $this->audio_equipment,
				'ground_pool' => $this->ground_pool,
				'bathroom_mrrors' => $this->bathroom_mrrors,
				'car_charging_system' => $this->car_charging_system,
				'potted_trees' => $this->potted_trees,
				// 'additional_items' => $this->additional_items,
				// 'excluded_items' => $this->excluded_items,

			];

			$this->items_include_exclude = $items_include_exclude;

			$this->save_property();
			break;

		}

		switch ($this->step) {
		case 1:$this->progressbar = asset('web/img/progressbar-step-empty.png');
			break;
		case 2:$this->progressbar = asset('web/img/progressbar-step-empty-2.png');
			break;
		case 3:$this->progressbar = asset('web/img/progressbar-step-empty-5.png');
			break;
		}
	}

	public function save_property() {
		$seller = Seller::where(['user_type' => 'seller', 'property_id' => $this->property_id, 'phone_no' => $this->seller_phone])->first();

		if (!$seller) {
			$seller = new Seller;
			$seller->property_id = $this->property_id;
			$seller->full_name = $this->owner;
			$seller->phone_no = $this->seller_phone;
			$seller->account_id = Auth::guard('accounts')->id();
			$seller->user_type = 'seller';
			$seller->save();
		}

		//save property
		if (!MProperty::where('vms_property_id', $this->property_id)->exists()) {
			$agent = Agent::where(['user_type' => 'agent', 'property_id' => $this->property_id, 'phone_no' => $this->agent_phone])->first();

			if (!$agent) {
				$agent = new Agent;
				$agent->property_id = $this->property_id;
				$agent->full_name = $this->agent_name;
				$agent->phone_no = $this->agent_phone;
				$agent->license_no = $this->agent_license;
				$agent->user_type = 'agent';
				$agent->save();
			}

			//assign agent to seller
			$seller->agent_id = $agent->id;
			$seller->save();

			$property = new MProperty;
			$property->user_id = $seller->id;
			$property->agent_id = $agent->id;
			$property->vms_property_id = $seller->property_id;
			$property->property_address = $this->address;
			$property->owner_name = $this->owner;

			if ($this->activation_date == date('Y-m-d')) {
				$active = $this->activation_date . ' ' . date('H:i:s');
			} else {
				$active = $this->activation_date . ' 06:00:00';
			}
			$property->vms_start_date = $active;
			$property->vms_end_date = $this->deactivation_date . ' ' . date('H:i:s', strtotime($active));
			/*$property->vms_start_date = $this->activation_date . ' 06:00:00';
            $property->vms_end_date = $this->deactivation_date . ' 18:00:00';*/
			$property->reserved_price = $this->formatCurrency($this->reserved_price);
			$property->square_foot_rate = $this->formatCurrency($this->square_foot);
			$property->offer_increase = $this->offer_increase;
			$property->occupancy = $this->occupancy;
			$property->possession = $this->possession;
			if ($property->possession == 'rent_back') {
				$property->possession_rent_back = $this->rent_back_date;
			} elseif ($property->possession == 'tenant_rights') {
				$property->possession_tenant_rights = $this->tenant_rights;
			}
			$property->property_type = $this->property_type;
			$property->seller_credit_buyer = $this->buyer_credit;
			$property->seller_financing = $this->financing;
			$property->purchase_agreement = $this->purchase_agreement;
			$property->brokerage_name = $this->brokerage_name;
			$property->brokerge_license_no = $this->brokerage_license;
			$property->agent_name = $this->agent_name;
			$property->agent_phone = $this->agent_phone;
			$property->agent_license = $this->agent_license;
			$property->escrow_holder = $this->escrow_holder;
			$property->escrow_number = $this->escrow_number;
			$property->escrow_officer = $this->escrow_officer;
			$property->escrow_office_email = $this->escrow_officer_email;
			$property->escrow_office_phone = $this->escrow_officer_phone;
			$property->transaction_coordinator = $this->transaction_coordinator;
			$property->transaction_coordinator_email = $this->transaction_coordinator_email;
			$property->transaction_coordinator_phone = $this->transaction_coordinator_phone;
			$property->disclosure_hoa_fee = $this->singleFamily == 1?null: $this->disclosure_hoa_fee;
			$property->hoa_certification_fee = $this->singleFamily == 1?null: $this->certification_hoa_fee;
			$property->hoa_transfer_fee = $this->singleFamily == 1?null: $this->hoa_transfer_fee;
			$property->private_transfer_fee = $this->private_transfer_fee;
			$property->other_fee = $this->other_fee == 'N/A' ? '' : $this->other_fee;
			$property->other_fee_describe = $this->other_fee_describe;
			//items exclude/include

			$property->items_include_exclude = json_encode($this->items_include_exclude);
			$property->additional_items = $this->additional_items;
			$property->excluded_items = $this->excluded_items;
			$property->save();

			//save history
			$history = new PropertyHistory();
			$history->property_id = $property->id;
			$history->start_date = $property->vms_start_date;
			$history->end_date = $property->vms_end_date;
			$history->additional_hours = 0;
			$history->hours = 6;
			$history->save();

			if ($this->disclosure) {
				$path = $this->disclosure->store('uploads/MProperty/' . $property->id);

				$property->disclosure = $path;
			}

			$property->save();

			//notify admin
			$admin = Admin::whereRole(1)->first();
			$admin->notify(new InformAdminNewProperty($property));
			session()->flash('message', $this->getMessage(201));
			return redirect()->route('weblogin');
		} else {

			session()->flash('error', $this->getMessage(202));
			return redirect()->back();
		}
	}
}
