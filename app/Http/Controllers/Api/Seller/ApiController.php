<?php

namespace App\Http\Controllers\Api\Seller;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\OfferDetailResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\PropertyResource;
use App\Models\Admin;
use App\Models\Agent;
use App\Models\Buyer;
use App\Models\CounterOffer;
use App\Models\Offers;
use App\Models\Property;
use App\Models\PropertyHistory;
use App\Models\Seller;
use App\Models\Setting;
use App\Notifications\InformAdminNewProperty;
use App\Notifications\InformBuyerDeadlineExtension;
use App\Notifications\InformBuyerOfferAcceptance;
use App\Notifications\InformBuyerOfferInterest;
use App\Notifications\InformBuyerOfferRejection;
use App\Notifications\InformCounterOffer;
use App\Notifications\InformOfferClosed;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use DB;
use File;
use Illuminate\Http\Request;
use Image;
use Validator;

class ApiController extends BaseController {
	use ResponseMessages, Helper;

	//unique code for property listing
	public function generateCode() {
		$code = 1;
		$code += $this->getSetting('property_code');
		Setting::whereRule('property_code')->update(['value' => $code]);
		return $this->sendResponse('VMS' . $code, $this->getMessage(200));
	}
	/**
	 * @OA\Post(
	 *     path="/seller/add-property",
	 *     description="Api for seller to add property",
	 *     tags={"Seller"},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *      @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"property_id","address","owner","seller_phone","activation_date","deactivation_date","reserved_price","square_foot","offer_increase","occupancy","possession","property_type","financing","buyer_credit","purchase_agreement","brokerage_name","brokerage_license","agent_name","agent_phone","agent_license","escrow_holder","escrow_number","disclosure","items_include_exclude","escrow_officer","escrow_officer_email","escrow_officer_phone","transaction_coordinator","transaction_coordinator_email","transaction_coordinator_phone"},
	 *                   @OA\Property(property="property_id", type="string", format="text", example="VMS222"),
	 *                   @OA\Property(property="address", type="string", format="text", example="123 EZ Street, san francisco CA"),
	 *                   @OA\Property(property="owner", type="string", format="text", example="Peter D Seller"),
	 *                   @OA\Property(property="seller_phone", type="string", format="text", example="1234567890"),
	 *                   @OA\Property(property="activation_date", type="string", format="text", example="2022-11-10"),
	 *                   @OA\Property(property="deactivation_date", type="string", format="text", example="09-11-2022"),
	 *                   @OA\Property(property="reserved_price", type="string", format="text", example="1500000"),
	 *                   @OA\Property(property="square_foot", type="string", format="text", example="1650"),
	 *                   @OA\Property(property="offer_increase", type="string", format="text", example="1"),
	 *                   @OA\Property(property="occupancy", type="string", format="text", example="owner/vacant/tenant"),
	 *                   @OA\Property(property="possession", type="string", format="text", example="close_escrow/month_day/rent_back/tenant_rights"),
	 *                   @OA\Property(property="property_type", type="string", format="text", example="single_family/tic/condo/multiunit"),
	 *                   @OA\Property(property="financing", type="string", format="text", example="yes/no"),
	 *                   @OA\Property(property="buyer_credit", type="string", format="text", example="yes,no,will_consider"),
	 *                   @OA\Property(property="purchase_agreement", type="string", format="text", example="car/sfar"),
	 *                   @OA\Property(property="brokerage_name", type="string", format="text", example="Qonectin"),
	 *                   @OA\Property(property="brokerage_license", type="string", format="text", example="1776125"),
	 *                   @OA\Property(property="agent_name", type="string", format="text", example="Lucy steller"),
	 *                   @OA\Property(property="agent_phone", type="string", format="text", example="1234568790"),
	 *                   @OA\Property(property="agent_license", type="string", format="text", example="1230045"),
	 *                   @OA\Property(property="escrow_holder", type="string", format="text", example="fidelity"),
	 *                   @OA\Property(property="escrow_number", type="string", format="text", example="123456"),
	 *                   @OA\Property(property="disclosure", type="file", format="text", example="doc.pdf"),
	 *                   @OA\Property(property="escrow_officer", type="string", format="text", example="khristina berquist"),
	 *                   @OA\Property(property="escrow_officer_email", type="string", format="text", example="khristina@gmail.ocm"),
	 *                   @OA\Property(property="escrow_officer_phone", type="string", format="text", example="321456789"),
	 *                   @OA\Property(property="transaction_coordinator", type="string", format="text", example="Ana maria S"),
	 *                   @OA\Property(property="transaction_coordinator_email", type="string", format="text", example="ana@gmail.com"),
	 *                   @OA\Property(property="transaction_coordinator_phone", type="string", format="text", example="2123456478"),
	 *                   @OA\Property(property="disclosure_hoa_fee", type="string", format="text", example="buyer/seller/50"),
	 *                   @OA\Property(property="certification_hoa_fee", type="string", format="text", example="buyer/seller/50"),
	 *                   @OA\Property(property="hoa_transfer_fee", type="string", format="text", example="buyer/seller/50"),
	 *                   @OA\Property(property="private_transfer_fee", type="string", format="text", example="buyer/seller/50"),
	 *                   @OA\Property(property="other_fee", type="string", format="text", example="buyer/seller/50"),
	 *                   @OA\Property(property="other_fee_describe", type="string", format="text", example="describe other fees"),
	 *                    @OA\Property(type="object",property="items_include_exclude",
	 *
	 *                       @OA\Property(property="stove_oven", type="string" ,format="text", example="Yes/No"),
	 *                        @OA\Property(property="refrigerator", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="wine_refrigerator", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="washer", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="dryer", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="dishwasher", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="microwave", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="video_doorbell", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="security_camera", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="security_system", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="control_devices", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="audio_equipment", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="ground_pool", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="bathroom_mrrors", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="car_charging_system", type="string", format="text", example="Yes/No"),
	 *                       @OA\Property(property="potted_trees", type="string", format="text", example="Yes/No"),
	 *                        )
	 *                         )
	 *                 )
	 *     ),
	 *        @OA\Response(
	 *             response=101,
	 *          description="Missing Parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               @OA\Property(property="data", type="string", example="Missing Parameters"),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=201,
	 *          description="Property sent for verification",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="201"),
	 *                 @OA\Property(property="message", type="string", example="Property sent for verification"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=202,
	 *          description="Property already exist",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="202"),
	 *                 @OA\Property(property="message", type="string", example="Property already exist"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 * )
	 */
	// api to create property
	public function addProperty(Request $request) {
		if (!is_array($request->items_include_exclude)) {
			$sis = ((array) json_decode($request->items_include_exclude));
			$request->request->add(['items_include_exclude' => $sis]);
		}

		//return response($request->items_include_exclude['stove_oven']);
		$validate = Validator::make($request->all(), [
			'property_id' => 'required',
			'address' => 'required|string|min:3|max:100',
			'owner' => 'required|max:50',
			'seller_phone' => 'required|digits_between:7,10',
			'activation_date' => 'required|date_format:Y-m-d|after_or_equal:today',
			'deactivation_date' => 'required|date_format:Y-m-d|after:activation_date',
			'reserved_price' => 'required|numeric|digits_between:1,10',
			'square_foot' => 'required|numeric|digits_between:1,10',
			'offer_increase' => 'required|numeric|min:0|max:100',
			'occupancy' => 'required|in:owner,vacant,tenant',
			'possession' => 'required|in:close_escrow,month_day,rent_back,tenant_rights',
			'property_type' => 'required|in:single_family,tic,condo,multiunit',
			'financing' => 'required|in:yes,no',
			'buyer_credit' => 'required|in:yes,no,will_consider',
			'purchase_agreement' => 'required|in:car,sfar',
			'brokerage_name' => 'required|max:50',
			'brokerage_license' => 'required|max:50',
			'agent_name' => 'required|max:50',
			'agent_phone' => 'required|digits_between:7,10',
			'agent_license' => 'required|max:15',
			'escrow_holder' => 'required|max:50',
			'escrow_number' => 'required|max:15',
			'disclosure' => 'required|mimes:jpeg,jpg,png,pdf', //|max:5000
			'items_include_exclude' => 'required|array',
			'escrow_officer' => 'required|max:50',
			'escrow_officer_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50',
			'escrow_officer_phone' => 'required|digits_between:7,10',
			'transaction_coordinator' => 'required|max:50',
			'transaction_coordinator_email' => 'required|regex:/(.+)@(.+)\.(.+)/i|max:50',
			'transaction_coordinator_phone' => 'required|digits_between:7,10',
			'disclosure_hoa_fee' => 'nullable|in:buyer,seller,50',
			'certification_hoa_fee' => 'nullable|in:buyer,seller,50',
			'hoa_transfer_fee' => 'nullable|max:10',
			'private_transfer_fee' => 'nullable|max:10',
			'other_fee' => 'nullable', //|max:10
			'other_fee_describe' => 'nullable', //|max:10
		], [
			'occupancy.in' => 'Occupancy must be owner,vacant,tenant',
		]);
		//dd("test");
		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}
		//dd("fsjdf");
		$seller = Seller::where(['user_type' => 'seller', 'property_id' => $request->property_id, 'phone_no' => $request->seller_phone])->first();

		if (!$seller) {
			$seller = new Seller;
			$seller->property_id = $request->property_id;
			$seller->full_name = $request->owner;
			$seller->phone_no = $request->seller_phone;
			$seller->user_type = 'seller';
			$seller->save();
		}

		//save property
		if (!Property::where('vms_property_id', $request->property_id)->exists()) {
			$agent = Agent::where(['user_type' => 'agent', 'property_id' => $request->property_id, 'phone_no' => $request->agent_phone])->first();

			if (!$agent) {
				$agent = new Agent;
				$agent->property_id = $request->property_id;
				$agent->full_name = $request->agent_name;
				$agent->phone_no = $request->agent_phone;
				$agent->license_no = $request->agent_license;
				$agent->user_type = 'agent';
				$agent->optin_out = 'OPTOUT';
				$agent->save();
			}

			//assign agent to seller
			$seller->agent_id = $agent->id;
			$seller->save();

			$property = new Property;
			$property->user_id = $seller->id;
			$property->agent_id = $agent->id;
			$property->vms_property_id = $seller->property_id;
			$property->property_address = $request->address;
			$property->owner_name = $request->owner;
			// $property->vms_start_date = $request->activation_date . ' 06:00:00';

			if ($request->activation_date == date('Y-m-d')) {
				$active = $request->activation_date . ' ' . date('H:i:s');
			} else {
				$active = $request->activation_date . ' 06:00:00';
			}
			$property->vms_start_date = $active;
			$property->vms_end_date = $request->deactivation_date . ' ' . date('H:i:s', strtotime($active));
			// $property->vms_end_date = $request->deactivation_date . ' 18:00:00';
			$property->reserved_price = $request->reserved_price;
			$property->square_foot_rate = $request->square_foot;
			$property->offer_increase = $request->offer_increase;
			$property->occupancy = $request->occupancy;
			$property->possession = $request->possession;
			if ($property->possession == 'rent_back') {
				$property->possession_rent_back = $request->rent_back_date;
			} elseif ($property->possession == 'tenant_rights') {
				$property->possession_tenant_rights = $request->possession_tenant_rights;
			}
			$property->property_type = $request->property_type;
			$property->seller_credit_buyer = $request->buyer_credit;
			$property->seller_financing = $request->financing;
			$property->purchase_agreement = $request->purchase_agreement;
			$property->brokerage_name = $request->brokerage_name;
			$property->brokerge_license_no = $request->brokerage_license;
			$property->agent_name = $request->agent_name;
			$property->agent_phone = $request->agent_phone;
			$property->agent_license = $request->agent_license;
			$property->escrow_holder = $request->escrow_holder;
			$property->escrow_number = $request->escrow_number;
			$property->escrow_officer = $request->escrow_officer;
			$property->escrow_office_email = $request->escrow_officer_email;
			$property->escrow_office_phone = $request->escrow_officer_phone;
			$property->transaction_coordinator = $request->transaction_coordinator;
			$property->transaction_coordinator_email = $request->transaction_coordinator_email;
			$property->transaction_coordinator_phone = $request->transaction_coordinator_phone;
			$property->disclosure_hoa_fee = $request->disclosure_hoa_fee;
			$property->hoa_certification_fee = $request->certification_hoa_fee;
			$property->hoa_transfer_fee = $request->hoa_transfer_fee;
			$property->private_transfer_fee = $request->private_transfer_fee;
			$property->other_fee = $request->other_fee;
			$property->other_fee_describe = $request->other_fee_describe;

			//items exclude/include
			$items_include_exclude = [
				'stove_oven' => $request->items_include_exclude['stove_oven'],
				'refrigerator' => $request->items_include_exclude['refrigerator'],
				'wine_refrigerator' => $request->items_include_exclude['wine_refrigerator'],
				'washer' => $request->items_include_exclude['washer'],
				'dryer' => $request->items_include_exclude['dryer'],
				'dishwasher' => $request->items_include_exclude['dishwasher'],
				'microwave' => $request->items_include_exclude['microwave'],
				'video_doorbell' => $request->items_include_exclude['video_doorbell'],
				'security_camera' => $request->items_include_exclude['security_camera'],
				'security_system' => $request->items_include_exclude['security_system'],
				'control_devices' => $request->items_include_exclude['control_devices'],
				'audio_equipment' => $request->items_include_exclude['audio_equipment'],
				'ground_pool' => $request->items_include_exclude['ground_pool'],
				'bathroom_mrrors' => $request->items_include_exclude['bathroom_mirrors'] ?? $request->items_include_exclude['bathroom_mrrors'],
				'car_charging_system' => $request->items_include_exclude['car_charging_system'],
				'potted_trees' => $request->items_include_exclude['potted_trees'],
			];

			$property->items_include_exclude = json_encode($items_include_exclude);
			$property->additional_items = $request->additional_items;
			$property->excluded_items = $request->excluded_items;
			$property->save();

			//save history
			$history = new PropertyHistory();
			$history->property_id = $property->id;
			$history->start_date = $property->vms_start_date;
			$history->end_date = $property->vms_end_date;
			$history->additional_hours = 0;
			$history->hours = 6;
			$history->save();

			if ($request->disclosure) {
				$extensionData = $request->disclosure->extension();
				if ($extensionData == 'pdf') {
					$file = $request->file('disclosure');
					$filename = time() . '.' . $file->getClientOriginalExtension();
					$folder_path = 'uploads/properties/' . $property->id . '/';
					$path = $folder_path . $filename;
					$file->move(public_path($folder_path), $filename);
				} else {
					$file = $request->file('disclosure');
					$extension = $file->getClientOriginalExtension();
					$filename = time() . '.' . $file->getClientOriginalExtension();
					$filename = str_replace('.jpeg', '.jpg', $filename);
					$path = 'uploads/properties/' . $property->id . '/' . $filename;
					$destinationPath = public_path('uploads/properties/' . $property->id);
					if (!File::isDirectory($destinationPath)) {
						File::makeDirectory($destinationPath, 0777, true, true);
					}
					$img = Image::make($file)->save($destinationPath . '/' . $filename);
				}
				$property->disclosure = $path;
			}
			$property->save();

			//notify admin
			$admin = Admin::whereRole(1)->first();
			$admin->notify(new InformAdminNewProperty($property));

			return $this->sendResponse('', $this->getMessage(201));

		} else {
			return $this->sendError($this->getMessage(202), [], 201);
		}
	}
	/**
	 * @OA\Post(
	 *     path="/seller/view-property",
	 *     description="Api for Seller to view property detail",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=200,
	 *          description="Success",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="200"),
	 *                 @OA\Property(property="message", type="string", example="Success"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *                 @OA\Property(property="data", type="object",
	 *                     @OA\Property(property="due_date",type="string", format="text", example="22-Nov-2022"),
	 *                     @OA\Property(property="reserved_price", type="string", format="text", example="1100000"),
	 *                     @OA\Property(property="offer_increase", type="string", format="text", example="5%"),
	 *                     @OA\Property(property="can_extend", type="string", format="text", example="1"),
	 *
	 *               ),
	 *               ),
	 *     ),
	 *
	 * )
	 */

	//api to view property details
	public function viewProperty(Request $request) {
		$user = auth()->user();
		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}
		$user->last_activity = now();
		$user->save();
		$property = Property::where(['user_id' => $user->id, 'vms_property_id' => $user->property_id])->first();

		if ($user->user_type == 'agent') {
			$property = Property::where(['agent_id' => $user->id, 'vms_property_id' => $user->property_id])->first();
		}

		if ($property) {
			$data = new PropertyResource($property);
			return $this->sendResponse($data, $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/seller/update-property",
	 *     description="Api for Seller to update property detail",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"extended_date","extended_hours","additional_hours"},
	 *                   @OA\Property(property="extended_date", type="string", format="date", example="2023-01-12"),
	 *                   @OA\Property(property="extended_hours", type="string", format="text", example="10"),
	 *                   @OA\Property(property="additional_hours", type="string", format="text", example="2"),
	 *                  )
	 *             )
	 *     ),
	 *         @OA\Response(
	 *             response=101,
	 *          description="Missing parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=203,
	 *          description="Property updated successfully",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="203"),
	 *                 @OA\Property(property="message", type="string", example="Property updated successfully"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=207,
	 *          description="Cannot extend offer deadline",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="207"),
	 *                 @OA\Property(property="message", type="string", example="Cannot extend offer deadline"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *
	 * )
	 */
	//api to update property details
	public function updateProperty(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'extended_date' => 'required|date_format:Y-m-d|after:today',
			'extended_hours' => 'required',
			'additional_hours' => 'required|min:1',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$property = Property::where('vms_property_id', $user->property_id)->first();

		if ($property) {
			if ($property->history()->count() < 2 && Carbon::now() >= Carbon::parse($property->vms_end_date)->subHours(48) && Carbon::now() <= Carbon::parse($property->vms_end_date)) {
				//update old slot to Inactive
				$total_time = 18 + $request->extended_hours + $request->additional_hours;
				$property->history()->update(['status' => 'IN']);

				$property->vms_end_date = Carbon::parse($request->extended_date)->addHour($total_time);
				$property->save();

				$history = new PropertyHistory();
				$history->property_id = $property->id;
				$history->hours = $request->extended_hours;
				$history->start_date = $property->vms_start_date;
				$history->end_date = Carbon::parse($request->extended_date)->addHour($total_time);
				$history->additional_hours = $request->additional_hours;
				$history->save();

				//notify buyer
				$offers = Offers::where('property_id', $property->id)->get();

				foreach ($offers as $offer) {
					//notify
					$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
					$agent = Agent::where('id', $offer->agent_id)->get();

					$notified_users = $buyer->concat($agent);

					foreach ($notified_users as $notify_user) {
						$notify_user->notify(new InformBuyerDeadlineExtension($offer, $total_time, $notify_user));
					}
				}
				$user->last_activity = now();
				$user->save();
				return $this->sendResponse('', $this->getMessage(203));
			} else {
				if (stripos(url()->current(), 'api') === false) {
					return $this->sendError($this->getMessage(207));
				} else {
					return $this->sendResponse('', $this->getMessage(207));
				}

			}
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/seller/dashboard",
	 *     description="Api for Seller to view bid detail on dashboard",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=399,
	 *          description="No offer has been submitted",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="399"),
	 *               @OA\Property(property="message", type="string", example="No offer has been submitted"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=407,
	 *          description="You have reached at the end of Offer List",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="407"),
	 *               @OA\Property(property="message", type="string", example="You have reached at the end of Offer List"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=200,
	 *          description="Success",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="200"),
	 *                 @OA\Property(property="message", type="string", example="Success"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *                 @OA\Property(property="data", type="object",
	 *                     @OA\Property(property="id",type="string", format="text", example="32"),
	 *                     @OA\Property(property="amount", type="string", format="text", example="1100000"),
	 *                     @OA\Property(property="buyer_name", type="string", format="text", example="danial creg"),
	 *                     @OA\Property(property="start_date", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="total_pages", type="string", format="text", example="2"),
	 *
	 *               ),
	 *               ),
	 *     ),
	 *
	 * )
	 */
	//api to fetch bids
	public function dashboard(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);
		if (gettype($res) != 'boolean') {
			return $res;
		}
		// $query = DB::select("CALL GetProperyOffer('".$user->property->id."')");

		// $bids = $query->offset(($request->page - 1) * $this->pagelength)->limit($this->pagelength);
		// // $total = $query->count();
		// dd($bids);
		$query = Offers::whereIn('status', ['AC', 'SO'])->whereNull('cancelled_at')->where('property_id', $user->property->id);
		$bids = $query->offset(($request->page - 1) * $this->pagelength)->limit($this->pagelength)->get();
		$total = $query->count();
		$bids = $query->offset(($request->page - 1) * $this->pagelength)->limit($this->pagelength)->get();

		$total_pages = ceil($total / $this->pagelength);
		$user->last_activity = now();
		$user->save();
		if (!empty($bids) && $bids->count() > 0) {
			return $this->sendResponse(OfferResource::collection($bids), $this->getMessage(200), ['total_pages' => $total_pages]);
		} else {
			return $this->sendError($total_pages == 0 ? $this->getMessage(399) : $this->getMessage(407), ['total_pages' => $total_pages]);
		}
	}
	/**
	 * @OA\GET(
	 *     path="/seller/view-offer",
	 *     description="Api for Seller to view offer details",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *         @OA\Parameter(
	 *         name="id",
	 *         in="query",
	 *         description="Offer id",
	 *         required=true,
	 *      ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=399,
	 *          description="No offer has been submitted",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="399"),
	 *               @OA\Property(property="message", type="string", example="No offer has been submitted"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *                 @OA\Property(property="data", type="object",
	 *                     @OA\Property(property="total_pages",type="string", format="text", example="0"),
	 *               ),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=407,
	 *          description="You have reached at the end of Offer List",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="407"),
	 *               @OA\Property(property="message", type="string", example="You have reached at the end of Offer List"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *                 @OA\Property(property="data", type="object",
	 *                     @OA\Property(property="total_pages",type="string", format="text", example="0"),
	 *               ),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=200,
	 *          description="Success",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="200"),
	 *                 @OA\Property(property="message", type="string", example="Success"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *                 @OA\Property(property="data", type="object",
	 *                     @OA\Property(property="buyer_name",type="string", format="text", example="mickel smith"),
	 *                     @OA\Property(property="agent_name", type="string", format="text", example="jhon wick"),
	 *                     @OA\Property(property="submitted_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="offered_price", type="string", format="text", example="1100000"),
	 *                     @OA\Property(property="improved_price",type="string", format="text", example="5%"),
	 *                     @OA\Property(property="counter_price",type="string", format="text", example="1000000"),
	 *                     @OA\Property(property="email_sent",type="string", format="text", example="1"),
	 *                     @OA\Property(property="deadline",type="string", format="text", example="12-02-2023 12:02:02"),
	 *                     @OA\Property(property="agent_commission",type="string", format="text", example="100000"),
	 *                     @OA\Property(property="net_price",type="string", format="text", example="1200000"),
	 *                     @OA\Property(property="money_deposit",type="string", format="text", example="500000"),
	 *                     @OA\Property(property="down_payment",type="string", format="text", example="250000"),
	 *                     @OA\Property(property="est_mortgage",type="string", format="text", example="259999"),
	 *                     @OA\Property(property="mortgage_loan",type="string", format="text", example="800000"),
	 *                     @OA\Property(property="proof_funds",type="string", format="text", example="152300"),
	 *                     @OA\Property(property="preapproval_amount",type="string", format="text", example="300000"),
	 *                     @OA\Property(property="qualify_for",type="string", format="text", example="800000"),
	 *                     @OA\Property(property="lender",type="string", format="text", example="Robert downey - Robert lee"),
	 *                     @OA\Property(property="interest",type="string", format="text", example="2.5%"),
	 *                     @OA\Property(property="bid_per_sqfeet",type="string", format="text", example="45000"),
	 *                     @OA\Property(property="purchase_contract",type="string", format="text", example="uploads/purchase_contract/purchase-agreement.pdf"),
	 *                     @OA\Property(property="is_reviewed",type="string", format="text", example="-"),
	 *                     @OA\Property(property="financial_credentials",type="string", format="text", example="1"),
	 *                     @OA\Property(property="disclosure",type="string", format="text", example="9 Days"),
	 *                     @OA\Property(property="offer_increase",type="string", format="text", example="2%"),
	 *                     @OA\Property(property="status",type="string", format="text", example="IN"),
	 *                     @OA\Property(property="notification",type="string", format="text", example="-"),
	 *                     @OA\Property(property="minimum_offer_price",type="string", format="text", example="115000"),
	 *                     @OA\Property(property="highest_bid_amount",type="string", format="text", example="1100000"),
	 *                     @OA\Property(property="reserved_price",type="string", format="text", example="1150000"),
	 *                     @OA\Property(property="property_address", type="string", format="text", example="1/45b, jhalana, jaipur 201202"),
	 *                     @OA\Property(property="dashboard_dates", type="object",
	 *                     @OA\Property(property="email_recevied",type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="improved_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="withdrawan_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="notified_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="offer_accepted", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="financial_improved", type="string", format="text", example="12-08-2022 12:02:02"),
	 *                     @OA\Property(property="counter_on", type="string", format="text", example="12-08-2022 12:02:02"),
	 *               ),
	 *
	 *               ),
	 *
	 *               ),
	 *     ),
	 *
	 * )
	 */
	//api to fetch offer details of buyer
	public function viewOffer(Request $request) {

		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'id' => 'required',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$offer = Offers::whereIn('status', ['AC', 'SO'])->find($request->id);

		//$offer = Offers::find($request->id);

		if (isset($offer)) {
			$data = DB::select("CALL GetOfferDetail('" . $offer->id . "')")[0];
			$data->highest_bid = $offer->highest_bid;
			$data->is_offer_accepted = !empty($offer->property->sold_offer);
			$data->notification = '';
			$data->financial = '';
			$data->financials = [];
			$data->financial_improved_on = '';
			$data->financial_improved = '';
			$data->counter_price = '';
			$data->counter_on = '';

			$data->pdf = asset('uploads/offers/agreements/Purchase-Agreement-' . $offer->property->vms_property_id . '-' . $offer->id . '.pdf');
			$user->last_activity = now();
			$user->save();
			return $this->sendResponse(new OfferDetailResource($data), $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}

		// $data = Offers::whereStatus('AC')->find($request->id);

		// if (isset($data)) {
		//     $offer = DB::select("CALL GetOfferDetail('" . $request->id . "')")[0];
		//     $offer->highest_bid = $data->highest_bid;
		//     $offer->financial_improved_on = '';
		//     $offer->financial_improved = 0;
		//     $offer->counter_price = 0;
		//     $offer->counter_on = '';

		//     return $this->sendResponse(new OfferDetailResource($offer), $this->getMessage(200));
		// } else {
		//     return $this->sendError($this->getMessage(404));
		// }
	}

	/**
	 * @OA\Post(
	 *     path="/seller/optin-out",
	 *     description="Api for Seller to communicate with buyer",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"type"},
	 *                   @OA\Property(property="type", type="string", format="text", example="OPTIN/OPTOUT"),
	 *                  )
	 *             )
	 *     ),
	 *         @OA\Response(
	 *             response=101,
	 *          description="Missing parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=204,
	 *          description="Rights has been updated successfully",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="204"),
	 *                 @OA\Property(property="message", type="string", example="Rights has been updated successfully"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=501,
	 *          description="Something Went Wrong",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="501"),
	 *                 @OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=406,
	 *          description="You haven't assigned any agent for this property.",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="406"),
	 *                 @OA\Property(property="message", type="string", example="You haven't assigned any agent for this property."),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *
	 * )
	 */
	public function optinOut(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'type' => 'required|in:OPTIN,OPTOUT',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$user->optin_out = $request->type;
		$user->save();

		if ($request->type == 'OPTOUT') {
			$optin_out = 'OPTIN';
		} else {
			$optin_out = 'OPTOUT';
		}

		$agent = Agent::find($user->agent_id);

		if ($agent) {
			$agent->optin_out = $optin_out;
			$user->last_activity = now();
			$user->save();
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
	 *     path="/seller/update-offer-status",
	 *     description="Api for Seller to update offer status",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"status","offer_id"},
	 *                   @OA\Property(property="status", type="string", format="text", example="accept,reject"),
	 *                   @OA\Property(property="offer_id", type="string", format="text", example="32"),
	 *                  )
	 *             )
	 *     ),
	 *         @OA\Response(
	 *             response=101,
	 *          description="Missing parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=501,
	 *          description="Something Went Wrong",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="501"),
	 *                 @OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=205,
	 *          description="Offer status updated successfully",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="205"),
	 *                 @OA\Property(property="message", type="string", example="Offer status updated successfully"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *
	 * )
	 */

	//api to accept or reject buyer offer
	public function updateOfferStatus(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'status' => 'required|in:accept,reject',
			'offer_id' => 'required',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}
		$user->last_activity = now();
		$user->save();
		$offer = Offers::find($request->offer_id);

		if ($offer) {
			$offer->status = $request->status == 'accept' ? 'SO' : 'RJ';

			$offer->save();

			//notify
			$buyer = $offer->owner()->get();
			// $buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
			$agent = Agent::where('id', $offer->agent_id)->get();
			$notified_users = $buyer->concat($agent);

			//offerors
			$other_buyers = Offers::where(['property_id' => $offer->property_id])->whereNotIn('user_id', $buyer->pluck('id')->toArray())->get();
			// $other_buyers = Offers::where(['property_id' => $offer->property_id])->where('user_id', '!=', $user->id)->get();
			$offerors_buyers = Buyer::whereIn('id', $other_buyers->pluck('user_id'))->get();
			$offerors_agents = Agent::whereIn('id', $other_buyers->pluck('agent_id'))->get();
			$offerors = $offerors_buyers->concat($offerors_agents);

			//inform buyer
			if ($request->status == 'accept') {
				$offer->property->status = 'SO';
				$offer->property->save();

				foreach ($notified_users as $notify_user) {
					$notify_user->notify(new InformBuyerOfferAcceptance($offer, $notify_user));
				}

				//inform other offeror
				foreach ($offerors as $offeror) {
					$offeror->notify(new InformOfferClosed($offer->property_id, $offeror));
				}
			} else {
				foreach ($notified_users as $notify_user) {
					$notify_user->notify(new InformBuyerOfferRejection($offer, $notify_user));
				}
			}

			return $this->sendResponse('', $this->getMessage(205));
		} else {
			return $this->sendError($this->getMessage(501));
		}
	}
	/**
	 * @OA\Post(
	 *     path="/seller/counter-offer",
	 *     description="Api for Seller to update counter offer",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"amount","offer_id","close_of_escrow","inspection","loan_contingency","escrow_company","contact_info","escrow_officer","other_terms","tnc","multiple_counter"},
	 *                   @OA\Property(property="amount", type="string", format="text", example="112000"),
	 *                   @OA\Property(property="offer_id", type="string", format="text", example="32"),
	 *                   @OA\Property(property="close_of_escrow", type="string", format="text", example="10"),
	 *                   @OA\Property(property="inspection", type="string", format="text", example="10"),
	 *                   @OA\Property(property="loan_contingency", type="string", format="text", example="10"),
	 *                   @OA\Property(property="escrow_company", type="string", format="text", example="DOMA"),
	 *                   @OA\Property(property="contact_info", type="string", format="text", example="1234567890"),
	 *                   @OA\Property(property="escrow_officer", type="string", format="text", example="khristina berquist"),
	 *                   @OA\Property(property="other_terms", type="string", format="text", example="other tearms"),
	 *                   @OA\Property(property="tnc", type="string", format="text", example="1"),
	 *                   @OA\Property(property="multiple_counter", type="string", format="text", example="0"),
	 *                  )
	 *             )
	 *     ),
	 *         @OA\Response(
	 *             response=101,
	 *          description="Missing parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=501,
	 *          description="Something Went Wrong",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="501"),
	 *                 @OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=209,
	 *          description="Counter offer details sent successfully to buyer",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="209"),
	 *                 @OA\Property(property="message", type="string", example="Counter offer details sent successfully to buyer"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *
	 * )
	 */
	//api to update counter offer
	public function counterOfferUpdate(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'amount' => "required",
			'offer_id' => "required",
			'close_of_escrow' => "required",
			'inspection' => "required",
			'loan_contingency' => "required",
			'escrow_company' => "required",
			'contact_info' => "required",
			'escrow_officer' => "required",
			'other_terms' => "required",
			'tnc' => "required",
			'multiple_counter' => "required",
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		if ($user->user_type == 'agent') {
			$offer_update_user_id = $user->property->seller->id;
		} else {
			$offer_update_user_id = $user->id;
		}

		$data = CounterOffer::where(['offer_id' => $request->offer_id, 'user_id' => $offer_update_user_id]);

		if ($data->exists()) {
			$data->update(['status' => 'IN']);
		}

		$counter = new CounterOffer;

		if ($user->user_type == 'agent') {
			$counter->user_id = $user->property->seller->id;
		} else {
			$counter->user_id = $user->id;
		}

		$counter->offer_id = $request->offer_id;
		$counter->amount = $request->amount;
		$counter->close_of_escrow = $request->close_of_escrow;
		$counter->inspection = $request->inspection;
		$counter->loan_contingency = $request->loan_contingency;
		$counter->escrow_company = $request->escrow_company;
		$counter->escrow_number = $request->contact_info;
		$counter->escrow_officer = $request->escrow_officer;
		$counter->other_terms = $request->other_terms;
		$counter->multiple_counter = $request->multiple_counter;
		$counter->tnc = $request->tnc;
		$counter->save();

		$offer = Offers::find($request->offer_id);

		//notify
		$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
		$agent = Agent::where('id', $offer->agent_id)->get();
		$notified_users = $buyer->concat($agent);
		foreach ($notified_users as $notify_user) {
			$notify_user->notify(new InformCounterOffer($counter, $user->user_type, $notify_user));
		}

		$code = 209;
		$user->last_activity = now();
		$user->save();
		return $this->sendResponse('', $this->getMessage($code));
	}

	//api to contact buyer
	// public function offerInterest(Request $request) {
	//     $user = auth()->user();

	//     $res = $this->checkUserActive($user);

	//     if (gettype($res) != 'boolean') {
	//         return $res;
	//     }

	//     $validate = Validator::make($request->all(), [
	//         'type' => 'required|in:text,email,phone',
	//         'time' => "required_if:type,==,phone",
	//         'offer_id' => "required",
	//     ]);

	//     if ($validate->fails()) {
	//         return $this->sendError($validate->errors()->first(), $this->getMessage(101));
	//     }

	//     $offer = Offers::whereStatus('AC')->find($request->offer_id);

	//     if ($offer) {
	//         $interest = new OfferInterest;
	//         $interest->user_id = $user->id;
	//         $interest->offer_id = $request->offer_id;
	//         $interest->type = $request->type;
	//         $interest->time = $request->time;
	//         $interest->save();

	//         return $this->sendResponse('', $this->getMessage(200));
	//     } else {
	//         return $this->sendError($this->getMessage(399));
	//     }
	// }

	/**
	 * @OA\Post(
	 *     path="/seller/notify-offer-interest",
	 *     description="Api for Seller to notify offer intrest",
	 *     tags={"Seller"},
	 *        security={{"bearerAuth":{}}},
	 *        @OA\Server(
	 *             url=L5_SWAGGER_SELLER_CONST_HOST,
	 *          description="API Server for Seller"
	 *        ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 *                     required={"offer_id"},
	 *                   @OA\Property(property="offer_id", type="string", format="text", example="32"),
	 *                  )
	 *             )
	 *     ),
	 *         @OA\Response(
	 *             response=101,
	 *          description="Missing parameters",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="101"),
	 *               @OA\Property(property="message", type="string", example="Missing parameters"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=400,
	 *          description="User not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="400"),
	 *               @OA\Property(property="message", type="string", example="User not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=404,
	 *          description="Data not found",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="404"),
	 *               @OA\Property(property="message", type="string", example="Data not found"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=403,
	 *          description="Your account is not activated. Please contact administrator",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="403"),
	 *               @OA\Property(property="message", type="string", example="Your account is not activated. Please contact administrator"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *        @OA\Response(
	 *             response=401,
	 *          description="Account is not verified",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=false),
	 *               @OA\Property(property="status", type="number",example="401"),
	 *               @OA\Property(property="message", type="string", example="Account is not verified"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=501,
	 *          description="Something Went Wrong",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="501"),
	 *                 @OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=200,
	 *          description="Success",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="200"),
	 *                 @OA\Property(property="message", type="string", example="Success"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *         @OA\Response(
	 *             response=399,
	 *          description="No offer has been submitted",
	 *             @OA\JsonContent(
	 *                 @OA\Property(property="success", type="boolean",example=true),
	 *               @OA\Property(property="status", type="number",example="399"),
	 *                 @OA\Property(property="message", type="string", example="No offer has been submitted"),
	 *               @OA\Property(property="is_property_live", type="boolean", example=true),
	 *               @OA\Property(property="is_offer_live", type="boolean", example=true),
	 *               ),
	 *     ),
	 *
	 * )
	 */

	public function notifyOfferInterest(Request $request) {
		$user = auth()->user();
		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'offer_id' => "required",
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}
		$user->last_activity = now();
		$user->save();
		$offer = Offers::whereStatus('AC')->find($request->offer_id);
		if ($offer) {
			//send notification
			$buyer = $offer->owner()->where('optin_out', '!=', 'OPTOUTMODE2')->get();
			$agent = Agent::where('id', $offer->agent_id)->get();
			$notified_users = $buyer->concat($agent);

			foreach ($notified_users as $notify_user) {
				$notify_user->notify(new InformBuyerOfferInterest($offer->owner, $notify_user));
			}

			return $this->sendResponse('', $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(399));
		}
	}
}
