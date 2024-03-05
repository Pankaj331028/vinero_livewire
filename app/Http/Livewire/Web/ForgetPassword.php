<?php

namespace App\Http\Livewire\Web;

use App\Models\Account;
use Illuminate\Support\Str;
use Livewire\Component;
use Mail;

class ForgetPassword extends Component {
	public $email;
	public $data;
	public $otp = [];
	public $token;
	public $forgetPassword = '';
	public $verifyOtp = 'd-none';
	public $verifyPassword = 'd-none';
	public $password;
	public $confirmpassword;

	public function render() {
		return view('livewire.web.forget-password');
	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function getRules() {
		if ($this->forgetPassword == '') {

			$rules = [
				'email' => 'required|email:filter',
			];

		} else {

			$rules = [
				'email' => 'required|email:filter',
				'password' => 'required|string|min:8|regex:/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
				'confirmpassword' => 'required|same:password',

			];

		}

		return $rules;
	}

	public function getValidationAttributes() {
		if ($this->forgetPassword == '') {

			$gets = [
				'email' => 'Email',
			];

		} else {

			$gets = [
				// 'email' => 'Email',
				'password' => ' New Password',
				'confirmpassword' => 'Confirm Password',

			];
		}

		return $gets;
	}

	public function submitForgetPasswordForm() {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->getValidationAttributes());

		$this->data = Account::where('email', $this->email)->first();

		$this->otp = rand(1000, 9999);
		$token = Str::random(64);

		if ($this->data) {

			$data = [
				'email' => $this->email,
				'remember_token' => $token,
				'otp' => $this->otp,
			];
			Account::where('email', '=', $this->email)->update($data);

			Mail::send('emails.forgot_password', ['remember_token' => $token, 'otp' => $this->otp], function ($message) {
				$message->to($this->email);
				$message->subject('Reset Password');
			});

			$this->forgetPassword = 'd-none';
			$this->verifyOtp = '';
			$this->verifyPassword = 'd-none';

		} else {
			$this->forgetPassword = '';
			$this->verifyOtp = 'd-none';
			$this->verifyPassword = 'd-none';
			session()->flash('error', 'Invalid email');
			$this->dispatchBrowserEvent('show-error');
		}

	}

	public function verifyOTP() {

		$otp = implode('', $this->otp);
		$data = Account::where('email', $this->email)->first();

		if ($data->otp == $otp) {
			$this->forgetPassword = 'd-none';
			$this->verifyOtp = 'd-none';
			$this->verifyPassword = '';
		} else {

			$this->forgetPassword = 'd-none';
			$this->verifyOtp = '';
			$this->verifyPassword = 'd-none';
			session()->flash('error', 'Incorrect OTP');
			$this->dispatchBrowserEvent('show-error');
		}

	}

	public function newPassword() {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->getValidationAttributes());

		$data = bcrypt($this->password);
		Account::where('email', '=', $this->email)->update(['password' => $data]);

		return redirect()->route('weblogin')->with('success', "Password Successfully Updated");

	}

	public function resendOtp() {

		$this->otp = rand(1000, 9999);
		$token = Str::random(64);
		$data = [
			// 'email' => $this->email,
			'remember_token' => $token,
			'otp' => $this->otp,
		];
		Account::where('email', '=', $this->email)->update($data);

		Mail::send('emails.forgot_password', ['remember_token' => $token, 'otp' => $this->otp], function ($message) {
			$message->to($this->email);
			$message->subject('Resend Password');
		});

		session()->flash('success', 'OTP sent');
		$this->dispatchBrowserEvent('show-error');
	}
}
