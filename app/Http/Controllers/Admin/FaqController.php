<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\FaqDataTable;
use App\Models\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FaqController extends Controller
{
    public function index(Request $request, FaqDataTable $dt)
    {

        return $dt->render('admin.faq.index',['title' => 'faq']);
    }


    public function create()
    {

        $id = null;
        $title = 'Add';
        return view('admin.faq.add', compact('title','id'));
    }


    public function edit(Request $request, $id = NULl)
    {
        $title = 'Edit';
       return view('admin.faq.add', compact('title','id'));
    }



    public function update(Request $request)
    {

        $validate = Validator($request->all(), [
            'faq_que' => 'required',
            'faq_ans' => 'required',
        ]);
        
        $faq_id =  $request->faq_id;
        if ($validate->fails()) {
            return redirect()->route("edit-faq")->withInput($request->all())->withErrors($validate);
        } else {   
            Faq::where('id',$faq_id)->update([
    
                'faq_que' => $request->faq_que,
                'faq_ans' => $request->faq_ans,
                'status' => 'AC',
            ]);
        
        }
        session()->flash('success', 'Successfully update');
        return Redirect::route('faq');

    }

    public function delete(Request $request, $id = null){

    	Faq::where('id', $id)->update(['status' => 'DL']);
        Faq::where('id', $id)->delete();
        
        session()->flash('success', 'Faq Deleted Successfully');
        return redirect()->route('faq');
    }

    public function inactive(Request $request, $id = null){

        Faq::where('id', $id)->update(['status' => 'IN']);
        session()->flash('success', 'Faq Inactive Successfully');
        return redirect()->route('faq');

    }

    public function active(Request $request, $id = null){

        Faq::where('id', $id)->update(['status' => 'AC']);
        session()->flash('success', 'Faq Active Successfully');
        return redirect()->route('faq');

    }
}
