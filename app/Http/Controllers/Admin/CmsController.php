<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Cms;
use Illuminate\Http\Request;
use Image;

class CmsController extends Controller
{
    public function __construct() {
		$this->cms = new Cms;
		$this->columns = [
			"sno", "title", "action",
		];
	}

	public function index() {
		$title = 'Manage CMS';
		// dd($title);
		// return view('admin.cms.index', compact('title'));
	}

	public function cmsAjax(Request $request) {

		{
			$data = Cms::where('parent_id', null)->get();
			$cms = $data->flatten()->unique('title');
			$records = Cms::count();
			$total = $records;

			// echo $total;
			$result = [];
			$i = 1;
			foreach ($cms as $list) {

				$data = [];
				$data['sno'] = $i++;
				$data['name'] = $list->title;
				$action = '&nbsp;&nbsp;&nbsp;<a href="' . route('editCMS', $list->slug) . '" class="btn btn-outline-brand btn-pill">Edit</a>
                &nbsp;&nbsp;&nbsp;<a href="' . route('viewCMS', $list->slug) . '" class="btn btn-outline-brand btn-pill">View</a>';

				$data['action'] = $action;

				$result[] = $data;
			}

			$data = json_encode([
				'data' => $result,
				'recordsTotal' => $total,
				'recordsFiltered' => $total,
			]);
			echo $data;

		}

	}

	// public function editCMS(Request $request, $slug = null) {

	// 	if ($slug == 'about_us') {
	// 		$title = 'About Us';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.about', compact('data', 'title', 'slug', 'status', 'id'));

	// 	}
	// 	if ($slug == 'why_tutor') {
	// 		$title = 'Why Tutor';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.why_tutor', compact('data', 'title', 'slug', 'status', 'id'));

	// 	}
	// 	if ($slug == 'why_choose_us') {
	// 		$title = 'Why Choose Us';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.choose_us', compact('data', 'title', 'slug', 'status', 'id'));
	// 	}
	// 	if ($slug == 'tutor') {
	// 		$title = 'Home Tutor';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.tutor', compact('data', 'title', 'slug', 'status', 'id'));
	// 	}
	// 	if ($slug == 'student') {
	// 		$title = 'Home Student';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.student', compact('data', 'title', 'slug', 'status', 'id'));
	// 	}
	// 	if ($slug == 'otoo_works') {
	// 		$title = 'How To Otoo Works';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.otoo_works', compact('data', 'title', 'slug', 'status', 'id'));
	// 	}
	// 	if ($slug == 'doorsteps') {
	// 		$title = 'Otoo Doorsteps';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.doorsteps', compact('data', 'title', 'slug', 'status', 'id'));
	// 	}
	// 	if ($slug == 'otoo_advantage') {
	// 		$title = 'Otoo Advantages';
	// 		$id1 = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$image1 = Cms::where('slug', $slug)->where('parent_id', null)->value('image');
	// 		$status = Cms::where('slug', $slug)->where('parent_id', null)->value('status');
	// 		$data1 = Cms::where('slug', $slug)->where('parent_id', $id1)->get();

	// 		$id2 = Cms::where('slug', 'otoo_advantage2')->where('parent_id', null)->value('id');
	// 		$image2 = Cms::where('slug', 'otoo_advantage2')->where('parent_id', null)->where('id', $id2)->value('image');
	// 		$data2 = Cms::where('slug', $slug)->where('parent_id', $id2)->get();

	// 		return view('admin.cms.advantage', compact('data1', 'image1', 'image2', 'title', 'slug', 'status', 'id1', 'id2', 'data2'));
	// 	}

	// }

	// public function viewCMS(Request $request, $slug = null) {

	// 	if ($slug == 'about_us') {
	// 		$title = 'About Us View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.about_view', compact('view', 'title', 'slug'));

	// 	}
	// 	if ($slug == 'why_tutor') {
	// 		$title = 'Why Tutor View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.why_tutor_view', compact('view', 'title', 'slug'));

	// 	}
	// 	if ($slug == 'why_choose_us') {
	// 		$title = 'Why Choose Us View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.choose_us_view', compact('view', 'title', 'slug'));
	// 	}
	// 	if ($slug == 'tutor') {
	// 		$title = 'Tutor View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.tutor_view', compact('view', 'title', 'slug'));
	// 	}
	// 	if ($slug == 'student') {
	// 		$title = 'Student View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.student_view', compact('view', 'title', 'slug'));
	// 	}
	// 	if ($slug == 'otoo_works') {
	// 		$title = 'Otoo Works View';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.otoo_works_view', compact('view', 'title', 'slug', 'id'));
	// 	}
	// 	if ($slug == 'doorsteps') {
	// 		$title = 'Otoo Doorsteps';
	// 		$id = Cms::where('slug', $slug)->where('parent_id', null)->value('id');
	// 		$view = Cms::where('slug', $slug)->where('parent_id', $id)->get();
	// 		return view('admin.cms.doorsteps_view', compact('view', 'title', 'slug', 'id'));
	// 	}

	// }

	// public function about_otoo() {
	// 	$data = Cms::where('parent_id', 2)->get();
	// 	return view('admin.cms.about', compact('data'));
	// }

	public function update(Request $request) {
		$validate = Validator($request->all(), [
			'title' => 'required',
			'title.*' => 'required',
			'content' => 'required',
			'content.*' => 'required',
		]);
		if ($validate->fails()) {
			session()->flash('error', 'Error');
			return redirect()->back();
		} else {
			foreach ($request->title as $key => $value) {

				$data = [

					'title' => $request->title[$key],
					'content' => $request->content[$key],
				];

				Cms::where('id', $request->id[$key])->update($data);

			}
			if ($request->status == null) {
				Cms::where('id', $request->parent_id)->update([
					'status' => 'IN',
				]);
			} elseif ($request->status == "on") {
				Cms::where('id', $request->parent_id)->update([
					'status' => 'AC',
				]);

			}
			session()->flash('success', 'Successfully Update');
			return redirect()->back();
		}
	}

	// public function why_tutor_update(Request $request) {

	// 	$validate = Validator($request->all(), [
	// 		'title' => 'required',
	// 		'title.*' => 'required',
	// 		'content' => 'required',
	// 		'content.*' => 'required',
	// 	]);
	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		foreach ($request->content as $key => $value) {

	// 			$data = [

	// 				'title' => $request->title[$key],
	// 				'content' => $request->content[$key],
	// 			];

	// 			if ($request->file('image')) {

	// 				foreach ($request->image as $key => $value) {
	// 					//dd($request->old_image[$key]);
	// 					unlink('uploads/why_tutor/' . $request->old_image[$key]);
	// 					$file = $request->image[$key];
	// 					$image_resize = Image::make($file);
	// 					$image_resize->resize(87, 89);
	// 					$name = $request->image[$key]->getClientOriginalName();
	// 					$filename = time() . "-" . $name;
	// 					$image_resize->save(public_path('uploads/why_tutor/' . $filename));

	// 					Cms::findOrFail($request->id[$key])->update([

	// 						'title' => $request->title[$key],
	// 						'content' => $request->content[$key],
	// 						'image' => $filename,
	// 					]);
	// 					//dd('d');
	// 				}
	// 				session()->flash('success', 'Successfully Update');
	// 				return redirect()->back();
	// 			} else {

	// 				Cms::where('id', $request->id[$key])->update($data);
	// 			}
	// 			if ($request->status == null) {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'IN',
	// 				]);
	// 			} elseif ($request->status == "on") {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'AC',
	// 				]);
	// 			}
	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();
	// }

	// public function update_choose_us(Request $request) {

	// 	$validate = Validator($request->all(), [
	// 		'title' => 'required',
	// 		'title.*' => 'required',
	// 		'content' => 'required',
	// 		'content.*' => 'required',
	// 	]);
	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		foreach ($request->id as $key => $value) {

	// 			$all_data = [
	// 				'id' => $request->id[$key],
	// 				'img_id' => $request->old_image[$key],
	// 				'title' => $request->title[$key],
	// 				'content' => $request->content[$key],
	// 			];

	// 			$data = [
	// 				'title' => $request->title[$key],
	// 				'content' => $request->content[$key],
	// 			];

	// 			if ($request->file('image')) {

	// 				foreach ($request->image as $key => $value) {
	// 					//dd($request->old_image[$key]);
	// 					unlink('uploads/choose_us/' . $request->old_image[$key]);
	// 					$file = $request->image[$key];
	// 					$image_resize = Image::make($file);
	// 					$image_resize->resize(125, 121);
	// 					$name = $request->image[$key]->getClientOriginalName();
	// 					$filename = time() . "-" . $name;
	// 					$image_resize->save(public_path('uploads/choose_us/' . $filename));

	// 					Cms::findOrFail($request->id[$key])->update([

	// 						'title' => $request->title[$key],
	// 						'content' => $request->content[$key],
	// 						'image' => $filename,
	// 					]);
	// 					//dd('d');
	// 				}
	// 				session()->flash('success', 'Successfully Update');
	// 				return redirect()->back();
	// 			} else {
	// 				Cms::where('id', $request->id[$key])->update($data);

	// 				if ($request->status == null) {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'IN',
	// 					]);
	// 				} elseif ($request->status == "on") {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'AC',
	// 					]);
	// 				}
	// 			}

	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();

	// }

	// public function update_home_tutor(Request $request) {
	// 	//dd($request->content);
	// 	$validate = Validator($request->all(), [
	// 		'title' => 'required',
	// 		'content' => 'required',
	// 	]);
	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		if ($request->file('image')) {

	// 			unlink('uploads/home_tutor/' . $request->old_image);
	// 			$file = $request->image;
	// 			$image_resize = Image::make($file);
	// 			$image_resize->resize(658, 587);
	// 			$name = $request->image->getClientOriginalName();
	// 			$filename = time() . "-" . $name;
	// 			$image_resize->save(public_path('uploads/home_tutor/' . $filename));

	// 			Cms::findOrFail($request->id)->update([

	// 				'title' => $request->title,
	// 				'content' => $request->content,
	// 				'image' => $filename,
	// 			]);
	// 			session()->flash('success', 'Successfully Update');
	// 			return redirect()->back();
	// 		} else {
	// 			Cms::where('id', $request->id)->update([
	// 				'title' => $request->title,
	// 				'content' => $request->content,
	// 			]);

	// 			if ($request->status == null) {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'IN',
	// 				]);
	// 			} elseif ($request->status == "on") {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'AC',
	// 				]);
	// 			}
	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();

	// }

	// public function update_home_student(Request $request) {

	// 	$validate = Validator($request->all(), [
	// 		'title' => 'required',
	// 		'content' => 'required',
	// 	]);
	// 	$data = [
	// 		'title' => $request->title,
	// 		'content' => $request->content,
	// 	];
	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		if ($request->file('image')) {

	// 			unlink('uploads/home_student/' . $request->old_image);
	// 			$file = $request->image;
	// 			$image_resize = Image::make($file);
	// 			$image_resize->resize(658, 587);
	// 			$name = $request->image->getClientOriginalName();
	// 			$filename = time() . "-" . $name;
	// 			$image_resize->save(public_path('uploads/home_student/' . $filename));

	// 			Cms::where('id', $request->id)->update([

	// 				'title' => $request->title,
	// 				'content' => $request->content,
	// 				'image' => $filename,
	// 			]);
	// 			session()->flash('success', 'Successfully Update');
	// 			return redirect()->back();
	// 		} else {
	// 			Cms::where('id', $request->id)->update($data);

	// 			if ($request->status == null) {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'IN',
	// 				]);
	// 			} elseif ($request->status == "on") {
	// 				Cms::where('id', $request->parent_id)->update([
	// 					'status' => 'AC',
	// 				]);
	// 			}

	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();
	// }

	// public function update_otoo_works(Request $request) {

	// 	$validate = Validator($request->all(), [
	// 		'content' => 'required',
	// 		'content.*' => 'required',
	// 	]);
	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		foreach ($request->id as $key => $value) {

	// 			$all_data = [
	// 				'id' => $request->id[$key],
	// 				'img_id' => $request->old_image[$key],
	// 				'content' => $request->content[$key],
	// 			];

	// 			$data = [
	// 				'content' => $request->content[$key],
	// 			];

	// 			if ($request->file('image')) {

	// 				foreach ($request->image as $key => $value) {
	// 					//dd($request->old_image[$key]);
	// 					unlink('uploads/otoo_works/' . $request->old_image[$key]);
	// 					$file = $request->image[$key];
	// 					$image_resize = Image::make($file);
	// 					$image_resize->resize(125, 121);
	// 					$name = $request->image[$key]->getClientOriginalName();
	// 					$filename = time() . "-" . $name;
	// 					$image_resize->save(public_path('uploads/otoo_works/' . $filename));

	// 					Cms::findOrFail($request->id[$key])->update([
	// 						'content' => $request->content[$key],
	// 						'image' => $filename,
	// 					]);
	// 					//dd('d');
	// 				}
	// 				session()->flash('success', 'Successfully Update');
	// 				return redirect()->back();
	// 			} else {

	// 				Cms::where('id', $request->id[$key])->update($data);
	// 				if ($request->status == null) {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'IN',
	// 					]);
	// 				} elseif ($request->status == "on") {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'AC',
	// 					]);
	// 				}

	// 			}
	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();

	// }

	// public function update_otoo_doorsteps(Request $request) {
	// 	$validate = Validator($request->all(), [
	// 		'content' => 'required',
	// 		'content.*' => 'required',
	// 	]);

	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		foreach ($request->id as $key => $value) {

	// 			$data = [
	// 				'content' => $request->content[$key],
	// 			];

	// 			Cms::where('id', $request->id[$key])->update($data);

	// 		}

	// 		if ($request->status == null) {
	// 			Cms::where('id', $request->parent_id)->update([
	// 				'status' => 'IN',
	// 			]);
	// 		} elseif ($request->status == "on") {
	// 			Cms::where('id', $request->parent_id)->update([
	// 				'status' => 'AC',
	// 			]);
	// 		}
	// 	}
	// 	session()->flash('success', 'Successfully Update');
	// 	return redirect()->back();
	// }

	// public function update_otoo_advantage(Request $request) {

	// 	$validate = Validator($request->all(), [
	// 		'content' => 'required',
	// 		'content.*' => 'required',
	// 	]);

	// 	if ($validate->fails()) {
	// 		session()->flash('error', 'Error');
	// 		return redirect()->back();
	// 	} else {

	// 		foreach ($request->id as $key => $value) {

	// 			$data = [
	// 				'content' => $request->content[$key],
	// 			];
	// 			if ($request->file('image')) {
	// 				foreach ($request->image as $key => $value) {
	// 					dd($request->old_image[$key]);
	// 					unlink('uploads/advantage/' . $request->old_image[$key]);
	// 					$file = $request->image[$key];
	// 					$image_resize = Image::make($file);
	// 					$image_resize->resize(125, 121);
	// 					$name = $request->image[$key]->getClientOriginalName();
	// 					$filename = time() . "-" . $name;
	// 					$image_resize->save(public_path('uploads/otoo_works/' . $filename));

	// 					Cms::findOrFail($request->id[$key])->update([
	// 						'content' => $request->content[$key],
	// 						'image' => $filename,
	// 					]);
	// 					//dd('d');
	// 				}
	// 				session()->flash('success', 'Successfully Update');
	// 				return redirect()->back();
	// 			} else {

	// 				Cms::where('id', $request->id[$key])->update($data);
	// 				if ($request->status == null) {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'IN',
	// 					]);
	// 				} elseif ($request->status == "on") {
	// 					Cms::where('id', $request->parent_id)->update([
	// 						'status' => 'AC',
	// 					]);
	// 				}

	// 			}
	// 		}

	// 	}
	// }
}
