<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cms extends Model
{
    use HasFactory;

    protected $guarded = [];

	protected $table = 'cms';

	public function sections() {
		return $this->hasMany(Cms::class, 'parent_id', 'id');
	}

	public function getChild($slug) {

		return str_replace("span","em",$this->sections()->where('slug', $slug)->first()->content,$i);
	}

	public function getdate($slug) {

		return $this->sections()->where('slug', $slug)->first()->updated_at;
	}


	public function fetchCMS($request, $columns) {
		$query = Cms::whereNull('parent_id')->where('status', '!=', 'DL');
		if (isset($request->search)) {
			$query->where(function ($q) use ($request) {
				$q->orWhere('name', 'like', '%' . $request->search . '%');
			});
		}

		if (isset($request->order_column)) {
			$cms = $query->orderBy($columns[$request->order_column], $request->order_dir);
		} else {
			$cms = $query->orderBy('id', 'asc');
		}
		return $cms;
	}
}
