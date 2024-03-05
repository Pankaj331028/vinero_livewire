<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SurveyDataTable;
use App\Http\Controllers\Controller;
use App\Models\Survey;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class SurveyController extends Controller {
	public function index(Request $request, SurveyDataTable $dt) {
		if (isset($request->start_date) || isset($request->end_date)) {
			$start = Carbon::parse($request->start_date)->toDateTimeString();

			$end = Carbon::parse($request->end_date)->toDateTimeString();

			$buyers = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.id')
				->select('users.*', 'surveys.id AS s_id', 'surveys.created_at')
				->where('users.user_type', 'buyer')
				->whereDate('surveys.created_at', '<=', $end)
				->whereDate('surveys.created_at', '>=', $start)
				->get();

			$seller = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', 'seller')
				->whereDate('surveys.created_at', '<=', $end)
				->whereDate('surveys.created_at', '>=', $start)
				->get();

			$bagent = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.agent_id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', '=', 'buyer')
				->whereDate('surveys.created_at', '<=', $end)
				->whereDate('surveys.created_at', '>=', $start)
				->get();

			$sagent = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.agent_id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', '=', 'seller')
				->whereDate('surveys.created_at', '<=', $end)
				->whereDate('surveys.created_at', '>=', $start)
				->get();

		} else {
			$buyers = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.id')
				->select('users.*', 'surveys.id AS s_id', 'surveys.created_at')
				->where('users.user_type', 'buyer')
				->get('limit', 5);

			$seller = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', 'seller')
				->get('limit', 5);

			$bagent = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.agent_id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', '=', 'buyer')
				->get('limit', 5);

			$sagent = DB::table('surveys')
				->join('users', 'surveys.user_id', '=', 'users.agent_id')
				->select('users.*', 'surveys.id AS s_id')
				->where('users.user_type', '=', 'seller')
				->get('limit', 5);
		}

		$buyer_group_sum = 0;
		$seller_group_sum = 0;
		$sagent_group_sum = 0;
		$bagent_group_sum = 0;

		$type = config()->get('constants.survey_type');

		//$buyers->whereBetween('created_at', [$start, $end]);

		//dd($buyers);

		$buyerscount = count($buyers);

		$sellercount = count($seller);

		$bagentcount = count($bagent);

		$sagentcount = count($sagent);

		$type_count = count(config()->get('constants.survey_type'));

		$no_of_point = 5;
		$score_per_card = $no_of_point * $type_count;

		$buyer_data = array();
		foreach ($type as $key => $v) {
			$sum = 0;
			$algebric_sum = 0;
			foreach ($buyers as $value) {

				$buyer_data[$v][$value->s_id . '/' . $value->phone_no] = Survey::where('id', $value->s_id)->value($key);
				$sum += !empty($buyer_data[$v][$value->s_id . '/' . $value->phone_no]) ? $buyer_data[$v][$value->s_id . '/' . $value->phone_no] : 0;
				//echo $sum.',';
			}
			//echo "<br>";
			if (count($buyers) > 0) {
				$buyer_data[$v]['Group Average'] = $sum / count($buyers);
				$buyer_group_sum += $buyer_data[$v]['Group Average'] = $sum / count($buyers);
			}
			// $column = $buyer_data[$v]['Group Average'];
			// usort($buyer_data, fn($a, $b) => $a[$column] <=> $b[$column]);

		}
		if (count($buyers) > 0 && $buyer_group_sum > 0) {
			$buyer_group_avg_scr = round($type_count / $buyer_group_sum, 2);
			$buyer_per_score = round($type_count / $buyer_group_sum * 100, 2);
		} else {
			$buyer_group_avg_scr = 0;
			$buyer_per_score = 0;
		}

		$true = array_multisort(array_column($buyer_data, 'Group Average'), SORT_ASC, SORT_NUMERIC, $buyer_data);
		//$true = collect($buyer_data)->sortByDesc('Group Average')->all();
		// $sortkeys = array();
		// foreach ($buyer_data as $row => $c) {
		//     $sortkeys[] = $c['Group Average'];
		// }
		// array_multisort($sortkeys, SORT_ASC, $buyer_data);
		//var_dump($buyer_data);

		//dd($buyer_data[$v]['Group Average']);

		$seller_data = array();
		foreach ($type as $key => $v) {
			$sum = 0;
			foreach ($seller as $value) {

				$seller_data[$v][$value->s_id . '/' . $value->phone_no] = Survey::where('id', $value->s_id)->value($key);
				$sum += !empty($seller_data[$v][$value->s_id . '/' . $value->phone_no]) ? $seller_data[$v][$value->s_id . '/' . $value->phone_no] : 0;
			}
			if (count($seller) > 0) {
				$seller_data[$v]['Group Average'] = $sum / count($seller);
				$seller_group_sum += $seller_data[$v]['Group Average'] = $sum / count($seller);
			}
		}
		if (count($seller) > 0 && $seller_group_sum > 0) {
			$seller_group_avg_scr = round($type_count / $seller_group_sum, 2);
			$seller_per_score = round($type_count / $seller_group_sum * 100, 2);
		} else {
			$seller_group_avg_scr = 0;
			$seller_per_score = 0;
		}

		$true = array_multisort(array_column($seller_data, 'Group Average'), SORT_ASC, SORT_NUMERIC, $seller_data);

		$seller_agent_data = array();
		foreach ($type as $key => $v) {
			$sum = 0;
			foreach ($sagent as $value) {

				$seller_agent_data[$v][$value->s_id . '/' . $value->phone_no] = Survey::where('id', $value->s_id)->value($key);
				$sum += !empty($seller_agent_data[$v][$value->s_id . '/' . $value->phone_no]) ? $seller_agent_data[$v][$value->s_id . '/' . $value->phone_no] : 0;
			}
			if (count($sagent) > 0) {
				$seller_agent_data[$v]['Group Average'] = $sum / count($sagent);
				$sagent_group_sum += $seller_agent_data[$v]['Group Average'] = $sum / count($sagent);
			}

		}
		if (count($sagent) > 0 && $sagent_group_sum > 0) {
			$sagent_group_avg_scr = round($type_count / $sagent_group_sum, 2);
			$sagent_per_score = round($type_count / $sagent_group_sum * 100, 2);
		} else {
			$sagent_group_avg_scr = 0;
			$sagent_per_score = 0;
		}

		$true = array_multisort(array_column($seller_agent_data, 'Group Average'), SORT_ASC, SORT_NUMERIC, $seller_agent_data);

		$buyer_agent_data = array();
		foreach ($type as $key => $v) {
			$sum = 0;
			foreach ($bagent as $value) {

				$buyer_agent_data[$v][$value->s_id . '/' . $value->phone_no] = Survey::where('id', $value->s_id)->value($key);
				$sum += !empty($buyer_agent_data[$v][$value->s_id . '/' . $value->phone_no]) ? $buyer_agent_data[$v][$value->s_id . '/' . $value->phone_no] : 0;
			}
			if (count($bagent) > 0) {
				$buyer_agent_data[$v]['Group Average'] = $sum;
				$bagent_group_sum += $buyer_agent_data[$v]['Group Average'] = $sum / count($bagent);
			}

		}
		if (count($bagent) > 0 && $bagent_group_sum > 0) {
			$bagent_group_avg_scr = round($type_count / $bagent_group_sum, 2);
			$bagent_per_score = round($type_count / $bagent_group_sum * 100, 2);
		} else {
			$bagent_group_avg_scr = 0;
			$bagent_per_score = 0;
		}

		$true = array_multisort(array_column($buyer_agent_data, 'Group Average'), SORT_ASC, SORT_NUMERIC, $buyer_agent_data);

		return $dt->render('admin.survey.index',
			['title' => 'survey',
				'type' => $type,
				'seller' => $seller,
				'seller_data' => $seller_data,
				'seller_group_sum' => $seller_group_sum,
				'seller_group_avg_scr' => $seller_group_avg_scr,
				'seller_per_score' => $seller_per_score,
				'buyers' => $buyers,
				'buyer_data' => $buyer_data,
				'buyer_group_sum' => $buyer_group_sum,
				'buyer_group_avg_scr' => $buyer_group_avg_scr,
				'buyer_per_score' => $buyer_per_score,
				'bagent' => $bagent,
				'buyer_agent_data' => $buyer_agent_data,
				'bagent_group_sum' => $bagent_group_sum,
				'bagent_group_avg_scr' => $bagent_group_avg_scr,
				'bagent_per_score' => $bagent_per_score,
				'sagent' => $sagent,
				'seller_agent_data' => $seller_agent_data,
				'sagent_group_sum' => $sagent_group_sum,
				'sagent_group_avg_scr' => $sagent_group_avg_scr,
				'sagent_per_score' => $sagent_per_score,
				'buyerscount' => $buyerscount,
				'sellercount' => $sellercount,
				'bagentcount' => $bagentcount,
				'sagentcount' => $sagentcount,
				'score_per_card' => $score_per_card]);
	}

	public function view($id) {
		$title = 'view survey';
		$survey = Survey::where('id', $id)->first();
		return view('admin.survey.view', compact('survey', 'title'));

	}

}
