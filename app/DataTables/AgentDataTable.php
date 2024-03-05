<?php

namespace App\DataTables;

use App\Models\Agent;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AgentDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {
		$query = Agent::where('user_type', '=', 'agent');
		if (!empty($request->start_date)) {
			$query->whereDate('created_at', '>=', $request->start_date);
		}
		if (!empty($request->end_date)) {
			$query->whereDate('created_at', '<=', $request->start_date);
		}
		if (!empty($request->opt_mode)) {
			$query->where('mode', '=', $request->opt_mode);
		}
		if (!empty($request->status) || gettype($request->status) == 'string') {
			switch ($request->status) {
			// case 1:$query->whereHas('property.offers', function ($q) {
			// 		$q->whereIn('status', ['IN', 'PN', 'AC']);
			// 	});
			// 	break;
			case 1:$query->where(function ($q) {
				$q->whereHas('offers', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC']);
				})->orWhereHas('agent_properties.offers', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC']);
				});
				});
				break;
			case 0:$query->where(function ($q) {
					$q->whereNull('last_activity')->orWhereDate('last_activity', '<=', date('Y-m-d H:i:s', strtotime('-5 days')));
				});
				break;
			}
		} else {
			if (Auth::guard('admin')->user()->user_role->name != 'admin') {
				$query->whereHas('offers', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC']);
				});
			} else {
				// $query->whereHas('offers', function ($q) {
				// 	$q->whereNotIn('status', ['SO', 'RJ', 'CL']);
				// }, '<=', 0);
				$query->where(function ($q) {
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
			}

		}

		$data = $query->orderBy('created_at', 'desc')->get();
		return datatables()
			->of($data)
			->addIndexColumn()
			->addcolumn('agent_type', function ($row) {
				return $row->agent_type;
			})
			->editColumn('optin_out', function ($row) {
				switch ($row->optin_out) {
				case 'OPTINMODE1':return "In Control (Buyer's Opt Out Mode 1)";
					break;
				case 'OPTINMODE2':return "In Control (Buyer's Opt Out Mode 2)";
					break;
				case 'OPTOUT':return "Monitor (Buyer's Opt In)";
					break;
				}
			})
			->addcolumn('agent_name', function ($row) {
				
				return $row->first_name;
			})->addcolumn('total_bids', function ($row) {
			return $row->total_bids;
		})
			->editcolumn('phone_no', function ($row) {

				if (Helper::checkAccess('view agent')) {
					return '<a href="' . route('view-agent', $row->web_id) . '" class="dblclick">' . $row->phone_no . '</a>';
				} else {
					return $row->phone_no;
				}
			})->addcolumn('approved_bids', function ($row) {
			return $row->approved_bids;
		})->addcolumn('rejected_bids', function ($row) {
			return $row->unapproved_bids;
		})->editColumn('created_at', function ($row) {
			return date('d-m-Y', strtotime($row->created_at));
		})->addcolumn('action', function ($row) {
			$btn = '<span class="dtr-data">';

			if (Helper::checkAccess('edit agent')) {
				$btn .= '<a href="' . route('edit-agent', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><i class="la la-edit"></i></a>';
			}

			if (Auth::guard('admin')->user()->user_role->name == 'admin') {
				$btn .= '<a href="' . route('delete-agent', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_agent"  id="delete_agent" title="delete"><i class="la la-trash"></i></a>';
			}

			if (Helper::checkAccess('view agent')) {
				$btn .= '<a href="' . route('view-agent', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_agent"  id="view_agent" title="view"><i class="la la-eye"></i></a>';
			}

			if (Helper::checkAccess('block agent')) {
				if ($row->status == 3) {
					$btn .= '<a href="' . route('block-agent', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md block_agent"  id="block_agent" title="Unblock"><i class="la la-ban"></i></a>';
					
				}else{
					$btn .= '<a href="' . route('block-agent', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md block_agent"  id="block_agent" title="block"><i class="la la-ban"></i></a>';
				}
			}
			$btn .= '</span>';

			return $btn;
		})
			->editColumn('status', function ($row) {
				//return config()->get('constants.vmsuser_status.' . $row->status);
				$html = "";
				if ($row->status == 0) {
					$html .= "<span>Inactive </span>";/*Inactive*/
				} elseif ($row->status == 3) {

					$html .= "<span>Block </span>";/*Block*/
				} else {
					$html .= "Active";/*Active*/
				}
				return $html;
			})
			->rawColumns(['created_at', 'status', 'total_bids', 'approved_bids', 'rejected_bids', 'agent_name', 'action', 'agent_type', 'phone_no']);
	}
	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Agent $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Agent $model) {
		return $model->newQuery();
	}
	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('agent-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(2)
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
			// Column::make('property_id'),
			Column::make('full_name')->title('Name'),
			Column::make('phone_no')->title('Mobile Number'),
			Column::make('total_bids'),
			Column::make('approved_bids'),
			Column::make('rejected_bids'),
			Column::make('agent_type'),
			// Column::make('optin_out')->title('Opt In/Out'),
			Column::computed('created_at'),
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
		return 'Agent_' . date('YmdHis');
	}
}
