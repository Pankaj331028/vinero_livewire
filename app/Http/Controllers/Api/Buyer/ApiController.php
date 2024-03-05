<?php

namespace App\Http\Controllers\Api\Buyer;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\CounterOfferDetailsResource;
use App\Http\Resources\OfferDetailResource;
use App\Http\Resources\OfferStepResource;
use App\Models\AcquisitionStrategy;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\AllocationCost;
use App\Models\Buyer;
use App\Models\ContractTimings;
use App\Models\CounterOffer;
use App\Models\Document;
use App\Models\DocumentVerification;
use App\Models\FinancialCredential;
use App\Models\ItemsIncludeExclude;
use App\Models\OfferInterest;
use App\Models\Offers;
use App\Models\Property;
use App\Models\Seller;
use App\Models\Survey;
use App\Models\TransactionOverview;
use App\Notifications\InformAcceptCounterOffer;
use App\Notifications\InformAdminNewOffer;
use App\Notifications\InformBuyerHigherOffer;
use App\Notifications\InformCounterOffer;
use App\Notifications\InformOfferImprove;
use App\Notifications\InformOfferWithdrawn;
use App\Notifications\OfferInterestReceived;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Validator;

class ApiController extends BaseController {
	use ResponseMessages, Helper;

	/**
	 * @OA\GET(
	 *     path="/view-offer",
	 *     description="Api to view offer details",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *     @OA\Parameter(
	 *         name="type",
	 *         in="query",
	 *         description="my_offer/transaction/strategy/items_include_exclude/doc_verification/allocation_cost,summary/contract_timings",
	 *         required=true,
	 *      ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="address",type="string",example="jaipur"),
	 *             		@OA\Property(property="submission_date", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="due_date", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="seller_brokerage_firm", type="string", example="jp pvt. ltd."),
	 *             		@OA\Property(property="seller_agen_name", type="string", example="Mick"),
	 *             		@OA\Property(property="buyer_name", type="string", example="jennifer"),
	 *             		@OA\Property(property="entity", type="string", example="trust"),
	 *             		@OA\Property(property="buyer_representative", type="string", example="yes"),
	 *             		@OA\Property(property="brokerage_firm", type="string", example="Mark limited"),
	 *             		@OA\Property(property="brokerage_license", type="string", example="M001RK007"),
	 *             		@OA\Property(property="agent_phone", type="string", example="9859696985"),
	 *             		@OA\Property(property="agent_commission", type="string", example="0.75"),
	 *             		@OA\Property(property="offer_status", type="string", example="AC"),
	 *
	 *       		),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function viewOffer(Request $request) {
		$user = auth()->user();
		$res = $this->checkUserActive($user);

		$user->last_activity = now();
		$user->save();
		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'type' => 'required|in:my_offer,transaction,strategy,items_include_exclude,doc_verification,allocation_cost,summary,contract_timings',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property = $this->formatResourceData($list);

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

			if ($request->type == 'my_offer') {
				$data = [
					'address' => $property->property_address,
					'submission_date' => Carbon::now(),
					'due_date' => Carbon::parse($property->vms_end_date),
					'seller_brokerage_firm' => $property->brokerage_name . ' ' . $property->brokerge_license_no,
					'seller_agent_name' => $property->agent_name . ' ' . $property->agent_license,
					'buyer_name' => $offer->buyer_name ?? '',
					'entity' => $offer->legal_entity ?? '',
					'buyer_representative' => $offer->represented_by ?? '',
					'brokerage_firm' => $offer->buyer_brokerage_firm ?? '',
					'brokerage_license' => $offer->buyer_brokerge_license ?? '',
					'agent_name' => $offer->buyer_agent ?? '',
					'agent_license' => $offer->buyer_agent_license ?? '',
					'agent_phone' => $offer->buyer_agent_phone ?? 0,
					'agent_comission' => $offer->buyer_agent_commission_percentage ?? 0,
					'offer_status' => $status,
				];
			} elseif ($request->type == 'transaction') {
				$start_date = Carbon::parse($property->possession_rent_back);
				$end_date = Carbon::parse($property->vms_end_date);
				$different_days = $start_date->diffInDays($end_date);

				$data = [
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
					'offer_status' => $status,
				];
			} elseif ($request->type == 'strategy') {
				$offer1 = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
				$loan_amount = $offer1->first_mortgage_loan_amount + $offer1->second_mortgage_loan_amount;
				$data = [
					'seller_financing' => $property->seller_financing,
					'seller_credit_amount' => $offer->transaction->seller_credit_amount,
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
					'offer_status' => $status,
				];
			} elseif ($request->type == 'contract_timings') {
				$data = [
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
					'offer_status' => $status,
				];
			} elseif ($request->type == 'doc_verification') {
				$data = [
					'cash_verification' => isset($offer->strategy->first_mortgage_loan_amount) && $offer->strategy->first_mortgage_loan_amount > 0 ? 0 : 1,
					'cash_verified_amount' => $offer->document->cash_verified_amount ?? 0,
					'cash_verified_image' => $offer->document->cashVerifiedFiles ?? [],
					'downpayment_verified_amount' => $offer->strategy->first_mortgage_loan_amount > 0 ? $offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount : 0,
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
			} elseif ($request->type == 'items_include_exclude') {
				$data = [
					'items' => json_decode($property->items_include_exclude),
					'additional_items' => $property->additional_items,
					'excluded_items' => $property->excluded_items,
					'buyer' => [
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
					],
					'offer_status' => $status,
				];
			} elseif ($request->type == 'allocation_cost') {
				$data = [
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
			} elseif ($request->type == 'summary') {
				$data = [
					'offered_price' => $offer->transaction->offer_price,
					'closing_cost' => ($offer->transaction->offer_price * $offer->strategy->estimated_closing_costs / 100),
					'seller_credit' => $offer->transaction->seller_credit_amount,
					'closed_funds' => $offer->document->downpayment_verified_amount,
					'mortgage_loan_1' => $offer->strategy->first_mortgage_loan_amount,
					'mortgage_loan_2' => $offer->strategy->second_mortgage_loan_amount,
					'initial_deposit' => $offer->strategy->initial_deposit_amount,
					'deposit_increase' => $offer->strategy->deposit_increase,
					'closing_balance' => $offer->strategy->balance_down_payment,
					'escrow_closing' => Carbon::parse($user->property->end_date)->addDay($offer->transaction->days_of_escrow + 1),
					'offer_status' => $status,
					'buyer_agent' => !empty($offer->buyer_agent) ? true : false,
				];
			}

			return $this->sendResponse($data, $this->getMessage(200));
		}

	}
	//api to create offer on property
	public function submitOffer(Request $request) {
		$user = auth()->user();
		
		$res = $this->checkUserActive($user);
		
		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$rule = [];

		$validate = Validator::make($request->all(), [
			'type' => 'required|in:my_offer,transaction,strategy,contract_timings,doc_verification,items_include_exclude,allocation_cost,summary',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$property = Property::where('vms_property_id', $user->property_id)->first();
		$admin = Admin::whereRole(1)->first();

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

			if ($request->type == 'my_offer') {
				$rule['buyer_name'] = 'required|max:50';
				$rule['entity'] = 'required|in:principal,llc,trust,corporation,legal_entity';
				$rule['buyer_representative'] = 'nullable|in:yes,no';
				$rule['brokerage_firm'] = 'nullable|max:50';
				$rule['brokerage_license'] = 'nullable|max:15';
				$rule['agent_name'] = 'nullable|max:50';
				$rule['agent_license'] = 'nullable|max:15';
				$rule['agent_phone'] = 'nullable|regex:/^([0-9\s\-\+\(\)]*)$/|min:10';
				$rule['agent_comission'] = 'nullable|numeric|min:0|max:3';

				$validate = Validator::make($request->all(), $rule);

				if ($request->agent_phone == $property->agent->phone_no) {
					return $this->sendResponse('', $this->getMessage(211));
				}

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (empty($offer)) {
					$new_offer = new Offers;
					$new_offer->property_id = $property->id;
					$new_offer->user_id = $user->id;
					$new_offer->date_offers = Carbon::now()->format('Y-m-d');
				} else {
					$new_offer = $offer;
				}

				$new_offer->buyer_name = $request->buyer_name;
				$new_offer->legal_entity = $request->entity;
				$new_offer->represented_by = $request->buyer_representative;
				$new_offer->buyer_brokerage_firm = $request->brokerage_firm;
				$new_offer->buyer_brokerge_license = $request->brokerage_license;
				$new_offer->buyer_agent = $request->agent_name;
				$new_offer->buyer_agent_license = $request->agent_license;
				$new_offer->buyer_agent_phone = $request->agent_phone;
				$new_offer->buyer_agent_commission_percentage = $request->agent_comission ?? 0;
				$new_offer->save();

				if ($new_offer->represented_by == 'yes') {
					//create agent
					$agent = Agent::where(['user_type' => 'agent', 'property_id' => $new_offer->property->vms_property_id, 'phone_no' => $request->agent_phone])->first();

					if (!$agent) {
						$agent = new Agent;
						$agent->property_id = $new_offer->property->vms_property_id;
						$agent->full_name = $request->agent_name;
						$agent->phone_no = $request->agent_phone;
						$agent->user_type = 'agent';
						$agent->optin_out = 'OPTOUT';
						$agent->save();

					}

					Buyer::where('id', $new_offer->user_id)->update(['agent_id' => $agent->id]);
					//assign agent to offer
					$new_offer->agent_id = $agent->id;
					$new_offer->save();
				}

				return $this->sendResponse(['offer_id' => $new_offer->id, 'commission' => $new_offer->buyer_agent_commission_percentage], $this->getMessage(200));
			} elseif ($request->type == 'transaction') {
				$rule['offered_price'] = 'required|max:10|gte:"' . $property->reserved_price . '"';
				$rule['seller_credit'] = 'nullable|numeric|mod1000:125';
				$rule['net_price'] = 'required';
				$rule['close_escrow_days'] = 'required';
				$rule['final_verification'] = 'required|numeric|min:1|max:10';
				$rule['assignment_request'] = 'required|numeric|min:1|max:17';

				$messages = [
					'seller_credit.mod1000' => 'Increase the number with 0.125 of its value',
				];
				$validate = Validator::make($request->all(), $rule, $messages);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->transaction) {
					$transaction = new TransactionOverview;
				} else {
					$transaction = $offer->transaction;
				}
				$transaction->offer_id = $offer->id;
				$transaction->offer_price = $request->offered_price;
				$transaction->seller_credit = $request->seller_credit;
				$credit = ($transaction->offer_price * (!empty($transaction->seller_credit) ? $transaction->seller_credit : 0) / 100);

				if (stripos($request->URL(), 'api') === false) {
					if ($offer->buyer_agent_commission_percentage == "") {
						$commission = 0;
					} else {
						$commission = ($transaction->offer_price * $offer->buyer_agent_commission_percentage / 100);
					}
					$net_price = $transaction->offer_price - ($commission + $credit);

					$transaction->net_price = $net_price;

				} else {
					$commission = ($transaction->offer_price * $offer->buyer_agent_commission_percentage / 100);
					$net_price = $transaction->offer_price - ($commission + $credit);

					$transaction->net_price = $net_price;

				}
				$transaction->seller_credit_amount = $credit;
				$transaction->days_of_escrow = $request->close_escrow_days;
				$transaction->expiration_offer = $property->vms_end_date;
				$transaction->final_verification = $request->final_verification;
				$transaction->assignment_request = $request->assignment_request;
				$transaction->save();

				//notify admin for offer price updates
				if ($transaction->wasChanged('offer_price') == true) {
					$transaction->price_improved = 1;
					$transaction->price_improved_on = now();
					//$admin->notify(new InformAdminOfferImprove($offer));
				} else {
					$transaction->price_improved = 0;
				}

				$transaction->save();

				$offer->buyer_agent_commission = $commission;
				$offer->save();

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'strategy') {

				$rule['estimated_closing_costs'] = 'required|numeric|min:0|max:10';
				$rule['initial_deposit_amount'] = 'required|max:10';
				$rule['within_days'] = 'required|numeric|min:1|max:6';
				$rule['deposit_increase'] = 'required|max:10';
				$rule['deposit_increase_days'] = 'nullable';
				// $rule['down_payment'] = 'required';

				$rule['loan_amount_1'] = 'nullable|max:10';
				$rule['loan_interest_1'] = 'nullable|required_with:loan_amount_1 > 0|numeric|min:0|max:15';
				$rule['loan_points_1'] = 'nullable|numeric|max:10';
				$rule['direct_lender_1'] = 'nullable|max:20';
				$rule['financing_type_1'] = 'nullable|in:conventional,FHA,VA,seller_financing,other';
				$rule['additional_terms_1'] = 'nullable|max:100';

				$rule['loan_amount_2'] = 'nullable|max:10';
				$rule['loan_interest_2'] = 'nullable|required_with:loan_amount_2 > 0|numeric|min:0|max:18';
				$rule['loan_points_2'] = 'nullable|numeric|max:15';
				$rule['direct_lender_2'] = 'nullable|max:20';
				$rule['financing_type_2'] = 'nullable|in:conventional,FHA,VA,seller_financing,other';
				$rule['additional_terms_2'] = 'nullable|max:100';
				$rule['loan_value'] = 'nullable';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->strategy) {
					$strategy = new AcquisitionStrategy;
				} else {
					$strategy = $offer->strategy;
				}

				$strategy->offer_id = $offer->id;
				$strategy->estimated_closing_costs = $request->estimated_closing_costs;
				$strategy->initial_deposit_amount = $request->initial_deposit_amount;
				$strategy->within_days = $request->within_days;
				$strategy->deposit_increase = $request->deposit_increase;
				$strategy->days_to_increase = $request->deposit_increase_days;
				$strategy->first_mortgage_loan_amount = $request->loan_amount_1;
				$strategy->first_loan_interest_rate = $request->loan_interest_1;
				$strategy->first_mortage_loan_points = $request->loan_points_1;
				$strategy->first_direct_lender_name = $request->direct_lender_1;
				$strategy->first_type_of_financing = $request->financing_type_1;
				$strategy->first_additional_terms = $request->additional_terms_1;
				$strategy->second_mortgage_loan_amount = $request->loan_amount_2;
				$strategy->second_loan_interest_rate = $request->loan_interest_2;
				$strategy->second_mortage_loan_points = $request->loan_points_2;
				$strategy->second_direct_lender_name = $request->direct_lender_2;
				$strategy->second_type_of_financing = $request->financing_type_2;
				$strategy->second_additional_terms = $request->additional_terms_2;
				$total_loan_amount = $request->loan_amount_1 + $request->loan_amount_2;
				$strategy->combined_loan_value = ($total_loan_amount / $offer->transaction->offer_price) * 100;
				$balance = $offer->transaction->offer_price - $strategy->initial_deposit_amount - $strategy->deposit_increase - $total_loan_amount + ($offer->transaction->offer_price * $strategy->estimated_closing_costs / 100) - $offer->transaction->seller_credit_amount;
				//dd($balance);
				$strategy->balance_down_payment = $balance;
				$strategy->save();

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'contract_timings') {
				$rule['loan_contingency'] = 'required|numeric|min:1|max:20';
				$rule['appraisal_contingency'] = 'required|numeric|min:1|max:17';
				$rule['investigation_property'] = 'required|numeric|min:1|max:17';
				$rule['property_access'] = 'required|numeric|min:1|max:17';
				$rule['review_documents'] = 'required|numeric|min:1|max:17';
				$rule['preliminary_report'] = 'required|numeric|min:1|max:17';
				$rule['review_of_leased'] = 'min:1|max:17';
				$rule['common_interest_disclosures'] = 'min:1|max:17';
				$rule['sale_buyer_property'] = 'min:1|max:17';
				$rule['seller_delivery_document'] = 'required|numeric|min:1|max:7';
				$rule['provisions_instructions'] = 'required|numeric|min:1|max:7';
				$rule['smoke_alarm'] = 'required|numeric|min:1|max:7';
				$rule['evidence_authority'] = 'required|numeric|min:1|max:7';
				$rule['hoa_documents'] = 'min:1|max:7';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->contract) {
					$contract = new ContractTimings;
				} else {
					$contract = $offer->contract;
				}

				$contract->offer_id = $offer->id;
				$contract->loan_contingency = $request->loan_contingency;
				$contract->appraisal_contingency = $request->appraisal_contingency;
				$contract->investigation_property = $request->investigation_property;
				$contract->property_access = $request->property_access;
				$contract->review_documents = $request->review_documents;
				$contract->preliminary_report = $request->preliminary_report;
				$contract->review_of_leased = $request->review_of_leased == "" ? null : $request->review_of_leased;
				$contract->common_interest_disclosures = $request->common_interest_disclosures == "" ? null : $request->common_interest_disclosures;
				$contract->sale_buyer_property = $request->sale_buyer_property == "" ? null : $request->sale_buyer_property;
				$contract->seller_delivery_document = $request->seller_delivery_document;
				$contract->provisions_instructions = $request->provisions_instructions;
				$contract->smoke_alarm = $request->smoke_alarm;
				$contract->evidence_authority = $request->evidence_authority;
				$contract->hoa_documents = $request->hoa_documents == "" ? null : $request->hoa_documents;
				$contract->save();

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'doc_verification') {
				$rule['cash_verified_amount'] = 'nullable|max:10';
				$rule['cash_verified_image'] = 'array';
				$rule['cash_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
				// $rule['downpayment_verified_amount'] = 'nullable|max:10';
				$rule['downpayment_verified_image'] = 'array';
				$rule['downpayment_verified_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
				$rule['loan_application_status'] = 'nullable|in:pre_approval,pre_qualification,all_cash';
				// $rule['loan_application_amount'] = 'nullable|max:10';
				// $rule['loan_interest_rate'] = 'nullable|numeric|min:0|max:12';
				// $rule['direct_lender_name'] = 'nullable|max:20';
				$rule['loan_application_image'] = 'array';
				$rule['loan_application_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
				$rule['other_documents'] = 'max:20';
				$rule['other_document_image'] = 'array';
				$rule['other_document_image.*'] = 'nullable|mimes:jpeg,jpg,pdf,png|max:10000';
				$rule['deleted_images'] = 'nullable|array';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->document) {
					$document = new DocumentVerification;
				} else {
					$document = $offer->document;
				}

				$document->offer_id = $offer->id;
				$document->cash_verified_amount = $request->cash_verified_amount;
				$document->downpayment_verified_amount = $offer->transaction->offer_price - $offer->strategy->first_mortgage_loan_amount - $offer->strategy->second_mortgage_loan_amount - $offer->transaction->seller_credit_amount + $offer->strategy->initial_deposit_amount;
				$document->loan_application_status = $request->loan_application_status;
				// $document->loan_application_amount = $request->loan_application_amount;
				// $document->loan_interest_rate = $request->loan_interest_rate;
				$document->direct_lender_name = $request->direct_lender_name;
				$document->other_documents = $request->other_documents;
				$document->save();

				if ($request->cash_verified_image) {
					$files = $request->file('cash_verified_image');

					if (count($files) > 0) {
						foreach ($files as $file) {
							$extension = $file->getClientOriginalExtension();
							$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
							$filename = str_replace('.jpeg', '.jpg', $filename);
							$path = 'uploads/offers/' . $offer->id . '/' . $filename;
							$destinationPath = public_path('uploads/offers/' . $offer->id);
							if (!File::isDirectory($destinationPath)) {
								File::makeDirectory($destinationPath, 0777, true, true);
							}

							$file->move($destinationPath, $filename);
							// $img = Image::make($file)->save($destinationPath . '/' . $filename);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'cash_verified_image';
							$doc->name = $filename;
							$document->documents()->save($doc);
						}
					}
					// $document->cash_verified_amount = $path;
				}

				if ($request->downpayment_verified_image) {
					$files = $request->file('downpayment_verified_image');

					if (count($files) > 0) {
						foreach ($files as $file) {
							$extension = $file->getClientOriginalExtension();
							$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
							$filename = str_replace('.jpeg', '.jpg', $filename);
							$path = 'uploads/offers/' . $offer->id . '/' . $filename;
							$destinationPath = public_path('uploads/offers/' . $offer->id);
							if (!File::isDirectory($destinationPath)) {
								File::makeDirectory($destinationPath, 0777, true, true);
							}

							$file->move($destinationPath, $filename);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'downpayment_verified_image';
							$doc->name = $filename;
							$document->documents()->save($doc);
						}
					}
				}

				if ($request->loan_application_image) {
					$files = $request->file('loan_application_image');

					if (count($files) > 0) {
						foreach ($files as $file) {
							$extension = $file->getClientOriginalExtension();
							$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
							$filename = str_replace('.jpeg', '.jpg', $filename);
							$path = 'uploads/offers/' . $offer->id . '/' . $filename;
							$destinationPath = public_path('uploads/offers/' . $offer->id);
							if (!File::isDirectory($destinationPath)) {
								File::makeDirectory($destinationPath, 0777, true, true);
							}
							$file->move($destinationPath, $filename);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'loan_application_image';
							$doc->name = $filename;
							$document->documents()->save($doc);
						}
					}
				}

				if ($request->other_document_image) {
					$files = $request->file('other_document_image');

					if (count($files) > 0) {
						foreach ($files as $file) {
							$extension = $file->getClientOriginalExtension();
							$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
							$filename = str_replace('.jpeg', '.jpg', $filename);
							$path = 'uploads/offers/' . $offer->id . '/' . $filename;
							$destinationPath = public_path('uploads/offers/' . $offer->id);
							if (!File::isDirectory($destinationPath)) {
								File::makeDirectory($destinationPath, 0777, true, true);
							}
							$file->move($destinationPath, $filename);

							$doc = new Document();
							$doc->path = $path;
							$doc->type = 'other_document_image';
							$doc->name = $filename;
							$document->documents()->save($doc);
						}
					}
				} else {
					$doc_id = DocumentVerification::where('offer_id', $offer->id)->value('id');
					$images = Document::where('type', 'other_document_image')->where('documentable_id', $doc_id)->get();
					foreach ($images as $img) {
						if (File::exists(public_path('upload/offers/' . $offer->id . '/' . $img->name))) {
							File::delete(public_path('upload/offers/' . $offer->id . '/' . $img->name));
						}
					}
					Document::where('type', 'other_document_image')->where('documentable_id', $doc_id)->delete();
				}

				if (isset($request->deleted_images) && count($request->deleted_images) > 0) {
					Document::whereIn('id', $request->deleted_images)->delete();
				}

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'items_include_exclude') {

				$rule['stove_oven'] = 'required';
				$rule['refrigerator'] = 'required';
				$rule['wine_refrigerator'] = 'required';
				$rule['washer'] = 'required';
				$rule['dryer'] = 'required';
				$rule['dishwasher'] = 'required';
				$rule['microwave'] = 'required';
				$rule['video_doorbell'] = 'required';
				$rule['security_camera'] = 'required';
				$rule['security_system'] = 'required';
				$rule['control_devices'] = 'required';
				$rule['audio_equipment'] = 'required';
				$rule['ground_pool'] = 'required';
				$rule['bathroom_mrrors'] = 'required';
				$rule['car_charging_system'] = 'required';
				$rule['potted_trees'] = 'required';
				$rule['additional_items'] = 'nullable';
				$rule['excluded_items'] = 'nullable';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->include_exclude) {
					$item = new ItemsIncludeExclude;
				} else {
					$item = $offer->include_exclude;
				}

				$item->offer_id = $offer->id;
				$item->stove_oven = $request->stove_oven;
				$item->refrigerator = $request->refrigerator;
				$item->wine_refrigerator = $request->wine_refrigerator;
				$item->washer = $request->washer;
				$item->dryer = $request->dryer;
				$item->dishwasher = $request->dishwasher;
				$item->microwave = $request->microwave;
				$item->video_doorbell = $request->video_doorbell;
				$item->security_camera = $request->security_camera;
				$item->security_system = $request->security_system;
				$item->control_devices = $request->control_devices;
				$item->audio_equipment = $request->audio_equipment;
				$item->ground_pool = $request->ground_pool;
				$item->bathroom_mrrors = $request->bathroom_mrrors;
				$item->car_charging_system = $request->car_charging_system;
				$item->potted_trees = $request->potted_trees;
				$item->additional_items = $request->additional_items;
				$item->excluded_items = $request->excluded_items;
				$item->save();

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'allocation_cost') {
				$rule['natural_hazard_zone'] = 'required|in:buyer,seller,50';
				$rule['environmental'] = 'required|in:yes,no,N/A';
				$rule['provided_by'] = 'required|max:30';
				$rule['other'] = 'max:100';
				$rule['report_name'] = 'max:100';
				$rule['paid_by'] = 'required|in:buyer,seller,50';
				$rule['smoke_alarms'] = 'required|in:buyer,seller,50';
				$rule['gov_reports'] = 'required|in:buyer,seller,50';
				$rule['gov_required_point'] = 'required|in:buyer,seller,50';
				$rule['escrow_fees'] = 'required|in:buyer,seller,50,pay_own_fee';
				$rule['escrow_holder'] = 'required|max:50';
				$rule['insurance_policy'] = 'required|in:buyer,seller,50';
				$rule['title_company'] = 'max:50';
				$rule['buyer_lender_policy'] = 'required|in:buyer,seller,50';
				$rule['country_transfer_tax'] = 'required|in:buyer,seller,50';
				$rule['city_transfer_tax'] = 'required|in:buyer,seller,50,N/A,n/a';
				$rule['warranty_plan'] = 'nullable|in:buyer,seller,50,waives';
				$rule['issued_by'] = 'nullable|max:50';
				$rule['cost_not_exceed'] = 'nullable|required_if:warranty_plan,==,buyer,seller,50|max:10';
				// $rule['other_fee_cost'] = 'required|max:100'; //TODO
				$rule['other_terms'] = 'nullable|max:100';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				if (!$offer->cost_allocation) {
					$allocation = new AllocationCost;
				} else {
					$allocation = $offer->cost_allocation;
				}

				$allocation->offer_id = $offer->id;
				$allocation->natural_hazard_zone = $request->natural_hazard_zone;
				$allocation->environmental = $request->environmental;
				$allocation->provided_by = $request->provided_by;
				$allocation->other = $request->other;
				$allocation->report_name = $request->report_name;
				$allocation->paid_by = $request->paid_by;
				$allocation->smoke_alarms = $request->smoke_alarms;
				$allocation->gov_reports = $request->gov_reports;
				$allocation->gov_required_point = $request->gov_required_point;
				$allocation->escrow_fees = $request->escrow_fees;
				$allocation->escrow_holder = $request->escrow_holder;
				$allocation->insurance_policy = $request->insurance_policy;
				$allocation->title_company = $request->title_company;
				$allocation->buyer_lender_policy = $request->buyer_lender_policy;
				$allocation->country_transfer_tax = $request->country_transfer_tax;
				$allocation->city_transfer_tax = $request->city_transfer_tax;
				$allocation->warranty_plan = $request->warranty_plan;
				$allocation->issued_by = $request->issued_by;
				$allocation->cost_not_exceed = $request->cost_not_exceed;
				// $allocation->hoa_transfer_fee = $request->hoa_transfer_fee;
				// $allocation->private_transfer_fee = $request->private_transfer_fee;
				// $allocation->other_fee = $request->other_fee;
				$allocation->other_terms = $request->other_terms;
				$allocation->save();

				return $this->sendResponse("", $this->getMessage(200));
			} elseif ($request->type == 'summary') {

				$rule['approve'] = 'required|in:yes,no';
				$rule['buyer_advisory'] = 'required|in:yes,no';
				if (empty($offer->buyer_agent)) {
					$rule['talk_with_realtor'] = 'required|in:call_with_agent,decline';
				}
				$rule['submit_without_assistance'] = 'required|in:yes,no';

				$validate = Validator::make($request->all(), $rule);

				if ($validate->fails()) {
					return $this->sendError($validate->errors()->first(), $validate->errors()->first());
				}

				$offer->approve = $request->approve;
				$offer->buyer_advisory = $request->buyer_advisory;
				$offer->talk_with_realtor = $request->talk_with_realtor ?? null;
				$offer->submit_without_assistance = $request->submit_without_assistance;
				$offer->date_offers = now();

				//notify admin for new offer
				if ($offer->save()) {
					$admin->notify(new InformAdminNewOffer($offer));
					/*

						// send notify other buyers with lower offer price about higher price bid by logged in buyer

						$offers = Offers::where('property_id', $property->id)->whereHas('transaction', function ($q) use ($offer) {
							$q->where('offer_price', '<', $offer->transaction->offer_price);
						})->where('user_id', '!=', $user->id)->get();

						foreach ($offers as $offer1) {
							$diff = $offer->transaction->offer_price - $offer1->transaction->offer_price;

							//notify
							$buyer = $offer1->owner()->get();
							$agent = Agent::where('id', $offer1->agent_id)->get();

							$notified_users = $buyer->concat($agent);

							foreach ($notified_users as $notify_user) {
								$notify_user->notify(new InformBuyerHigherOffer($offer1, $diff, $notify_user));
							}
						}
					*/
				}

				return $this->sendResponse("", $this->getMessage(212));
			}
		}
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step1",
	 *     description="Api to add offer step 1",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","buyer_name","entity"},
	 *       			@OA\Property(property="type", type="string", format="text", example="my_offer"),
	 *       			@OA\Property(property="buyer_name", type="string", format="text", example="swagger"),
	 *       			@OA\Property(property="entity", type="string", format="text", example="principal/llc/trust/corporation/legal_entity"),
	 *       			@OA\Property(property="buyer_representative", type="string", format="text", example="yes"),
	 *       			@OA\Property(property="brokerage_firm", type="string", format="text", example="vinero"),
	 *       			@OA\Property(property="brokerage_license", type="string", format="text", example="v001"),
	 *       			@OA\Property(property="agent_name", type="string", format="text", example="jhon"),
	 *       			@OA\Property(property="agent_license", type="string", format="text", example="swagger"),
	 *       			@OA\Property(property="agent_phone", type="string", format="text", example="123456789"),
	 *       			@OA\Property(property="agent_comission", type="string", format="text", example="2.5"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep1(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step2",
	 *     description="Api to add offer step 2",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","offered_price","net_price","close_escrow_days","final_verification"},
	 *       			@OA\Property(property="type", type="string", format="text", example="transaction"),
	 *       			@OA\Property(property="offered_price", type="string", format="text", example="120000"),
	 *       			@OA\Property(property="net_price", type="string", format="text", example="122000"),
	 *       			@OA\Property(property="close_escrow_days", type="string", format="text", example="10"),
	 *       			@OA\Property(property="final_verification", type="string", format="text", example="5"),
	 *       			@OA\Property(property="assignment_request", type="string", format="text", example="5"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep2(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step3",
	 *     description="Api to add offer step 3",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","estimated_closing_costs","initial_deposit_amount","within_days","deposit_increase","deposit_increase_days"},
	 *       			@OA\Property(property="type", type="string", format="text", example="strategy"),
	 *       			@OA\Property(property="estimated_closing_costs", type="string", format="text", example="100000"),
	 *       			@OA\Property(property="initial_deposit_amount", type="string", format="text", example="122000"),
	 *       			@OA\Property(property="within_days", type="string", format="text", example="2"),
	 *       			@OA\Property(property="deposit_increase", type="string", format="text", example="1000000"),
	 *       			@OA\Property(property="deposit_increase_days", type="string", format="text", example="5"),
	 *       			@OA\Property(property="loan_amount_1", type="string", format="text", example="100000"),
	 *       			@OA\Property(property="loan_interest_1", type="string", format="text", example="2"),
	 *       			@OA\Property(property="loan_points_1", type="string", format="text", example="5"),
	 *       			@OA\Property(property="direct_lender_1", type="string", format="text", example="direct lander"),
	 *       			@OA\Property(property="financing_type_1", type="string", format="text", example="conventional/FHA/VA/seller_financing/other"),
	 *       			@OA\Property(property="additional_terms_1", type="string", format="text", example="additional terms"),
	 * 					@OA\Property(property="loan_amount_2", type="string", format="text", example="100000"),
	 *       			@OA\Property(property="loan_interest_2", type="string", format="text", example="2"),
	 *       			@OA\Property(property="loan_points_2", type="string", format="text", example="5"),
	 *       			@OA\Property(property="direct_lender_2", type="string", format="text", example="direct lander"),
	 *       			@OA\Property(property="financing_type_2", type="string", format="text", example="conventional/FHA/VA/seller_financing/other"),
	 *       			@OA\Property(property="additional_terms_2", type="string", format="text", example="additional terms"),
	 *       			@OA\Property(property="loan_value", type="string", format="text", example="demo"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep3(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step4",
	 *     description="Api to add offer step 4",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","loan_contingency","appraisal_contingency","investigation_property","property_access","review_documents","preliminary_report","review_of_leased","common_interest_disclosures","sale_buyer_property","seller_delivery_document","provisions_instructions","smoke_alarm","evidence_authority","hoa_documents"},
	 *       			@OA\Property(property="type", type="string", format="text", example="contract_timings"),
	 *       			@OA\Property(property="loan_contingency", type="string", format="text", example="10"),
	 *       			@OA\Property(property="appraisal_contingency", type="string", format="text", example="10"),
	 *       			@OA\Property(property="investigation_property", type="string", format="text", example="10"),
	 *       			@OA\Property(property="property_access", type="string", format="text", example="10"),
	 *       			@OA\Property(property="review_documents", type="string", format="text", example="10"),
	 *       			@OA\Property(property="preliminary_report", type="string", format="text", example="10"),
	 *       			@OA\Property(property="review_of_leased", type="string", format="text", example="10"),
	 *       			@OA\Property(property="common_interest_disclosures", type="string", format="text", example="10"),
	 *       			@OA\Property(property="sale_buyer_property", type="string", format="text", example="direct 10"),
	 *       			@OA\Property(property="seller_delivery_document", type="string", format="text", example="10"),
	 *       			@OA\Property(property="provisions_instructions", type="string", format="text", example="10"),
	 * 					@OA\Property(property="smoke_alarm", type="string", format="text", example="10"),
	 *       			@OA\Property(property="evidence_authority", type="string", format="text", example="10"),
	 *       			@OA\Property(property="hoa_documents", type="string", format="text", example="10"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep4(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step5",
	 *     description="Api to add offer step 5",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","other_documents"},
	 *       			@OA\Property(property="type", type="string", format="text", example="doc_verification"),
	 *       			@OA\Property(property="cash_verified_amount", type="string", format="text", example="100001"),
	 *       			@OA\Property(property="loan_application_status", type="string", format="text", example="pre_approval/pre_qualification/all_cash"),
	 *       			@OA\Property(property="other_documents", type="string", format="text", example="other documents"),
	 * 					@OA\Property(property="cash_verified_image",type="array",
	 *                  		@OA\Items(
	 *                       type="file",
	 *                       format="binary",
	 *                  		),
	 *               	  ),
	 *						@OA\Property(property="downpayment_verified_image",type="array",
	 *                  		@OA\Items(
	 *                       type="file",
	 *                       format="binary",
	 *                  		),
	 *               	  ),
	 *						@OA\Property(property="loan_application_image",type="array",
	 *                  		@OA\Items(
	 *                       type="file",
	 *                       format="binary",
	 *                  		),
	 *               	  ),
	 *						@OA\Property(property="other_document_image",type="array",
	 *                  		@OA\Items(
	 *                       type="file",
	 *                       format="binary",
	 *                  		),
	 *               	  ),
	 * 				)
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */
	public function addOfferStep5(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step6",
	 *     description="Api to add offer step 6",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","stove_oven","refrigerator","wine_refrigerator","washer","dryer","dishwasher","microwave","video_doorbell","security_camera","security_system","control_devices","audio_equipment","ground_pool","bathroom_mrrors","car_charging_system","potted_trees","additional_items","excluded_items"},
	 *       			@OA\Property(property="type", type="string", format="text", example="items_include_exclude"),
	 *       			@OA\Property(property="stove_oven", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="refrigerator", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="wine_refrigerator", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="washer", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="dryer", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="dishwasher", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="microwave", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="video_doorbell", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="security_camera", type="string", format="text", example="direct Yes/No/NA"),
	 *       			@OA\Property(property="security_system", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="control_devices", type="string", format="text", example="Yes/No/NA"),
	 * 					@OA\Property(property="audio_equipment", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="ground_pool", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="bathroom_mrrors", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="car_charging_system", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="potted_trees", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="additional_items", type="string", format="text", example="Yes/No/NA"),
	 *       			@OA\Property(property="excluded_items", type="string", format="text", example="Yes/No/NA"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep6(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step7",
	 *     description="Api to add offer step 7",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","natural_hazard_zone","environmental","provided_by","other","report_name","paid_by","smoke_alarms","gov_reports","gov_required_point","escrow_fees","escrow_holder","insurance_policy","title_company","buyer_lender_policy","country_transfer_tax","city_transfer_tax","warranty_plan","issued_by","cost_not_exceed","other_terms"},
	 *       			@OA\Property(property="type", type="string", format="text", example="allocation_cost"),
	 *       			@OA\Property(property="natural_hazard_zone", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="environmental", type="string", format="text", example="yes/no/N/A"),
	 *       			@OA\Property(property="provided_by", type="string", format="text", example="provided by"),
	 *       			@OA\Property(property="other", type="string", format="text", example="other"),
	 *       			@OA\Property(property="report_name", type="string", format="text", example="report name"),
	 *       			@OA\Property(property="paid_by", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="smoke_alarms", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="gov_reports", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="gov_required_point", type="string", format="text", example="direct buyer/seller/50"),
	 *       			@OA\Property(property="escrow_fees", type="string", format="text", example="buyer/seller/50/pay_own_fee"),
	 *       			@OA\Property(property="escrow_holder", type="string", format="text", example="escrow holder name"),
	 * 					@OA\Property(property="insurance_policy", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="title_company", type="string", format="text", example="company title"),
	 *       			@OA\Property(property="buyer_lender_policy", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="country_transfer_tax", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="city_transfer_tax", type="string", format="text", example="buyer/seller/50"),
	 *       			@OA\Property(property="warranty_plan", type="string", format="text", example="buyer/seller/50/waives"),
	 *       			@OA\Property(property="issued_by", type="string", format="text", example="issued by name"),
	 *       			@OA\Property(property="cost_not_exceed", type="string", format="text", example="cost"),
	 *       			@OA\Property(property="other_terms", type="string", format="text", example="other terms"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep7(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Post(
	 *     path="/submitOffer-Step8",
	 *     description="Api to add offer step 8",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","approve","buyer_advisory","talk_with_realtor","submit_without_assistance"},
	 *       			@OA\Property(property="type", type="string", format="text", example="summary"),
	 *       			@OA\Property(property="approve", type="string", format="text", example="yes/no"),
	 *       			@OA\Property(property="buyer_advisory", type="string", format="text", example="yes/no"),
	 *       			@OA\Property(property="talk_with_realtor", type="string", format="text", example="call_with_agent/decline"),
	 *       			@OA\Property(property="submit_without_assistance", type="string", format="text", example="yes/no"),
	 *
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=211,
	 *          description="his agent is already associated with other buyer/seller for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="211"),
	 * 				@OA\Property(property="message", type="string", example="his agent is already associated with other buyer/seller for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=212,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="212"),
	 * 				@OA\Property(property="message", type="string", example="All steps have been completed. The final submission of your offer is one step closer."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function addOfferStep8(Request $request) {
		return $this->submitOffer($request);
	}
	/**
	 * @OA\Get(
	 *     path="/get-offer-details",
	 *     description="Api for buyer to get offer details",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 * 				@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="buyer_name",type="string", format="text", example="Jhon mark"),
	 * 					@OA\Property(property="agent_name", type="string", format="text", example="lan nato"),
	 *             		@OA\Property(property="submitted_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *             		@OA\Property(property="offered_price", type="string", format="text", example="1200020"),
	 * 					@OA\Property(property="counter_price", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="improved_price", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="email_sent", type="string", format="text", example="1"),
	 * 					@OA\Property(property="deadline", type="string", format="text", example="12-08-2023 12:02:02"),
	 * 					@OA\Property(property="agent_commission", type="string", format="text", example="11000"),
	 * 					@OA\Property(property="net_price", type="string", format="text", example="1200000"),
	 * 					@OA\Property(property="money_deposit", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="down_payment", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="est_mortgage", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="mortgage_loan", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="proof_funds", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="preapproval_amount", type="string", format="text", example="10000-20000"),
	 * 					@OA\Property(property="qualify_for", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="lender", type="string", format="text", example="jhon mark - lan nato"),
	 * 					@OA\Property(property="interest", type="string", format="text", example="2.5% - 1.5%"),
	 * 					@OA\Property(property="bid_per_sqfeet", type="string", format="text", example="1000.00"),
	 * 					@OA\Property(property="purchase_contract", type="string", format="text", example="uploads/purchase_contract/purchase-agreement.pdf"),
	 * 					@OA\Property(property="is_reviewed", type="string", format="text", example="1"),
	 * 					@OA\Property(property="financial_credentials", type="string", format="text", example="1"),
	 * 					@OA\Property(property="disclosure", type="string", format="text", example="disclosure"),
	 * 					@OA\Property(property="offer_increase", type="string", format="text", example="100000"),
	 * 					@OA\Property(property="status", type="string", format="text", example="PN"),
	 * 					@OA\Property(property="notification", type="string", format="text", example="12-02-2022"),
	 * 					@OA\Property(property="minimum_offer_price", type="string", format="text", example="120000"),
	 *
	 * 					@OA\Property(property="highest_bid_amount", type="string", format="text", example="120000"),
	 * 					@OA\Property(property="reserved_price", type="string", format="text", example="1100000"),
	 * 					@OA\Property(property="property_address", type="string", format="text", example="1/24B jaipur"),
	 * 					@OA\Property(property="dashboard data", type="object",
	 *             		@OA\Property(property="email_recevied",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="improved_on",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="withdrawan_on",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="notified_on",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="offer_accepted",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="financial_improved",type="string", format="text", example="12-08-2023 12:02:02"),
	 *             		@OA\Property(property="counter_on",type="string", format="text", example="12-08-2023 12:02:02"),
	 * 					),
	 * 				),
	 * 	  		),
	 *     ),
	 * )
	 */

	//api to fetch offer details
	public function offerDetails(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$user->last_activity = now();
		$user->save();
		$offer = $user->offer ?? null;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
		}

		if (isset($offer)) {
			$data = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
			$data->highest_bid = $offer->highest_bid;
			$data->notification = $user->notifications()->latest()->first();
			$data->financial = $offer->financials()->exists();
			$data->financials = $offer->financials;
			$data->financial_improved_on = $offer->financials()->latest()->count() > 1 ? $offer->financials()->latest()->first()->created_at : '';

			$data->financial_improved = $offer->financials()->count() > 1 ? 1 : 0;
			$data->counter_price = $offer->counter->amount ?? 0;
			$data->counter_on = $offer->counter->created_at ?? '';
			// $data->counter_price = $offer->property->seller->counter->amount ?? 0;
			// $data->counter_on = $offer->property->seller->counter->created_at ?? '';

			// get purchase agreement pdf
			$pdf = app('App\Http\Controllers\WebsiteController')->download_pdf($request);

			$data->pdf = $pdf;

			return $this->sendResponse(new OfferDetailResource($data), $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/submit-financial-credentials",
	 *     description="Api for submit financial credentials",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"tnc"},
	 *       			@OA\Property(property="tnc", type="string", format="text", example="1"),
	 *       			@OA\Property(property="file", type="string", format="text", example="uploads/offers/32/166254835963187987d8498.pdf"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=213,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="213"),
	 * 				@OA\Property(property="message", type="string", example="Financial credentials have been submitted successfully"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */
	//api to submit financial credential
	public function submitFinancialCredentials(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$validate = Validator::make($request->all(), [
			'file' => 'nullable|mimes:docx,pdf|max:10000',
			'tnc' => 'required|in:0,1',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$offer = $user->offer;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		$financial = new FinancialCredential;
		$financial->loan_amount = 0;
		$financial->offer_id = $offer->id;

		if ($request->file) {
			$file = $request->file;
			$extension = $file->getClientOriginalExtension();
			$filename = time() . uniqid() . '.' . $request->file->getClientOriginalExtension();
			$filename = str_replace('.jpeg', '.jpg', $filename);
			$path = 'uploads/offers/' . $offer->id . '/' . $filename;
			$destinationPath = public_path('uploads/offers/' . $offer->id);
			if (!File::isDirectory($destinationPath)) {
				File::makeDirectory($destinationPath, 0777, true, true);
			}
			$request->file->move($destinationPath, $filename);
			$financial->file = $path;
		}

		$financial->tnc = $request->tnc;
		$financial->save();

		return $this->sendResponse("", $this->getMessage(213));
	}
	/**
	 * @OA\Post(
	 *     path="/update-offer-status",
	 *     description="Api to update there offer status",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type","improve"},
	 *       			@OA\Property(property="type", type="string", format="text", example="offer_reject/offer_reject_exceed/higher_offer/modify_bid/counter_offer"),
	 *       			@OA\Property(property="improve", type="string", format="text", example="0"),
	 *       			@OA\Property(property="amount", type="string", format="text", example="120000"),
	 *       			@OA\Property(property="file", type="file", format="text", example="file.pdf"),
	 *
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=399,
	 *          description="No offer has been submitted",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="399"),
	 *       		@OA\Property(property="message", type="string", example="No offer has been submitted"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	//api to improve/reject offer, bid modification
	public function updateOfferStatus(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$validate = Validator::make($request->all(), [
			'type' => 'required', //type:offer_reject,offer_reject_exceed,higher_offer,modify_bid,counter_offer
			'improve' => 'required',
			'amount' => "required_if:improve,==,1",
			'file' => 'nullable|mimes:docx,pdf|max:10000',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$offer = $user->offer;
		$admin = Admin::whereRole(1)->get();

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		if ($request->improve == 1) {
			$offer->transaction->improved_price = $request->amount - $offer->transaction->offer_price;
			$offer->transaction->offer_price = $request->amount;
			$offer->transaction->price_improved_on = now();

			if ($request->type == 'modify_bid' || $request->type == 'deadline_extension') {
				//notify
				$seller = $offer->property->seller()->get();
				$notified_users = $admin->concat($seller);

				$agent = Agent::where('id', $seller->first()->agent_id)->get();
				$notified_users = $notified_users->concat($agent);

				foreach ($notified_users as $notified_user) {
					$notified_user->notify(new InformOfferImprove($offer, $notified_user));
				}

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

			   if($off->count()>0){
				$off=$off[0];
				

				$diff = $off->transaction->offer_price - $offer->transaction->offer_price;

				//notify
				$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
				$agent = Agent::where('id', $offer->agent_id)->get();

				$notified_users = $buyer->concat($agent);

				foreach ($notified_users as $notify_user) {
					$notify_user->notify(new InformBuyerHigherOffer($offer, $diff, $notify_user));
				}
				}
			}

			if ($request->type == 'counter_offer') {
				//notify
				$seller = $offer->property->seller()->get();
				$notified_users = $admin->concat($seller);

				$agent = Agent::where('id', $seller->first()->agent_id)->get();
				$notified_users = $notified_users->concat($agent);

				foreach ($notified_users as $notified_user) {
					$notified_user->notify(new InformAcceptCounterOffer($offer, $notified_user));
				}
			}

			$offer->transaction->save();

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

			$balance = $offer->transaction->offer_price - $offer->strategy->initial_deposit_amount - $offer->strategy->deposit_increase - $total_loan_amount + ($offer->transaction->offer_price * $offer->strategy->estimated_closing_costs / 100) - $offer->transaction->seller_credit_amount;
			$offer->strategy->balance_down_payment = $balance;
			$offer->strategy->save();

			$pdf = app('App\Http\Controllers\WebsiteController')->download_pdf($request);

		} else {
			if ($request->file) {
				//inactive old FC
				$user->offer->financials()->update(['status' => 'IN']);

				$financial = new FinancialCredential;
				$file = $request->file;
				$extension = $file->getClientOriginalExtension();
				$filename = time() . uniqid() . '.' . $file->getClientOriginalExtension();
				$filename = str_replace('.jpeg', '.jpg', $filename);
				$path = 'uploads/offers/' . $offer->id . '/' . $filename;
				$destinationPath = public_path('uploads/offers/' . $offer->id);
				if (!File::isDirectory($destinationPath)) {
					File::makeDirectory($destinationPath, 0777, true, true);
				}

				$file->move($destinationPath, $filename);
				$financial->file = $path;
				$financial->offer_id = $offer->id;
				$financial->tnc = 1;
				$financial->save();
			}
		}

		return $this->sendResponse("", $this->getMessage(200));
	}
	/**
	 * @OA\Post(
	 *     path="/cancel-offer",
	 *     description="Api for buyer for cancel offer",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=206,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="206"),
	 * 				@OA\Property(property="message", type="string", example="Offer withdrawn successfully"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */
	public function cancelOffer(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$offer = $user->offer;
		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		$offer->status = 'CL';
		$offer->cancelled_at = now();
		$offer->save();

		//delete current offer details
		if (isset($user->offer)) {
			$user->offer->delete();
		}

		if ($user->user_type == 'agent') {
			$buyer = Agent::find($user->id)->head;

			$buyer->notify(new InformOfferWithdrawn($offer, $buyer, 'agent'));
		} else {
			$agent = Agent::find($user->agent_id);

			$agent->notify(new InformOfferWithdrawn($offer, $agent, 'buyer'));
		}

		return $this->sendResponse('', $this->getMessage(206));
	}
	/**
	 * @OA\Post(
	 *     path="/optin-out",
	 *     description="Api to update monitoring of the app to agent/buyer",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type"},
	 *       			@OA\Property(property="type", type="string", format="text", example="OPTIN/OPTOUT/OPTOUTMODE1/OPTOUTMODE2"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=204,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="204"),
	 * 				@OA\Property(property="message", type="string", example="Rights has been updated successfully"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *		 @OA\Response(
	 *     		response=501,
	 *          description="Something Went Wrong",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="501"),
	 * 				@OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=406,
	 *          description="You haven't assigned any agent for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="406"),
	 * 				@OA\Property(property="message", type="string", example="You haven't assigned any agent for this property."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */
	//api to update monitoring of the app to agent/buyer
	public function optinOut(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$validate = Validator::make($request->all(), [
			'type' => 'required|in:OPTIN,OPTOUT,OPTOUTMODE1,OPTOUTMODE2',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$user->optin_out = $request->type;
		$user->save();

		if ($request->type == 'OPTOUTMODE1') {
			$optin_out = 'OPTINMODE1';
		} elseif ($request->type == 'OPTOUTMODE2') {
			$optin_out = 'OPTINMODE2';
		} else {
			$optin_out = 'OPTOUT';
		}

		$agent = Agent::find($user->agent_id);

		if ($agent) {
			$agent->optin_out = $optin_out;

			if ($agent->save()) {
				return $this->sendResponse('', $this->getMessage(204));
			} else {
				return $this->sendError($this->getMessage(501));
			}
		} else {
			return $this->sendError($this->getMessage(406));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/offer-interest",
	 *     description="Api to update contact and time to communicate",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type"},
	 *       			@OA\Property(property="type", type="string", format="text", example="text/email/phone"),
	 *       			@OA\Property(property="time", type="string", format="text", example="12AM"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=399,
	 *          description="No offer has been submitted",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="399"),
	 *       		@OA\Property(property="message", type="string", example="No offer has been submitted"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	//way of communication
	public function offerInterest(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		
		$validate = Validator::make($request->all(), [
			'type' => 'required|in:text,email,phone',
			'time' => "required_if:type,==,phone",
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}
		$user->last_activity = now();
		$user->save();
		$offer = $user->offer;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		if ($offer) {
			$interest = new OfferInterest;
			$interest->user_id = $user->id;
			$interest->offer_id = $offer->id;
			$interest->type = $request->type;
			$interest->time = $request->time;
			$interest->save();

			$data = [
				'type' => $request->type,
				'time' => $request->time,
				'buyer_no' => $offer->owner->phone_no,
			];

			$seller = $offer->property->seller()->get();
			$agent = Agent::where('id', $seller->first()->agent_id)->get();

			$notified_users = $seller->concat($agent);
			// dd($data);
			foreach ($notified_users as $notify_user) {
				$notify_user->notify(new OfferInterestReceived($data, $notify_user));
			}

			return $this->sendResponse('', $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(399));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/submit-survey",
	 *     description="Api for buyer to submit survey",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 *  	@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"user_friendly","enjoyed_experience","convenience","complicated","exiting","intrusive","kept_me_informed","kept_me_control","kept_me_focused","found_value","will_use_it_again","will_recommend","transparency","fairness","inclusiveness","a_better_way","frictions"},
	 *       			@OA\Property(property="user_friendly", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="enjoyed_experience", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="convenience", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="complicated", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="exiting", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="intrusive", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="kept_me_informed", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="kept_me_control", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="kept_me_focused", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="found_value", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="will_use_it_again", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="will_recommend", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="transparency", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="fairness", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="inclusiveness", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="a_better_way", type="integer", format="text", example="1/2/3/4/5"),
	 *       			@OA\Property(property="frictions", type="integer", format="text", example="1/2/3/4/5"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=208,
	 *          description="Survey submitted successfully",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="208"),
	 * 				@OA\Property(property="message", type="string", example="Survey submitted successfully"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	public function submitSurvey(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'user_friendly' => 'required',
			'enjoyed_experience' => 'required',
			'convenience' => 'required',
			'complicated' => 'required',
			'exiting' => 'required',
			'intrusive' => 'required',
			'kept_me_informed' => 'required',
			'kept_me_control' => 'required',
			'kept_me_focused' => 'required',
			'found_value' => 'required',
			'will_use_it_again' => 'required',
			'will_recommend' => 'required',
			'transparency' => 'required',
			'fairness' => 'required',
			'inclusiveness' => 'required',
			'a_better_way' => 'required',
			'frictions' => 'required',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$survey = new Survey;
		$survey->user_id = $user->id;
		$survey->user_friendly = $request->user_friendly;
		$survey->enjoyed_experience = $request->enjoyed_experience;
		$survey->convenience = $request->convenience;
		$survey->complicated = $request->complicated;
		$survey->exiting = $request->exiting;
		$survey->intrusive = $request->intrusive;
		$survey->kept_me_informed = $request->kept_me_informed;
		$survey->kept_me_control = $request->kept_me_control;
		$survey->kept_me_focused = $request->kept_me_focused;
		$survey->found_value = $request->found_value;
		$survey->will_use_it_again = $request->will_use_it_again;
		$survey->will_recommend = $request->will_recommend;
		$survey->transparency = $request->transparency;
		$survey->fairness = $request->fairness;
		$survey->inclusiveness = $request->inclusiveness;
		$survey->a_better_way = $request->a_better_way;
		$survey->frictions = $request->frictions;
		$survey->save();

		$user->last_activity = now();
		$user->save();
		return $this->sendResponse('', $this->getMessage(208));

	}
	/**
	 * @OA\GET(
	 *     path="/offer-acceptance",
	 *     description="Api for buyer to accept offer",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="contractual_disclosure",type="string",example="jaipur"),
	 *             		@OA\Property(property="loan_contingency", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="inspections_contingency", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="title_review", type="string", example="jp pvt. ltd."),
	 *             		@OA\Property(property="close_of_escrow", type="string", example="Mick"),
	 *             		@OA\Property(property="emd", type="string", example="jennifer"),
	 *             		@OA\Property(property="escrow_no", type="string", example="trust"),
	 *             		@OA\Property(property="escrow_officer", type="string", example="yes"),
	 *             		@OA\Property(property="escrow_officer_contact", type="string", example="Mark limited"),
	 *             		@OA\Property(property="transaction_coordinator", type="string", example="M001RK007"),
	 *             		@OA\Property(property="coordinator_contact", type="string", example="9859696985"),
	 *
	 *       		),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	//api to fetch details of offer after seller acceptance
	public function offerAcceptance(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$data = [];

		$offer = $user->offer;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		if (isset($offer->id)) {
			$item = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];

			$data = [
				'initial_deposit_escrow' => ['days' => $item->within_days, 'date' => Carbon::parse($item->vms_end_date)->addDays($item->within_days)->format('D M d,Y')],
				'purchase_price' => $item->offer_price,
				'contractual_disclosure' => ['days' => 0, 'date' => Carbon::parse($item->vms_end_date)->format('D M d,Y')],
				'loan_contingency' => ['days' => $item->loan_contingency, 'date' => Carbon::parse($item->vms_end_date)->addDays($item->loan_contingency)->format('D M d,Y')],
				'inspections_contingency' => ['days' => $item->investigation_property, 'date' => Carbon::parse($item->vms_end_date)->addDays($item->investigation_property)->format('D M d,Y')],
				'title_review' => ['days' => $item->preliminary_report, 'date' => Carbon::parse($item->vms_end_date)->addDays($item->preliminary_report)->format('D M d,Y')],
				'close_of_escrow' => ['days' => $item->days_of_escrow, 'date' => Carbon::parse($item->vms_end_date)->addDays($item->days_of_escrow)->format('D M d,Y')],
				'emd' => '$' . ((int) $item->initial_deposit_amount + (int) $item->deposit_increase) . ' within 3 days',
				'emd_deposit' => ((int) $item->initial_deposit_amount + (int) $item->deposit_increase),
				'escrow_no' => $item->escrow_number,
				'escrow_officer' => $item->escrow_officer,
				'escrow_officer_contact' => $item->escrow_office_phone . ' - ' . $item->escrow_office_email,
				'transaction_coordinator' => $item->transaction_coordinator,
				'coordinator_contact' => $item->transaction_coordinator_phone . ' - ' . $item->transaction_coordinator_email,
			];
		}
		$user->last_activity = now();
		$user->save();
		return $this->sendResponse($data, $this->getMessage(200));
	}
	/**
	 * @OA\GET(
	 *     path="/counter-details",
	 *     description="Api for buyer to view counter details",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=404,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="amount",type="integer",example="120000"),
	 *             		@OA\Property(property="close_of_escrow", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="inspection_prop", type="string", example="04/Nov/2022"),
	 *             		@OA\Property(property="loan_contingency", type="string", example="jp pvt. ltd."),
	 *             		@OA\Property(property="escrow_number", type="string", example="Mick"),
	 *             		@OA\Property(property="escrow_company", type="string", example="jennifer"),
	 *             		@OA\Property(property="escrow_officer", type="string", example="yes"),
	 *             		@OA\Property(property="escrow_officer_contact", type="string", example="Mark limited"),
	 *             		@OA\Property(property="multiple_counter", type="string", example="Mark limited"),
	 *
	 *       		),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	//api to fetch seller counter-offer details
	public function counterDetails(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);

			$active_off_id = $user->offer->id;
		} else {
			$active_off_id = $user->active_offer->id;
		}

		$seller_id = $user->property->seller->id;

		$data = CounterOffer::where(['offer_id' => $active_off_id, 'user_id' => $seller_id, 'status' => 'AC'])->first();

		if ($data) {
			$user->last_activity = now();
			$user->save();
			return $this->sendResponse(new CounterOfferDetailsResource($data), $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/counter-offer",
	 *     description="Api for buyer to update counter offer",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"amount","close_of_escrow","inspection","loan_contingency","escrow_company","escrow_number","contact_info","escrow_officer","other_tearms","tnc"},
	 *       			@OA\Property(property="amount", type="string", format="text", example="100001"),
	 *       			@OA\Property(property="close_of_escrow", type="string", format="text", example="9547812306"),
	 *       			@OA\Property(property="inspection", type="string",  format="text", example="buyer/seller/agent" ),
	 *       			@OA\Property(property="loan_contingency", type="string",  format="text", example="fvsdf7sg8dgs8dfgs8d"),
	 *       			@OA\Property(property="escrow_company", type="string",  format="text", example="Logical Prime"),
	 *       			@OA\Property(property="escrow_number", type="string",  format="text", example="1254789630"),
	 *       			@OA\Property(property="contact_info", type="integer", example="9859585958"),
	 *       			@OA\Property(property="escrow_officer", type="string", example="denial"),
	 *       			@OA\Property(property="other_tearms", type="string", example="property"),
	 *       			@OA\Property(property="tnc", type="integer", example="1"),
	 *
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=404,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=210,
	 *          description="Counter offer details sent successfully to seller",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="210"),
	 * 				@OA\Property(property="message", type="string", example="Counter offer details sent successfully to seller"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	//api to update counter offer
	public function counterOfferUpdate(Request $request) {
		$user = auth()->user();
		// dd($user);
		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'amount' => "required",
			'close_of_escrow' => "required",
			'inspection' => "required",
			'loan_contingency' => "required",
			'escrow_company' => "required",
			'escrow_number' => "required",
			'contact_info' => "required",
			'escrow_officer' => "required",
			'other_terms' => "required",
			'tnc' => "required",
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}
		$offer = $user->offer;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
			if (!$offer) {
				$offer = null;
			}
		}

		$counter = new CounterOffer;
		$counter->user_id = $user->id;
		$counter->offer_id = $offer->id;
		$counter->amount = $request->amount;
		$counter->close_of_escrow = $request->close_of_escrow;
		$counter->inspection = $request->inspection;
		$counter->loan_contingency = $request->loan_contingency;
		$counter->escrow_company = $request->escrow_company;
		$counter->escrow_number = $request->escrow_number;
		$counter->escrow_officer = $request->escrow_officer;
		$counter->other_terms = $request->other_terms;
		$counter->tnc = $request->tnc;
		$counter->save();

		//update offer details
		$offer = Offers::find($counter->offer_id);
		$offer->transaction->offer_price = $request->amount;
		$offer->transaction->save();

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
		$balance = $offer->transaction->offer_price - $offer->strategy->initial_deposit_amount - $offer->strategy->deposit_increase - $total_loan_amount + ($offer->transaction->offer_price * $offer->strategy->estimated_closing_costs / 100) - $offer->transaction->seller_credit_amount;
		$offer->strategy->balance_down_payment = $balance;
		$offer->strategy->save();

		$pdf = app('App\Http\Controllers\WebsiteController')->download_pdf($request);

		$user->last_activity = now();
		$user->save();
		//notify
		$seller = $user->property->seller()->get();
		$agent = Agent::where('id', $seller->first()->agent_id)->get();

		$notified_users = $seller->concat($agent);

		foreach ($notified_users as $notify_user) {
			$notify_user->notify(new InformCounterOffer($counter, 'buyer', $notify_user));
		}

		$code = 210;

		return $this->sendResponse('', $this->getMessage($code));
	}
	/**
	 * @OA\Post(
	 *     path="/review",
	 *     description="Api for buyer to review",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=404,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	public function review() {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		if ($user->offer) {
			$user->offer->is_reviewed = 1;
			$user->offer->save();
			$user->last_activity = now();
			$user->save();
			return $this->sendResponse(1, $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/submit-signature",
	 *     description="Api for buyer to submit there signature",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"file"},
	 *       			@OA\Property(property="file", type="file", format="text", example="jpg/png/jpeg"),
	 *
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=101,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="101"),
	 *       		@OA\Property(property="message", type="string", example="Missing parameters"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 		@OA\Response(
	 *     		response=404,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=214,
	 *          description="Thank you for submitting an offer. Our team will revert back soon.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="214"),
	 * 				@OA\Property(property="message", type="string", example="Thank you for submitting an offer. Our team will revert back soon."),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */
	public function submitSignature(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'file' => "required|mimes:jpeg,jpg,png|max:10000",
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		if ($user->offer) {
			$file = $request->file;
			$extension = $file->getClientOriginalExtension();
			$filename = time() . uniqid() . '.' . $request->file->getClientOriginalExtension();
			$filename = str_replace('.jpeg', '.jpg', $filename);
			$path = 'uploads/offers/' . $user->offer->id . '/' . $filename;
			$destinationPath = public_path('uploads/offers/' . $user->offer->id);
			if (!File::isDirectory($destinationPath)) {
				File::makeDirectory($destinationPath, 0777, true, true);
			}
			$request->file->move($destinationPath, $filename);

			$user->offer->signature = $path;
			$user->offer->status = 'PN';
			$user->offer->save();
			$user->last_activity = now();
			$user->save();
			return $this->sendResponse('', $this->getMessage(214));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/has-agent",
	 *     description="Api for buyer to check agent available or not",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="response",type="string", format="text", example="1"),
	 *       		),
	 * 	  		),
	 *     ),
	 *
	 * )
	 */

	public function hasAgent() {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		if (isset($user->offer->agent_id)) {
			return $this->sendResponse(1, $this->getMessage(200));
		} else {
			return $this->sendResponse(0, $this->getMessage(200));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/get-offer-steps",
	 *     description="Api for buyer to get offer steps",
	 *     tags={"Buyer"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_BUYER_CONST_HOST,
	 *      	description="API Server for Buyer"
	 * 	   ),
	 * 		@OA\Response(
	 *     		response=400,
	 *          description="User not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="400"),
	 *       		@OA\Property(property="message", type="string", example="User not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=401,
	 *          description="Account is not verified",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="401"),
	 *       		@OA\Property(property="message", type="string", example="Account is not verified"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 * 				@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="status",type="string", format="text", example="true"),
	 *             		@OA\Property(property="my_offer",type="string", format="text", example="true"),
	 *             		@OA\Property(property="transaction",type="string", format="text", example="true"),
	 *             		@OA\Property(property="strategy",type="string", format="text", example="true"),
	 *             		@OA\Property(property="timings",type="string", format="text", example="true"),
	 *             		@OA\Property(property="doc_verification",type="string", format="text", example="true"),
	 *             		@OA\Property(property="items_include_exclude",type="string", format="text", example="true"),
	 *             		@OA\Property(property="cost_allocation",type="string", format="text", example="true"),
	 *             		@OA\Property(property="summary",type="string", format="text", example="true"),
	 *             		@OA\Property(property="financial_credentials",type="string", format="text", example="1"),
	 * 					@OA\Property(property="details", type="object",
	 *             		@OA\Property(property="property_address",type="string", format="text", example="f this is not the correct address, please contact us. info@Qonectin.com"),
	 *             		@OA\Property(property="buyer_name",type="string", format="text", example="Enter all Buyers separated by semi-colon ;"),
	 *             		@OA\Property(property="real_estate",type="string", format="text", example="Contact us if you need assistance info@Qonectin.com"),
	 *             		@OA\Property(property="possession",type="string", format="text", example="Terms can be negotiated under “Other Terms and Conditions"),
	 *             		@OA\Property(property="doc_verification",type="string", format="text", example="You must upload documentation that supports your financial capacity to complete the transaction"),
	 *             		@OA\Property(property="include_exclude",type="string", format="text", example="Items Seller included and exclude in the sale.  Buyers can negotiate items in this section. N/A is not applicable"),
	 *             		@OA\Property(property="cost_allocation",type="string", format="text", example="Buyers can negotiate items in this section."),
	 *             		@OA\Property(property="offer_summary",type="string", format="text", example="Verify your Offer Summary. Go back to Smart Offer Terms Manager to edit your offer."),
	 *       		),
	 *       		),
	 *
	 * 	  		),
	 *     ),
	 *
	 * )
	 */

	public function offerSteps() {
		$user = auth()->user();
		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$offer = null;

		if ($user->user_type == 'agent') {
			$offer = Offers::where('agent_id', $user->id)->where('property_id', $user->property->id)->first();
		} else {
			$offer = $user->offer;

		}
		return $this->sendResponse(new OfferStepResource($offer), $this->getMessage(200));
	}
}
