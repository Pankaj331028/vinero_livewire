<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Resource;
use Livewire\WithFileUploads;
use Intervention\Image\ImageManagerStatic as Image;
use App\Traits\Helper;
class AdminResource extends Component
{
    use WithFileUploads;

    public $types;
	public $slug;
	public $oldfile;
	public $oldfilepath;
    public $type = [];
	public $name;
	public $file;
	public $content;
	public $short_description;
	public $rules = [
		'file' => 'required|file|max:5120|mimes:jpg,jpeg,png,svg|dimensions:min_width=1200,min_height=500',
		// 'type' => 'nullable',
		'name' => 'required',
		'content' => 'required',
		'short_description' => 'required',
	];

	public $validationAttributes = [
		'file' => 'Resource file',
		// 'type' => 'Resource Type',
		'name' => 'Resource Title',
		'content' => 'Resource Content',
		'short_description' => 'Resource Short Description',
	];

	public $message = [
		// 'type' => 'please select any one'
	];

    public function mount($types, $slug = '') {
		$this->types = $types;
				
		if ($this->types == 'edit' && !empty($this->slug)) {
			$loc = Resource::find($this->slug);
			
			if (!isset($loc->id)) {
				session()->flash('error', 'Invalid Request');
				return redirect()->route('resource');
			}
			// $this->type = explode (",", $loc->type); 
			$this->name = $loc->name;
			$this->short_description = $loc->short_description;
			$this->content=$loc->content;		
			$this->file = null;
			
			$this->oldfilepath = $loc->file;
			$this->oldfile = asset($loc->file);

			$this->rules = [
				'file' => ($this->types == 'add' || ($this->types == 'edit' && empty($this->oldfilepath)) ? 'required' : 'nullable') . '|file|max:1000|mimes:jpg,jpeg,png,svg|dimensions:min_width=1200,min_height=500',
				// 'type' => 'required',
				'name' => 'required',
				'content' => 'required',
				'short_description' => 'required',
			];
		}
	}

    protected function rules() {
		$rules = [
			'file' => ($this->types == 'add' || ($this->types == 'edit' && empty($this->oldfilepath)) ? 'required' : 'nullable') . '|file|max:1000|mimes:jpg,jpeg,png,svg|dimensions:min_width=1200,min_height=500',
			// 'type' => 'required',
			'name' => 'required',
			'content' => 'required',
			'short_description' => 'required',
		];
		return $rules;
	}

    public function render()
    {
        return view('livewire.admin.admin-resource');
    }

	public function updated($name) {
		$this->validateOnly($name);
	}

    public function submitresource() {
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->getRules(), [], $this->validationAttributes);
		
        $commasaprated = implode(',', $this->type);
		if ($this->types == 'edit') {
			$msg = 'Resource updated successfully';
			$resource = Resource::find($this->slug);
			// $resource->type = $commasaprated;
			$resource->name = $this->name;
			$resource->short_description = $this->short_description;
			$resource->content=$this->content;
			if (!empty($this->file)) {
				// $resource->file = $this->file->store('uploads/resources');

				$filename    = $this->file->getClientOriginalName();	
				$image_resize = Image::make($this->file->getRealPath());
				$image_resize->resize( Helper::getBladeSetting('resources_image_width') ,Helper::getBladeSetting('resources_image_height') );
				$image_resize->save(public_path('uploads/resources/' .$filename));
				$resource->file = 'uploads/resources/' .$filename;
			}
			$resource->status = 'AC';
			$resource->save();
			$this->dispatchBrowserEvent('show-success');
			session()->flash('message', $msg);
			return redirect()->route('resource');
			
		} else {
			
			$msg = 'Resource added successfully';
			$resource = new resource;
			// $resource->type = $commasaprated;
			$resource->name = $this->name;
			$resource->short_description = $this->short_description;
			$resource->content=$this->content;

			$filename    = $this->file->getClientOriginalName();	
			$image_resize = Image::make($this->file->getRealPath());
			$image_resize->resize(Helper::getBladeSetting('resources_image_width') , Helper::getBladeSetting('resources_image_height') );
			$image_resize->save(public_path('uploads/resources/' .$filename));
			$resource->file = 'uploads/resources/' .$filename;
	
			$resource->status = 'AC';

			if ($resource->save()) {
				$this->dispatchBrowserEvent('show-success');
				session()->flash('message', $msg);
				return redirect()->route('resource');
			} else {
				session()->flash('error', 'Something went wrong! Please try again later.');
				$this->dispatchBrowserEvent('show-error');
			}
		}
		
	}
}
