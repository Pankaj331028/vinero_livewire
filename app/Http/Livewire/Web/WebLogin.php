<?php

namespace App\Http\Livewire\Web;

use App\Models\Otp;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Component;

class WebLogin extends Component {
	use ResponseMessages, Helper;

	public $property_button = false;
	public $hidden;
	public $property_id;
	public $email_id;
	public $mobile_number;
	public $user_type;
	public $seconds;
	public $device_id;
	public $olduser_type;
	public $device_type;
	public $device_token;
	public $otp;
	public $timer = null;
	public $rules = [];
	protected $messages = [];

	public function rules() {
		$rules = [
			'property_id' => [
				'required',
				Rule::exists('property', 'vms_property_id')->where('status', 'AC'),
			],
			'mobile_number' => 'required|numeric',
			'user_type' => 'required|in:buyer,seller,agent',
			'email_id' => 'required|regex:/(.+)@(.+)\.(.+)/i',
		];

		return $rules;
	}

	public function messages() {

		$messages['property_id.required'] = 'Property ID cannot be left blank';
		$messages['mobile_number.required'] = 'Phone number cannot be left blank';
		$messages['email_id.required'] = 'Email address cannot be left blank';
		$messages['user_type.required'] = 'Please select your user type';
		$messages['property_id.exists'] = 'Please enter valid Property ID';
		$messages['user_type.in'] = 'Select as buyer, seller or agent only';
		return $messages;

	}

	public function render() {
		return view('livewire.web.web-login');
	}

	public function updated($name) {
		$this->validateOnly($name);

		$val = $this->user_type;
		if ($val == 'seller') {
			$this->property_button = true;
		} else {
			$this->property_button = false;
		}

		if ($name == 'user_type' && $this->olduser_type != '' && $this->user_type != $this->olduser_type) {
			$this->property_id = '';
			$this->email_id = '';
			$this->mobile_number = '';
			$this->otp = '';
			$this->hidden = 0;
		}

		$this->olduser_type = $this->user_type;
	}

	public function sendOtp(Request $request) {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());

		$request->merge(['property_id' => $this->property_id,
			'mobile_number' => $this->mobile_number,
			'email_id' => $this->email_id,
			'user_type' => $this->user_type]);
		$result = app('App\Http\Controllers\Api\ApiController')->login($request);
		$data = $result->getData();
		if ($result->getData()->status == 200) {
			$this->dispatchBrowserEvent('startTimer', $this->timer);
			session()->flash('success', $this->getMessage(102) . ' . Your OTP is ' . $data->data->otp);
			$this->hidden = 1;
			return redirect()->back();
		} else {
			session()->flash('error', $data->message);
		}

	}

	// public function resendOtp(Request $request)
	// {

	//     $validatedData = $this->validate([
	//         'property_id' => 'required',
	//         'mobile_number' => 'required',
	//         'user_type' => 'required',
	//     ]);

	//     // if ($validate->fails()) {
	//     //     return $this->sendError($validate->errors()->first(), $this->getMessage(101));
	//     // }
	//     $this->dispatchBrowserEvent('error-result');
	//     //$this->validate($this->getRules(), $this->getMessages());

	//     $user = User::where(['property_id' => $this->property_id , 'phone_no' => $this->mobile_number])->where('status', '1')->first();
	//     $res = (new BaseController)->checkUserActive($user, 'resend');

	//     if (gettype($res) != 'boolean') {
	//         return $res;
	//     }

	//     $otp = $this->generateOtp($user->id, $this->mobile_number);

	//     if (gettype($otp) == 'boolean') {
	//         $this->dispatchBrowserEvent('show-error');
	// 	    session()->flash('error', $this->getMessage(405));
	//         return redirect()->back();

	//     }

	//     $user = (new BaseController)->formatData($user);
	//     $data = ['otp' => $otp->otp, 'timer' => intval($this->getSetting('otp_timer'))];
	//     $this->timer = intval($this->getSetting('otp_timer'));
	//     $this->dispatchBrowserEvent('startTimer', $this->timer);
	//     $this->dispatchBrowserEvent('show-success');
	//     session()->flash('success', $this->getMessage(102) .' . Your OTP is '. $otp->otp);
	//     return redirect()->back();

	// }

	public function login(Request $request) {
		$validatedData = $this->validate([
			'property_id' => 'required',
			'mobile_number' => 'required',
			'user_type' => 'required',
			'device_id' => 'nullable',
			'device_type' => 'nullable',
			'device_token' => 'nullable',
			'otp' => 'required',
		]);

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());

		$request->merge(['property_id' => $this->property_id,
			'mobile_number' => $this->mobile_number,
			'user_type' => $this->user_type,
			'device_id' => 'vve13vi6j26caby8',
			'device_type' => 'pc/laptop',
			'device_token' => 'hkjashdasd87as89dasda89sda8s',
			'otp' => $this->otp]);

		$result = app('App\Http\Controllers\Api\ApiController')->verifyOtp($request);
		$data = $result->getData();

		if ($data->status == 200 && $data->data->user_type == 'seller-agent') {
			return redirect()->route('seller-dashboard');
		} elseif ($data->status == 200 && $data->data->user_type == 'buyer-agent') {
			return redirect()->route('buyer-dashboard');
		} elseif ($data->status == 200 && $data->data->user_type == 'buyer') {
			return redirect()->route('buyer-dashboard');
		} elseif ($data->status == 200 && $data->data->user_type == 'seller') {
			return redirect()->route('seller-dashboard');
		} elseif ($data->status == 200 && $data->data->role == 'agent') {
			return redirect()->route('offer');
		} else {
			session()->flash('error', $data->message);
			return redirect()->back();
		}
	}

}
