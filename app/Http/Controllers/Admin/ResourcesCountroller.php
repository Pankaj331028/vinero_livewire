<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\ResourceDataTable;
use App\Models\Resource;
use Illuminate\Support\Facades\Redirect;
use URL;

class ResourcesCountroller extends Controller
{
    public function index(Request $request, ResourceDataTable $dt)
    {
        
        return $dt->render('admin.resource.index',['title' => 'resources']);
    }

    public function create()
    {
        $id = null;
        $title = 'Add';
        return view('admin.resource.add', compact('title','id'));
    }

    public function edit(Request $request, $id = NULl)
    {
        $title = 'Edit';
       return view('admin.resource.add', compact('title','id'));
    }
    
    public function show($id, ResourceDataTable $ot){

        $previous_url = URL::previous();
		$resources = Resource::find($id);
        $title = 'Resources View';

        return view('admin.resource.view', compact('resources', 'title'));
    }

    public function delete(Request $request, $id = null){

    	Resource::where('id', $id)->update(['status' => 'DL']);
        Resource::where('id', $id)->delete();
        
        session()->flash('success', 'Resource Deleted Successfully');
        return redirect()->route('resource');
    }

    public function inactive(Request $request, $id = null){

        Resource::where('id', $id)->update(['status' => 'IN']);
        session()->flash('success', 'Resource Inactive Successfully');
        return redirect()->route('resource');

    }

    public function active(Request $request, $id = null){

        Resource::where('id', $id)->update(['status' => 'AC']);
        session()->flash('success', 'Resource Active Successfully');
        return redirect()->route('resource');

    }
}
