<?php

namespace App\Http\Livewire\Web;

use App\Traits\ResponseMessages;
use Illuminate\Http\Request;
use Livewire\Component;

class Survey extends Component {
	use ResponseMessages;
	public $rule = [];
	public $user_friendly;
	public $enjoyed_experience;
	public $convenience;
	public $complicated;
	public $exiting;
	public $intrusive;
	public $kept_me_informed;
	public $kept_me_control;
	public $kept_me_focused;
	public $will_use_it_again;
	public $will_recommend;
	public $transparency;
	public $fairness;
	public $inclusiveness;
	public $a_better_way;
	public $frictions;
	public $found_value;
	public $survey_logout = 1;

	public function mount() {
		$user = auth()->user();

		if (($user->optin_out == 'OPTOUT' && $user->user_type == 'agent') || (($user->optin_out == 'OPTOUTMODE1' || $user->optin_out == 'OPTOUTMODE2') && $user->user_type == 'buyer')) {
			$this->control_mode = 0;
		} else {
			$this->control_mode = 1;
		}
	}
	public function render() {
		return view('livewire.web.survey');
	}
	public function rules() {
		$rules = [
			'user_friendly' => 'required',
			'enjoyed_experience' => 'required',
			'convenience' => 'required',
			'complicated' => 'required',
			'exiting' => 'required',
			'intrusive' => 'required',
			'kept_me_informed' => 'required',
			'kept_me_control' => 'required',
			'kept_me_focused' => 'required',
			'found_value' => 'required',
			'will_use_it_again' => 'required',
			'will_recommend' => 'required',
			'transparency' => 'required',
			'fairness' => 'required',
			'inclusiveness' => 'required',
			'a_better_way' => 'required',
			'frictions' => 'required',
		];
		return $rules;
	}
	public function getValidationAttributes() {
		$gets = [
			'user_friendly' => 'User friendly',
			'enjoyed_experience' => 'Enjoyed the experience',
			'convenience' => 'Convenient',
			'complicated' => 'Complicated',
			'exiting' => 'Exciting',
			'intrusive' => 'Intrusive',
			'kept_me_informed' => 'Kept me informed',
			'kept_me_control' => 'Kept me in control',
			'kept_me_focused' => 'Kept me focused',
			'found_value' => 'Found value',
			'will_use_it_again' => 'Would use again',
			'will_recommend' => 'Would recommend',
			'transparency' => 'Transparent',
			'fairness' => 'Fair',
			'inclusiveness' => 'Inclusive',
			'a_better_way' => 'A better way',
			'frictions' => 'Reduces frictions',
		];
		return $gets;
	}
	public function messages() {

		$messages['user_friendly.required'] = 'Please provide this rating';

		$messages['enjoyed_experience.required'] = 'Please provide this rating';
		$messages['convenience.required'] = 'Please provide this rating';
		$messages['complicated.required'] = 'Please provide this rating';
		$messages['exiting.required'] = 'Please provide this rating';
		$messages['intrusive.required'] = 'Please provide this rating';
		$messages['kept_me_informed.required'] = 'Please provide this rating';
		$messages['kept_me_control.required'] = 'Please provide this rating';
		$messages['kept_me_focused.required'] = 'Please provide this rating';
		$messages['found_value.required'] = 'Please provide this rating';
		$messages['will_use_it_again.required'] = 'Please provide this rating';
		$messages['will_recommend.required'] = 'Please provide this rating';
		$messages['transparency.required'] = 'Please provide this rating';
		$messages['fairness.required'] = 'Please provide this rating';
		$messages['inclusiveness.required'] = 'Please provide this rating';
		$messages['a_better_way.required'] = 'Please provide this rating';
		$messages['frictions.required'] = 'Please provide this rating';

		return $messages;

	}

	public function updated($new) {
		$this->validateOnly($new);
	}

	public function submitSurvey(Request $request) {

		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), $this->getMessages(), $this->getValidationAttributes());
		$user = auth()->user();
		$request->merge([
			'user_friendly' => $this->user_friendly,
			'enjoyed_experience' => $this->enjoyed_experience,
			'convenience' => $this->convenience,
			'complicated' => $this->complicated,
			'exiting' => $this->exiting,
			'intrusive' => $this->intrusive,
			'kept_me_informed' => $this->kept_me_informed,
			'kept_me_control' => $this->kept_me_control,
			'kept_me_focused' => $this->kept_me_focused,
			'found_value' => $this->found_value,
			'will_use_it_again' => $this->will_use_it_again,
			'will_recommend' => $this->will_recommend,
			'transparency' => $this->transparency,
			'fairness' => $this->fairness,
			'inclusiveness' => $this->inclusiveness,
			'a_better_way' => $this->a_better_way,
			'frictions' => $this->frictions,
		]);

		$result = app('App\Http\Controllers\Api\Buyer\ApiController')->submitSurvey($request);
		$data = $result->getData();
		// $this->reset();
		if ($result->getData()->status == 200) {
			$user->last_activity = now();
			$user->save();
			session()->flash('message', $this->getMessage(208));
			return redirect()->route('buyer-dashboard', ['action' => 'survey']);
		}

	}
}
