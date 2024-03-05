<?php

namespace App\Http\Livewire\Web;

use App\Models\Account;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ConfirmationEmail extends Component {
	public $email;
	public $user_id;

	public function mount() {
		$user = Auth::guard('accounts')->user();
		$this->user_id = Auth::guard('accounts')->id();
	}

	public function render() {
		return view('livewire.web.confirmation-email');
	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function getRules() {

		$rules = [
			'email' => 'required|unique:accounts,email|email:rfc,dns',
		];

		return $rules;
	}

	public function getValidationAttributes() {

		$gets = [
			'email' => 'Email',
		];

		return $gets;
	}

	public function ConfirmEmail() {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->getValidationAttributes());

		$data = $this->email;
		Account::where('id', $this->user_id)->update(['email' => $data]);
		return redirect()->route('weblogin');

	}
}
