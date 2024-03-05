<?php

namespace App\Http\Livewire\Web;

use App\Models\Account;
use App\Models\Otp;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Mail;
use Session;

class Login extends Component {
	use ResponseMessages, Helper;

	public $email;
	public $password;
	public $remember_me;
	public $step = 1;

	public $property_button = false;
	public $hidden;
	public $property_id;
	// public $email_id;
	public $mobile_number;
	public $user_type;
	public $seconds;
	public $device_id;
	public $olduser_type;
	public $device_type;
	public $device_token;
	public $otp;
	public $otp_verify;
	public $timer = null;
	public $rules = [];
	protected $messages = [];

	public function mount() {
		$this->timer = $this->getSetting('otp_timer');

		if (Auth::guard('accounts')->check()) {
			if (Auth::check()) {
				if (Auth::user()->user_type == 'seller-agent') {
					return redirect()->route('seller-dashboard');
				} elseif (Auth::user()->user_type == 'buyer-agent') {
					return redirect()->route('buyer-dashboard');
				} elseif (Auth::user()->user_type == 'buyer') {
					return redirect()->route('buyer-dashboard');
				} elseif (Auth::user()->user_type == 'seller') {
					return redirect()->route('seller-dashboard');
				} elseif (Auth::user()->role == 'agent') {
					return redirect()->route('buyer-dashboard');
					// return redirect()->route('offer');
				}
			} else {
				if (Auth::guard('accounts')->user()->status == 'IN') {
					$this->email = Auth::guard('accounts')->user()->email;
					$this->step = 'verify';

					if (!Auth::guard('accounts')->user()->otp_sent) {
						$otp = rand(1000, 9999);
						Account::where('email', '=', Auth::guard('accounts')->user()->email)->update(['otp' => $otp, 'otp_sent' => true]);

						Mail::send('emails.verify_account', ['otp' => $otp], function ($message) {
							$message->to(Auth::guard('accounts')->user()->email);
							$message->subject('Verify Account');
						});
					}

					$this->dispatchBrowserEvent('move-top');
				} else {
					$this->step = 2;
				}

			}
		}
	}

	public function render() {
		return view('livewire.web.login');
	}

	public function rules() {

		if ($this->step == 1) {
			$rules = [
				// 'email' => 'required|email:rfc,dns',
				'email' => 'required|email:filter',
				'password' => 'required',
			];

		} else {
			$rules = [
				'property_id' => [
					'required',
					Rule::exists('property', 'vms_property_id')->where('status', 'AC'),
				],
				// 'mobile_number' => 'required|numeric',
				'mobile_number' => 'required',
				'user_type' => 'required|in:buyer,seller,agent',
				// 'email_id' => 'required|regex:/(.+)@(.+)\.(.+)/i',
			];

			return $rules;
		}

		return $rules;
	}

	public function messages() {
		$messages = [];
		if ($this->step != 1) {
			$messages['property_id.required'] = 'Property ID cannot be left blank';
			$messages['mobile_number.required'] = 'Phone number cannot be left blank';
			// $messages['email_id.required'] = 'Email address cannot be left blank';
			$messages['user_type.required'] = 'Please select your user type';
			$messages['property_id.exists'] = 'Please enter valid Property ID';
			$messages['user_type.in'] = 'Select as buyer, seller or agent only';

		}
		return $messages;

	}

	public function getValidationAttributes() {
		$gets = [
			'email' => 'Email',
		];
		return $gets;
	}

	public function updated($name) {
		//    dd($this->validateOnly($name));
		$this->validateOnly($name);

		if ($this->step != 1) {
			$val = $this->user_type;
			if ($val == 'seller') {
				$this->property_button = true;
			} else {
				$this->property_button = false;
			}

			if ($name == 'user_type' && $this->olduser_type != '' && $this->user_type != $this->olduser_type) {
				$this->property_id = '';
				// $this->email_id = '';
				$this->mobile_number = '';
				$this->otp = '';
				$this->hidden = 0;
			}

			$this->olduser_type = $this->user_type;
		}
	}

	public function sendOtp(Request $request) {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules());

		$request->merge(['property_id' => $this->property_id,
			'mobile_number' => str_replace(" ", "", $this->mobile_number),
			'email_id' => $this->email,
			'account_id' => Auth::guard('accounts')->id(),
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

	public function step_continue() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->getValidationAttributes());

		if (Auth::guard('accounts')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember_me)) {
			switch (Auth::guard('accounts')->user()->status) {
			case 'AC':$this->step = 2;
				Account::where('email', '=', $this->email)->update(['otp_sent' => false]);
				$this->dispatchBrowserEvent('update-item');
				break;
			case 'IN':$this->step = 'verify';
				if (!Auth::guard('accounts')->user()->otp_sent) {
					$otp = rand(1000, 9999);
					Account::where('email', '=', $this->email)->update(['otp' => $otp, 'otp_sent' => true]);

					Mail::send('emails.verify_account', ['otp' => $otp], function ($message) {
						$message->to($this->email);
						$message->subject('Verify Account');
					});
				}

				$this->dispatchBrowserEvent('move-top');
				break;
			}

		} else {
			session()->flash('error', 'Invalid Credentials');
		}

	}

	public function resendOtp() {

		$otp = rand(1000, 9999);
		Account::where('email', '=', $this->email)->update(['otp' => $otp, 'otp_sent' => true]);

		Mail::send('emails.verify_account', ['otp' => $otp], function ($message) {
			$message->to($this->email);
			$message->subject('Verify Account');
		});

		$this->createAcc = 'd-none';
		$this->verifyOtp = '';

		$this->dispatchBrowserEvent('move-top');
		session()->flash('success', 'We have sent a new OTP to your email.');
		$this->dispatchBrowserEvent('show-success');

	}

	public function verifyOTP() {

		$otp = implode('', $this->otp_verify);
		$data = Account::where('email', $this->email)->first();

		if ($data->otp == $otp) {
			$data->status = 'AC';
			$data->save();
			$this->step = 2;
		} else {
			session()->flash('error', 'Incorrect OTP');
		}

	}

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
			'mobile_number' => str_replace(" ", "", $this->mobile_number),
			'user_type' => $this->user_type,
			'device_id' => 'vve13vi6j26caby8',
			'device_type' => 'pc/laptop',
			'device_token' => 'hkjashdasd87as89dasda89sda8s',
			'account_id' => Auth::guard('accounts')->id(),
			'otp' => $this->otp]);

		$result = app('App\Http\Controllers\Api\ApiController')->verifyOtp($request);
		$data = $result->getData();

		if ($data->status == 200) {
			Session::put('user_type', $data->data->user_type ?? '');
			Session::put('role', $data->data->role ?? '');
			return redirect()->route('agreement');
		} else {
			session()->flash('error', $data->message);
			return redirect()->back();
		}
	}

}
