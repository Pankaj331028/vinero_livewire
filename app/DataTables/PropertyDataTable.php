<?php

namespace App\DataTables;

use App\Models\Offers;
use App\Models\Property;
use App\Models\Seller;
use App\Models\Agent;
use App\Traits\Helper;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use Auth;

class PropertyDataTable extends DataTable {
	use Helper;
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) { 
		
		if ($this->user_id) {
			
			$user = Seller::find($this->user_id);

			if($user->user_type == 'agent'){
			$user = Agent::find($this->user_id);
			$users = Agent::where('phone_no', $user->phone_no)->where('status', '1')->whereUserType('agent')->pluck('id')->toArray();
			$query = Property::whereIn('agent_id', $users);
			}
			else
			{
			$users = Seller::where('phone_no', $user->phone_no)->where('status', '1')->whereUserType('seller')->pluck('id')->toArray();
			$query = Property::whereIn('user_id', $users);
			}
		

		} else {
			// $query = DB::table('property')
			// 		->join('offers', 'property.id', '=', 'offers.property_id')
			// 		->select(array('property.*',DB::raw("count(vms_offers.id) as count")))
			// 		->groupBy('property.id')
			// 		->orderBy('count', 'DESC')
			// 		->get('user_id');

			//DB::select("SET sql_mode=(SELECT CONCAT(@@sql_mode,'ONLY_FULL_GROUP_BY',''));");
			//DB::select("SET GLOBAL sql_mode=(SELECT CONCAT(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");
			$query = Property::
				select(array('property.*', 'transaction_overview.offer_price', 'transaction_overview.net_price', DB::raw('COUNT(vms_offers.id) as count')))
				->leftjoin('offers', function ($join) {
					$join->on('property.id', '=', 'offers.property_id');
					$join->where('offers.status', '!=', 'IN');
				})
				->leftjoin('transaction_overview', 'offers.id', '=', 'transaction_overview.offer_id')
				->orderBy('count', 'desc')
				->groupBy('property.id');
			//$query = DB::select("select `vms_property`.*, `vms_transaction_overview`.`offer_price`, `vms_transaction_overview`.`net_price`, COUNT(vms_offers.id) as count from `vms_property` left join `vms_offers` on `vms_property`.`id` = `vms_offers`.`property_id` left join `vms_transaction_overview` on `vms_offers`.`id` = `vms_transaction_overview`.`offer_id` group by `vms_property`.`id`");
			//dd($query);

		}

		if (!empty($request->start_date)) {
			$query->whereDate('property.created_at', '>=', $request->start_date);
		}

		if (!empty($request->end_date)) {
			$query->whereDate('property.created_at', '<=', $request->end_date);
		}

		if (!empty($request->status)) {

			$query->where('property.status', '=', $request->status);
		}

		$data = $query->get();
		//dd($data);

		return datatables()
			->of($data)
			->addIndexColumn()
			->editColumn('vms_start_date', function ($row) {

				return date('d-m-Y', strtotime($row->vms_start_date));
			})
			->editColumn('vms_end_date', function ($row) {
				return date('d-m-Y', strtotime($row->vms_end_date));
			})
			->addColumn('agent', function ($row) {
				return "<a href=" . route('view-agent', ['id' => $row->agent_id]) . ">" . $row->agent_name . "</a>";
			})
			->addColumn('highest_gross', function ($row) {

				return !empty(max([$row->offer_price])) ? $this->getSetting('currency') . ' ' . max([$row->offer_price]) : '-';
			})
			->addColumn('highest_net', function ($row) {
				return !empty(max([$row->net_price])) ? $this->getSetting('currency') . ' ' . max([$row->net_price]) : '-';
			})
			->addColumn('no_bids', function ($row) {
				return $row->count;
			})
			->addcolumn('action', function ($row) {
				$btn = '';
				if (Helper::checkAccess(['view all_property', 'view active_property', 'view farm_property'])) {
					$btn = '<span class="dtr-data">
                <a href="' . route('view-property', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_properties"  id="view_properties" title="View"><i class="la la-eye"></i></a>
                <a href="' . route('view-offer', ['id' => $row->id]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view-offer"  id="view-offer" title="Offers"><img src="' . asset('web/images/bid.png') . '" style="height: 20px;" /></a>
                </span>';
				}

				if ($row->status == 'AC' && date('Y-m-d', strtotime($row->vms_start_date)) > date('Y-m-d')) {
					$btn .= '<span class="prior_active"></span>';
				}

				return $btn;
			})

			->editColumn('status', function ($row) {
				$current_url = url()->full();
				if (preg_match('/status=FR/i', $current_url) == 1) {
					if ($row->sold_offer == null) {
						return "<span class='btn btn-danger btn-sm'>Not Sold</span>";
					} elseif ($row->offers->count() == 0) {
						return "<span class='btn btn-danger btn-sm'>Not Sold - No offers</span>";
					} elseif ($row->cl_offer == null) {
						return "<span class='btn btn-danger btn-sm'>Not Sold - Withdrawn Offers</span>";
					} else {
						return "<span class='btn btn-danger btn-sm'>Sold</span>";
					}
				} else {
					return "<span class='btn btn-" . config()->get('constants.property_status_link.' . $row->status) . " btn-sm'>" . config()->get('constants.property_status.' . $row->status) . "</span>";
				}
			})

			// ->addcolumn('Nlcount', function ($row) {
			//     $total_nl = Property::where('status', 'NL')->count();
			//     return $total_nl;
			// })

			->rawColumns(['created_at', 'agent', 'status', 'action', 'highest_gross', 'highest_net', 'no_bids']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Property $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Property $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		$route = '';
		if ($this->user_id) {
			$route = route('get-properties', ['id' => $this->user_id]);
		}
		$table = 'properties-table';

		return $this->builder()
			->setTableId($table)
			->columns($this->getColumns())
			->minifiedAjax($route)
			->dom('Bfrtip')
			->orderBy(8)
			->responsive(true)
			->buttons(
				Button::make('excel'),
				Button::make('csv'),
				Button::make('pdf')
			);
	}

	/**
	 * Get columns.
	 *
	 * @return array
	 */
	protected function getColumns() {
		return [

			Column::make('id')->data('DT_RowIndex')->name('ID'),
			Column::make('vms_property_id')->title('Property Code'),
			Column::make('reserved_price')->title('Reserved Price (' . $this->getSetting('currency') . ')'),
			Column::make('property_address'),
			Column::make('vms_start_date')->title('Activation Date'),
			Column::make('vms_end_date')->title('Deadline'),
			Column::computed('highest_gross')->title('Highest Gross Offer received'),
			Column::computed('highest_net')->title('Highest Net Offer received'),
			Column::computed('no_bids')->title('Number of Bids received'),
			Column::computed('agent'),
			Column::make('status'),
			Column::computed('action')
				->printable(false)
				->exportable(false)
				->printable(false)
				->addClass('text-center'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Properties_' . date('YmdHis');
	}
}
