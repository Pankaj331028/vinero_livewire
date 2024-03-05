<?php

namespace App\Http\Livewire\Admin;

use App\Models\Cms;
use App\Traits\Helper;
use Livewire\Component;
use Livewire\WithFileUploads;

class ManageCms extends Component {
	use WithFileUploads, Helper;

	public $slug;
	public $page;
	public $title;
	public $meta_desc;
	public $meta_key;
	public $content;
	public $section_content = [];
	public $sections = [];
	public $path;
	public $video_cms;

	public $rules;
	public $validationAttributes;

	public function mount($slug) {
		$this->slug = $slug;
		$this->page = Cms::whereSlug($this->slug)->first();
		$this->title = $this->page->page_title;
		$this->meta_desc = $this->page->meta_description;
		$this->meta_key = $this->page->meta_keywords;

		if (!isset($this->page->title)) {
			session()->flash('error', 'Invalid Request');
			return redirect()->route('index');
		}

		$this->validationAttributes['title'] = 'Page Title';
		$this->validationAttributes['meta_desc'] = 'Meta Description';
		$this->validationAttributes['meta_key'] = 'Meta Keywords';

		$this->rules['title'] = 'required';
		$this->rules['meta_desc'] = 'required';
		$this->rules['meta_key'] = 'required';

		if ($this->page->sections->count() > 0) {
			foreach ($this->page->sections as $key => $value) {
				array_push($this->sections, $value->toArray());
				if ($value->type == 'video') {
					$this->video_cms = $value->content;
					$this->section_content[$value->slug] = null;
				} else {
					$this->section_content[$value->slug] = $value->content;
				}

				switch ($value->type) {
				case 'text':$this->rules['section_content.' . $value->slug] = 'required';
					break;
				case 'textarea':$this->rules['section_content.' . $value->slug] = 'required';
					break;
				case 'editor':$this->rules['section_content.' . $value->slug] = 'required';
					break;
				case 'video':
					if ($value->content == '') {

						$this->rules['section_content.' . $value->slug] = 'required|max:10240|mimetypes:video/mp4';

					} else {

						$this->rules['section_content.' . $value->slug] = 'nullable|max:10240|mimetypes:video/mp4';
					}

					break;
				}
				$this->validationAttributes['section_content.' . $value->slug] = $value->title;
			}
		} else {

			$this->content = $this->page->content;
			$this->rules['content'] = 'required';
			$this->validationAttributes['content'] = 'Content';
		}

	}

	public function render() {
		return view('livewire.admin.manage-cms');
	}

	public function updated($name) {
		$this->validateOnly($name);
	}

	public function updatePage() {
		$this->dispatchBrowserEvent('update-summernote');
		$this->dispatchBrowserEvent('error-result');
		$this->validate($this->rules);

		$page = Cms::whereSlug($this->slug)->first();
		$page->page_title = $this->title;
		$page->meta_description = $this->meta_desc;
		$page->meta_keywords = $this->meta_key;
		$page->save();

		if ($page->sections->count() > 0) {
			foreach ($this->sections as $key => $value) {
				$section = Cms::whereId($value['id'])->first();
				if ($value['type'] == 'video') {

					if ($this->section_content[$value['slug']] == null) {

						$this->path = $this->video_cms;
					} else {
						$this->path = $this->section_content[$value['slug']]->store('uploads/videos');
					}

				}
				switch ($value['type']) {

				case 'text':
				case 'textarea':
				case 'editor':$section->content = $this->section_content[$value['slug']];
					break;
				case 'video':$section->content = $this->path;
					break;
				}
				$section->save();
			}
		} else {
			$page->content = $this->content;
			$page->save();
		}

		session()->flash('message', 'Page updated successfully.');
		$this->dispatchBrowserEvent('show-success');
	}
}
