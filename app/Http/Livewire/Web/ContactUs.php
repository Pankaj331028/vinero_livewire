<?php

namespace App\Http\Livewire\Web;

use Livewire\Component;
use App\Models\Contact;
use Mail;
use Cookie;

class ContactUs extends Component
{
    public $name;
    public $email;
    public $phone;
    public $communication_type;
    public $help_type;
    public $description;  
    public $cookiesValue;
    public $contactus_msg =1;

    public function mount(){
 
        if(isset($_COOKIE["BuyerCommission"])){

            $this->cookiesValue = $_COOKIE["BuyerCommission"];            
             $this->description="I would like to negotiate $this->cookiesValue% buyers commission";

        }
        
    }
    
    public function render()
    {
        return view('livewire.web.contact-us');
    }

    public function updated($name) {

        $this->validateOnly($name);
           
	}

    protected function getRules(){
        $rules=[
            'name' => 'required',
            'email' => 'required|email',          
            'phone' => 'nullable|digits_between:7,15',  
        ];
       
        return $rules;
    }

    protected function getValidationAttributes(){

        $gets=[
            'name' => 'Name',
            'email' => 'Email',
            'phone' => 'Phone Number',
            'description' => 'Description',
            'communication_type' => ' Communication type'
        ];
        return $gets;
    }
    
    protected function messages() {

		return [
            'phone.digits_between' => 'Please Enter Valide Phone Number',
        ];
        
	}
    public function store()
    {

        $this->dispatchBrowserEvent('error-result');         
        $this->validate($this->getRules(),$this->getMessages(),$this->getValidationAttributes());
        
        Contact::create([
            'name' => $this->name,
            'email' => $this->email,
            'phone' => $this->phone,
            'communication_type' => $this->communication_type,
            'help_type' => $this->help_type,
            'description' => $this->description
        ]);
        $data = ['foo' => 'test'];
        Mail::send('emails.contact_us', $data,function ($message) {
            $message->to($this->email);
            $message->subject('NEW INQUIRY');
        });
        
        Cookie::queue(Cookie::forget('BuyerCommission'));
        // session()->flash('error', 'Your message has been sent. A trusted Qonectin representative will contact you shortly.');
		
        // return redirect()->route('web-contact-us');
        $this->contactus_msg = 2;
        $this->dispatchBrowserEvent('show');
        $this->resetInput();
    }

    public function resetInput(){
        $this->reset(['name', 'email', 'phone' , 'communication_type', 'help_type', 'description']);
    }
}
