<?php

namespace App\Http\Livewire\Web;

use App\Models\Account;
use Livewire\Component;
use Mail;

class CreateAccount extends Component {
	public $email;
	public $password;
	public $otp = [];
	public $createAcc = '';
	public $verifyOtp = 'd-none';

	public function render() {
		return view('livewire.web.create-account');
	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	protected function getRules() {
		$rules = [
			// 'email' => 'required|unique:accounts,email|email:rfc,dns',
			'email' => 'required|unique:accounts,email|email:filter',
			'password' => 'required|string|min:8|regex:/^(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/',
		];

		return $rules;
	}

	protected function getValidationAttributes() {
		$gets = [
			'email' => 'Email',
			'password' => 'Password',
		];

		return $gets;
	}

	public function messages() {

		$messages['email.email'] = 'Invalid email format';
		return $messages;

	}

	public function store() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), $this->getMessages(), $this->getValidationAttributes());

		if (Account::create(['email' => $this->email, 'password' => bcrypt($this->password)])) {

			$otp = rand(1000, 9999);
			Account::where('email', '=', $this->email)->update(['otp' => $otp]);

			Mail::send('emails.verify_account', ['otp' => $otp], function ($message) {
				$message->to($this->email);
				$message->subject('Verify Account');
			});

			$this->createAcc = 'd-none';
			$this->verifyOtp = '';

			$this->dispatchBrowserEvent('move-top');

			// return redirect()->to('/web-login')->with('success', "Continue the login process...");
		} else {

			$this->createAcc = '';
			$this->verifyOtp = 'd-none';
			session()->flash('error', 'Something went wrong. Please try again later');
			$this->dispatchBrowserEvent('show-error');
		}
	}

	public function resendOtp() {

		$otp = rand(1000, 9999);
		Account::where('email', '=', $this->email)->update(['otp' => $otp]);

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

		$otp = implode('', $this->otp);
		$data = Account::where('email', $this->email)->first();

		if ($data->otp == $otp) {
			$data->status = 'AC';
			$data->save();
			return redirect()->route('weblogin')->with('success', "Account verified successfully.");
		} else {
			$this->createAcc = 'd-none';
			$this->verifyOtp = '';
			session()->flash('error', 'Incorrect OTP');
		}

	}

	public function resetInput() {
		$this->reset(['email', 'password']);
	}

}
