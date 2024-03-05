<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PropertyDataTable;
use App\DataTables\AgentDataTable;
use App\DataTables\OfferDataTable;
use App\Http\Controllers\Controller;
use App\Models\Agent;
use App\Models\Buyer;
use Illuminate\Http\Request;
use Session;
use URL;
use Auth;

use Log;
use Illuminate\Support\Facades\DB;

class AgentController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request, AgentDataTable $dt) {
		$opt_mode = config()->get('constants.buyer_opt_modes');

		// $active_count = Agent::where('user_type', '=', 'agent')->whereHas('offers', function ($q) {
		// 	$q->whereIn('status', ['IN', 'PN', 'AC']);
		// })->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;
		// $active_count = Agent::where('user_type', '=', 'agent')->where(function ($q) {
			
		// 	$q->whereHas('offers', function ($q) {
		// 		$q->whereIn('status', ['IN', 'PN', 'AC']);
		// 		})
		// 		->orWhereHas('property.offers', function ($q) {
		// 			$q->whereIn('status', ['IN', 'PN', 'AC']);
		// 			});
					
		// })->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;
		// Enable query logging
			

			// Execute your query
			$active_count = Agent::where('user_type', '=', 'agent')->where(function ($q) {
				$q->whereHas('offers', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC']);
				})->orWhereHas('agent_properties.offers', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC']);
				});
			})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;

			
			
		
		$inactive_count = Agent::where('user_type', '=', 'agent')->where(function ($q) {
			$q->whereNull('last_activity')->orWhereDate('last_activity', '<=', date('Y-m-d H:i:s', strtotime('-5 days')));
		})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;
	
		// $past_count = Agent::where('user_type', '=', 'agent')->whereHas('offers', function ($q) {
		// 	$q->whereNotIn('status', ['SO', 'RJ', 'CL']);
		// }, '<=', 0)->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;
		DB::enableQueryLog();
		$past_count = Agent::where('user_type', '=', 'agent')->where(function ($que) {
			$que->where(function ($q) {
				$q->whereHas('offers', function ($qu) {
					$qu->whereNotIn('status', ['SO', 'RJ', 'CL']);
				}, '<=', 0)
				->whereHas('head',function($qu){
					$qu->whereUserType('buyer');
				});
			})->orWhere(function ($q) {
				$q->whereHas('agent_properties', function($qu) {
					$qu->where('vms_end_date', '>', date('Y-m-d H:i:s'));
				}, '<=', 0)
				->whereHas('head',function($qu){
					$qu->whereUserType('seller');
				});
			});
		})->selectRaw('COALESCE(count(DISTINCT phone_no),0) as count')->first()->count;
		// Retrieve the executed queries
		$queries = DB::getQueryLog();

		// Disable query logging
		DB::disableQueryLog();
		// dd($queries);
		return $dt->render('admin.agent.list', ['title' => 'Agent', 'opt_mode' => $opt_mode, 'active_count' => $active_count, 'inactive_count' => $inactive_count, 'past_count' => $past_count]);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Request $request) {
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  \App\Models\Agent  $agent
	 * @return \Illuminate\Http\Response
	 */

	public function show($id, OfferDataTable $ot ,PropertyDataTable $pt) {
		
		$privious_url = URL::previous();
		$agent = Agent::find($id);
		// dd($agent);
		$u = Buyer::whereAgentId($id)->first();
		$usertype = ($u->user_type == 'buyer') ? 'buyer-agent' : 'seller-agent';
			return $pt->with(['type'=> $usertype,'user_id'=> $id])->render('admin.agent.view', [
				'agent' => $agent,
				'usertype' => $usertype,
				'offers' => $ot->with('user_id', $id)->with('type', 'agent')->html(),
				'title' => 'View Agent',
				'privious_url' => $privious_url,
			]);
	}

	public function getOffers($id = null, OfferDataTable $ot) {
		return $ot->with('user_id', $id)->with('type', 'agent')->render('admin.agent.view');
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  \App\Models\Agent  $agent
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		$privious_url = URL::previous();
		$url = "update-agent";
		$agent = Agent::find($id);

		return view('admin.agent.edit', array('agent' => $agent, 'title' => 'Edit Agent', 'url' => $url, 'privious_url' => $privious_url));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Agent  $agent
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$agent = Agent::findOrFail($id);

		$this->validate($request, array(
			// 'first_name' => 'required',
			// 'last_name' => 'required',
			'comment_note' => 'required',
		)
		);

		$input = $request->all();

		$agent->fill($input)->save();
		session()->flash('success', 'Agent details updated successfully!');
		return redirect(url($request->privious_url));
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  \App\Models\Agent  $agent
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		$privious_url = URL::previous();
		Agent::find($id)->delete();
		session()->flash('success', 'Agent deleted successfully!');
		return redirect(url($privious_url));
	}

	public function block($id) {
		
		$privious_url = URL::previous();

		$url = "block-agent";
		$agent = Agent::find($id);
		return view('admin.agent.block', array('agent' => $agent, 'title' => 'Block/Unblock Agent', 'url' => $url , 'privious_url' => $privious_url));

	}

	/**
	 * Block the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Agent  $agent
	 * @return \Illuminate\Http\Response
	 */
	public function update_block(Request $request, $id) {
		$privious_url = $request->privious_url;
		$agent = Agent::findOrFail($id);
		$this->validate($request, array('status' => 'required'));
		try {
			$input = $request->all();
			$agent->fill($input)->save();
			session()->flash('success', 'Block/unblock updated successfully!');
			return redirect(url($privious_url));
		} catch (\Exception $e) {
			// do task when error
			echo $e->getMessage(); // insert query
		}

	}
}
