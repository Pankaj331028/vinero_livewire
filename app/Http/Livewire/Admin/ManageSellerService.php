<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\SellerService;

class ManageSellerService extends Component
{
    public $service=[];
    public $seller_service;
    public $qonectin=[];
    public $traditional_realtor=[];
    public $sellerService;
    public $ids=[];
    public $other=[];
    public $traditional_other=[];
    
    

    public function mount(){

        $this->sellerService = SellerService::select('id','service','qonectin', 'traditional_realtor')->get();

        foreach($this->sellerService as  $key => $servics){

            $this->service[$key] =$servics->service;

            $temp= $servics->qonectin;   
            if($temp == 'yes' || $temp == 'no' || $temp == 'never'|| $temp == 'Sometimes'){
                $temp= $servics->qonectin;
            }else{
                $temp = 'other';
                $this->other[$key]=$servics->qonectin;  
            }
            $this->qonectin[$key] =$temp;   

            $temp_traditional=$servics->traditional_realtor;
            if($temp_traditional == 'yes' || $temp_traditional == 'no' || $temp_traditional == 'never'|| $temp_traditional == 'Sometimes'){
                $temp_traditional= $servics->traditional_realtor;
            }else{
                $temp_traditional = 'traditional_other';  
                $this->traditional_other[$key]=$servics->traditional_realtor;
            }
            $this->traditional_realtor[$key] =$temp_traditional; 

            $this->ids[$key] =$servics->id;
        }
        
    } 

    public function render()
    {
        return view('livewire.admin.manage-seller-service');
    }

    public function updated($name) {
        foreach($this->ids as $key => $service){
            if($this->traditional_realtor[$key] == 'traditional_other'){
                if(!isset($this->traditional_other[$key]))
                    $this->traditional_other[$key]='';                  
            }
            if($this->qonectin[$key] =='other'){
                if(!isset($this->other[$key]))
                    $this->other[$key]='';
            }
        }  
        $this->validateOnly($name);
            
	}

    protected function getRules(){
        $rules=[];
        foreach($this->qonectin as $key => $servics){
            $temp= $servics;
            if(!in_array($temp,['yes','no','never','Sometimes'])){
                        $rules['other.'.$key] = 'required';
            }
            
        }
        
        foreach($this->traditional_realtor as $key => $servics){
            $temp= $servics;
            if(!in_array($temp,['yes','no','never','Sometimes'])){
                        $rules['traditional_other.'.$key] = 'required';
            }
        }
        return $rules;
    }

    protected function getValidationAttributes(){
        $gets=[];
      
        foreach($this->qonectin as $key => $servics){
            $temp= $servics;
            if(!in_array($temp,['yes','no','never','Sometimes'])){
                        $gets['other.'.$key] = 'other';
            }
            
        }
        
        foreach($this->traditional_realtor as $key => $servics){
            $temp= $servics;
            if(!in_array($temp,['yes','no','never','Sometimes'])){
                        $gets['traditional_other.'.$key] = 'other';
            }
        }
        return $gets;
    }

   public function updatePage(){   

        $this->dispatchBrowserEvent('error-result');         
        $this->validate($this->getRules(),[],$this->getValidationAttributes());
        foreach($this->ids as $key => $service){
            $data=[
                'qonectin' => $this->qonectin[$key] == 'other' ? $this->other[$key] : $this->qonectin[$key],
                'traditional_realtor' => $this->traditional_realtor[$key] == 'traditional_other' ? $this->traditional_other[$key] : $this->traditional_realtor[$key],
            ];
            
            SellerService::where('id','=' , $service)->update($data);
        } 
        
        session()->flash('message', 'Updated successfully.');
		$this->dispatchBrowserEvent('show-success');
   }
   
}
