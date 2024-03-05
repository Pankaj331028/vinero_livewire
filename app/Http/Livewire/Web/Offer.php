<?php

namespace App\Http\Livewire\Web;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Buyer as User;
use App\Models\Cms;
use App\Models\Document;
use App\Models\DocumentVerification;
use App\Models\FinancialCredential;
use App\Models\Offers;
use App\Models\Property;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;
use Session;

class Offer extends Component {
	use WithFileUploads, ResponseMessages, Helper;

	public $type;
	public $step = 1;
	public $result;
	public $admin;
	public $next_step;
	public $offer_steps;
	public $property;
	public $step_count;
	public $button;
	//public $steps = 'my_offer';
	public $realStateAgency = 0;
	public $property_rate;
	public $user;
	public $current_offer;
	public $buyer_representative;
	public $control_mode;
	public $validatedData = [];
	public $loan_amount1;
	public $loan_amount2;
	public $loan_interest_rate_1;
	public $loan_interest_rate_2;
	public $direct_lender1;
	public $direct_lender2;
	public $buyer_representative_yes_no;
	public $talk_realtor;
	public $buyer_advisory_content;
	public $property_Countdown;
	public $Property_Purchase_Agreement = 1;
	public $edit_status = true;
	public $lone_count = 1;
	public $buyer_property_type;
	public $is_reviewed = 0;
	public $pdf_re;
	// public $checkbox_1=false;

	public $step1 = [
		'buyer_name' => '',
		'entity' => '',
		'buyer_representative' => '',
		'brokerage_firm' => '',
		'brokerage_license' => '',
		'agent_name' => '',
		'agent_license' => '',
		'agent_phone' => '',
		'agent_comission' => '',
	];
	public $rules_step1 = [
		'step1.buyer_name' => 'required|max:50',
		'step1.entity' => 'required|in:principal,llc,trust,corporation,legal_entity',
		'step1.buyer_representative' => 'required|in:yes,no',
		'step1.brokerage_firm' => 'nullable|max:50',
		'step1.brokerage_license' => 'nullable|max:15',
		'step1.agent_name' => 'nullable|max:50',
		'step1.agent_license' => 'nullable|max:15',
		'step1.agent_phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
		// 'step1.agent_phone' => 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|digits_between:9,11',
		'step1.agent_comission' => 'nullable|numeric|min:0|max:3',
	];

	public $attr_step1 = [
		'step1.buyer_name' => 'Buyer name',
		'step1.entity' => 'Entity',
		'step1.buyer_representative' => 'Buyer representative',
		'step1.brokerage_firm' => 'Brokerage firm',
		'step1.brokerage_license' => 'Brokerage license',
		'step1.agent_name' => 'Agent name',
		'step1.agent_license' => 'Agent license',
		'step1.agent_phone' => 'Agent phone',
		'step1.agent_comission' => 'Agent comission',
	];

	public $step2 = [
		'offered_price' => '',
		'seller_credit' => '',
		'net_price' => '',
		'close_escrow_days' => '',
		'final_verification' => '',
		'assignment_request' => '',
	];
	public $rules_step2 = [
		'step2.offered_price' => 'required',
		'step2.offered_price1' => 'required',
		'step2.seller_credit' => 'nullable|numeric|mod1000:125',
		'step2.net_price' => 'required',
		'step2.close_escrow_days' => 'required|numeric|min:1',
		'step2.final_verification' => 'required|numeric|min:1|max:10',
		'step2.assignment_request' => 'required|numeric|min:1|max:17',
	];
	public $attr_step2 = [
		'step2.offered_price' => 'Offered price',
		'step2.offered_price1' => 'Offered price',
		'step2.seller_credit' => 'Seller credit',
		'step2.net_price' => 'Net price',
		'step2.close_escrow_days' => 'Close escrow days',
		'step2.final_verification' => 'Final verification',
		'step2.assignment_request' => 'Assignment request',

	];

	protected function messages() {
		return [
			'step2.offered_price1.gte' => 'Offered price must be greater then or equal to property reserved price',
			'step8.approve.required' => 'Please approve to the offer details',
			'step8.buyer_advisory.required' => 'Please agree to the Buyers Advisory',
			'step8.talk_with_realtor.required' => 'Please select one of the options',
			'step8.talk_with_realtor.in' => 'Please select one of the options',
			'step8.submit_without_assistance.required' => 'Please confirm before submitting ',
			'step8.verify_human.required' => 'Please Verify you are a human',
			'step9.tnc.in' => 'Please accept this and continue',
			'step9.qualify_value.gte' => 'Insufficient funds, please revise',
			// 'step9.tnc' => 'Please accept this and continue',
			// 'step9.file.nullable' => 'Please accept this and continue',
			'step3.down_payment1.lte' => 'Balance of down payment can not greater than offer price',
			'step3.down_payment1.min' => 'Invalid down payment. Please check your inputs',
		];
	}

	public $step3 = [
		'estimated_closing_costs' => '',
		'initial_deposit_amount' => '',
		'within_days' => '',
		'deposit_increase' => '',
		'deposit_increase_days' => '',
		'down_payment' => '',
		'down_payment1' => '',
		'loan_amount_1' => '',
		'loan_interest_1' => '',
		'loan_points_1' => '',
		'direct_lender_1' => '',
		'financing_type_1' => '',
		'additional_terms_1' => '',
		'loan_amount_2' => '',
		'loan_interest_2' => '',
		'loan_points_2' => '',
		'direct_lender_2' => '',
		'financing_type_2' => '',
		'additional_terms_2' => '',
		'loan_value' => '',

	];
	public $rules_step3 = [
		'step3.estimated_closing_costs' => 'required|numeric|min:0|max:7',
		'step3.initial_deposit_amount' => 'required|max:10',
		'step3.within_days' => 'required|numeric|min:1|max:6',
		'step3.deposit_increase' => 'required|max:10',
		'step3.deposit_increase_days' => 'nullable',
		'step3.down_payment1' => 'required',
		'step3.down_payment' => 'required',
		'step3.loan_amount_1' => 'nullable|max:10',
		'step3.loan_interest_1' => 'nullable|required_with:loan_amount_1 > 0|numeric|min:0|max:18',
		'step3.loan_points_1' => 'nullable|numeric|max:10',
		'step3.direct_lender_1' => 'nullable|max:20',
		'step3.financing_type_1' => 'nullable|in:conventional,FHA,VA,seller_financing,other',
		'step3.additional_terms_1' => 'nullable|max:100',

		'step3.loan_amount_2' => 'nullable|max:10',
		'step3.loan_interest_2' => 'nullable|required_with:loan_amount_2 > 0|numeric|min:0|max:18',
		'step3.loan_points_2' => 'nullable|numeric|max:15',
		'step3.direct_lender_2' => 'nullable|max:20',
		'step3.financing_type_2' => 'nullable|in:conventional,FHA,VA,seller_financing,other',
		'step3.additional_terms_2' => 'nullable|max:100',
		'step3.loan_value' => 'nullable',
	];
	public $attr_step3 = [
		'step3.estimated_closing_costs' => 'Estimated closing cost',
		'step3.initial_deposit_amount' => 'Initial deposit amount',
		'step3.within_days' => 'Within days',
		'step3.deposit_increase' => 'Deposit increase',
		'step3.down_payment' => 'Down payment',
		'step3.down_payment1' => 'Down payment',
		'step3.deposit_increase_days' => 'Deposit increase days',
		'step3.loan_amount_1' => 'First loan amount',
		'step3.loan_interest_1' => 'First loan interest',
		'step3.loan_points_1' => 'First loan point',
		'step3.direct_lender_1' => 'First driect lender',
		'step3.financing_type_1' => 'First financing type',
		'step3.additional_terms_1' => 'First additional terms',
		'step3.loan_amount_2' => 'Second loan amount',
		'step3.loan_interest_2' => 'Second loan interest',
		'step3.loan_points_2' => 'Second loan point',
		'step3.direct_lender_2' => 'Second driect lender',
		'step3.financing_type_2' => 'Second financing type',
		'step3.additional_terms_2' => 'Second additional terms',
		'step3.loan_value' => 'Loana value',

	];

	public $step4 = [
		'loan_contingency' => '',
		'appraisal_contingency' => '',
		'investigation_property' => '',
		'property_access' => '',
		'review_documents' => '',
		'preliminary_report' => '',
		'review_of_leased' => '',
		'common_interest_disclosures' => '',
		'sale_buyer_property' => '',
		'seller_delivery_document' => '',
		'provisions_instructions' => '',
		'smoke_alarm' => '',
		'evidence_authority' => '',
		'hoa_documents' => '',
	];
	public $rules_step4 = [
		'step4.loan_contingency' => 'required|numeric|min:1|max:20',
		'step4.appraisal_contingency' => 'required|numeric|min:1|max:17',
		'step4.investigation_property' => 'required|numeric|min:1|max:17',
		'step4.property_access' => 'required|numeric|min:1|max:17',
		'step4.review_documents' => 'required|numeric|min:1|max:17',
		'step4.preliminary_report' => 'required|numeric|min:1|max:17',
		'step4.review_of_leased' => 'min:1|max:17',
		'step4.common_interest_disclosures' => 'min:1|max:17',
		'step4.sale_buyer_property' => 'min:1|max:17',
		'step4.seller_delivery_document' => 'required|numeric|min:1|max:7',
		'step4.provisions_instructions' => 'required|numeric|min:1|max:7',
		'step4.smoke_alarm' => 'required|numeric|min:1|max:7',
		'step4.evidence_authority' => 'required|numeric|min:1|max:7',
		'step4.hoa_documents' => 'min:1|max:7',
	];
	public $attr_step4 = [
		'step4.loan_contingency' => 'Loan contingency',
		'step4.appraisal_contingency' => 'Appraisal contingency',
		'step4.investigation_property' => 'Investigation property',
		'step4.property_access' => 'Property access',
		'step4.review_documents' => 'Review documents',
		'step4.preliminary_report' => 'Preliminary report',
		'step4.review_of_leased' => 'Review of leased',
		'step4.common_interest_disclosures' => 'Common interest disclosures',
		'step4.sale_buyer_property' => 'Sale buyer property',
		'step4.seller_delivery_document' => 'Saller delivery document',
		'step4.provisions_instructions' => 'Provisions instructions',
		'step4.smoke_alarm' => 'Smoke alarm',
		'step4.evidence_authority' => 'Evidence authority',
		'step4.hoa_documents' => 'Hoa documents',

	];

	public $step5 = [
		'cash_verified_amount' => '',
		'cash_verified_image' => [],
		'downpayment_verified_amount' => '',
		'downpayment_verified_image' => [],
		'loan_application_status' => '',
		'loan_application_amount' => '',
		'loan_interest_rate' => '',
		'direct_lender_name' => '',
		'loan_application_image' => [],
		'other_documents' => '',
		'other_document_image' => [],
	];
	public $rules_step5 = [
		'step5.cash_verified_amount' => 'nullable',
		'step5.cash_verified_image' => 'array|max:7',
		'step5.cash_verified_image.*' => 'nullable|mimes:jpeg,jpg,pdf,png|max:10000',
		'step5.downpayment_verified_amount' => 'required|max:10',
		'step5.downpayment_verified_image' => 'nullable|array|max:7',
		'step5.downpayment_verified_image.*' => 'nullable|mimes:jpeg,jpg,pdf,png|max:10000',
		'step5.loan_application_status' => 'nullable|in:pre_approval,pre_qualification,all_cash',
		// 'step5.loan_application_amount' => 'nullable',
		// 'step5.loan_interest_rate' => 'nullable|numeric|min:0|max:12',
		// 'step5.direct_lender_name' => 'nullable',
		'step5.loan_application_image' => 'array|max:7',
		'step5.loan_application_image.*' => 'nullable|mimes:jpeg,jpg,pdf,png|max:10000',
		'step5.other_documents' => 'max:20',
		'step5.other_document_image' => 'nullable|array|max:7',
		'step5.other_document_image.*' => 'nullable|mimes:jpeg,jpg,pdf,png|max:10000',
	];
	public $attr_step5 = [
		'step5.cash_verified_amount' => 'Cash verified amount',
		'step5.cash_verified_image' => 'Cash verified image',
		'step5.cash_verified_image.*' => 'Cash verified image',
		'step5.downpayment_verified_amount' => 'Downpayment verification amount',
		'step5.downpayment_verified_image' => 'Downpayment verification image',
		'step5.downpayment_verified_image.*' => 'Downpayment verification image',
		'step5.loan_application_status' => 'Loan application status',
		'step5.loan_application_amount' => 'Loan application amount',
		'step5.loan_interest_rate' => 'Loan application rate',
		'step5.direct_lender_name' => 'Direct lender name',
		'step5.loan_application_image' => 'Loan application image',
		'step5.loan_application_image.*' => 'Loan application image',
		'step5.other_documents' => 'Other documents',
		'step5.other_document_image' => 'Other document image',
		'step5.other_document_image.*' => 'Other document image',

	];

	public $step6 = [
		'additional_items' => '',
		'excluded_items' => '',
		'stove_oven' => '',
		'refrigerator' => '',
		'wine_refrigerator' => '',
		'washer' => '',
		'dryer' => '',
		'dishwasher' => '',
		'microwave' => '',
		'video_doorbell' => '',
		'security_camera' => '',
		'security_system' => '',
		'control_devices' => '',
		'audio_equipment' => '',
		'ground_pool' => '',
		'bathroom_mrrors' => '',
		'car_charging_system' => '',
		'potted_trees' => '',

	];
	public $rules_step6 = [
		'step6.additional_items' => 'nullable',
		'step6.excluded_items' => 'nullable',
		'step6.stove_oven' => 'nullable',
		'step6.refrigerator' => 'nullable',
		'step6.wine_refrigerator' => 'nullable',
		'step6.washer' => 'nullable',
		'step6.dryer' => 'nullable',
		'step6.dishwasher' => 'nullable',
		'step6.microwave' => 'nullable',
		'step6.video_doorbell' => 'nullable',
		'step6.security_camera' => 'nullable',
		'step6.security_system' => 'nullable',
		'step6.control_devices' => 'nullable',
		'step6.audio_equipment' => 'nullable',
		'step6.ground_pool' => 'nullable',
		'step6.bathroom_mrrors' => 'nullable',
		'step6.car_charging_system' => 'nullable',
		'step6.potted_trees' => 'nullable',
	];
	public $attr_step6 = [
		'step6.additional_items' => 'Additional item',
		'step6.excluded_items' => 'Excluded item',
		'step6.stove_oven' => 'Stove oven',
		'step6.refrigerator' => 'Refigerator',
		'step6.wine_refrigerator' => 'Wine refrigerator',
		'step6.washer' => 'Washer',
		'step6.dryer' => 'Dryer',
		'step6.dishwasher' => 'Dishwasher',
		'step6.microwave' => 'Microwave',
		'step6.video_doorbell' => 'Video doorbell',
		'step6.security_camera' => 'Security camera',
		'step6.security_system' => 'Security system',
		'step6.control_devices' => 'Control devices',
		'step6.audio_equipment' => 'Audio equipment',
		'step6.ground_pool' => 'Ground pool',
		'step6.bathroom_mrrors' => 'Bathroom mrror',
		'step6.car_charging_system' => 'Car charging system',
		'step6.potted_trees' => 'Potted trees',
	];

	public $step7 = [
		'natural_hazard_zone' => '',
		'environmental' => '',
		'provided_by' => '',
		'other' => '',
		'report_name' => '',
		'paid_by' => '',
		'smoke_alarms' => '',
		'gov_reports' => '',
		'gov_required_point' => '',
		'escrow_fees' => '',
		'escrow_holder' => '',
		'insurance_policy' => '',
		'title_company' => '',
		'buyer_lender_policy' => '',
		'country_transfer_tax' => '',
		'city_transfer_tax' => '',
		'warranty_plan' => '',
		'issued_by' => '',
		'cost_not_exceed' => '',
		'other_terms' => '',

	];
	public $rules_step7 = [
		'step7.natural_hazard_zone' => 'required|in:buyer,seller,50',
		'step7.environmental' => 'required|in:yes,no,n/a,N/A',
		'step7.provided_by' => 'required|max:30',
		'step7.other' => 'nullable|max:100',
		'step7.report_name' => 'nullable|max:100',
		'step7.paid_by' => 'required|in:buyer,seller,50',
		'step7.smoke_alarms' => 'required|in:buyer,seller,50',
		'step7.gov_reports' => 'required|in:buyer,seller,50',
		'step7.gov_required_point' => 'required|in:buyer,seller,50',
		'step7.escrow_fees' => 'required|in:buyer,seller,50,pay_own_fee',
		'step7.escrow_holder' => 'required|max:50',
		'step7.insurance_policy' => 'required|in:buyer,seller,50',
		'step7.title_company' => 'nullable|max:50',
		'step7.buyer_lender_policy' => 'required|in:buyer,seller,50',
		'step7.country_transfer_tax' => 'required|in:buyer,seller,50',
		'step7.city_transfer_tax' => 'required|in:buyer,seller,50',
		'step7.warranty_plan' => 'nullable|in:buyer,seller,50,waives',
		'step7.issued_by' => 'nullable|max:50',
		'step7.cost_not_exceed' => 'required_if:step7.warranty_plan,=,buyer,seller,50|max:10|nullable',
		// 'step7.other_fee_cost' => 'required|max:100'; //TODO
		'step7.other_terms' => 'nullable|max:100',
	];
	public $attr_step7 = [
		'step7.natural_hazard_zone' => 'Natural hazard zone',
		'step7.environmental' => 'Environmental',
		'step7.provided_by' => 'Provided by',
		'step7.other' => 'Other',
		'step7.report_name' => 'Report name',
		'step7.paid_by' => 'Paid by',
		'step7.smoke_alarms' => 'Smoke alarms',
		'step7.gov_reports' => 'Gov. reports',
		'step7.gov_required_point' => 'Gov. required point',
		'step7.escrow_fees' => 'Escrow fees',
		'step7.escrow_holder' => 'Escrow holder',
		'step7.insurance_policy' => 'insurance policy',
		'step7.title_company' => 'Company title',
		'step7.buyer_lender_policy' => 'Buyer lender policy',
		'step7.country_transfer_tax' => 'Country transfer tex',
		'step7.city_transfer_tax' => 'City transfet tex',
		'step7.warranty_plan' => 'Warranty plan',
		'step7.issued_by' => 'Issued by',
		'step7.cost_not_exceed' => 'Cost not exceed',
		'step7.other_terms' => 'Other terms',
	];

	public $step8 = [
		'approve' => '',
		'buyer_advisory' => '',
		'talk_with_realtor' => '',
		'submit_without_assistance' => '',
		'verify_human' => '',

	];
	public $rules_step8 = [
		'step8.approve' => 'required|in:yes,no',
		'step8.buyer_advisory' => 'required|in:yes,no',
		'step8.talk_with_realtor' => 'required|in:call_with_agent,decline',
		'step8.submit_without_assistance' => 'required',
		'step8.verify_human' => 'required|in:yes,no',
		// 'step8.submit_without_assistance' => 'required',
	];
	public $attr_step8 = [
		'step8.approve' => 'Please Approve the offer',
		'step8.buyer_advisory' => 'Please agree the Buyers Advisory',
		'step8.talk_with_realtor' => 'Please select one options',
		// 'step8.submit_without_assistance' => 'I want to submit my offer without the assistance of a realtor',
		'step8.submit_without_assistance' => 'Please confirm before submiting ',
		'step8.verify_human' => ' Please Verify you are a human',
	];

	public $step9 = [
		'file' => '',
		'tnc' => '',
	];
	public $rules_step9 = [
		'step9.file' => 'nullable',
		// 'step9.tnc' => 'required|in:yes,no',
		'step9.tnc' => 'required|in:1',
	];
	public $attr_step9 = [
		'step9.file' => 'File field',
		'step9.tnc' => 'Tearm & condition',
	];
	public $step10 = [
		'file' => '',
	];
	public $rules_step10 = [
		'step10.file' => "required|mimes:jpeg,jpg,png|max:10000",
		// 'step10.file' => "nullable",
	];
	public $attr_step10 = [
		'step10.file' => 'File field',
	];

	public $offered_price = '';
	// protected $rules = [];
	// public $attr = [];
	public $net_price = '';
	public $seller_credit = '';

	public $cash_verified_image = [], $cash_verified_image_ids = [];
	public $downpayment_verified_image = [], $downpayment_verified_image_ids = [];
	public $loan_application_image = [], $loan_application_image_ids = [];
	public $other_document_image = [], $other_document_image_ids = [];

	public function mount($type = null, $id = null, Request $request) {

		if (Session::has('signed') && Session::get('signed')) {

			$user = User::find(Auth::id());

			if ($user->offer) {

				$user->offer->signature = 'signed';
				$user->offer->status = 'PN';
				$user->offer->save();

				session()->flash('message', $this->getMessage(212));
			}
		}
		// dd(auth()->user());
		// dd($this->notifications_type('App\Notifications\InformBuyerHigherOffer'));
		$cms = Cms::where(['slug' => 'buyer-advisory'])->first();
		$this->buyer_advisory_content = html_entity_decode($cms->content);

		$st_eps = app('App\Http\Controllers\Api\Buyer\ApiController')->offerSteps();
		$st_ep = $st_eps->getData();

		$array = ((array) $st_ep->data);
		$this->result = array_search(false, $array);
		$this->result1 = array_search('1', $array);

		$this->slug = $id;
		$this->type = $type;
		$user = User::find(Auth::id());
		$this->user = $user;

		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
		$obj = new \App\Http\Controllers\Api\Buyer\ApiController;
		// $obj = submitOffer();

		$res = (new BaseController)->checkUserActive($user);
		if (gettype($res) != 'boolean') {
			return $res;
		}

		$list = Property::where('vms_property_id', $user->property_id)->first();

		$this->buyer_property_type = $list;
		// dd($this->buyer_property_type->seller_credit_buyer);
		$property = (new BaseController)->formatResourceData($list);
		$this->property_rate = $property->reserved_price;
		$this->property_Countdown = $property->vms_end_date;

		if ($property) {

			if ($user->user_type == 'agent') {
				$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();

				if (!$offer) {
					$offer = null;
				}
			} else {
				if ($user->offer) {
					$offer = $user->offer;
				} else {
					$offer = null;
				}
			}

			// $this->rules_step2['step2.offered_price'] .= '|gte:' . $this->property_rate;
			$this->rules_step2['step2.offered_price1'] .= '|gte:' . $this->property_rate;
			$status = true; //can edit

			if (isset($offer->status)) {
				if (in_array($offer->status, ['IN', 'PN', 'DCIN', 'FCIN'])) {
					$this->edit_status = true;
				} else {
					// $status = false; //cannot edit
					$this->edit_status = false;
				}
			}

			$start_date = Carbon::parse($property->possession_rent_back);
			$end_date = Carbon::parse($property->vms_end_date);

			$data_step1 = [
				'address' => $property->property_address,
				'submission_date' => date('Y-m-d'),
				'due_date' => $end_date->format('Y-m-d'),
				'seller_brokerage_firm' => $property->brokerage_name . ' ' . $property->brokerge_license_no,
				'seller_agent_name' => $property->agent_name . ' ' . $property->agent_license,
				'buyer_name' => $offer->buyer_name ?? '',
				'entity' => $offer->legal_entity ?? '',
				'buyer_representative' => $offer->represented_by ?? '',
				'brokerage_firm' => $offer->buyer_brokerage_firm ?? '',
				'brokerage_license' => $offer->buyer_brokerge_license ?? '',
				'agent_name' => $offer->buyer_agent ?? '',
				'agent_license' => $offer->buyer_agent_license ?? '',
				'agent_phone' => $offer->buyer_agent_phone ?? '',
				'agent_comission' => $offer->buyer_agent_commission_percentage ?? '',
			];
			$this->step1 = $data_step1;
			if ($offer) {
				$this->buyer_representative_yes_no = $offer->represented_by;
			}

			$start_date = Carbon::parse($property->possession_rent_back);
			$end_date = Carbon::parse($property->vms_end_date);
			$different_days = $start_date->diffInDays($end_date);
			$data_step2 = [
				'commission' => $offer->buyer_agent_commission_percentage ?? 0,
				'expiry_date' => $end_date->format('M d,Y'),
				'occupancy' => $property->occupancy,
				'possession' => $property->possession,
				'possession_rent_back' => $different_days,
				'possession_tenant_rights' => $property->possession_tenant_rights,
				'seller_credit_buyer' => $property->seller_credit_buyer,
				'offered_price' => $this->getSetting('currency') . number_format($offer->transaction->offer_price ?? 0) ?? 0,
				'offered_price1' => $offer->transaction->offer_price ?? 0,
				'seller_credit' => $offer->transaction->seller_credit ?? 0,
				'net_price' => $this->getSetting('currency') . number_format($offer->transaction->net_price ?? 0) ?? 0,
				'final_verification' => $offer->transaction->final_verification ?? 0,
				'assignment_request' => $offer->transaction->assignment_request ?? 0,
				// 'close_escrow_days' => $offer->transaction->days_of_escrow ?? 0,
				'close_escrow_days' => $offer->transaction->days_of_escrow ?? '',
				'offer_status' => $status,
			];
			// dd($offer->transaction->days_of_escrow);
			$this->step2 = $data_step2;
			$this->dispatchBrowserEvent('update-item');
			if (isset($offer)) {
				// dd(isset($offer->strategy->combined_loan_value) == false ? 0 :$offer->strategy->combined_loan_value.' & CLTV');
				// dd($offer->strategy->combined_loan_value);
				$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
				// dd($offer1);

				$loan_amount = $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
				$data_step3 = [
					'seller_financing' => $property->seller_financing,
					'seller_credit_amount' => $this->getSetting('currency') . number_format($offer->transaction->seller_credit_amount ?? 0) ?? '',
					'down_payment' => $this->getSetting('currency') . number_format($offer->strategy->balance_down_payment ?? 0) ?? 0,
					'down_payment1' => $offer->strategy->balance_down_payment ?? 0,
					'credit_to_buyer' => $property->seller_credit_buyer == 'yes' ? 1 : 0,
					'offered_price' => $this->getSetting('currency') . number_format($offer1->offer_price),
					'offered_price1' => $offer1->offer_price,
					'estimated_closing_costs' => $offer->strategy->estimated_closing_costs ?? 0,
					'initial_deposit_amount' => $this->getSetting('currency') . number_format($offer->strategy->initial_deposit_amount ?? 0) ?? 0,
					'within_days' => $offer->strategy->within_days ?? '3',
					'deposit_increase' => $this->getSetting('currency') . number_format($offer->strategy->deposit_increase ?? 0) ?? 0,
					'deposit_increase_days' => $offer->strategy->days_to_increase ?? '',
					'loan_amount_1' => $this->getSetting('currency') . number_format($offer->strategy->first_mortgage_loan_amount ?? 0) ?? 0,
					'loan_interest_1' => $offer->strategy->first_loan_interest_rate ?? 0,
					'loan_points_1' => $offer->strategy->first_mortage_loan_points ?? '',
					'direct_lender_1' => $offer->strategy->first_direct_lender_name ?? '',
					'financing_type_1' => $offer->strategy->first_type_of_financing ?? '',
					'additional_terms_1' => $offer->strategy->first_additional_terms ?? '',
					'loan_amount_2' => $this->getSetting('currency') . number_format($offer->strategy->second_mortgage_loan_amount ?? 0) ?? 0,
					'loan_interest_2' => $offer->strategy->second_loan_interest_rate ?? 0,
					'loan_points_2' => $offer->strategy->second_mortage_loan_points ?? '',
					'direct_lender_2' => $offer->strategy->second_direct_lender_name ?? '',
					'financing_type_2' => $offer->strategy->second_type_of_financing ?? '',
					'additional_terms_2' => $offer->strategy->second_additional_terms ?? '',
					'loan_value' => isset($offer->strategy->combined_loan_value) == false ? 0 : $offer->strategy->combined_loan_value . ' & CLTV',
					'offer_status' => $status,
				];
				$this->step3 = $data_step3;
				// dd($data_step3);
				$this->loan_interest_rate_1 = $this->step3['loan_interest_1'] == "" ? '-' : $this->step3['loan_interest_1'] . '%';
				$this->loan_interest_rate_2 = $this->step3['loan_interest_2'] == "" ? '-' : $this->step3['loan_interest_2'] . '%';
				$this->loan_amount1 = $this->formatCurrency($this->step3['loan_amount_1']) == "" ? 0.00 : $this->getSetting('currency') . number_format($this->formatCurrency($this->step3['loan_amount_1']));
				$this->loan_amount2 = $this->formatCurrency($this->step3['loan_amount_2']) == "" ? 0.00 : $this->getSetting('currency') . number_format($this->formatCurrency($this->step3['loan_amount_2']));
				$this->direct_lender1 = $this->step3['direct_lender_1'] == "" ? '-' : $this->step3['direct_lender_1'];
				$this->direct_lender2 = $this->step3['direct_lender_2'] == "" ? '-' : $this->step3['direct_lender_2'];
				$this->dispatchBrowserEvent('update-item');
			}
			//
			$data_step4 = [
				'loan_contingency' => $offer->contract->loan_contingency ?? '17',
				'appraisal_contingency' => $offer->contract->appraisal_contingency ?? '17',
				'investigation_property' => $offer->contract->investigation_property ?? '17',
				'property_access' => $offer->contract->property_access ?? '17',
				'review_documents' => $offer->contract->review_documents ?? '17',
				'preliminary_report' => $offer->contract->preliminary_report ?? '17',
				'review_of_leased' => $offer->contract->review_of_leased ?? 0,
				'common_interest_disclosures' => $offer->contract->common_interest_disclosures ?? 0,
				'sale_buyer_property' => $offer->contract->sale_buyer_property ?? 0,
				'seller_delivery_document' => $offer->contract->seller_delivery_document ?? '7',
				'provisions_instructions' => $offer->contract->provisions_instructions ?? '5',
				'smoke_alarm' => $offer->contract->smoke_alarm ?? '7',
				'evidence_authority' => $offer->contract->evidence_authority ?? '1',
				'hoa_documents' => $offer->contract->hoa_documents ?? 0,
				'offer_status' => $status,
			];
			$this->step4 = $data_step4;
			// dd($data_step4);
			$this->dispatchBrowserEvent('update-item');
			if (!isset($offer->strategy)) {

				$data_step5 = [
					'cash_verification' => isset($offer->strategy->first_mortgage_loan_amount) || isset($offer->strategy->second_mortgage_loan_amount) ? (($offer->strategy->second_mortgage_loan_amount > 0 || $offer->strategy->first_mortgage_loan_amount > 0) ? 1 : 0) : 0,
					'cash_verified_amount' => isset($offer->document->cash_verified_amount) ? $this->getSetting('currency') . number_format($offer->document->cash_verified_amount) : '',
					'cash_verified_image' => $offer->document->cashVerifiedFiles ?? [],
					'downpayment_verified_amount' => 0,
					'downpayment_verified_image' => $offer->document->downpaymentFiles ?? [],
					'loan_application_status' => $offer->document->loan_application_status ?? '',
					'loan_application_amount' => 0,
					'loan_interest_rate' => 0,
					'direct_lender_name' => 0,
					'loan_application_image' => $offer->document->loanApplicationFiles ?? [],
					'other_documents' => $offer->document->other_documents ?? "",
					'other_document_image' => $offer->document->otherFiles ?? [],
					'offer_status' => $status,
				];
				// dd($this->step5['cash_verification']);
				// dd($offer->document->otherFiles);
				$this->dispatchBrowserEvent('update-item');
			} else {
				// dd($offer->document->otherFiles);
				$data_step5 = [
					'cash_verification' => isset($offer->strategy->first_mortgage_loan_amount) || isset($offer->strategy->second_mortgage_loan_amount) ? (($offer->strategy->second_mortgage_loan_amount > 0 || $offer->strategy->first_mortgage_loan_amount > 0) ? 1 : 0) : 0,
					'cash_verified_amount' => isset($offer->document->cash_verified_amount) ? $this->getSetting('currency') . number_format($offer->document->cash_verified_amount) : '',
					'cash_verified_image' => $offer->document->cashVerifiedFiles ?? [],
					'downpayment_verified_amount' => $offer->strategy->first_mortgage_loan_amount > 0 ? $this->getSetting('currency') . number_format($offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount) : 0,
					'downpayment_verified_image' => $offer->document->downpaymentFiles ?? [],
					'loan_application_status' => $offer->document->loan_application_status ?? '',
					'loan_application_amount' => $offer->strategy->first_mortgage_loan_amount ? $this->getSetting('currency') . $offer->strategy->first_mortgage_loan_amount . ' - ' . $this->getSetting('currency') . $offer->strategy->second_mortgage_loan_amount : '',
					'loan_interest_rate' => $offer->strategy->first_loan_interest_rate ? $offer->strategy->first_loan_interest_rate . '% -' . $offer->strategy->second_loan_interest_rate . '%' : '',
					'direct_lender_name' => isset($offer->strategy->first_direct_lender_name) ? $offer->strategy->first_direct_lender_name . ' - ' . $offer->strategy->second_direct_lender_name : '',
					'loan_application_image' => $offer->document->loanApplicationFiles ?? [],
					'other_documents' => $offer->document->other_documents ?? "",
					'other_document_image' => $offer->document->otherFiles ?? [],
					'offer_status' => $status,
				];
				// dd($data_step5['loan_application_amount']);
				// dd($offer->strategy->first_mortgage_loan_amount);
				// dd(isset($offer->strategy->first_mortgage_loan_amount) ||isset($offer->strategy->second_mortgage_loan_amount) ? (($offer->strategy->second_mortgage_loan_amount >0 || $offer->strategy->first_mortgage_loan_amount>0) ? 1 : 0) : 0);
				// dd((isset($offer->strategy->first_mortgage_loan_amount) || isset($offer->strategy->second_mortgage_loan_amount)) ? 0 : 1);
				// dd($data_step5['cash_verification']);
				$this->dispatchBrowserEvent('update-item');
			}

			if (isset($offer->id)) {
				if ($data_step5['cash_verification'] == 1) {
					// disable cash_verified
					Document::where('documentable_id', $offer->id)->whereType('cash_verified_image')->update(['status' => 'DL']);
					$data_step5['cash_verified_image'] = [];
				} else {
					Document::where('documentable_id', $offer->id)->whereType('downpayment_verified_image')->update(['status' => 'DL']);
					Document::where('documentable_id', $offer->id)->whereType('loan_application_image')->update(['status' => 'DL']);
					$data_step5['downpayment_verified_image'] = [];
					$data_step5['loan_application_image'] = [];
				}
			}

			$this->data_step5 = $data_step5;

			$this->step5['other_documents'] = $data_step5['other_documents'];
			$this->step5['cash_verification'] = $data_step5['cash_verification'];
			$this->step5['cash_verified_amount'] = $data_step5['cash_verified_amount'];
			$this->step5['downpayment_verified_amount'] = $data_step5['downpayment_verified_amount'];
			$this->step5['loan_application_status'] = $data_step5['loan_application_status'];
			$this->step5['loan_application_amount'] = $data_step5['loan_application_amount'];
			$this->step5['loan_interest_rate'] = $data_step5['loan_interest_rate'];
			$this->step5['direct_lender_name'] = $data_step5['direct_lender_name'];
			// dd($data_step5['cash_verification']);
			$this->cash_verified_image = $data_step5['cash_verified_image'];
			$this->downpayment_verified_image = $data_step5['downpayment_verified_image'];
			$this->loan_application_image = $data_step5['loan_application_image'];
			$this->other_document_image = $data_step5['other_document_image'];

			// dd($data_step5['other_document_image']);
			// dd($offer);
			if (isset($offer)) {
				// dd($offer->include_exclude);
				if (isset($offer->include_exclude)) {
					$item = json_decode($property->items_include_exclude);
					$data_step6 = [
						'items' => json_decode($property->items_include_exclude),
						'additional_items' => $property->additional_items,
						'excluded_items' => $property->excluded_items,
						'stove_oven' => $offer->include_exclude->stove_oven == "No" ? false : $offer->include_exclude->stove_oven,
						'refrigerator' => $offer->include_exclude->refrigerator == "No" ? false : $offer->include_exclude->refrigerator,
						'wine_refrigerator' => $offer->include_exclude->wine_refrigerator == "No" ? false : $offer->include_exclude->wine_refrigerator,
						'washer' => $offer->include_exclude->washer == "No" ? false : $offer->include_exclude->washer,
						'dryer' => $offer->include_exclude->dryer == "No" ? false : $offer->include_exclude->dryer,
						'dishwasher' => $offer->include_exclude->dishwasher == "No" ? false : $offer->include_exclude->dishwasher,
						'microwave' => $offer->include_exclude->microwave == "No" ? false : $offer->include_exclude->microwave,
						'video_doorbell' => $offer->include_exclude->video_doorbell == "No" ? false : $offer->include_exclude->video_doorbell,
						'security_camera' => $offer->include_exclude->security_camera == "No" ? false : $offer->include_exclude->security_camera,
						'security_system' => $offer->include_exclude->security_system == "No" ? false : $offer->include_exclude->security_system,
						'control_devices' => $offer->include_exclude->control_devices == "No" ? false : $offer->include_exclude->control_devices,
						'audio_equipment' => $offer->include_exclude->audio_equipment == "No" ? false : $offer->include_exclude->audio_equipment,
						'ground_pool' => $offer->include_exclude->ground_pool == "No" ? false : $offer->include_exclude->ground_pool,
						'bathroom_mrrors' => $offer->include_exclude->bathroom_mrrors == "No" ? false : $offer->include_exclude->bathroom_mrrors,
						'car_charging_system' => $offer->include_exclude->car_charging_system == "No" ? false : $offer->include_exclude->car_charging_system,
						'potted_trees' => $offer->include_exclude->potted_trees == "No" ? false : $offer->include_exclude->potted_trees,
						'additional_items' => $offer->include_exclude->additional_items ?? '',
						'excluded_items' => $offer->include_exclude->excluded_items ?? '',
						'offer_status' => $status,
					];
					$this->step6 = $data_step6;
					// dd($data_step6);
					$this->dispatchBrowserEvent('update-item');
				} else {
					$item = json_decode($property->items_include_exclude);
					$data_step6 = [
						'items' => json_decode($property->items_include_exclude),
					];
					$this->step6 = $data_step6;
					$this->dispatchBrowserEvent('update-item');
				}

			} else {
				$item = json_decode($property->items_include_exclude);
				$data_step6 = [
					'items' => json_decode($property->items_include_exclude),
				];
				$this->step6 = $data_step6;
			}

			// dd($data_step6['stove_oven']);
			$data_step7 = [
				'property_type' => $property->property_type,
				'disclosure_hoa_fee' => $property->disclosure_hoa_fee ?? '',
				'hoa_certification_fee' => $property->hoa_certification_fee ?? '',
				'hoa_transfer_fee' => $property->hoa_transfer_fee ?? '',
				'private_transfer_fee' => $property->private_transfer_fee ?? '',
				'other_fee' => $property->other_fee ?? '',
				'natural_hazard_zone' => $offer->cost_allocation->natural_hazard_zone ?? '',
				'environmental' => $offer->cost_allocation->environmental ?? '',
				'provided_by' => $offer->cost_allocation->provided_by ?? '',
				'other' => $offer->cost_allocation->other ?? '',
				'report_name' => $offer->cost_allocation->report_name ?? '',
				'paid_by' => $offer->cost_allocation->paid_by ?? '',
				'smoke_alarms' => $offer->cost_allocation->smoke_alarms ?? '',
				'gov_reports' => $offer->cost_allocation->gov_reports ?? '',
				'gov_required_point' => $offer->cost_allocation->gov_required_point ?? '',
				'escrow_fees' => $offer->cost_allocation->escrow_fees ?? '',
				'escrow_holder' => $property->escrow_holder ?? $offer->cost_allocation->escrow_holder,
				'insurance_policy' => $offer->cost_allocation->insurance_policy ?? '',
				'title_company' => $offer->cost_allocation->title_company ?? '',
				'buyer_lender_policy' => $offer->cost_allocation->buyer_lender_policy ?? '',
				'country_transfer_tax' => $offer->cost_allocation->country_transfer_tax ?? '',
				'city_transfer_tax' => $offer->cost_allocation->city_transfer_tax ?? '',
				'warranty_plan' => $offer->cost_allocation->warranty_plan ?? '',
				'issued_by' => $offer->cost_allocation->issued_by ?? '',
				'cost_not_exceed' => $offer->cost_allocation->cost_not_exceed ?? '',
				'other_terms' => $offer->cost_allocation->other_terms ?? '',
				'offer_status' => $status,
			];
			$this->step7 = $data_step7;
			if (isset($offer) && isset($offer->transaction) && isset($offer->strategy)) {
				// dd($offer->strategy);
				// dd(isset($offer->document->downpayment_verified_amount));
				$data_step8 = [
					'offered_price' => ($offer->transaction->offer_price),
					'closing_cost' => ($offer->transaction->offer_price * ($offer->strategy->estimated_closing_costs ?? 0) / 100),
					'seller_credit' => ($offer->transaction->seller_credit_amount),
					'closed_funds' => isset($offer->document->downpayment_verified_amount) == false ? 0 : ($offer->document->downpayment_verified_amount),
					'mortgage_loan_1' => ($offer->strategy->first_mortgage_loan_amount),
					'mortgage_loan_2' => ($offer->strategy->second_mortgage_loan_amount),
					'initial_deposit' => ($offer->strategy->initial_deposit_amount),
					'deposit_increase' => ($offer->strategy->deposit_increase),
					'closing_balance' => ($offer->strategy->balance_down_payment),
					'escrow_closing' => Carbon::parse($user->property->end_date)->addDay($offer->transaction->days_of_escrow + 1)->format('Y-m-d'),
					'offer_status' => $status,
					'approve' => $offer->approve,
					'buyer_advisory' => $offer->buyer_advisory,
					'talk_with_realtor' => $offer->talk_with_realtor,
					'submit_without_assistance' => $offer->submit_without_assistance,
					'verify_human' => $offer->verify_human,
				];

				$this->step8 = $data_step8;

				$this->talk_realtor = $offer->talk_with_realtor;

			}

			if ($offer == null) {
				$data_step9 = [
					'current_offer' => "",
					'qualify_value' => 0,
					'loan_amount_1' => "",
					'loan_interest_1' => 0,
					'direct_lender_1' => "",
					'loan_amount_2' => "",
					'loan_interest_2' => 0,
					'direct_lender_2' => "",
				];
				$this->step9 = $data_step9;
			} else {
				$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
				$bid = $offer_details->getData()->data;
				$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
				$loan_amount = $offer1->first_mortgage_loan_amount == null ? 0 : $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
				$intrest_rate = isset($offer->strategy->first_loan_interest_rate)+isset($offer->strategy->second_loan_interest_rate);
				$data_step9 = [
					'current_offer' => number_format($offer->transaction->offer_price ?? 0),
					// 'qualify_value' => number_format($loan_amount + $intrest_rate),
					'qualify_value' => ($bid->qualify_for),
					'loan_amount_1' => $this->getSetting('currency') . number_format($offer->strategy->first_mortgage_loan_amount ?? 0) ?? 0,
					'loan_interest_1' => $offer->strategy->first_loan_interest_rate ?? 0,
					'direct_lender_1' => $offer->strategy->first_direct_lender_name ?? '',
					'loan_amount_2' => $this->getSetting('currency') . number_format($offer->strategy->second_mortgage_loan_amount ?? 0) ?? 0,
					'loan_interest_2' => $offer->strategy->second_loan_interest_rate ?? 0,
					'direct_lender_2' => $offer->strategy->second_direct_lender_name ?? '',
					'tnc' => $offer->financial->tnc ?? 0,
					// 'file_old' => $offer->financial->file ?? '',
					// 'file'=> null,
					'file' => $offer->financial->file ?? '',
					'proof_funds' => number_format($bid->proof_funds),
				];
				$this->step9 = $data_step9;

			}
			$this->is_reviewed = $offer->is_reviewed ?? 0;
			if (isset($offer->transaction)) {
				$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
				$bid = $offer_details->getData()->data;
				$this->pdf_re = $bid->purchase_contract;
				$data_step10 = [
					'current_bid' => number_format($offer->transaction->offer_price ?? 0) ?? 0,
					'financial_qulification' => number_format($bid->qualify_for),
					'bid_per_sqfeet' => sprintf('%0.2f', $offer->transaction->offer_price / $property->square_foot_rate) ?? '',
					'est_morgage' => number_format($bid->est_mortgage),
					'file' => $offer->signature ?? '',
				];

				$this->step10 = $data_step10;

			}

			$realState = $this->step1['buyer_representative'];
			if ($realState == 'no') {
				$this->realStateAgency = 1;
			} else {
				$this->realStateAgency = 0;
			}
			if (strpos(url()->current(), "my-offer")) {
				if ($array['my_offer'] == true) {
					$this->step = 1;
				} elseif ($array['transaction'] == false) {
					$this->step = 2;
				} elseif ($array['strategy'] == false) {
					$this->step = 3;
				} elseif ($array['timings'] == false) {
					$this->step = 4;
				} elseif ($array['doc_verification'] == false) {
					$this->step = 5;
				} elseif ($array['items_include_exclude'] == false) {
					$this->step = 6;
				} elseif ($array['cost_allocation'] == false) {
					$this->step = 7;
				} elseif ($array['summary'] == false) {
					$this->step = 8;
				} elseif ($array['financial_credentials'] == 1) {
					$this->step = 9;
					$this->step = 9;
				} else {
					$this->step = 10;
					$this->step = 10;
				}
			} else {
				if ($array['my_offer'] == false) {
					$this->step = 1;
				} elseif ($array['transaction'] == false) {
					$this->step = 2;
				} elseif ($array['strategy'] == false) {
					$this->step = 3;
				} elseif ($array['timings'] == false) {
					$this->step = 4;
				} elseif ($array['doc_verification'] == false) {
					$this->step = 5;
				} elseif ($array['items_include_exclude'] == false) {
					$this->step = 6;
				} elseif ($array['cost_allocation'] == false) {
					$this->step = 7;
				} elseif ($array['summary'] == false) {
					$this->step = 8;
				} elseif ($array['financial_credentials'] == 0) {
					$this->step = 9;
					$this->step = 9;
				} else {
					$this->step = 10;
					$this->step = 10;
				}
			}

		}

	}

	protected function getValidationAttributes() {
		return array_merge($this->attr_step1, $this->attr_step2, $this->attr_step3, $this->attr_step4, $this->attr_step5, $this->attr_step6, $this->attr_step7, $this->attr_step8, $this->attr_step9, $this->attr_step10);
	}

	protected function getRules() {
		return array_merge($this->rules_step1, $this->rules_step2, $this->rules_step3, $this->rules_step4, $this->rules_step5, $this->rules_step6, $this->rules_step7, $this->rules_step8, $this->rules_step9, $this->rules_step10);
	}

	public function render() {

		return view('livewire.web.offer');
	}

	public function updated($new) {

		// dd($this->step1['brokerage_firm'],$this->step1['brokerage_license']);
		// $this->doc_image_count =count($this->step5['downpayment_verified_image']);

		if (strpos($new, '_2') !== false) {
			$this->lone_count = 2;
		} elseif (strpos($new, '_1') !== false) {
			$this->lone_count = 1;
		}

		$loan1 = $this->formatCurrency($this->step3['loan_amount_1']);
		$loan2 = $this->formatCurrency($this->step3['loan_amount_2']);

		$this->talk_realtor = $this->step8['talk_with_realtor'];
		$this->buyer_representative_yes_no = $this->step1['buyer_representative'];

		$realState = $this->step1['buyer_representative'];
		if ($realState == 'no') {
			$this->realStateAgency = 1;
			if ($this->formatCurrency($this->step2['offered_price']) > 0) {
				$oferePrice = $this->formatCurrency($this->step2['offered_price']);
				$sellerCredit = str_replace(",", "", (!empty($this->step2['seller_credit']) ? $this->step2['seller_credit'] : 0));

				$differnce = ($oferePrice * $sellerCredit) / 100;

				$this->step2['net_price'] = $this->getSetting('currency') . number_format($oferePrice - $differnce);

			}
			// $this->step8['talk_with_realtor'] = '';
			$this->rules_step8['step8.talk_with_realtor'] = 'required|in:call_with_agent,decline';
		} else {
			$this->realStateAgency = 0;
			if ($this->formatCurrency($this->step2['offered_price']) > 0) {
				$buyer_with_agent_commission_percentage = str_replace(",", "", $this->step1['agent_comission'] ?? 0) ?? 0;

				$oferePrice = $this->formatCurrency($this->step2['offered_price']);
				$sellerCredit = str_replace(",", "", (!empty($this->step2['seller_credit']) ? $this->step2['seller_credit'] : 0));
				$commission = ($oferePrice * $this->formatCurrency($buyer_with_agent_commission_percentage)) / 100;
				$differnce = ($oferePrice * $sellerCredit) / 100;
				$this->step2['net_price'] = $this->getSetting('currency') . number_format($oferePrice - ($differnce + $commission));
				$this->rules_step8['step8.talk_with_realtor'] = 'nullable|in:call_with_agent,decline';

			}
			// $this->step8['talk_with_realtor'] = '';
		}
		// dd($this->formatCurrency($this->step3['loan_amount_1']));
		// dd($this->formatCurrency($this->step2['offered_price']));
		if ($this->formatCurrency($this->step3['initial_deposit_amount']) > 0 && $this->formatCurrency($this->step2['offered_price']) > 0) {
			// $transaction_offer_price = str_replace(",", "", $this->step2['offered_price']) ? (int) str_replace(",", "", $this->step2['offered_price']) : 0;
			// $initial_deposit_amount =$this->step3['initial_deposit_amount'];
			// // dd($initial_deposit_amount);
			// $deposit_increase=$this->step3['deposit_increase'];
			// $sellerCredit = str_replace(",", "", $this->step2['seller_credit']);
			// $estimated_closing_costs = $this->step3['estimated_closing_costs'];
			// $seller_credit_Amount= ((int) $transaction_offer_price * $sellerCredit) / 100;
			// dd(str_replace(",", "", $this->step2['offered_price']) ?? 0);

			$colsing_cost = ($this->formatCurrency($this->step2['offered_price']) * ($this->step3['estimated_closing_costs']) / 100);
			$step3['down_payment'] = $this->getSetting('currency') . number_format(($this->formatCurrency($this->step2['offered_price'])) - ($this->formatCurrency($this->step3['initial_deposit_amount'])) - ($this->formatCurrency($this->step3['deposit_increase'])) - $loan1 - $loan2 + ($colsing_cost) - ((!empty($this->step2['seller_credit']) ? $this->step2['seller_credit'] : 0) * ($this->formatCurrency($this->step2['offered_price']) / 100)));
			// $step3['down_payment'] =$transaction_offer_price - $initial_deposit_amount -$deposit_increase - $loan1 - $loan2 + ($estimated_closing_costs * $transaction_offer_price /100) - $seller_credit_Amount;
			$this->step3['down_payment'] = $step3['down_payment'];
			$this->step3['down_payment1'] = ($this->formatCurrency($this->step2['offered_price'])) - ($this->formatCurrency($this->step3['initial_deposit_amount'])) - ($this->formatCurrency($this->step3['deposit_increase'])) - $loan1 - $loan2 + ($colsing_cost) - ((!empty($this->step2['seller_credit']) ? $this->step2['seller_credit'] : 0) * ($this->formatCurrency($this->step2['offered_price']) / 100));
		}

		if (($loan1 != "" || $loan2 != "") && ($this->formatCurrency($this->step2['offered_price']) > 0)) {
			$total_loan_amount = $loan1 + $loan2;
			$transaction_offer_price = $this->formatCurrency($this->step2['offered_price']) ? $this->formatCurrency($this->step2['offered_price']) : 0;

			$this->step3['loan_value'] = number_format((($total_loan_amount / $transaction_offer_price) * 100), 2, '.', '') . ' & CLTV';

		}
		// dd($this->step2['offered_price'] );
		$this->loan_interest_rate_1 = $this->step3['loan_interest_1'] == "" ? '-' : $this->step3['loan_interest_1'] . '%';
		$this->loan_interest_rate_2 = $this->step3['loan_interest_2'] == "" ? '-' : $this->step3['loan_interest_2'] . '%';
		$this->loan_amount1 = $this->getSetting('currency') . number_format($loan1);
		$this->loan_amount2 = $this->getSetting('currency') . number_format($loan2);
		$this->direct_lender1 = $this->step3['direct_lender_1'] == "" ? '-' : $this->step3['direct_lender_1'];
		$this->direct_lender2 = $this->step3['direct_lender_2'] == "" ? '-' : $this->step3['direct_lender_2'];
		$this->step5['cash_verification'] = isset($offer->strategy->first_mortgage_loan_amount) || isset($offer->strategy->second_mortgage_loan_amount) ? (($offer->strategy->second_mortgage_loan_amount > 0 || $offer->strategy->first_mortgage_loan_amount > 0) ? 1 : 0) : 0;

		if ($this->realStateAgency == 1 && $this->step1['buyer_representative'] == 'no') {
			$this->step1['brokerage_firm'] = isset($this->step1['brokerage_firm']) ? '' : '';
			$this->step1['brokerage_license'] = isset($this->step1['brokerage_license']) ? '' : '';
			$this->step1['agent_name'] = isset($this->step1['agent_name']) ? '' : '';
			$this->step1['agent_license'] = isset($this->step1['agent_license']) ? '' : '';
			$this->step1['agent_phone'] = isset($this->step1['agent_phone']) ? '' : '';
			$this->step1['agent_comission'] = isset($this->step1['agent_comission']) ? '' : '';
		}

		if ($this->formatCurrency($this->step2['offered_price']) > 0 && ($loan1 > 0 || $loan2 > 0)) {
			$sellerCredit = str_replace(",", "", (!empty($this->step2['seller_credit']) ? $this->step2['seller_credit'] : 0));
			$seller_credit_Amount = ($this->formatCurrency($this->step2['offered_price']) * $sellerCredit) / 100;
			$this->step5['downpayment_verified_amount'] = $this->getSetting('currency') . number_format($this->formatCurrency($this->step2['offered_price']) - $loan1 - $loan2 - $seller_credit_Amount + $this->formatCurrency($this->step3['initial_deposit_amount']));
			$this->step5['cash_verification'] = 1;
			$this->step5['cash_verified_amount'] = 0;
			$this->step5['cash_verified_image'] = [];
			$this->cash_verified_image = [];
		}
		$this->rules_step3['step3.down_payment1'] = 'required|min:0|lte:' . $this->formatCurrency($this->step2['offered_price']);
		$this->step2['offered_price1'] = $this->formatCurrency($this->step2['offered_price']);

		// $this->step8['escrow_closing']
		$this->dispatchBrowserEvent('update-item');
		$this->validateOnly($new);

		if ($new == 'step2.offered_price') {
			$this->validateOnly('step2.offered_price1');
		}

	}
	public function PropertyPurchaseAgreement() {
		$this->Property_Purchase_Agreement = 2;
		$this->is_reviewed = 1;

		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->review();

		$data = $result->getData();
	}
	public function fetch_data($s) {
		if ($s == 1) {
			$this->step = 1;
		} elseif ($s == 2) {
			$this->step = 2;
		} elseif ($s == 3) {
			$this->step = 3;
		} elseif ($s == 4) {
			$this->step = 4;
		} elseif ($s == 5) {
			$this->step = 5;
		} elseif ($s == 6) {
			$this->step = 6;
		} elseif ($s == 7) {
			$this->step = 7;
		} elseif ($s == 8) {
			$this->step = 8;
		} elseif ($s == 9) {
			$this->step = 9;
		} elseif ($s == 10) {
			$this->step = 10;
		}
	}

	public function moveToStep($new) {

		if ($new <= $this->step || $this->step != 10) {
			$this->step = $new;
		}
	}

	public function removeTempImage1($key) {
		unset($this->step5['cash_verified_image'][$key]);
		if (isset($this->rules_step5['step5.cash_verified_image.' . $key])) {
			unset($this->rules_step5['step5.cash_verified_image.' . $key]);
		}

	}
	public function removeTempImage2($key) {
		unset($this->step5['downpayment_verified_image'][$key]);
		if (isset($this->rules_step5['step5.downpayment_verified_image.' . $key])) {
			unset($this->rules_step5['step5.downpayment_verified_image.' . $key]);
		}

	}
	public function removeTempImage3($key) {
		unset($this->step5['loan_application_image'][$key]);
		if (isset($this->rules_step5['step5.loan_application_image.' . $key])) {
			unset($this->rules_step5['step5.loan_application_image.' . $key]);
		}

	}
	public function removeTempImage4($key) {

		unset($this->step5['other_document_image'][$key]);
		if (isset($this->rules_step5['step5.other_document_image.' . $key])) {
			unset($this->rules_step5['step5.other_document_image.' . $key]);
		}

	}
	public function removeImage1($key, $id) {
		$data = Document::whereId($id)->first();
		unset($this->cash_verified_image[$key]);
		unset($this->cash_verified_image_ids[$key]);
		if (file_exists(asset($data->path))) {
			unlink(public_path($data->path));
		}
		// dd($this->cash_verified_image, $this->step5['cash_verified_image']);

		Document::whereId($id)->update(['status' => 'DL']);
	}

	public function removeImage2($key, $id) {

		$data = Document::whereId($id)->first();
		unset($this->downpayment_verified_image[$key]);
		unset($this->downpayment_verified_image_ids[$key]);
		if (file_exists(asset($data->path))) {
			unlink(public_path($data->path));
		}

		Document::whereId($id)->update(['status' => 'DL']);
	}

	public function removeImage3($key, $id) {
		$data = Document::whereId($id)->first();
		unset($this->loan_application_image[$key]);
		unset($this->loan_application_image_ids[$key]);
		if (file_exists(asset($data->path))) {
			unlink(public_path($data->path));
		}

		Document::whereId($id)->update(['status' => 'DL']);
	}

	public function removeImage4($key, $id) {
		$data = Document::whereId($id)->first();
		unset($this->other_document_image[$key]);
		unset($this->other_document_image_ids[$key]);
		if (file_exists(asset($data->path))) {
			unlink(public_path($data->path));
		}

		Document::whereId($id)->update(['status' => 'DL']);
	}

	public function changeStepcontinu($new) {

		if ($new <= $this->step || $this->step != 11) {
			switch ($new - 1) {
			case 1:
				$this->moveToStep($new);
				break;
			case 2:
				$this->moveToStep($new);
				break;
			case 3:
				$this->moveToStep($new);
				break;
			case 4:
				$this->moveToStep($new);
				break;
			case 5:
				$this->moveToStep($new);
				break;
			case 6:
				$this->moveToStep($new);
				break;
			case 7:
				$this->moveToStep($new);
				break;
			case 8:
				$this->moveToStep($new);
				break;
			case 9:
				$this->moveToStep($new);
				break;
			case 10:
				// dd($new);
				return redirect()->route('buyer-dashboard');
				break;
			}

			$this->moveToStep($new);

			$this->dispatchBrowserEvent('update-item');
		}
	}

	public function changeStep(Request $request, $new, $savelater) {
		// dd($request->all());

		$user = auth()->user();
		// dd($user->offer);
		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property = (new BaseController)->formatResourceData($list);
		// dd($property);
		if ($property) {
			if ($user->user_type == 'agent') {
				$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();

				if (!$offer) {
					$offer = null;
				}
			} else {
				if ($user->offer) {
					$offer = $user->offer;
				} else {
					$offer = null;
				}
			}
			$status = true; //can edit

			if (isset($offer->status)) {
				if (in_array($offer->status, ['IN', 'PN', 'DCIN', 'FCIN'])) {
					$status = true;
				} else {
					$status = false; //cannot edit
				}
			}

			if ($new <= $this->step || $this->step != 11) {
				switch ($new - 1) {

				case 1:
					// dd(str_replace(" ","",$this->step1['agent_phone']));
					$request->merge(['type' => 'my_offer',
						'buyer_name' => $this->step1['buyer_name'],
						'entity' => $this->step1['entity'],
						'buyer_representative' => $this->step1['buyer_representative'],
						'brokerage_firm' => $this->step1['brokerage_firm'],
						'brokerage_license' => $this->step1['brokerage_license'],
						'agent_name' => $this->step1['agent_name'],
						'agent_license' => $this->step1['agent_license'],
						'agent_phone' => str_replace("-", "", $this->step1['agent_phone']) == null ? null : str_replace("-", "", $this->step1['agent_phone']),
						'agent_comission' => $this->step1['agent_comission'] == "" ? 0.00 : $this->step1['agent_comission'],
					]);

					$this->validatedData = [
						'step1.brokerage_firm' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.brokerage_license' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.agent_name' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.agent_license' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.agent_phone' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.agent_comission' => Rule::requiredIf($this->step1['buyer_representative'] == 'yes'),
						'step1.buyer_name' => 'required|max:50',
						'step1.entity' => 'required|in:principal,llc,trust,corporation,legal_entity',
						'step1.buyer_representative' => 'required|in:yes,no',
					];

					$this->dispatchBrowserEvent('update-item');
					$this->validate($this->validatedData, [], $this->attr_step1);

					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);
					$data = $result->getData();
					if ($result->getData()->status == 200) {
						$start_date = Carbon::parse($property->possession_rent_back);
						$end_date = Carbon::parse($property->vms_end_date);
						$different_days = $start_date->diffInDays($end_date);
						$data_step2 = [
							'commission' => $offer->buyer_agent_commission_percentage ?? 0,
							'expiry_date' => $property->vms_end_date,
							'occupancy' => $property->occupancy,
							'possession' => $property->possession,
							'possession_rent_back' => $different_days,
							'possession_tenant_rights' => $property->possession_tenant_rights,
							'seller_credit_buyer' => $property->seller_credit_buyer,
							'offered_price' => $this->getSetting('currency') . number_format($offer->transaction->offer_price ?? 0) ?? 0,
							'offered_price1' => $offer->transaction->offer_price ?? 0,
							'seller_credit' => $offer->transaction->seller_credit ?? 0,
							'net_price' => $this->getSetting('currency') . number_format($offer->transaction->net_price ?? 0) ?? 0,
							'final_verification' => $offer->transaction->final_verification ?? 0,
							'assignment_request' => $offer->transaction->assignment_request ?? 0,
							'close_escrow_days' => $offer->transaction->days_of_escrow ?? '',
							'offer_status' => $status,
						];

						$this->step2 = $data_step2;
						// dd($this->step2);
						// dd($this->step2['close_escrow_days']);
						$this->moveToStep($new);
						if ($savelater == 22) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step1, [], $this->attr_step1);
					}
				case 2:
					$this->step2['offered_price1'] = $this->formatCurrency($this->step2['offered_price']);
					// dd($this->rules_step2);
					$this->dispatchBrowserEvent('update-item');
					$this->dispatchBrowserEvent('error-result');
					$this->validate($this->rules_step2, [], $this->attr_step2);

					$request->merge(['type' => 'transaction',
						'offered_price' => $this->formatCurrency($this->step2['offered_price']),
						'seller_credit' => str_replace(",", "", $this->step2['seller_credit']),
						'net_price' => $this->formatCurrency($this->step2['net_price']),
						'close_escrow_days' => $this->step2['close_escrow_days'],
						'final_verification' => $this->step2['final_verification'],
						'assignment_request' => $this->step2['assignment_request']]);

					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);

					$data = $result->getData();

					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
						$loan_amount = $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
						$data_step3 = [
							'seller_financing' => $property->seller_financing,
							'seller_credit_amount' => $offer->transaction->seller_credit_amount ?? '',
							'down_payment' => ($offer->strategy->balance_down_payment) ?? 0,
							'down_payment1' => ($offer->strategy->balance_down_payment) ?? 0,
							'credit_to_buyer' => $property->seller_credit_buyer == 'yes' ? 1 : 0,
							'offered_price' => $offer1->offer_price,
							'estimated_closing_costs' => $offer->strategy->estimated_closing_costs ?? 0,
							'initial_deposit_amount' => $offer->strategy->initial_deposit_amount ?? 0,
							'within_days' => $offer->strategy->within_days ?? '3',
							'deposit_increase' => $offer->strategy->deposit_increase ?? 0,
							'deposit_increase_days' => $offer->strategy->days_to_increase ?? '',
							'loan_amount_1' => $offer->strategy->first_mortgage_loan_amount ?? 0,
							'loan_interest_1' => $offer->strategy->first_loan_interest_rate ?? 0,
							'loan_points_1' => $offer->strategy->first_mortage_loan_points ?? '',
							'direct_lender_1' => $offer->strategy->first_direct_lender_name ?? '',
							'financing_type_1' => $offer->strategy->first_type_of_financing ?? '',
							'additional_terms_1' => $offer->strategy->first_additional_terms ?? '',
							'loan_amount_2' => $offer->strategy->second_mortgage_loan_amount ?? 0,
							'loan_interest_2' => $offer->strategy->second_loan_interest_rate ?? 0,
							'loan_points_2' => $offer->strategy->second_mortage_loan_points ?? '',
							'direct_lender_2' => $offer->strategy->second_direct_lender_name ?? '',
							'financing_type_2' => $offer->strategy->second_type_of_financing ?? '',
							'additional_terms_2' => $offer->strategy->second_additional_terms ?? '',
							// 'loan_value' => ($offer->strategy->combined_loan_value) ?? 0,
							'loan_value' => isset($offer->strategy->combined_loan_value) == false ? 0 : $offer->strategy->combined_loan_value . ' & CLTV',
							'offer_status' => $status,
						];
						$this->step3 = $data_step3;

						$this->moveToStep($new);
						if ($savelater == 23) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step2, [], $this->attr_step2);
					}
				case 3:
					// if ($this->formatCurrency($this->step3['down_payment']) > $this->formatCurrency($this->step2['offered_price'])) {
					$this->rules_step3['step3.down_payment1'] = 'required|min:0|lte:' . $this->formatCurrency($this->step2['offered_price']);
					$this->dispatchBrowserEvent('update-item');
					$this->dispatchBrowserEvent('error-result');
					$this->validate($this->rules_step3, $this->getMessages(), $this->attr_step3);
					// }

					$request->merge(['type' => 'strategy',
						'estimated_closing_costs' => $this->step3['estimated_closing_costs'],
						'initial_deposit_amount' => $this->formatCurrency($this->step3['initial_deposit_amount']),
						'within_days' => $this->step3['within_days'] ?? '3',
						'deposit_increase' => $this->formatCurrency($this->step3['deposit_increase']),
						'deposit_increase_days' => $this->step3['deposit_increase_days'],
						'loan_amount_1' => $this->formatCurrency($this->step3['loan_amount_1']),
						'loan_interest_1' => $this->step3['loan_interest_1'] == "" ? null : $this->step3['loan_interest_1'],
						'loan_points_1' => $this->step3['loan_points_1'] == "" ? null : $this->step3['loan_points_1'],
						'direct_lender_1' => $this->step3['direct_lender_1'],
						'financing_type_1' => $this->step3['financing_type_1'],
						'additional_terms_1' => $this->step3['additional_terms_1'],
						'loan_amount_2' => $this->formatCurrency($this->step3['loan_amount_2']),
						'loan_interest_2' => $this->step3['loan_interest_2'] == "" ? null : $this->step3['loan_interest_2'],
						'loan_points_2' => $this->step3['loan_points_2'] == "" ? null : $this->step3['loan_points_2'],
						'direct_lender_2' => $this->step3['direct_lender_2'],
						'financing_type_2' => $this->step3['financing_type_2'],
						'additional_terms_2' => $this->step3['additional_terms_2'],
						'loan_value' => str_replace("& CLTV", "", $this->step3['loan_value']) ?? '0',
					]);

					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);
					$data = $result->getData();

					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$data_step4 = [
							'loan_contingency' => $offer->contract->loan_contingency ?? '17',
							'appraisal_contingency' => $offer->contract->appraisal_contingency ?? '17',
							'investigation_property' => $offer->contract->investigation_property ?? '17',
							'property_access' => $offer->contract->property_access ?? '17',
							'review_documents' => $offer->contract->review_documents ?? '17',
							'preliminary_report' => $offer->contract->preliminary_report ?? '17',
							'review_of_leased' => $offer->contract->review_of_leased ?? 0,
							'common_interest_disclosures' => $offer->contract->common_interest_disclosures ?? 0,
							'sale_buyer_property' => $offer->contract->sale_buyer_property ?? 0,
							'seller_delivery_document' => $offer->contract->seller_delivery_document ?? '7',
							'provisions_instructions' => $offer->contract->provisions_instructions ?? '5',
							'smoke_alarm' => $offer->contract->smoke_alarm ?? '7',
							'evidence_authority' => $offer->contract->evidence_authority ?? '1',
							'hoa_documents' => $offer->contract->hoa_documents ?? 0,
							'offer_status' => $status,
						];
						$this->step4 = $data_step4;

						$this->moveToStep($new);
						if ($savelater == 24) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step3, [], $this->attr_step3);
					}
				case 4:
					$request->merge(['type' => 'contract_timings',
						'loan_contingency' => $this->step4['loan_contingency'],
						'appraisal_contingency' => $this->step4['appraisal_contingency'],
						'investigation_property' => $this->step4['investigation_property'],
						'property_access' => $this->step4['property_access'],
						'review_documents' => $this->step4['review_documents'],
						'preliminary_report' => $this->step4['preliminary_report'],
						'review_of_leased' => $this->step4['review_of_leased'],
						'common_interest_disclosures' => $this->step4['common_interest_disclosures'],
						'sale_buyer_property' => $this->step4['sale_buyer_property'],
						'seller_delivery_document' => $this->step4['seller_delivery_document'],
						'provisions_instructions' => $this->step4['provisions_instructions'],
						'smoke_alarm' => $this->step4['smoke_alarm'],
						'evidence_authority' => $this->step4['evidence_authority'],
						'hoa_documents' => $this->step4['hoa_documents']]);

					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);

					$this->dispatchBrowserEvent('update-item');
					$data = $result->getData();

					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$data_step5 = [
							'cash_verification' => isset($offer->strategy->first_mortgage_loan_amount) || isset($offer->strategy->second_mortgage_loan_amount) ? (($offer->strategy->second_mortgage_loan_amount > 0 || $offer->strategy->first_mortgage_loan_amount > 0) ? 1 : 0) : 0,
							'cash_verified_amount' => $offer->document->cash_verified_amount ?? '',
							'cash_verified_image' => $offer->document->cashVerifiedFiles ?? [],
							'downpayment_verified_amount' => $offer->strategy->first_mortgage_loan_amount > 0 ? $this->getSetting('currency') . number_format($offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount) : 0,
							'downpayment_verified_image' => $offer->document->downpaymentFiles ?? [],
							'loan_application_status' => $offer->document->loan_application_status ?? '',
							'loan_application_amount' => $offer->strategy->first_mortgage_loan_amount ? $this->getSetting('currency') . $offer->strategy->first_mortgage_loan_amount . ' - ' . $this->getSetting('currency') . $offer->strategy->second_mortgage_loan_amount : '',
							'loan_interest_rate' => $offer->strategy->first_loan_interest_rate ? $offer->strategy->first_loan_interest_rate . '% -' . $offer->strategy->second_loan_interest_rate . '%' : '',
							'direct_lender_name' => isset($offer->strategy->first_direct_lender_name) ? $offer->strategy->first_direct_lender_name . ' - ' . $offer->strategy->second_direct_lender_name : '',
							'loan_application_image' => $offer->document->loanApplicationFiles ?? [],
							'other_documents' => $offer->document->other_documents ?? "",
							'other_document_image' => $offer->document->otherFiles ?? [],
							'offer_status' => $status,
						];
						if ($data_step5['cash_verification'] == 1) {
							// disable cash_verified
							$data_step5['cash_verified_image'] = [];
							$this->cash_verified_image = [];
						} else {
							$data_step5['downpayment_verified_image'] = [];
							$data_step5['loan_application_image'] = [];
							$this->downpayment_verified_image = [];
							$this->loan_application_image = [];
						}

						$this->data_step5 = $data_step5;
						$this->moveToStep($new);
						if ($savelater == 25) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step4, [], $this->attr_step4);
					}

				case 5:
					// dd($this->rules_step5, $this->step5['cash_verified_image']);
					$downpayment_count = count($this->downpayment_verified_image);
					$cash_count = count($this->cash_verified_image);
					$loan_count = count($this->loan_application_image);
					$other_count = count($this->other_document_image);
					if ($this->formatCurrency($this->step3['loan_amount_1']) > 0 || $this->formatCurrency($this->step3['loan_amount_2']) > 0) {
						$this->rules_step5['step5.downpayment_verified_amount'] = 'required';

						if (count($this->step5['downpayment_verified_image']) <= 0 && count($this->downpayment_verified_image) <= 0) {
							$this->rules_step5['step5.downpayment_verified_image'] = 'required|array|max:' . (7 - $downpayment_count);
							$this->rules_step5['step5.downpayment_verified_image.*'] = 'required|mimes:jpeg,jpg,pdf,png|max:10000';
						} else {
							$this->rules_step5['step5.downpayment_verified_image'] = 'nullable|array|max:' . (7 - $downpayment_count);
							$this->rules_step5['step5.downpayment_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
						}
						$this->rules_step5['step5.cash_verified_amount'] = 'nullable';
						$this->rules_step5['step5.cash_verified_image'] = 'nullable|array|max:' . (7 - $cash_count);
						$this->rules_step5['step5.cash_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
						$this->rules_step5['step5.loan_application_status'] = 'required|in:pre_approval,pre_qualification,all_cash';
						if (count($this->step5['loan_application_image']) <= 0 && count($this->loan_application_image) <= 0) {
							$this->rules_step5['step5.loan_application_image'] = 'required|array|max:' . (7 - $loan_count);
							$this->rules_step5['step5.loan_application_image.*'] = 'required|mimes:jpeg,jpg,pdf,png|max:10000';
						} else {
							$this->rules_step5['step5.loan_application_image'] = 'nullable|array|max:' . (7 - $loan_count);
							$this->rules_step5['step5.loan_application_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
						}
					} else {
						$this->rules_step5['step5.downpayment_verified_amount'] = 'required';
						$this->rules_step5['step5.downpayment_verified_image'] = 'nullable|array|max:' . (7 - $downpayment_count);
						$this->rules_step5['step5.downpayment_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
						$this->rules_step5['step5.cash_verified_amount'] = 'required';

						if (count($this->step5['cash_verified_image']) <= 0 && count($this->cash_verified_image) <= 0) {
							$this->rules_step5['step5.cash_verified_image'] = 'required|array|max:' . (7 - $cash_count);
							$this->rules_step5['step5.cash_verified_image.*'] = 'required|mimes:jpeg,jpg,pdf,png|max:10000';
						} else {
							$this->rules_step5['step5.cash_verified_image'] = 'nullable|array|max:' . (7 - $cash_count);
							$this->rules_step5['step5.cash_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
						}

						$this->rules_step5['step5.loan_application_status'] = 'nullable|in:pre_approval,pre_qualification,all_cash';
						$this->rules_step5['step5.loan_application_image'] = 'nullable|array|max:' . (7 - $loan_count);
						$this->rules_step5['step5.loan_application_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
					}

					$this->rules_step5['step5.other_document_image'] = 'nullable|array|max:' . (7 - $other_count);
					$this->rules_step5['step5.other_document_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';

					if ($this->step5['cash_verified_image']) {

						foreach ($this->step5['cash_verified_image'] as $key => $value) {
							$this->rules_step5['step5.cash_verified_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.cash_verified_image.' . $key] = 'cash_verified_image ' . ($key + 1);
						}
					}
					if ($this->step5['downpayment_verified_image']) {

						foreach ($this->step5['downpayment_verified_image'] as $key => $value) {
							$this->rules_step5['step5.downpayment_verified_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.downpayment_verified_image.' . $key] = 'downpayment_verified_image ' . ($key + 1);
						}
					}
					if ($this->step5['loan_application_image']) {
						foreach ($this->step5['loan_application_image'] as $key => $value) {
							$this->rules_step5['step5.loan_application_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.loan_application_image.' . $key] = 'loan_application_image ' . ($key + 1);
						}
					}
					if ($this->step5['other_document_image']) {
						foreach ($this->step5['other_document_image'] as $key => $value) {
							$this->rules_step5['step5.other_document_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.other_document_image.' . $key] = 'other_document_image ' . ($key + 1);
						}
					}

					$this->dispatchBrowserEvent('update-item');
					$this->dispatchBrowserEvent('error-result');
					$this->validate($this->rules_step5, [], $this->attr_step5);

					if (!$offer->document) {
						$document = new DocumentVerification;
					} else {
						$document = $offer->document;

					}
					$document->offer_id = $offer->id;
					$document->cash_verified_amount = $this->formatCurrency($this->step5['cash_verified_amount']);
					$document->downpayment_verified_amount = $offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount;
					$document->loan_application_status = $this->step5['loan_application_status'];
					$document->loan_application_amount = str_replace(",", "", $this->step5['loan_application_amount']) == "" ? 0 : str_replace(",", "", $this->step5['loan_application_amount']);
					$document->loan_interest_rate = $this->step5['loan_interest_rate'];
					$document->direct_lender_name = $this->step5['direct_lender_name'];
					$document->other_documents = $this->step5['other_documents'];
					// dd($document->loan_application_amount);
					$document->save();

					if ($this->step5['cash_verified_image']) {
						/*foreach ($this->step5['cash_verified_image'] as $key => $value) {
							$this->rules_step5['step5.cash_verified_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.cash_verified_image.' . $key] = 'cash_verified_image ' . ($key + 1);
						}*/
						//$files = $this->file('cash_verified_image');

						foreach ($this->step5['cash_verified_image'] as $key => $file) {
							$path = $file->store('uploads/offers/' . $offer->id);
							$path_name = explode("/", $path);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'cash_verified_image';
							// $doc->name = $file;
							$doc->name = $path_name[count($path_name) - 1];
							$document->documents()->save($doc);
						}
						// $document->cash_verified_amount = $path;
						foreach ($this->step5['cash_verified_image'] as $key => $value) {
							unset($this->rules_step5['step5.cash_verified_image.' . $key]);
							unset($this->attr_step5['step5.cash_verified_image.' . $key]);
						}
						$this->step5['cash_verified_image'] = [];
						$this->cash_verified_image = $document->cashVerifiedFiles ?? [];
					}

					if ($this->step5['downpayment_verified_image']) {

						/*foreach ($this->step5['downpayment_verified_image'] as $key => $value) {
							$this->rules_step5['step5.downpayment_verified_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.downpayment_verified_image.' . $key] = 'downpayment_verified_image ' . ($key + 1);
						}*/

						foreach ($this->step5['downpayment_verified_image'] as $key => $file) {
							$path = $file->store('uploads/offers/' . $offer->id);
							$path_name = explode("/", $path);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'downpayment_verified_image';
							// $doc->name = $file;
							$doc->name = $path_name[count($path_name) - 1];
							$document->documents()->save($doc);
						}
						foreach ($this->step5['downpayment_verified_image'] as $key => $value) {
							unset($this->rules_step5['step5.downpayment_verified_image.' . $key]);
							unset($this->attr_step5['step5.downpayment_verified_image.' . $key]);
						}
						$this->step5['downpayment_verified_image'] = [];
						$this->downpayment_verified_image = $document->downpaymentFiles ?? [];
					}

					if ($this->step5['loan_application_image']) {
						/*foreach ($this->step5['loan_application_image'] as $key => $value) {
							$this->rules_step5['step5.loan_application_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.loan_application_image.' . $key] = 'loan_application_image ' . ($key + 1);
						}*/

						foreach ($this->step5['loan_application_image'] as $key => $file) {
							// $path = $file->store('uploads/offers/' . $offer->id . '/' . $file);
							$path = $file->store('uploads/offers/' . $offer->id);
							$path_name = explode("/", $path);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'loan_application_image';
							// $doc->name = $file;
							$doc->name = $path_name[count($path_name) - 1];
							$document->documents()->save($doc);
						}
						foreach ($this->step5['loan_application_image'] as $key => $value) {
							unset($this->rules_step5['step5.loan_application_image.' . $key]);
							unset($this->attr_step5['step5.loan_application_image.' . $key]);
						}
						$this->step5['loan_application_image'] = [];
						$this->loan_application_image = $document->loanApplicationFiles ?? [];
					}

					if ($this->step5['other_document_image']) {
						/*foreach ($this->step5['other_document_image'] as $key => $value) {
							$this->rules_step5['step5.other_document_image.' . $key] = 'required|mimes:pdf,jpeg,png,jpg';
							$this->attr_step5['step5.other_document_image.' . $key] = 'other_document_image ' . ($key + 1);
						}*/
						// dd($this->rules_step5);

						foreach ($this->step5['other_document_image'] as $key => $file) {
							$path = $file->store('uploads/offers/' . $offer->id);
							$path_name = explode("/", $path);
							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'other_document_image';
							// $doc->name = $file;
							$doc->name = $path_name[count($path_name) - 1];
							$document->documents()->save($doc);
						}
						foreach ($this->step5['other_document_image'] as $key => $value) {
							unset($this->rules_step5['step5.other_document_image.' . $key]);
							unset($this->attr_step5['step5.other_document_image.' . $key]);
						}
						$this->step5['other_document_image'] = [];
						$this->other_document_image = $document->otherFiles ?? [];
					}

					if ($this->data_step5['cash_verification'] == 1) {
						// disable cash_verified
						Document::where('documentable_id', $offer->id)->whereType('cash_verified_image')->update(['status' => 'DL']);
						$data_step5['cash_verified_image'] = [];
						$this->cash_verified_image = [];
					} else {
						Document::where('documentable_id', $offer->id)->whereType('downpayment_verified_image')->update(['status' => 'DL']);
						Document::where('documentable_id', $offer->id)->whereType('loan_application_image')->update(['status' => 'DL']);
						$data_step5['downpayment_verified_image'] = [];
						$data_step5['loan_application_image'] = [];
						$this->downpayment_verified_image = [];
						$this->loan_application_image = [];
					}

					// if(isset($offer->include_exclude))
					if ($offer->include_exclude != null) {
						$data_step6 = [
							'items' => json_decode($property->items_include_exclude),
							'additional_items' => $property->additional_items,
							'excluded_items' => $property->excluded_items,
							'stove_oven' => ($offer->include_exclude->stove_oven == "No" ? false : $offer->include_exclude->stove_oven) ?? '',
							'refrigerator' => $offer->include_exclude->refrigerator == "No" ? false : $offer->include_exclude->refrigerator,
							'wine_refrigerator' => $offer->include_exclude->wine_refrigerator == "No" ? false : $offer->include_exclude->wine_refrigerator,
							'washer' => $offer->include_exclude->washer == "No" ? false : $offer->include_exclude->washer,
							'dryer' => $offer->include_exclude->dryer == "No" ? false : $offer->include_exclude->dryer,
							'dishwasher' => $offer->include_exclude->dishwasher == "No" ? false : $offer->include_exclude->dishwasher,
							'microwave' => $offer->include_exclude->microwave == "No" ? false : $offer->include_exclude->microwave,
							'video_doorbell' => $offer->include_exclude->video_doorbell == "No" ? false : $offer->include_exclude->video_doorbell,
							'security_camera' => $offer->include_exclude->security_camera == "No" ? false : $offer->include_exclude->security_camera,
							'security_system' => $offer->include_exclude->security_system == "No" ? false : $offer->include_exclude->security_system,
							'control_devices' => $offer->include_exclude->control_devices == "No" ? false : $offer->include_exclude->control_devices,
							'audio_equipment' => $offer->include_exclude->audio_equipment == "No" ? false : $offer->include_exclude->audio_equipment,
							'ground_pool' => $offer->include_exclude->ground_pool == "No" ? false : $offer->include_exclude->ground_pool,
							'bathroom_mrrors' => $offer->include_exclude->bathroom_mrrors == "No" ? false : $offer->include_exclude->bathroom_mrrors,
							'car_charging_system' => $offer->include_exclude->car_charging_system == "No" ? false : $offer->include_exclude->car_charging_system,
							'potted_trees' => $offer->include_exclude->potted_trees == "No" ? false : $offer->include_exclude->potted_trees,
							'additional_items' => $offer->include_exclude->additional_items ?? '',
							'excluded_items' => $offer->include_exclude->excluded_items ?? '',
							'offer_status' => $status,
						];
					} else {
						$data_step6 = [
							'items' => json_decode($property->items_include_exclude),
							'additional_items' => $property->additional_items,
							'excluded_items' => $property->excluded_items,
							'stove_oven' => $offer->include_exclude->stove_oven ?? '',
							'refrigerator' => $offer->include_exclude->refrigerator ?? '',
							'wine_refrigerator' => $offer->include_exclude->wine_refrigerator ?? '',
							'washer' => $offer->include_exclude->washer ?? '',
							'dryer' => $offer->include_exclude->dryer ?? '',
							'dishwasher' => $offer->include_exclude->dishwasher ?? '',
							'microwave' => $offer->include_exclude->microwave ?? '',
							'video_doorbell' => $offer->include_exclude->video_doorbell ?? '',
							'security_camera' => $offer->include_exclude->security_camera ?? '',
							'security_system' => $offer->include_exclude->security_system ?? '',
							'control_devices' => $offer->include_exclude->control_devices ?? '',
							'audio_equipment' => $offer->include_exclude->audio_equipment ?? '',
							'ground_pool' => $offer->include_exclude->ground_pool ?? '',
							'bathroom_mrrors' => $offer->include_exclude->bathroom_mrrors ?? '',
							'car_charging_system' => $offer->include_exclude->car_charging_system ?? '',
							'potted_trees' => $offer->include_exclude->potted_trees ?? '',
							'additional_items' => $offer->include_exclude->additional_items ?? '',
							'excluded_items' => $offer->include_exclude->excluded_items ?? '',
							'offer_status' => $status,
						];
					}

					$this->step6 = $data_step6;
					// dd($this->step6);
					$this->moveToStep($new);
					if ($savelater == 26) {
						return redirect()->route('buyer-dashboard');
					}
					$user->last_activity = now();
					$user->save();
					$this->dispatchBrowserEvent('update-item');
					break;

				case 6:

					$this->dispatchBrowserEvent('update-item');
					$request->merge(['type' => 'items_include_exclude',
						'stove_oven' => $this->step6['items']['stove_oven'] == 'N/A' ? 'N/A' : ((!isset($this->step6['stove_oven']) || (isset($this->step6['stove_oven']) && $this->step6['stove_oven'] == false)) ? 'No' : $this->step6['stove_oven']),
						'refrigerator' => $this->step6['items']['refrigerator'] == 'N/A' ? 'N/A' : ((!isset($this->step6['refrigerator']) || (isset($this->step6['refrigerator']) && $this->step6['refrigerator'] == false)) ? 'No' : $this->step6['refrigerator']),
						'wine_refrigerator' => $this->step6['items']['wine_refrigerator'] == 'N/A' ? 'N/A' : ((!isset($this->step6['wine_refrigerator']) || (isset($this->step6['wine_refrigerator']) && $this->step6['wine_refrigerator'] == false)) ? 'No' : $this->step6['wine_refrigerator']),
						'washer' => $this->step6['items']['washer'] == 'N/A' ? 'N/A' : ((!isset($this->step6['washer']) || (isset($this->step6['washer']) && $this->step6['washer'] == false)) ? 'No' : $this->step6['washer']),
						'dryer' => $this->step6['items']['dryer'] == 'N/A' ? 'N/A' : ((!isset($this->step6['dryer']) || (isset($this->step6['dryer']) && $this->step6['dryer'] == false)) ? 'No' : $this->step6['dryer']),
						'dishwasher' => $this->step6['items']['dishwasher'] == 'N/A' ? 'N/A' : ((!isset($this->step6['dishwasher']) || (isset($this->step6['dishwasher']) && $this->step6['dishwasher'] == false)) ? 'No' : $this->step6['dishwasher']),
						'microwave' => $this->step6['items']['microwave'] == 'N/A' ? 'N/A' : ((!isset($this->step6['microwave']) || (isset($this->step6['microwave']) && $this->step6['microwave'] == false)) ? 'No' : $this->step6['microwave']),
						'video_doorbell' => $this->step6['items']['video_doorbell'] == 'N/A' ? 'N/A' : ((!isset($this->step6['video_doorbell']) || (isset($this->step6['video_doorbell']) && $this->step6['video_doorbell'] == false)) ? 'No' : $this->step6['video_doorbell']),
						'security_camera' => $this->step6['items']['security_camera'] == 'N/A' ? 'N/A' : ((!isset($this->step6['security_camera']) || (isset($this->step6['security_camera']) && $this->step6['security_camera'] == false)) ? 'No' : $this->step6['security_camera']),
						'security_system' => $this->step6['items']['security_system'] == 'N/A' ? 'N/A' : ((!isset($this->step6['security_system']) || (isset($this->step6['security_system']) && $this->step6['security_system'] == false)) ? 'No' : $this->step6['security_system']),
						'control_devices' => $this->step6['items']['control_devices'] == 'N/A' ? 'N/A' : ((!isset($this->step6['control_devices']) || (isset($this->step6['control_devices']) && $this->step6['control_devices'] == false)) ? 'No' : $this->step6['control_devices']),
						'audio_equipment' => $this->step6['items']['audio_equipment'] == 'N/A' ? 'N/A' : ((!isset($this->step6['audio_equipment']) || (isset($this->step6['audio_equipment']) && $this->step6['audio_equipment'] == false)) ? 'No' : $this->step6['audio_equipment']),
						'ground_pool' => $this->step6['items']['ground_pool'] == 'N/A' ? 'N/A' : ((!isset($this->step6['ground_pool']) || (isset($this->step6['ground_pool']) && $this->step6['ground_pool'] == false)) ? 'No' : $this->step6['ground_pool']),
						'bathroom_mrrors' => $this->step6['items']['bathroom_mrrors'] == 'N/A' ? 'N/A' : ((!isset($this->step6['bathroom_mrrors']) || (isset($this->step6['bathroom_mrrors']) && $this->step6['bathroom_mrrors'] == false)) ? 'No' : $this->step6['bathroom_mrrors']),
						'car_charging_system' => $this->step6['items']['car_charging_system'] == 'N/A' ? 'N/A' : ((!isset($this->step6['car_charging_system']) || (isset($this->step6['car_charging_system']) && $this->step6['car_charging_system'] == false)) ? 'No' : $this->step6['car_charging_system']),

						// 'potted_trees' => $this->step6['items']['potted_trees'] == 'N/A' ? 'N/A' :  ($this->step6['potted_trees'] ),
						'potted_trees' => $this->step6['items']['potted_trees'] == 'N/A' ? 'N/A' : ((!isset($this->step6['potted_trees']) || (isset($this->step6['potted_trees']) && $this->step6['potted_trees'] == false)) ? 'No' : $this->step6['potted_trees']),
						'additional_items' => $this->step6['additional_items'] ?? '',
						'excluded_items' => $this->step6['excluded_items'] ?? '']);
					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);

					$data = $result->getData();
					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$data_step7 = [
							'property_type' => $property->property_type,
							'disclosure_hoa_fee' => $property->disclosure_hoa_fee ?? '',
							'hoa_certification_fee' => $property->hoa_certification_fee ?? '',
							'hoa_transfer_fee' => $property->hoa_transfer_fee ?? '',
							'private_transfer_fee' => $property->private_transfer_fee ?? '',
							'other_fee' => $property->other_fee ?? '',
							'natural_hazard_zone' => $offer->cost_allocation->natural_hazard_zone ?? '',
							'environmental' => $offer->cost_allocation->environmental ?? '',
							'provided_by' => $offer->cost_allocation->provided_by ?? '',
							'other' => $offer->cost_allocation->other ?? '',
							'report_name' => $offer->cost_allocation->report_name ?? '',
							'paid_by' => $offer->cost_allocation->paid_by ?? '',
							'smoke_alarms' => $offer->cost_allocation->smoke_alarms ?? '',
							'gov_reports' => $offer->cost_allocation->gov_reports ?? '',
							'gov_required_point' => $offer->cost_allocation->gov_required_point ?? '',
							'escrow_fees' => $offer->cost_allocation->escrow_fees ?? '',
							'escrow_holder' => $property->escrow_holder ?? $offer->cost_allocation->escrow_holder,
							'insurance_policy' => $offer->cost_allocation->insurance_policy ?? '',
							'title_company' => $offer->cost_allocation->title_company ?? '',
							'buyer_lender_policy' => $offer->cost_allocation->buyer_lender_policy ?? '',
							'country_transfer_tax' => $offer->cost_allocation->country_transfer_tax ?? '',
							'city_transfer_tax' => $offer->cost_allocation->city_transfer_tax ?? '',
							'warranty_plan' => $offer->cost_allocation->warranty_plan ?? '',
							'issued_by' => $offer->cost_allocation->issued_by ?? '',
							'cost_not_exceed' => $offer->cost_allocation->cost_not_exceed ?? '',
							'other_terms' => $offer->cost_allocation->other_terms ?? '',
							'offer_status' => $status,
						];
						$this->step7 = $data_step7;
						$this->moveToStep($new);
						if ($savelater == 27) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step6, [], $this->attr_step6);
					}

				case 7:

					$request->merge(['type' => 'allocation_cost',
						'natural_hazard_zone' => $this->step7['natural_hazard_zone'],
						'environmental' => $this->step7['environmental'],
						'provided_by' => $this->step7['provided_by'],
						'other' => $this->step7['other'],
						'report_name' => $this->step7['report_name'],
						'paid_by' => $this->step7['paid_by'],
						'smoke_alarms' => $this->step7['smoke_alarms'],
						'gov_reports' => $this->step7['gov_reports'],
						'gov_required_point' => $this->step7['gov_required_point'],
						'escrow_fees' => $this->step7['escrow_fees'],
						'escrow_holder' => $this->step7['escrow_holder'],
						'insurance_policy' => $this->step7['insurance_policy'],
						'title_company' => $this->step7['title_company'],
						'buyer_lender_policy' => $this->step7['buyer_lender_policy'],
						'country_transfer_tax' => $this->step7['country_transfer_tax'],
						'city_transfer_tax' => $this->step7['city_transfer_tax'],
						'warranty_plan' => $this->step7['warranty_plan'],
						'issued_by' => $this->step7['issued_by'],
						'cost_not_exceed' => $this->formatCurrency($this->step7['cost_not_exceed']),
						//'other_fee_cost' => $this->step7['other_fee_cost'],
						'other_terms' => $this->step7['other_terms']]);

					$this->dispatchBrowserEvent('update-item');
					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);
					$data = $result->getData();
					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$data_step8 = [
							'offered_price' => $offer->transaction->offer_price,
							'closing_cost' => ($offer->transaction->offer_price * $offer->strategy->estimated_closing_costs / 100),
							'seller_credit' => $offer->transaction->seller_credit_amount,
							'closed_funds' => $offer->document->downpayment_verified_amount,
							'mortgage_loan_1' => $offer->strategy->first_mortgage_loan_amount,
							'mortgage_loan_2' => $offer->strategy->second_mortgage_loan_amount,
							'initial_deposit' => $offer->strategy->initial_deposit_amount,
							'deposit_increase' => $offer->strategy->deposit_increase,
							'closing_balance' => $offer->strategy->balance_down_payment,
							'escrow_closing' => Carbon::parse($user->property->end_date)->addDay($offer->transaction->days_of_escrow + 1)->format('Y-m-d'),
							'offer_status' => $status,
							'approve' => $offer->approve,
							'buyer_advisory' => $offer->buyer_advisory,
							'talk_with_realtor' => $offer->talk_with_realtor,
							'submit_without_assistance' => $offer->submit_without_assistance,
						];

						$this->step8 = $data_step8;
						$this->moveToStep($new);
						if ($savelater == 28) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {
						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step7, [], $this->attr_step7);
					}

				case 8:
					// dd($this->step8);
					$this->dispatchBrowserEvent('update-item');
					$this->dispatchBrowserEvent('error-result');
					// dd($this->step8);
					// $this->step8['talk_with_realtor'] = $this->step8['talk_with_realtor'] == null ? 'decline' : $this->step8['talk_with_realtor'];

					$this->validate($this->rules_step8, $this->getMessages(), $this->attr_step8);

					$request->merge(['type' => 'summary',
						'approve' => $this->step8['approve'],
						'buyer_advisory' => $this->step8['buyer_advisory'],
						'talk_with_realtor' => $this->step8['talk_with_realtor'],
						'submit_without_assistance' => $this->step8['submit_without_assistance'],
						// 'verify_human' => $this->step8['verify_human'],
					]);

					$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitOffer($request);

					$data = $result->getData();
					$this->new_offer = $data->data;
					if ($result->getData()->status == 200) {
						$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
						$loan_amount = $offer1->first_mortgage_loan_amount == null ? 0 : $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
						$intrest_rate = $offer->strategy->first_loan_interest_rate + $offer->strategy->second_loan_interest_rate;
						$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
						$bid = $offer_details->getData()->data;
						$data_step9 = [
							'current_offer' => number_format($offer->transaction->offer_price),
							'qualify_value' => ($bid->qualify_for),
							'loan_amount_1' => $this->getSetting('currency') . number_format($offer->strategy->first_mortgage_loan_amount) ?? 0,
							'loan_interest_1' => $offer->strategy->first_loan_interest_rate ?? 0,
							'direct_lender_1' => $offer->strategy->first_direct_lender_name ?? '',
							'loan_amount_2' => $this->getSetting('currency') . number_format($offer->strategy->second_mortgage_loan_amount) ?? 0,
							'loan_interest_2' => $offer->strategy->second_loan_interest_rate ?? 0,
							'direct_lender_2' => $offer->strategy->second_direct_lender_name ?? '',
							'tnc' => $offer->financial->tnc ?? 0,
							'file' => $offer->financial->file ?? '',
							'proof_funds' => number_format($bid->proof_funds),
						];
						$this->step9 = $data_step9;
						$this->moveToStep($new);
						if ($savelater == 29) {
							return redirect()->route('buyer-dashboard');
						}
						$user->last_activity = now();
						$user->save();
						$this->dispatchBrowserEvent('update-item');
						break;
					} else {

						$this->dispatchBrowserEvent('error-result');
						$this->validate($this->rules_step8, $this->getMessages(), $this->attr_step8);
					}
					$this->dispatchBrowserEvent('update-item');
					$this->moveToStep($new);
					break;

				case 9:

					$this->dispatchBrowserEvent('update-item');
					$this->rules_step9['step9.file'] = 'required|mimes:pdf,docx|max:10000';
					if (gettype($this->step9['file']) != 'string') {
						$this->rules_step9['step9.file'] = 'required|mimes:pdf,docx|max:10000';
						$this->rules_step9['step9.qualify_value'] = 'gte:' . $this->formatCurrency($this->step2['offered_price']);
						$this->dispatchBrowserEvent('error-result');
					} else {
						if (empty($this->step9['file'])) {
							$this->rules_step9['step9.file'] = 'required|mimes:pdf,docx|max:10000';
						} else {
							$this->rules_step9['step9.file'] = 'nullable';
						}

						$this->rules_step9['step9.qualify_value'] = 'gte:' . $this->formatCurrency($this->step2['offered_price']);
						$this->dispatchBrowserEvent('error-result');
					}
					// dd(gettype($this->step9['file']), $this->step9['file'], $this->rules_step9);
					$this->validate($this->rules_step9, $this->getMessages(), $this->attr_step9);

					$user->offer->financials()->update(['status' => 'IN']);
					$financial = new FinancialCredential;
					$financial->loan_amount = 0;
					$financial->offer_id = $user->offer->id;

					// if ($this->step9['file']) {
					// 	$path = $this->step9['file']->store('uploads/offers/' . $offer->id);
					// 	$financial->file = $path;
					// }
					if (gettype($this->step9['file']) != 'string') {
						$path = $this->step9['file']->store('uploads/offers/' . $offer->id);

					} else {
						$path = $this->step9['file'];
					}
					$financial->file = $path;

					$financial->tnc = $this->step9['tnc'] == 'yes' ? 1 : $this->step9['tnc'];
					$financial->save();

					$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);
					$bid = $offer_details->getData()->data;
					$data_step10 = [
						'current_bid' => number_format($offer->transaction->offer_price),
						'financial_qulification' => number_format($bid->qualify_for),
						'bid_per_sqfeet' => sprintf('%0.2f', $offer->transaction->offer_price / $property->square_foot_rate) ?? '',
						'est_morgage' => $bid->est_mortgage,
						'file' => $offer->signature ?? '',
					];
					$this->step10 = $data_step10;

					$this->moveToStep($new);
					if ($savelater == 30) {
						return redirect()->route('buyer-dashboard');
					}
					$user->last_activity = now();
					$user->save();
					$this->dispatchBrowserEvent('update-item');
					break;

				case 10:
					return redirect()->route('connect.docusign');

					/*if (gettype($this->step10['file']) != 'string' || $this->step10['file'] == "") {
							$this->rules_step10['step10.file'] = 'required|mimes:jpeg,jpg,png|max:10000';
							$this->dispatchBrowserEvent('error-result');
							$this->validate($this->rules_step10, [], $this->attr_step10);
						} else {
							// $this->rules_step10['step10.file'] = 'nullable|mimes:jpeg,jpg,png|max:10000';
							$this->rules_step10['step10.file'] = 'nullable';
							$this->dispatchBrowserEvent('error-result');
							$this->validate($this->rules_step10, [], $this->attr_step10);
						}

						$user = auth()->user();
						$res = (new BaseController)->checkUserActive($user);
						if ($user->offer) {
							if (gettype($this->step10['file']) != 'string') {
								$path = $this->step10['file']->store('uploads/offers/' . $offer->id);
							} else {
								$path = $this->step10['file'];
							}
							$user->offer->signature = $path;
							$user->offer->status = 'PN';
							$user->offer->save();
							session()->flash('message', $this->getMessage(212));
							return redirect()->route('buyer-dashboard');
						} else {
							return $this->sendError($this->getMessage(404));
						}
					*/
					break;

					/*$this->step = $num;
						$tab = 'my_offer';

						switch ($this->step) {
						case 1:$tab = 'my_offer';
						    break;
						case 2:$tab = 'transaction';
						    break;
						case 3:$tab = 'strategy';
						    break;
						case 4:$tab = 'contract_timings';
						    break;
						case 5:$tab = 'doc_verification';
						    break;
						case 6:$tab = 'items_include_exclude';
						    break;
						case 7:$tab = 'allocation_cost';
						    break;
						case 8:$tab = 'summary';
						    break;
						}

						$this->openTab($tab, $this->step - 1);
					*/

				}
			}

		}

	}

}
