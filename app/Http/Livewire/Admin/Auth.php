<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Traits\Helper;
use App\Traits\MailSubject;
use Auth as LaraAuth;
use Livewire\Component;

class Auth extends Component {
	use Helper, MailSubject;

	public $type;
	public $email;
	public $password;
	public $remember;

	public $rules = [
		'email' => 'required|email',
		'password' => 'required',
	];

	public function mount($type) {
		$this->type = $type;
	}

	public function render() {
		return view('livewire.admin.auth');
	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function login() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->rules);

		if (LaraAuth::guard('admin')->attempt(['email' => $this->email, 'password' => $this->password], $this->remember)) {
			return redirect()->route('index');
		} else {
			session()->flash('error', 'Invalid Credentials');
			$this->dispatchBrowserEvent('show-error');
		}
	}

	public function forgotPassword() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate([
			'email' => 'required|email',
		]);

		$admin = Admin::whereEmail($this->email)->first();
		if (isset($admin->id)) {
			$admin->password = bcrypt('123456');
			$admin->save();

			$data = [
				'email' => $admin->email,
				'name' => $admin->name,
				'password' => '123456',
				'subject' => $this->getSubject('forgot_password'),
			];

			$this->sendMail('emails.forgot_password', $data);
			session()->flash('message', 'Temporary Password has been sent to your Email Address. Please use to login.');
			return redirect()->route('login');
		} else {
			session()->flash('error', "Email does not exists.");
			$this->dispatchBrowserEvent('show-error');
		}
	}
}
