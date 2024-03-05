<?php

namespace App\Http\Livewire\Admin;

use App\Models\Admin;
use App\Models\ModelPermission;
use App\Models\Permission;
use App\Models\Role;
use App\Notifications\InformNewAccount;
use App\Traits\Helper;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageAccount extends Component {
	use WithFileUploads, Helper;

	public $type, $screen = 'personal';
	public $slug;
	public $user;
	public $steps_completed = 1;
	public $show_step = 1;
	public $previous_url;

	public $step1 = [
		'name' => '',
		'mobile_number' => '',
		'country_code' => '1',
		'country_iso' => 'us',
		'email' => '',
		'password' => '',
		'password_confirmation' => '',
		'description' => '',
	];

	public $step2 = [
		'permissions' => [],
	];

	protected $rules = [
		'step1.name' => 'required',
		'step1.country_code' => 'required',
		'step1.mobile_number' => 'required',
		'step1.email' => 'required|email:filter',
		'step1.password' => 'confirmed',
	];

	protected $validationAttributes = [
		'step1.name' => 'User Name',
		'step1.mobile_number' => 'Mobile Number',
		'step1.email' => 'Email',
		'step1.password' => 'Password',
		'step1.password_confirmation' => 'Confirm Password',
	];

	protected $messages = [
		'step1.password.confirmed' => 'Passwords do not match',
		'step1.password_confirmation.required' => 'Please reenter the password',
	];

	public function mount(Request $request, $type, $slug = '', $previous_url) {
		$this->type = $type;
		$this->slug = $slug;

		if (!empty($this->slug) && $this->type == 'edit') {

			$this->user = Admin::find($this->slug);

			$mobile = explode('-', $this->user->mobile_number);

			$this->step1 = [
				'name' => $this->user->name,
				'mobile_number' => $mobile[1],
				'email' => $this->user->email,
				'description' => $this->user->description,
				'country_code' => str_replace('+', '', $mobile[0]),
			];
			$this->steps_completed++;

			foreach ($this->user->permissions as $key => $value) {

				$this->step2['permissions'][$value->module][trim(str_replace($value->module, '', $value->name))] = 1;
			}
			$this->steps_completed++;
		}

	}

	public function render() {
		return view('livewire.admin.manage-account');
	}

	public function openTab($num, $step) {
		if ($step <= $this->steps_completed) {
			$this->screen = $num;
			$this->steps_completed = $step;
		}

	}

	public function updated($name) {
		$this->dispatchBrowserEvent('checkMobile');
		$this->validateOnly($name);

		if (stripos($name, 'step2.permissions') !== false) {
			$keys = explode('.', $name);
			if ($keys[3] != 'list') {
				$this->step2['permissions'][$keys[2]]['list'] = '1';
			}
			if (!$this->step2['permissions'][$keys[2]][$keys[3]]) {
				unset($this->step2['permissions'][$keys[2]][$keys[3]]);
			}
		}
	}

	public function moveToNextStep($num) {
		$oldstep = $this->steps_completed;

		switch ($oldstep) {
		case 1:$this->rules = [
				'step1.name' => 'required',
				'step1.country_code' => 'required',
				'step1.mobile_number' => 'required',
				'step1.email' => ['required', 'email:filter', Rule::unique('admin', 'email')->where(function ($query) {
					return $query->where('status', '!=', 'DL')->where(function ($q) {
						if (isset($this->slug) && !empty($this->slug)) {
							$q->where('id', '!=', $this->slug);
						}
					});
				})],
				'step1.password' => ($this->type == 'add' ? 'required|' : '') . 'confirmed',
				'step1.password_confirmation' => ($this->type == 'add' ? 'required' : ''),
			];
			$this->validationAttributes = [
				'step1.name' => 'User Name',
				'step1.country_code' => 'Country Code',
				'step1.mobile_number' => 'Mobile Number',
				'step1.email' => 'Email Address',
				'step1.password' => 'Password',
				'step1.password_confirmation' => 'Confirm Password',
			];
			$this->messages = [
				'step1.password.confirmed' => 'Passwords do not match',
				'step1.password_confirmation.required' => 'Please reenter the password',
			];
			$this->dispatchBrowserEvent('checkMobile');
			$this->validate($this->rules, $this->messages, $this->validationAttributes);

			break;
		}

		$tab = 'personal';

		switch ($num) {
		case 1:$tab = 'personal';
			break;
		case 2:$tab = 'permission';
			break;
		}

		$this->openTab($tab, $num - 1);
		$this->steps_completed = $num;

	}

	public function saveUpdates() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->rules, $this->messages, $this->validationAttributes);

		if ($this->type == 'edit') {
			$admin = Admin::find($this->slug);
		} else {
			$admin = new Admin;
		}
		$admin->role = Role::whereName('subadmin')->first()->id;
		$admin->email = $this->step1['email'];
		$admin->name = $this->step1['name'];
		if (!empty($this->step1['password'])) {
			$admin->password = bcrypt($this->step1['password']);
		}

		$admin->mobile_number = '+' . $this->step1['country_code'] . '-' . $this->step1['mobile_number'];
		$admin->description = $this->step1['description'];

		if ($admin->save()) {
			$perms = [];

			foreach ($this->step2['permissions'] as $key => $value) {
				foreach ($value as $action => $val) {
					if ($val == 1) {
						$pid = Permission::whereName($action . ' ' . $key)->whereGuardName('admin')->first();

						$mhr = ModelPermission::whereModelId($admin->id)->wherePermissionId($pid->id)->first();

						if (!isset($mhr->permission_id)) {
							$mhr = new ModelPermission;
						}

						$mhr->permission_id = $pid->id;
						$mhr->module = $pid->module;
						$mhr->model_type = get_class($admin);
						$mhr->model_id = $admin->id;
						$mhr->save();

					}
				}
			}
			// $admin->givePermissionTo($perms);

			if ($this->type == 'add') {
				$admin->notify(new InformNewAccount($admin, $this->step1['password']));
				session()->flash('success', 'SubAdmin added successfully');
			} else {
				session()->flash('success', 'SubAdmin updated successfully');
			}

			return redirect()->url($previous_url);

		} else {
			$this->dispatchBrowserEvent('show-error');
			session()->flash('error', 'Something Went Wrong! Please try again later');
		}

	}

}
