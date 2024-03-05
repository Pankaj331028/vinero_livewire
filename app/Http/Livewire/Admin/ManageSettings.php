<?php

namespace App\Http\Livewire\Admin;

use App\Models\Setting;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageSettings extends Component
{
    use WithFileUploads;

    public $settings;
    public $names;
    public $val_types;
    public $allowed;
    public $rules = [];
    public $messages = [];
    public $textarea;
    public $video;
    public $validationAttributes = [];

    public function mount()
    {
        $options = [];
        $set = Setting::select('heading', 'name', 'rule', 'value', 'value_type')->whereEditable(1)->whereStatus('AC')->orderBy('heading')->orderBy('name')->get();

        foreach ($set as $key => $value) {

            $value->heading = empty($value->heading) ? 'General Settings' : $value->heading;
            $options[str_replace(' ', '_', $value->heading)][$value->rule] = ($value->value_type!='video') ? ($value->value_type == 'boolean' ? intval($value->value) : $value->value) : null;
            $this->names[$value->rule] = $value->name;
            $this->val_types[$value->rule] = $value->value_type;

            if ($value->value_type == 'textarea') {
                $this->textarea[$value->rule] = $value->value;
            }
            if ($value->value_type == 'video') {
                $this->video[$value->rule] = $value->value;
            }

        }
        $this->settings = $options;

        foreach ($this->settings as $key => $value) {

            foreach ($value as $field => $val) {

                if($this->val_types[$field] == 'video'){
                    if($val = ""){                       
                    $this->rules['settings.' . $key . '.' . $field] = 'required|max:10240|mimetypes:video/mp4';
                    $this->messages['settings.' . $key . '.' . $field . '.required'] = 'This field is required';
                    $this->validationAttributes['settings.' . $key . '.' . $field] = $this->names[$field];

                    }else{

                    $this->rules['settings.' . $key . '.' . $field] = 'nullable|max:10240|mimetypes:video/mp4';
                    $this->validationAttributes['settings.' . $key . '.' . $field] = $this->names[$field];
                    }
                    
                
                }else{
                    
                    $this->rules['settings.' . $key . '.' . $field] = 'required';
                    $this->messages['settings.' . $key . '.' . $field . '.required'] = 'This field is required';
                    $this->validationAttributes['settings.' . $key . '.' . $field] = $this->names[$field];
                
                }
                
            }
        }
    }

    public function updated($propertyName)
    {
        $key = explode('.', $propertyName)[1];
        $this->validateOnly($propertyName);
        if (isset($this->textarea[$propertyName])) {
            $this->textarea[$propertyName] = $this->settings[$key][$propertyName];
        }

        if (isset($this->video[$propertyName])) {
            $this->video[$propertyName] = $this->settings[$key][$propertyName];
        }
    }

    public function updateRule($key, $field)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.admin.manage-settings');
    }

    public function submitSettings()
    {

        $this->dispatchBrowserEvent('error-result');
        $this->validate($this->rules, $this->messages);

        foreach ($this->settings as $key => $value) {
    
            foreach ($value as $field => $val) {

                if($this->val_types[$field] == 'video'){
                    if(!empty($val)){
                        $path = $val->store('uploads/videos');
                        Setting::whereRule($field)->update(['value' => $path]);
                    }
                }
               else{

                Setting::whereRule($field)->update(['value' => $val]);
               }                

            }
        }

        $this->dispatchBrowserEvent('show-success');
        session()->flash('message', 'Settings Updated Successfully');
    }
}
