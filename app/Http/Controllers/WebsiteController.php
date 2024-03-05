<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Agent;
use App\Models\Buyer as User;
use App\Models\BuyerService;
use App\Models\Cms;
use App\Models\CounterOffer;
use App\Models\Faq;
use App\Models\FaqCategory;
use App\Models\Offers;
use App\Models\Property;
use App\Models\Resource;
use App\Models\SellerService;
use App\Models\Survey;
use App\Models\UserDevice;
use App\Traits\Helper;
use Auth;
use Carbon\Carbon;
use DB;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Laravel\Socialite\Facades\Socialite;
use PDF;
use Session;

class WebsiteController extends Controller {
	
	public $control_mode = 0;

	public function __construct() {
		$this->middleware(function ($request, $next) {

			if (Auth::check()) {
				$user = User::find(Auth::id());
				if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer') || (($user->optin_out == 'OPTOUT') && $user->user_type == 'seller')) {
					$this->control_mode = 0;
				} else {
					$this->control_mode = 1;
				}
			}

			View::share('user_control', $this->control_mode);

			return $next($request);
		});
	}

	public function index(Request $request) {

		$page = Cms::whereSlug('homepage')->first();
		$Faq_category = FaqCategory::all();
		$faq = Faq::where('status', '=', 'AC')->get();
		// dd($faq);
		return view('web.index', compact('page', 'faq', 'Faq_category'));
	}

	public function faq(Request $request) {

		$value = $_COOKIE["faq"];
		$faq = Faq::where('status', '=', 'AC')->get();

		return view('web.faq', compact('faq', 'value'));
	}

	public function seller(Request $request) {

		$page = Cms::whereSlug('seller ')->first();
		$services = SellerService::all();

		return view('web.seller', compact('page', 'services'));
	}

	public function buyer(Request $request) {

		$page = Cms::whereSlug('buyer ')->first();
		$buyer_service = BuyerService::all();

		return view('web.buyer', compact('page', 'buyer_service'));

	}

	public function contactus(Request $request) {
		$page = Cms::whereSlug('contact-us ')->first();

		return view('web.contactus', compact('page'));
	}
	public function resources() {
		$page = Cms::whereSlug('resources')->first();
		$resource = Resource::all();
		$user = Auth::guard('accounts')->user();
		return view('web.resources', compact('page', 'resource', 'user'));
	}

	public function createAccount() {

		if (Auth::guard('accounts')->check()) {
			if (Auth::check()) {
				if (Auth::user()->user_type == 'seller-agent') {
					$link = route('seller-dashboard');
				} elseif (Auth::user()->user_type == 'buyer-agent') {
					$link = route('buyer-dashboard');
				} elseif (Auth::user()->user_type == 'buyer') {
					$link = route('buyer-dashboard');
				} elseif (Auth::user()->user_type == 'seller') {
					$link = route('seller-dashboard');
				} elseif (Auth::user()->user_type == 'agent') {
					$link = route('buyer-dashboard');
				}

				return redirect($link);
			} else {
				return redirect()->route('weblogin');
			}
		} else {
			return view('web.create-account');
		}

	}

	public function login() {

		return view('web.login');
	}

	public function forgotPassword() {

		return view('web.forgot-password');
	}

	public function redirectToGoogle() {
		return Socialite::driver('google')->redirect();
	}

	public function handleGoogleCallback() {
		try {

			$user = Socialite::driver('google')->user();
			// dd($user);

			$finduser = Account::where('google_authid', $user->id)->first();

			if ($finduser) {
				$finduser->status = 'AC';
				$finduser->save();

				$data = Auth::guard('accounts')->login($finduser);

				return redirect()->route('weblogin');

			} else {
				$newUser = Account::updateOrCreate(['email' => $user->email], [
					'google_authid' => $user->id,
					'google_signin' => 1,
					'status' => 'AC',
				]);

				Auth::guard('accounts')->login($newUser);

				return redirect()->route('weblogin');
			}

		} catch (Exception $e) {
			session()->flash('error', 'Something Went Wrong. Please contact ' . env('APP_NAME') . ' team if this issue persists.');
			return redirect()->route('weblogin');
		}
	}

	public function redirectToFacebook() {

		return Socialite::driver('facebook')->redirect();
	}

	public function handleFacebookCallback() {

		try {

			$user = Socialite::driver('facebook')->user();
			$finduser = Account::where('facebook_authid', $user->id)->first();

			if ($finduser) {

				Auth::guard('accounts')->login($finduser);
				$finduser->status = 'AC';
				$finduser->save();
				return redirect()->route('weblogin');
			} else {
				if ($user->email == null) {

					$newUser = Account::updateOrCreate(['facebook_authid' => $user->id], [
						'facebook_signin' => 1,
						'status' => 'AC',
					]);

					Auth::guard('accounts')->login($newUser);
					return redirect()->route('email-confirmation');

				} else {

					$newUser = Account::updateOrCreate(['email' => $user->email], [
						'facebook_authid' => $user->id,
						'facebook_signin' => 1,
						'status' => 'AC',
					]);

					Auth::guard('accounts')->login($newUser);
					return redirect()->route('weblogin');
				}

			}

		} catch (Exception $e) {
			session()->flash('error', 'Something Went Wrong. Please contact ' . env('APP_NAME') . ' team if this issue persists.');
			return redirect()->route('weblogin');
		}

	}

	public function appleLogin() {

		return Socialite::driver("sign-in-with-apple")
			->scopes(["name", "email"])
			->redirect();

	}

	public function appleCallback() {

		try {
			$user = Socialite::driver("sign-in-with-apple")->user();

			$finduser = Account::where('apple_authid', $user->id)->first();
			if ($finduser) {

				Auth::guard('accounts')->login($finduser);
				$finduser->status = 'AC';
				$finduser->save();
				return redirect()->route('weblogin');
			} else {
				if ($user->email == null) {

					$newUser = Account::updateOrCreate(['apple_authid' => $user->id], [
						// 'apple_authid' => $user->id,
						'apple_signin' => 1,
						'status' => 'AC',
					]);
					Auth::guard('accounts')->login($newUser);

					return redirect()->route('email-confirmation');

				} else {

					$newUser = Account::updateOrCreate(['email' => $user->email], [
						'apple_authid' => $user->id,
						'apple_signin' => 1,
						'status' => 'AC',
					]);
					Auth::guard('accounts')->login($newUser);

					return redirect()->route('weblogin');

				}

			}
		} catch (Exception $e) {

			session()->flash('error', 'Something Went Wrong. Please contact ' . env('APP_NAME') . ' team if this issue persists.');
			return redirect()->route('weblogin');
		}

	}

	public function emailConfirmation() {

		return view('web.email-confirmation');
	}

	public function privacyPolicy() {

		$page = Cms::whereSlug('privacy-policy')->first();

		return view('page', compact('page'));
	}

	public function buyerAdvisory() {

		$page = Cms::whereSlug('buyer-advisory')->first();

		return view('page', compact('page'));
	}

	public function userAgreement() {

		$page = Cms::whereSlug('user-agreement')->first();

		return view('page', compact('page'));
	}

	public function agreement() {

		$page = Cms::whereSlug('user-agreement')->first();
		$url = '';
		$type = Session::get('user_type');
		$role = Session::get('role');

		if ($type == 'seller-agent') {
			$url = route('seller-dashboard');
		} elseif ($type == 'buyer-agent') {
			$url = route('buyer-dashboard');
		} elseif ($type == 'buyer') {
			$url = route('buyer-dashboard');
		} elseif ($type == 'seller') {
			$url = route('seller-dashboard');
		} elseif ($role == 'agent') {
			$url = route('buyer-dashboard');
		}

		return view('web.user-agreement', compact('page', 'url'));
	}

	public function page(Request $request) {
		$page = Cms::whereSlug($request->segment(1))->first();
		return view('page', compact('page'));
	}

	public function property_index() {

		return view('web.add-property');
	}

	public function offer() {
		return view('web.buyer_offer');
	}

	public function seller_dashboard(Request $request) {

		$result = app('App\Http\Controllers\Api\Seller\ApiController')->dashboard($request);
		$data = $result->getData();
		// dd($data);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->viewProperty($request);
		$data2 = $result->getData()->data;
		$property = Auth::user()->property;

		return view('web.seller-dashboard', compact('data', 'property', 'data2'));
	}

	public function buyer_dashboard(Request $request) {
		$user = User::find(Auth::id());
		// dd($user->mobile_verified_at);
		$control_mode = 0;
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$control_mode = 0;
		} else {
			$control_mode = 1;
		}

		$res = (new BaseController)->checkUserActive($user);

		if (gettype($res) != 'boolean') {

			session()->flash('error', $res->getData()->message);
			return redirect()->route('weblogout');
			// return $res;
		}
		if ($request->get('action') != null && $request->get('action') == 'survey') {
			return redirect()->route('weblogout');
		}
		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		if ($user->offer == null) {
			return redirect()->route('offer');
		}
		$data = Offers::find($user->offer->id);
		// dd($data);
		$offer = DB::select("CALL GetOfferDetail('" . $user->offer->id . "')")[0];
		// dd($offer);
		$offer->highest_bid = $data->highest_bid;
		$offer_details = app('App\Http\Controllers\Api\Buyer\ApiController')->offerDetails($request);

		$dashboard = $offer_details->getData()->data;
		// dd($data->financial);
		// dd($dashboard->submitted_on);
		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property = (new BaseController)->formatResourceData($list);
		$counter_to_counter = CounterOffer::where(['user_id' => $user->id, 'offer_id' => $user->offer->id])->first();
		$survey = Survey::where(['user_id' => $user->id, 'status' => 'AC'])->first();
		$sesstion = $request->session()->get('my_name');
		return view('web.buyer-dashboard', compact('property', 'user', 'dashboard', 'offer', 'counter_to_counter', 'survey', 'data'));
	}

	public function bid_modification() {
		return view('web.bid-modification');
	}

	public function buyerAgentMode() {

		return view('web.control-monitor');
	}

	public function offerOfInterest() {

		return view('web.offer-of-interest');
	}

	public function buyerIncompleteOffer() {
		return view('web.buyer-incomplete-offer');
	}

	public function buyerOfferCancellation() {
		return view('web.buyer-offer-cancellation');
	}

	public function buyerViewSellersCounter() {

		return view('web.buyer-view-sellers-counter');
	}

	public function CounterToCounter() {

		return view('web.counter-to-counter');
	}

	public function higherOfferReceived(Request $request) {
		$q = $request->q;
		return view('web.higher-offer-received', compact('q'));
	}

	public function offerNotAccepted() {

		return view('web.offer-not-accepted');
	}

	public function offerDeadlineExtension() {

		return view('web.offer-deadline-extension');
	}

	public function updateCredentials() {
		return view('web.update-credentials');
	}
	public function survey() {

		return view('web.survey');
	}
	public function congratulations() {
		return view('web.buyer-congratulations');
	}
	public function bidFinalBest() {
		return view('web.bid-final-best');
	}
	public function view_offer(Request $request, $id) {

		$user = auth()->user();
		$loguser = User::find($user->id);
		if (User::where('agent_id', $loguser->id)->whereUserType('seller')->exists()) {
			$loguser->user_type = 'seller-agent';
		} else {
			$loguser->user_type = 'seller';
		}

		$control_mode = 0;
		if ($loguser->optin_out == 'OPTIN' && $loguser->user_type == 'seller-agent' || $loguser->optin_out == 'OPTOUT' && $loguser->user_type == 'seller') {
			$control_mode = 0;
		} else {
			$control_mode = 1;
		}

		$request->merge(['id' => $id]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->viewOffer($request);
		$data = $result->getData();
		$type = 'single-offer';

		return view('web.seller-offers', compact('data', 'id', 'loguser', 'control_mode', 'type'));
	}

	public function userDeviceKey() {
		$user = auth()->user();
		$id = auth()->user()->id;
		$device_token = UserDevice::where('user_id', '=', $id)->where('device_type', '=', 'pc/laptop')->value('device_token');
		return response()->json($device_token);
	}

	public function notifyOfferInterest(Request $request, $id) {
		$request->merge(['offer_id' => $id]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->notifyOfferInterest($request);
		$data = $result->getData();

		if ($data->status == 200) {
			return redirect()->route('seller-dashboard');
		}

	}

	public function updateOfferStatus(Request $request, $status, $id) {
		$request->merge(['status' => $status,
			'offer_id' => $id]);
		$result = app('App\Http\Controllers\Api\Seller\ApiController')->updateOfferStatus($request);
		$data = $result->getData();
		return redirect()->back();
	}

	public function download_pdf(Request $request) {

		$user = auth()->user();
		$list = Property::where('vms_property_id', $user->property_id)->first();

		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}

		$property = (new BaseController)->formatResourceData($list);
		$this->property_rate = $property->reserved_price;
		if ($property) {
			if ($user->offer) {
				$offer = $user->offer;
			} else {
				$offer = null;
			}
			if (!empty($offer->buyer_agent_commission_percentage)) {
				$agent_comission_val = $property->reserved_price / $offer->buyer_agent_commission_percentage * 100;
			}

			if (!empty($offer->signature) && $offer->signature == 'signed') {
				return asset('uploads/offers/agreements/Purchase-Agreement-' . $property->vms_property_id . '-' . $offer->id . '.pdf');
			}

			$data_step1 = [
				'signature' => $offer->signature,
				'address' => $property->property_address,
				'submission_date' => Carbon::today(),
				'due_date' => Carbon::today(),
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
				'agent_comission_per' => $offer->buyer_agent_commission_percentage ?? '',
				'agent_comission_val' => $agent_comission_val ?? '',
			];
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
				'offered_price' => $offer->transaction->offer_price ?? 0,
				'seller_credit' => $offer->transaction->seller_credit ?? 0,
				'net_price' => $offer->transaction->net_price ?? 0,
				'final_verification' => $offer->transaction->final_verification ?? 0,
				'assignment_request' => $offer->transaction->assignment_request ?? 0,
				'close_escrow_days' => $offer->transaction->days_of_escrow ?? 0,
			];
			$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
			$loan_amount = $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
			$data_step3 = [
				'seller_financing' => $property->seller_financing,
				'seller_credit_amount' => $offer->transaction->seller_credit_amount ?? 0,
				'down_payment' => $offer->strategy->balance_down_payment ?? 0,
				'credit_to_buyer' => $property->seller_credit_buyer == 'yes' ? 1 : 0,
				'offered_price' => $offer1->offer_price,
				'estimated_closing_costs' => $offer->strategy->estimated_closing_costs ?? 0,
				'initial_deposit_amount' => $offer->strategy->initial_deposit_amount ?? 0,
				'within_days' => $offer->strategy->within_days ?? 0,
				'deposit_increase' => $offer->strategy->deposit_increase ?? 0,
				'deposit_increase_days' => $offer->strategy->days_to_increase ?? '',
				'loan_amount_1' => $offer->strategy->first_mortgage_loan_amount ?? 0,
				'loan_interest_1' => $offer->strategy->first_loan_interest_rate ?? 0,
				'loan_points_1' => $offer->strategy->first_mortage_loan_points ?? 0,
				'direct_lender_1' => $offer->strategy->first_direct_lender_name ?? '',
				'financing_type_1' => $offer->strategy->first_type_of_financing ?? '',
				'additional_terms_1' => $offer->strategy->first_additional_terms ?? '',
				'loan_amount_2' => $offer->strategy->second_mortgage_loan_amount ?? 0,
				'loan_interest_2' => $offer->strategy->second_loan_interest_rate ?? 0,
				'loan_points_2' => $offer->strategy->second_mortage_loan_points ?? 0,
				'direct_lender_2' => $offer->strategy->second_direct_lender_name ?? '',
				'financing_type_2' => $offer->strategy->second_type_of_financing ?? '',
				'additional_terms_2' => $offer->strategy->second_additional_terms ?? '',
				// 'loan_amount' => $loan_amount,
				'loan_amount' => $offer->strategy->combined_loan_value ?? '',
			];
			$data_step4 = [
				'loan_contingency' => $offer->contract->loan_contingency ?? 0,
				'appraisal_contingency' => $offer->contract->appraisal_contingency ?? 0,
				'investigation_property' => $offer->contract->investigation_property ?? 0,
				'property_access' => $offer->contract->property_access ?? 0,
				'review_documents' => $offer->contract->review_documents ?? 0,
				'preliminary_report' => $offer->contract->preliminary_report ?? 0,
				'review_of_leased' => $offer->contract->review_of_leased ?? 0,
				'common_interest_disclosures' => $offer->contract->common_interest_disclosures ?? 0,
				'sale_buyer_property' => $offer->contract->sale_buyer_property ?? 0,
				'seller_delivery_document' => $offer->contract->seller_delivery_document ?? 0,
				'provisions_instructions' => $offer->contract->provisions_instructions ?? 0,
				'smoke_alarm' => $offer->contract->smoke_alarm ?? 0,
				'evidence_authority' => $offer->contract->evidence_authority ?? 0,
				'hoa_documents' => $offer->contract->hoa_documents ?? 0,
			];
			
			$data_step5 = [
				'cash_verification' => isset($offer->strategy->first_mortgage_loan_amount) && $offer->strategy->first_mortgage_loan_amount > 0 ? 0 : 1,
				'cash_verified_amount' => $offer->document->cash_verified_amount ?? 0,
				'cash_verified_image' => $offer->document->cashVerifiedFiles ?? [],
				'downpayment_verified_amount' => isset($offer->strategy->first_mortgage_loan_amount) > 0 ? $offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount : 0,
				'downpayment_verified_image' => $offer->document->downpaymentFiles ?? [],
				'loan_application_status' => $offer->document->loan_application_status ?? '',
				'loan_application_amount' => Helper::getBladeSetting('currency') . isset($offer->strategy->first_mortgage_loan_amount) . ' - ' . Helper::getBladeSetting('currency') . isset($offer->strategy->second_mortgage_loan_amount),
				'loan_interest_rate' => isset($offer->strategy->first_loan_interest_rate) . '% -' . isset($offer->strategy->second_loan_interest_rate) . '%',
				// 'direct_lender_name' => $offer->document->direct_lender_name ?? '',
				'direct_lender_name' => isset($offer->strategy->first_direct_lender_name) ? $offer->strategy->first_direct_lender_name . ' - ' . $offer->strategy->second_direct_lender_name : '',
				'loan_application_image' => $offer->document->loanApplicationFiles ?? [],
				'other_documents' => $offer->document->other_documents ?? "",
				'other_document_image' => $offer->document->otherFiles ?? [],
			];
			$data_step6 = [
				'items' => json_decode($property->items_include_exclude, true),
				'additional_items' => $property->additional_items,
				'excluded_items' => $property->excluded_items,
			];

			if (isset($data_step6['items']['bathroom_mirrors'])) {
				$data_step6['items']['bathroom_mrrors'] = $data_step6['items']['bathroom_mirrors'];
			}

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
				'escrow_holder' => $offer->cost_allocation->escrow_holder ?? '',
				'insurance_policy' => $offer->cost_allocation->insurance_policy ?? '',
				'title_company' => $offer->cost_allocation->title_company ?? '',
				'buyer_lender_policy' => $offer->cost_allocation->buyer_lender_policy ?? '',
				'country_transfer_tax' => $offer->cost_allocation->country_transfer_tax ?? '',
				'city_transfer_tax' => $offer->cost_allocation->city_transfer_tax ?? '',
				'warranty_plan' => $offer->cost_allocation->warranty_plan ?? '',
				'issued_by' => $offer->cost_allocation->issued_by ?? '',
				'cost_not_exceed' => $offer->cost_allocation->cost_not_exceed ?? '',
				'other_terms' => $offer->cost_allocation->other_terms ?? '',
			];
			$data_step8 = [
				'buyer_advisory' => $offer->buyer_advisory,
			];
		}
		view()->share(['data_step1' => $data_step1,
			'data_step2' => $data_step2,
			'data_step3' => $data_step3,
			'data_step4' => $data_step4,
			'data_step5' => $data_step5,
			'data_step6' => $data_step6,
			'data_step7' => $data_step7,
			'data_step8' => $data_step8]);

		$pdf = PDF::loadView('web.pdf.offer');

		// $pdf->stream('web.pdf.offer', array("Attachment" => false));

		if (file_exists(public_path('uploads/offers/agreements/Purchase-Agreement-' . $property->vms_property_id . '-' . $offer->id . '.pdf'))) {
			unlink(public_path('uploads/offers/agreements/Purchase-Agreement-' . $property->vms_property_id . '-' . $offer->id . '.pdf'));
		}
		// dd($pdf);
		$pdf->save('uploads/offers/agreements/Purchase-Agreement-' . $property->vms_property_id . '-' . $offer->id . '.pdf');

		// dd($pdf);
		// // dd(URL::current());
		// if (stripos(URL::current(), 'api') === false) {
		//     return $pdf->download('pdfview.pdf');
		// } else {
		return asset('uploads/offers/agreements/Purchase-Agreement-' . $property->vms_property_id . '-' . $offer->id . '.pdf');
		// }

		//  return view('web.pdf.offer');
	}

}
