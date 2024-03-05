<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\BuyerResource;
use App\Http\Resources\SellerResource;
use App\Models\Agent;
use App\Models\Buyer as User;
use App\Models\Cms;
use App\Models\DocumentVerification;
use App\Models\FinancialCredential;
use App\Models\Offers;
use App\Models\Otp;
use App\Models\Property;
use App\Notifications\InformBuyerIncompleteOffer;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Validator;

class ApiController extends BaseController {
	use ResponseMessages, Helper;

	/**
	 * @OA\Post(
	 *     path="/login",
	 *     description="Api to create new user/login user - send otp for verification",
	 *     tags={"Account"},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"property_id","mobile_number","user_type"},
	 *       			@OA\Property(property="property_id", type="string", format="text", example="VMS100"),
	 *       			@OA\Property(property="mobile_number", type="string", format="text", example="9547812306"),
	 *       			@OA\Property(property="user_type", type="string",  format="text", example="buyer/seller/agent" ),
	 *       			@OA\Property(property="email_id", type="string",  format="text", example="charlie@gmail.com"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Please enter valid Property ID"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=405,
	 *          description="Your account is blocked please contact to administrator",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="405"),
	 *       		@OA\Property(property="message", type="string", example="Your account is blocked please contact to administrator"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=403,
	 *          description="Access Forbidden",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="403"),
	 *       		@OA\Property(property="message", type="string", example="Access Forbidden"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=408,
	 *          description="You must withdraw your current running offer in order to join a new property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="408"),
	 *       		@OA\Property(property="message", type="string", example="You must withdraw your current running offer in order to join a new property."),
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
	 *       		@OA\Property(property="message", type="string", example="OTP sent to your mobile number. Please verify"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="otp",type="integer",example="4256"),
	 *             		@OA\Property(property="timer", type="integer", example="300"),
	 *       		),
	 * 	  		),
	 *     ),
	 * )
	 */

	// api to create new user/login user - send otp for verification
	public function login(Request $request) {
		$validate = Validator::make($request->all(), [
			'property_id' => [
				'required',
				Rule::exists('property', 'vms_property_id')->where('status', 'AC'),
			],
			'mobile_number' => 'required|numeric|digits:10',
			'user_type' => 'required|in:buyer,seller,agent',
			'email_id' => 'nullable|regex:/(.+)@(.+)\.(.+)/i',
		], [
			'property_id.exists' => 'Please enter valid Property ID',
			'user_type.in' => 'Select as buyer, seller or agent only',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$is_blocked = User::where(['phone_no' => $request->mobile_number, 'user_type' => $request->user_type])->whereNotIn('status', ['1'])->exists();

		if ($is_blocked) {
			return $this->sendError($this->getMessage(405), [], 405);
		}
		$user = User::where(['property_id' => $request->property_id, 'phone_no' => $request->mobile_number])->first();

		if (isset($user->id) && $user->user_type != $request->user_type) {
			return $this->sendError($this->getMessage(410));
		}

		$user = User::where(['property_id' => $request->property_id, 'user_type' => $request->user_type, 'phone_no' => $request->mobile_number])->first();

		$property = Property::where('vms_property_id', $request->property_id)->first();

		if (!isset($property->id)) {
			return $this->sendError($this->getMessage(411), [], 411);
		}

		if ($request->user_type == 'buyer' && $property->vms_start_date > date('Y-m-d H:i:s')) {
			return $this->sendError($this->getMessage(413), [], 413);
		}

		if (isset($user->id)) {
			$user->email_id = $request->email_id;
			$user->save();

			if (isset($request->account_id) && !empty($user->account_id) && $user->account_id != $request->account_id) {

				return $this->sendError($this->getMessage(414), [], 403);
			}
			/*if ($user->user_type == 'seller') {
					if ($user->property_id != $property->vms_property_id) {
						return $this->sendError($this->getMessage(403), [], 403);
					}
				}
			*/
			$offer = Offers::wherePropertyId($property->id)->where(function ($q) use ($user) {
				$q->whereUserId($user->id)->orWhere('agent_id', $user->id);
			})->first();
			if (isset($offer->id) && !empty($offer->cancelled_at)) {
				return $this->sendError($this->getMessage(412), [], 412);
			}

		} else {
			if (in_array($request->user_type, ['seller', 'agent'])) {
				return $this->sendError($this->getMessage(411), [], 411);
			}

			if ($request->user_type == 'buyer') {
				$buyer = User::where(['user_type' => 'buyer', 'phone_no' => $request->mobile_number])->first();
				if (isset($buyer->id) && $buyer->property_id != $property->vms_property_id && isset($buyer->offer) && ($buyer->offer()->whereIn('status', ['PN', 'AC', 'IN', 'RJ', 'DCIN', 'FCIN']) && $buyer->offer()->whereNull('cancelled_at'))) {
					return $this->sendError($this->getMessage(408), [], 408);
				}
			}
		}

		if ($request->user_type == 'buyer') {
			$seller = User::find($property->user_id);
			if ($seller->phone_no == $request->mobile_number) {
				return $this->sendError($this->getMessage(409), [], 403);
			}

		}

		if (!isset($user->id)) {
			$user = new User;
			$user->phone_no = $request->mobile_number;
			$user->property_id = $request->property_id;
			$user->email_id = $request->email_id;
			$user->user_type = $request->user_type;
			$user->save();
		}

		$otp = $this->generateOtp($user->id, $request->mobile_number);
		/*if (stripos($request->URL(), 'api') == false) {
			$test = auth()->guard('web')->login($user);
		}*/
		if (gettype($otp) == 'boolean') {
			return $this->sendError($this->getMessage(405), [], 405);
		}

		$data = ['otp' => $otp->otp, 'timer' => intval($this->getSetting('otp_timer'))];
		return $this->sendResponse($data, $this->getMessage(102));
	}

	// api to resend otp for verification (NO USE)
	// public function resendOtp(Request $request)
	// {
	//     $validate = Validator::make($request->all(), [
	//         'mobile_number' => 'required',
	//         'property_id' => 'required',
	//     ]);

	//     if ($validate->fails()) {
	//         return $this->sendError($validate->errors()->first(), $this->getMessage(101));
	//     }

	//     $user = User::where(['property_id' => $request->property_id , 'phone_no' => $request->mobile_number])->where('status', '1')->first();

	//     $res = $this->checkUserActive($user, 'resend');
	//     if (gettype($res) != 'boolean') {
	//         return $res;
	//     }

	//     $otp = $this->generateOtp($user->id, $request->mobile_number);

	//     if (gettype($otp) == 'boolean') {
	//         return $this->sendError($this->getMessage(405), [], 405);
	//     }

	//     $user = $this->formatData($user);
	//     $data = ['otp' => $otp->otp, 'timer' => intval($this->getSetting('otp_timer'))];
	//     return $this->sendResponse($data, $this->getMessage(102));

	// }

	/**
	 * @OA\Post(
	 *     path="/verify-otp",
	 *     description="Api to verify OTP for user to login",
	 *     tags={"Account"},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"property_id","mobile_number","user_type","otp"},
	 *       			@OA\Property(property="property_id", type="string", format="text", example="VMS100"),
	 *       			@OA\Property(property="mobile_number", type="string", format="text", example="9547812306"),
	 *       			@OA\Property(property="user_type", type="string",  format="text", example="buyer/seller/agent" ),
	 *       			@OA\Property(property="device_id", type="string",  format="text", example="fvsdf7sg8dgs8dfgs8d"),
	 *       			@OA\Property(property="device_type", type="string",  format="text", example="'ios'/'android'/'pc/laptop'"),
	 *       			@OA\Property(property="device_token", type="string",  format="text", example="sbsbgsyvn7835nt4873tvn8478c45yt78c5tvg875nyhfvn"),
	 *       			@OA\Property(property="otp", type="integer", example="9845"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Please enter valid Property ID"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
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
	 *     		response=501,
	 *          description="Something Went Wrong",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="501"),
	 *       		@OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=201,
	 *          description="Incorrect OTP. Please input correct OTP",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="201"),
	 *       		@OA\Property(property="message", type="string", example="Incorrect OTP. Please input correct OTP"),
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
	 *       		@OA\Property(property="message", type="string", example="OTP sent to your mobile number. Please verify"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 				@OA\Property(property="data", type="object",
	 *             		@OA\Property(property="id",type="integer",example="4256"),
	 *             		@OA\Property(property="mobile_verified", type="integer", example="300"),
	 *             		@OA\Property(property="property_id", type="string", format="text", example="VMS100"),
	 *             		@OA\Property(property="property_status", type="string", format="text", example="AC"),
	 *             		@OA\Property(property="first_name", type="string", format="text", example="Charlie"),
	 *             		@OA\Property(property="last_name", type="string", format="text", example="Brown"),
	 *             		@OA\Property(property="email", type="string", format="text", example="charlie@gmail.com"),
	 *             		@OA\Property(property="mobile", type="string", format="text", example="9658741203"),
	 *             		@OA\Property(property="status", type="string", format="text", example="1"),
	 *             		@OA\Property(property="user_type", type="string", format="text", example="buyer"),
	 *             		@OA\Property(property="access_token", type="string", format="text", example="eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiIxIiwianRpIjoiYzNmMDg0YmI3NDhkYzkyNDBjYTM3OThhZDcxZTRhMmZiZjQxZjQ2ZTQzNTIwOWRhOTg2NmY0Y2U4NzY3NTA2Y2JlYjQyOWE3YjkyZDkzODEiLCJpYXQiOjE2NTk3MDg1MDcsIm5iZiI6MTY1OTcwODUwNywiZXhwIjoxNjkxMjQ0NTA3LCJzdWIiOiIxNSIsInNjb3BlcyI6W119.Pw_l4Ogmh0wUGqj3ZfyNOCa6RbhjnYJ3KA9XttVGUPwuWMjNTYJTu860wCEN51ASmJlFYYA_fQDViFkce3VJZTCk9RoEiyVs0sF7vRmvYkY5lVjLmMph31m-tJurafCm1mgj4g72b0onkYTe964BO-gvYTA1GnJkTGAd7RrQYcxHyWOTRkd3XKXGxIE2Dz_hHn7nCE-5ZzalIDyFdxw29lDX7LYxhEXexRVq85YsCVtMiL2OKc2U-Q02giRYitnTE9g6V-CDQlmut5DbWCRBx3zkoxKer2q882MUDQgj25lehykmUceRMuKoJQvGr1t447LCgsirxScvChIQ1mUmBAt5ocG_3bm9d4HziA1yxMa7-xlivMKz6EiGPhcNBLDcYHpiaZ3rQQbL5Qools4att8yVT-aS9cKRJKZNqPHZT2wwPIh6eiI1i7Px032FAYu4jhLiLUOxmvbX5sJzGMiQtUfCfV5JoayXDzoP2oOkZeAWJ2vCq4nlwcOthyaPKiE9t8fnKYcD4QVvhTsSZsgqt9nEJjiSl6Gux2fN3P4X8HkIl_JovAXARzqPdwnlFUth36XdXbLRby3K2EbAPN1q9a4fNRmRPTpZjbAHNNqYZENESo8xQ76eq_8dBJWqCIYlkCjPmcTrA1xlxb9lBrTd0R56aMCQwhZh7hrq0NY0aA"),
	 *             		@OA\Property(property="monitoring_control", type="string", format="text", example="OPTIN"),
	 *             		@OA\Property(property="my_offer", type="boolean", example=false),
	 *             		@OA\Property(property="transaction", type="boolean", example=false),
	 *             		@OA\Property(property="strategy", type="boolean", example=false),
	 *             		@OA\Property(property="timings", type="boolean", example=false),
	 *             		@OA\Property(property="doc_verification", type="boolean", example=false),
	 *             		@OA\Property(property="items_include_exclude", type="boolean", example=false),
	 *             		@OA\Property(property="cost_allocation", type="boolean", example=false),
	 *             		@OA\Property(property="summary", type="boolean", example=false),
	 *             		@OA\Property(property="financial_credentials", type="integer", example="0"),
	 *       		),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function verifyOtp(Request $request) {
		$validate = Validator::make($request->all(), [
			'property_id' => 'required',
			'mobile_number' => 'required',
			'user_type' => 'required',
			'device_id' => 'nullable',
			'device_type' => 'nullable',
			'device_token' => 'nullable',
			'otp' => 'required',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$user = User::where(['property_id' => $request->property_id, 'phone_no' => $request->mobile_number, 'user_type' => $request->user_type])->where('status', '1')->first();

		$res = $this->checkUserActive($user, 'verify');
		if (gettype($res) != 'boolean') {
			return $res;
		}

		if (Otp::where('user_id', $user->id)->where('mobile_number', $request->mobile_number)->whereOtp($request->otp)->whereStatus('AC')->count() > 0) {

			if (isset($request->account_id)) {
				$user->account_id = $request->account_id;
				$user->save();
			}
			if (empty($user->mobile_verified_at)) {
				$user->mobile_verified_at = Carbon::now();
				$user->save();

			}

			$loguser = User::find($user->id);
			if (isset($loguser->id)) {

				$this->saveUserDevice($loguser->id, $request->device_id, $request->device_type, $request->device_token);

				if (stripos($request->URL(), 'api') === false) {
				} else {
					$loguser->logtoken = $loguser->createToken(env('APP_NAME') . ' Login')->accessToken;
				}
				$loguser = $this->formatData($loguser);

				//send email
				$data = [
					'role' => $loguser->user_type,
					'name' => 'Member',
				];

				if (stripos($request->URL(), 'api') === false) {
					$test = auth()->guard('web')->login($user);
				} else {
					// $loguser->notify(new WelcomeMail($data));
				}

				if ($loguser->user_type == 'buyer') {
					$data = new BuyerResource($loguser);
				} elseif ($loguser->user_type == 'agent') {
					$loguser = Agent::find($loguser->id);
					$loguser->logtoken = $loguser->createToken(env('APP_NAME') . ' Login')->accessToken;

					if (User::where('agent_id', $loguser->id)->whereUserType('seller')->exists()) {
						$loguser->user_type = 'seller-agent';
						$data = new SellerResource($loguser);
					} elseif (User::where('agent_id', $loguser->id)->whereUserType('buyer')->exists()) {
						$loguser->user_type = 'buyer-agent';
						$data = new BuyerResource($loguser);
					}
				} else {
					$data = new SellerResource($loguser);
				}

				return $this->sendResponse($data, $this->getMessage(104));
			} else {
				return $this->sendError($this->getMessage(501), [], 501);
			}
		} else {
			return $this->sendError($this->getMessage(103), [], 201);
		}
	}

	/**
	 * @OA\Post(
	 *     path="/get-content",
	 *     description="Api to get CMS Content",
	 *     tags={"Account"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"type"},
	 *       			@OA\Property(property="type", type="string", format="text", example="user-agreement/buyer-advisory"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Please enter valid value for type"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
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
	 *     		response=501,
	 *          description="Something Went Wrong",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="501"),
	 *       		@OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=201,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="201"),
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
	 *       		@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="data", type="string", example="<h1>User Agreement</h1>"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function getContent(Request $request) {
		$user = auth()->user();

		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$validate = Validator::make($request->all(), [
			'type' => 'required|in:user-agreement,buyer-advisory',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$cms = Cms::where(['slug' => $request->type])->first();
		$data = html_entity_decode($cms->content);

		if (isset($cms)) {
			return $this->sendResponse($data, $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}

	/**
	 * @OA\Post(
	 *     path="/get-license",
	 *     description="Api to fetch Agent's license Number if mobile number is already registered",
	 *     tags={"Account"},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"mobile_number"},
	 *       			@OA\Property(property="mobile_number", type="string", format="text", example="9874512630"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Missing Parameters",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Please enter valid value for type"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters"),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=201,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="201"),
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
	 *       		@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="data", type="string", example="LIC123456"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	//api to fetch agent license no.
	public function getLicense(Request $request) {
		// $user = auth()->user();
		// $res = $this->checkUserActive($user);

		// if (gettype($res) != 'boolean') {
		// 	return $res;
		// }

		$validate = Validator::make($request->all(), [
			'mobile_number' => 'required',
		]);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$agent = Agent::where('user_type', 'agent')->where('phone_no', $request->mobile_number)->first();

		if (isset($agent->phone_no)) {
			return $this->sendResponse($agent->license_no, $this->getMessage(200));
		} else {
			return $this->sendError($this->getMessage(404));
		}
	}

	/**
	 * @OA\GET(
	 *     path="/get-survey-data",
	 *     description="Api to get list of survey types",
	 *     tags={"Account"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 *       		@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="data", type="object",
	 * 					@OA\Property(property="frictions",type="string",example="frictions"),
	 *             		@OA\Property(property="a_better_way", type="string", example="A better way"),
	 *             		@OA\Property(property="user_friendly", type="string", example="User Friendly")
	 * 				),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function surveyType() {
		$survey_types = config()->get('constants.survey_type');
		return $this->sendResponse($survey_types, $this->getMessage(200));
	}

	public function updateLicense() {
		$offers = Offers::whereNotNull('agent_id')->pluck('buyer_agent_license', 'agent_id')->toArray();

		$properties = Property::whereNotNull('agent_id')->pluck('agent_license', 'agent_id')->toArray();

		foreach ($offers as $key => $value) {
			User::where('id', $key)->update(['license_no' => $value]);
		}

		foreach ($properties as $key => $property) {
			User::where('id', $key)->update(['license_no' => $property]);
		}
	}

	/**
	 * @OA\GET(
	 *     path="/get-monitoring-details",
	 *     description="Api to get user's current Controlling Mode (Opt In/Opt Out)",
	 *     tags={"Account"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="Success",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 *       		@OA\Property(property="message", type="string", example="Success"),
	 *       		@OA\Property(property="data", type="string", example="OPTIN"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function getMonitoringDetails() {
		$user = auth()->user();
		$res = $this->checkUserActive($user);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		return $this->sendResponse($user->optin_out, $this->getMessage(200));
	}

	public function notify() {
		try {
			$offer = Offers::find(40);
			if ($offer) {
				$doc = DocumentVerification::where('offer_id', $offer->id)->update(['status' => $offer->status]);

				$fcstatus = FinancialCredential::where('offer_id', $offer->id)->whereIn('status', ['IN', 'PN'])->count();

				$offer->owner->notify(new InformBuyerIncompleteOffer($offer, 1, 'proof_funds'));
			}
		} catch (\Exception $ex) {
			dd($ex);
		}

	}

	/**
	 * @OA\Post(
	 *     path="/logout",
	 *     description="Api to logout user",
	 *     tags={"Account"},
	 * 	   security={{"bearerAuth":{}}},
	 * 	   @OA\Server(
	 *     		url=L5_SWAGGER_CONST_HOST,
	 *      	description="API Server for All Usertypes"
	 * 	   ),
	 *     @OA\RequestBody(
	 *          @OA\MediaType(
	 *              mediaType="multipart/form-data",
	 *               @OA\Schema(
	 * 					required={"device_id","device_type","device_token"},
	 *       			@OA\Property(property="device_id", type="string", format="text", example="svjbajhvq34jkbjrhvbjfdvfhv"),
	 *       			@OA\Property(property="device_type", type="string", format="text", example="'ios'/'android'/'pc/laptop'"),
	 *       			@OA\Property(property="device_token", type="string", format="text", example="sdkfjvbjhkbg4jh34br2j4hbfwj3hkbvq34jhwjkefb4jh34ejwb34vk4jhebg"),
	 * 				 )
	 * 			)
	 *     ),
	 * 	   @OA\Response(
	 *     		response=404,
	 *          description="Missing Parameters/You haven't assigned any agent for this property.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="404"),
	 *       		@OA\Property(property="message", type="string", example="Device ID key is missing"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 *       		@OA\Property(property="data", type="string", example="Missing Parameters/You haven't assigned any agent for this property."),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
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
	 *     		response=501,
	 *          description="Something Went Wrong",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="501"),
	 *       		@OA\Property(property="message", type="string", example="Something Went Wrong"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=201,
	 *          description="Data not found",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=false),
	 *       		@OA\Property(property="status", type="number",example="201"),
	 *       		@OA\Property(property="message", type="string", example="Data not found"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * 	   @OA\Response(
	 *     		response=200,
	 *          description="You are logged out from the app.",
	 * 			@OA\JsonContent(
	 * 				@OA\Property(property="success", type="boolean",example=true),
	 *       		@OA\Property(property="status", type="number",example="200"),
	 *       		@OA\Property(property="message", type="string", example="You are logged out from the app."),
	 *       		@OA\Property(property="data", type="object"),
	 *       		@OA\Property(property="is_property_live", type="boolean", example=true),
	 *       		@OA\Property(property="is_offer_live", type="boolean", example=true),
	 * 	  		),
	 *     ),
	 * )
	 */

	public function logout(Request $request) {
		$loguser = auth()->user();

		$res = $this->checkUserActive($loguser);
		if (gettype($res) != 'boolean') {
			return $res;
		}

		$rules = [
			'device_id' => 'required',
			'device_type' => 'required',
			'device_token' => 'required',
		];

		$validate = Validator::make($request->all(), $rules);

		if ($validate->fails()) {
			return $this->sendError($validate->errors()->first(), $this->getMessage(101));
		}

		$res = $this->checkUserDevice($loguser->id, $request->device_id, $request->device_type, $request->device_token);

		if (gettype($res) != 'boolean') {
			return $res;
		}

		$this->logoutUserDevice($loguser->id, $request->device_id, $request->device_type, $request->device_token);
		auth()->user()->token()->revoke();

		return $this->sendResponse([], $this->getMessage(105));
	}
}