<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PropertyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Property;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use URL;

class PropertiesController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, PropertyDataTable $dt) {

		$total_all = Property::count();
		$total_nl = Property::where('status', 'NL')->count();
		$total_ip = Property::where('status', 'IP')->count();
		$total_rj = Property::where('status', 'RJ')->count();
		$total_ac = Property::where('status', 'AC')->count();
		$total_vc = Property::where('status', 'VC')->count();
		$total_fa = Property::where('status', 'FR')->count();
		$total_fl = Property::where('status', 'FL')->count();

		$fullarr = ['title' => 'Properties', 'total_all' => $total_all, 'total_nl' => $total_nl, 'total_ip' => $total_ip, 'total_rj' => $total_rj, 'total_ac' => $total_ac, 'total_vc' => $total_vc, 'total_fa' => $total_fa, 'total_fl' => $total_fl];

		return $dt->render('admin.properties.list', $fullarr);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	// public function create()
	// {
	//     return view('admin.properties.create', array('title' => 'Create Properties','propertyid'=> $propertyid));
	// }

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	// public function store(Request $request)
	// {

	//     $rules = [
	//         //'file' => 'image|mimes:jpeg,png,jpg|max:1024',
	//         'vms_property_id' => 'required',
	//         'property_name' => 'required',
	//         'property_address' => 'required',
	//         'owner_name' => 'required',
	//         'vms_start_date' => 'required',
	//         'vms_end_date' => 'required',
	//        ];

	//     $validator = Validator::make($request->post(), $rules);

	//     if ($validator->fails())
	//     {
	//     return redirect(route('create-properties'))->withErrors($validator);

	//     }

	//     try{
	//         $property = new Property;
	//         $property->user_id = 4;
	//         $property->vms_property_id = $request->vms_property_id;
	//         $property->property_name = $request->property_name;
	//         $property->property_address = $request->property_address;
	//         $property->owner_name = $request->owner_name;
	//         $property->vms_start_date = $request->vms_start_date;
	//         $property->vms_end_date = $request->vms_end_date;
	//         $property->reserved_price = $request->reserved_price;
	//         $property->square_foot_rate = $request->square_foot_rate;
	//         $property->offer_increase = $request->offer_increase;
	//         $property->disclosure = $request->disclosure;
	//         $property->occupancy = $request->occupacy;
	//         $property->possession = $request->possession;
	//         $property->property_type = $request->property_type;
	//         $property->itmes_include_exclude = $request->itmes_include_exclude;
	//         $property->seller_financing = $request->seller_financing;
	//         $property->seller_credit_buyer = $request->seller_credit_buyer;
	//         $property->purchase_agreement = $request->purchase_agreement;
	//         $property->brokerage_name = $request->brokerage_name;
	//         $property->brokerge_license_no = $request->brokerge_license_no;
	//         $property->agent_name = $request->agent_name;
	//         $property->agent_license = $request->agent_license;
	//         $property->escrow_holder = $request->escrow_holder;
	//         $property->escrow_number = $request->escrow_number;
	//         $property->escrow_officer = $request->escrow_officer;
	//         $property->escrow_office_email = $request->escrow_office_email;
	//         $property->escrow_office_phone = $request->escrow_office_phone;
	//         $property->transaction_coordinator = $request->transaction_coordinator;
	//         $property->transaction_coordinator_email = $request->transaction_coordinator_email;
	//         $property->transaction_coordinator_phone = $request->transaction_coordinator_phone;
	//         $property->save(); // returns false

	//         session()->flash('success', 'Property Create successfully!');
	//         return redirect(route('properties'));
	//      }
	//      catch(\Exception $e){
	//         // do task when error
	//         echo $e->getMessage();   // insert query
	//      }

	// }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show(Request $request, $id) {

		$previous_url = URL::previous();
		Session::put('previous_url', $previous_url);
		$property = Property::find($id);
		$title = 'Property Details';

		return view('admin.properties.view', compact('property', 'title', 'previous_url'));

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	public function change_status(Request $request, $id) {

		$property = Property::findOrFail($id);
		$this->validate($request, array(
			'status' => 'required',
			'comment_note' => 'required',
		)
		);
		try {
			$input = $request->all();
			$property->fill($input)->save();
			session()->flash('success', 'Status updated successfully!');
			return redirect(url($request->previous_url));
		} catch (\Exception $e) {
			// do task when error
			echo $e->getMessage(); // insert query
		}

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
