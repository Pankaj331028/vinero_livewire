<?php

namespace App\Http\Livewire\Web;

use App\Models\Agent;
use App\Models\Buyer as User;
use App\Models\Property;
use Auth;
use App\Traits\Helper;
use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Livewire\Component;

class CounterToCounter extends Component {
	use Helper, ResponseMessages;

	public $price;
	public $close_of_escrow;
	public $inspection_property;
	public $loan_contingency;
	public $escrow_company;
	public $escrow_number;
	public $escrow_officer;
	public $contact_information;
	public $other_terms;
	public $rule = [];
	public $buyer_price;
	public $buyer_price1;
	public $buyer_close_of_escrow;
	public $buyer_inspection_property;
	public $buyer_loan_contingency;
	public $buyer_escrow_company;
	public $buyer_escrow_number;
	public $buyer_escrow_officer;
	public $buyer_contact_information;
	public $buyer_other_terms;

	public function mount(Request $request) {

		$user = auth()->user();

		if ($user->user_type == 'agent') {
			$user = Agent::find($user->id);
		}
		// dd($user);
		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}

		$counter_details = app('App\Http\Controllers\Api\Buyer\ApiController')->counterDetails($request);
		$counter_detail = $counter_details->getData()->data;
		$this->price = number_format($counter_detail->amount);
		$this->close_of_escrow = $counter_detail->close_of_escrow;
		$this->inspection_property = $counter_detail->inspection_prop;
		$this->loan_contingency = $counter_detail->loan_contingency;
		$this->escrow_company = $counter_detail->escrow_company;
		$this->escrow_officer = $counter_detail->escrow_officer;
		// $this->escrow_number = $counter_detail->escrow_number;
		$this->contact_information = $counter_detail->escrow_contact;
		$this->other_terms = $counter_detail->other_terms;

		$this->dispatchBrowserEvent('update-item');
	}
	public function render() {
		return view('livewire.web.counter-to-counter');
	}

	public function rules() {
		$user = User::find(Auth::id());
		$list = Property::where('vms_property_id', $user->property_id)->first();
		$property_rate = $list->reserved_price;
		$rules = [
			'buyer_price' => "required",
			'buyer_price1' => 'required|gte:' . $property_rate,
			'buyer_close_of_escrow' => "required",
			'buyer_inspection_property' => "required",
			'buyer_loan_contingency' => "required",
			'buyer_escrow_company' => "required",
			'buyer_escrow_number' => "required|digits:10",
			'buyer_escrow_officer' => "required",
			'buyer_contact_information' => "required|digits:10",
			'buyer_other_terms' => "required",
		];
		
		return $rules;
	}

	public function getValidationAttributes() {
		$gets = [
			'buyer_price' => "Price",
			'buyer_price1' => "Price",
			'buyer_close_of_escrow' => "Close of escrow",
			'buyer_inspection_property' => "Inspection & property condition ",
			'buyer_loan_contingency' => "Loan contingency",
			'buyer_escrow_company' => "Escrow company",
			'buyer_escrow_number' => "Escrow number",
			'buyer_escrow_officer' => "Escrow officer",
			'buyer_contact_information' => "Contact information",
			'buyer_other_terms' => "Other terms",
		];
		return $gets;
	}

	public function updated($new) {
		$this->buyer_price1 =$this->formatCurrency($this->buyer_price);
		if ($new == 'buyer_price') {
			$this->validateOnly('buyer_price1');
		}
		else{
		$this->validateOnly($new);
		}
		// $this->validateOnly($new);
	}

	public function counterOffer(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->getValidationAttributes());
		$user = auth()->user();
		
		$request->merge([
			'amount' => $this->formatCurrency($this->buyer_price),
			'close_of_escrow' => $this->buyer_close_of_escrow,
			'inspection' => $this->buyer_inspection_property,
			'loan_contingency' => $this->buyer_loan_contingency,
			'escrow_company' => $this->buyer_escrow_company,
			'escrow_number' => str_replace(" ", "", $this->buyer_escrow_number),
			'contact_info' => str_replace(" ", "", $this->buyer_contact_information),
			'escrow_officer' => $this->buyer_escrow_officer,
			'other_terms' => $this->buyer_other_terms,
			'tnc' => '1',

		]);

		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->counterOfferUpdate($request);
		$data = $result->getData();

		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $result->getData()->message);
			return redirect()->route('buyer-dashboard');
		}
		$this->dispatchBrowserEvent('update-item');
		$this->reset(['buyer_price', 'buyer_close_of_escrow', 'buyer_inspection_property', 'buyer_loan_contingency', 'buyer_loan_contingency', 'buyer_escrow_company', 'buyer_escrow_number', 'buyer_contact_information', 'buyer_escrow_officer', 'buyer_other_terms']);
	}
}
