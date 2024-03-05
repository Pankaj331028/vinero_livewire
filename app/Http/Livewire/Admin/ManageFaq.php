<?php

namespace App\Http\Livewire\Admin;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ManageFaq extends Component
{    
    public $type;
	public $question;
	public $cat;
	public $slug;
	public $faq;
	public $faq_que;
	public $faq_ans;
	
	public $inputs = [];
	public $i = 0;
	public $faq_ids = [];
	protected $rules = [];
	protected $messages = [];
	protected $validationAttributes = [];
	public $Faq_category;
	public $faq_category_id;

	public function mount($type, $slug = '') {
		$this->Faq_category =FaqCategory::all();
		$this->type = $type;
		$faq = [];

		$this->i++;
		array_push($this->inputs, $this->i);

		$this->rules['faq_que.0'] = 'required';
		$this->rules['faq_ans.0'] = 'required';
		$this->rules['faq_category_id.0'] = 'required';
		

		$this->validationAttributes['faq_que.0'] = 'faq_que 1';
		$this->validationAttributes['faq_ans.0'] = 'faq_ans 1';
		$this->validationAttributes['faq_category_id.0'] = 'faq Category';
		
		if ($this->type == 'edit' && !empty($this->slug)) {
			$faq = Faq::find($this->slug);
			// dd($this->slug);
			if (!isset($faq->id)) {
				session()->flash('error', 'Invalid Request');
				return redirect()->route('city');
			}

			$this->faq_que = $faq->faq_que;
			$this->faq_ans = $faq->faq_ans;
			$this->faq_category_id =$faq->faq_category_id;
		}
	}

	public function add($i) {
		$this->dispatchBrowserEvent('update-summernote');
		$this->i = $i + 1;
		array_push($this->inputs, $this->i);

	}

	public function remove($key) {
		unset($this->inputs[$key]);
		unset($this->faq_que[$key]);
		unset($this->faq_ans[$key]);
		unset($this->faq_category_id[$key]);

		if (isset($this->faq_ids[$key])) {
			// Category::whereId($this->faq_ids[$key])->update(['status' => 'DL']);
			unset($this->faq_ids[$key]);
		}

	}

	public function updated($faq) {
		$this->validateOnly($faq);
	}

	public function render() {
		return view('livewire.admin.manage-faq');
	}

	protected function rules() {

		if ($this->type == 'edit') {
			$rules['faq_ans'] = 'required';
			$rules['faq_que'] = [
				'required',
				Rule::unique('faqs')->where(function ($query) {
					// return $query->where('faq_que', $this->faq_que)->where('status', '!=', 'DL');
				}),
			];
			return $rules;
		}

		foreach ($this->inputs as $key => $value) {

			$rules['faq_que.' . $key] = 'required';
			$rules['faq_ans.' . $key] = 'required';
			$rules['faq_category_id.' . $key] = 'required';
		}
		return $rules;
	}

	protected function messages() {

		if ($this->type == 'edit') {

			$messages['faq_que'] = 'Question is required.';
			$messages['faq_ans'] = 'Answer is required.';
			$messages['faq_category_id'] = 'Faq Category is required.';
			return $messages;
		}
		foreach ($this->inputs as $key => $value) {

			$messages['faq_ans.' . $key . '.required'] = 'Answer ' . ($key + 1) . ' is required.';
			$messages['faq_que.' . $key . '.required'] = 'Question ' . ($key + 1) . ' is required.';
			$messages['faq_category_id.' . $key . '.required'] = 'faq category is required.';
		}
		return $messages;
	}

	protected function validationAttributes() {

		if ($this->type == 'edit') {
			$attr['faq_que'] = 'Question ';
			$attr['faq_ans'] = 'Answer ';
			$attr['faq_category_id'] = 'Faq category ';

			return $attr;
		}

		foreach ($this->inputs as $key => $value) {

			$attr['faq_ans.' . $key] = 'Answer ' . ($key + 1);
			$attr['faq_que.' . $key] = 'Question ' . ($key + 1);
			$attr['faq_category_id.' . $key] = 'Faq category' ;
		}
		return $attr;
	}

	public function updateFaq() {
		// dd();
		$this->dispatchBrowserEvent('update-summernote');
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), $this->getMessages(), $this->getValidationAttributes());
		if (isset($this->slug)) {
			Faq::whereId($this->slug)->update([
				'faq_que' => $this->faq_que,
				'faq_ans' => $this->faq_ans,
				'faq_category_id' => $this->faq_category_id,
			]);
		}
		$this->dispatchBrowserEvent('show-success');
		session()->flash('message', 'Faq updated Successfully');
		return redirect()->route('faq');

	}

	public function submitFaq() {
		$this->dispatchBrowserEvent('update-summernote');
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), $this->getMessages(), $this->getValidationAttributes());
		

		foreach ($this->inputs as $key => $value) {
			// $this->faq_category_id[$key];
			// dd($this->faq_category_id[$key]);
			$faq = new Faq;
			$faq->faq_que = $this->faq_que[$key];
			$faq->faq_ans = $this->faq_ans[$key];
			$faq->faq_category_id = $this->faq_category_id[$key];
			$faq->status = 'AC';
			$faq->save();

		}

		$this->dispatchBrowserEvent('show-success');
		session()->flash('message', 'Faq Added Successfully');
		return redirect()->route('faq');
	}
}
