<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller as Controller;
use App\Models\UserDevice;
use App\Traits\ResponseMessages;

class BaseController extends Controller {
	use ResponseMessages;
	/**
	 * @OA\Info(
	 *      version="1.0.0",
	 *      title="Laravel OpenApi Demo Documentation",
	 *      description="L5 Swagger OpenApi description",
	 *      @OA\Contact(
	 *          email="admin@admin.com"
	 *      ),
	 *      @OA\License(
	 *          name="Apache 2.0",
	 *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
	 *      )
	 * )
	 *
	 * @OA\SecurityScheme(
	 * 		securityScheme="bearerAuth",
	 *  	type="https",
	 *  	type="http",
	 *  	scheme="bearer",
	 * ),
	* @OA\Tag(
	 *     name="Account",
	 *     description=""
	 * )
	 * @OA\Tag(
	 * 		name = "Buyer",
	 * 		description=""	
	 * )
	 * @OA\Tag(
	 * 		name = "Seller",
	 * 		description=""
	 * )
	 */

	protected $pagelength = 21;
	protected $list_pagelength = 10;
	/**
	 * success response method.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendResponse($result, $message, $extradata = [], $status = 200) {
		$auth_user = auth()->user();
		$property_status = true;
		$offer_status = true;

		if (isset($auth_user) && $auth_user->user_type == 'buyer') {
			$property_status = in_array($auth_user->property->status, ['SO', 'EP']) ? false : true;
			$offer_status = isset($auth_user->offer) && in_array($auth_user->offer->status, ['SO', 'EP']) ? false : true;
		}

		$response = [
			'success' => true,
			'data' => $result,
			'message' => $message,
			'status' => $status,
			'is_property_live' => $property_status,
			'is_offer_live' => $offer_status,
		];

		$response = array_merge($response, $extradata);

		return response()->json($response, 200);
	}

	/**
	 * return error response.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function sendError($error, $errorMessages = [], $code = 404) {
		$auth_user = auth()->user();
		$property_status = true;
		$offer_status = true;

		if (isset($auth_user) && $auth_user->user_type == 'buyer') {
			$property_status = in_array($auth_user->property->status, ['SO', 'EP']) ? false : true;
			$offer_status = isset($auth_user->offer) && in_array($auth_user->offer->status, ['SO', 'EP']) ? false : true;
		}

		$response = [
			'success' => false,
			'message' => $error,
			'status' => $code,
			'is_property_live' => $property_status,
			'is_offer_live' => $offer_status,
		];

		if (!empty($errorMessages)) {
			$response['data'] = $errorMessages;
		}

		return response()->json($response, $code);
	}

	public function formatData($data) {

		foreach ($data as $key => &$value) {
			$data->{$key} = ($value == null) ? (gettype($value) == 'boolean' ? 0 : (stripos(gettype($value), 'int') !== false ? 0 : '')) : $value;

			if (gettype($data->{$key}) == 'string' && stripos($data->{$key}, 'http:') !== false) {
				$val = $data->{$key};
				$data->{$key} = str_replace('http:', 'https:', $val);
			}

			if (gettype($data->{$key}) == 'string' && stripos($data->{$key}, 'uploads') !== false) {
				$data->{$key} = asset($data->{$key});
			}
		}
		return $data;
	}

	public function formatResourceData($data) {

		foreach ($data->toArray() as $key => &$value) {
			$data->{$key} = ($value == null) ? (gettype($value) == 'boolean' ? 0 : (stripos(gettype($value), 'int') !== false ? 0 : '')) : $value;

			if (gettype($data->{$key}) == 'string' && stripos($data->{$key}, 'http:') !== false) {
				$val = $data->{$key};
				$data->{$key} = str_replace('http:', 'https:', $val);
			}

			if (gettype($data->{$key}) == 'string' && stripos($data->{$key}, 'uploads') !== false) {
				$data->{$key} = asset($data->{$key});
			}
		}
		return $data;
	}

	public function checkUserActive($user, $api = null) {
		if (!isset($user->id)) {
			return $this->sendError($this->getMessage(400));
		}

		if ($user->status != '1') {
			return $this->sendError($this->getMessage(502), [], 403);
		}
		if (empty($api)) {
			if (empty($user->mobile_verified_at)) {
				return $this->sendError($this->getMessage(401), [], 403);
			}
		}
		return true;
	}

	public function saveUserDevice($id, $deviceid, $devicetype, $devicetoken) {
		$device = UserDevice::where([
			'user_id' => $id,
			'device_id' => $deviceid,
			'status' => 'AC',
		])->first();

		if (!isset($device->id)) {
			$device = new UserDevice;
			$device->user_id = $id;
		}

		$device->device_id = $deviceid;
		$device->device_type = $devicetype;
		$device->device_token = $devicetoken;
		$device->save();
	}

	public function logoutUserDevice($id, $deviceid, $devicetype, $devicetoken) {
		UserDevice::where([
			'user_id' => $id,
			'device_id' => $deviceid,
			'device_token' => $devicetoken,
			'device_type' => $devicetype,
			'status' => 'AC',
		])->update(['status' => 'DL']);
	}

	public function checkUserDevice($id, $deviceid, $devicetype, $devicetoken) {
		$device = UserDevice::where([
			'user_id' => $id,
			'device_id' => $deviceid,
			'device_token' => $devicetoken,
			'device_type' => $devicetype,
			'status' => 'AC',
		])->first();

		if (!isset($device->id)) {
			return $this->sendError($this->getMessage(406));
		}
		return true;
	}
}