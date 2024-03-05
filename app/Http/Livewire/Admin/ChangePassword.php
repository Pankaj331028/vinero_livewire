<?php

namespace App\Http\Livewire\Admin;

use Auth;
use Hash;
use Livewire\Component;

class ChangePassword extends Component
{
    public $current_password      = '';
    public $password              = '';
    public $password_confirmation = '';
    public $rules                 = [
        'current_password'      => 'required',
        'password'              => 'required',
        'password_confirmation' => 'required|same:password',
    ];

    public function render()
    {
        return view('livewire.admin.change-password');
    }

    public function updated($name)
    {
        $this->validateOnly($name);
    }

    public function submitChanges()
    {

        $this->dispatchBrowserEvent('error-result');
        $this->validate($this->rules);

        $admin = Auth::guard('admin')->user();

        if (Hash::check($this->current_password, $admin->password)) {
            $admin->password = bcrypt($this->password);
            $admin->save();
            Auth::guard('admin')->logout();
            $this->dispatchBrowserEvent('show-success');
            session()->flash('message', 'Password changed. Please login again to continue');
            return redirect()->route('login');
        } else {
            $this->dispatchBrowserEvent('show-error');
            session()->flash('error', 'Incorrect Current Password');
        }
    }
}