<?php

namespace App\DataTables;

use App\Models\Buyer;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BuyerDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {
		$query = Buyer::where('user_type', '=', 'buyer');

		if (!empty($request->start_date)) {
			//$query->whereDate('created_at', '>=', $request->start_date);
			$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date("Y-m-d", strtotime($request->start_date)) . '"');
		}

		if (!empty($request->end_date)) {
			//$query->whereDate('created_at', '<=', $request->end_date);
			$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") <= "' . date("Y-m-d", strtotime($request->end_date)) . '"');
		}

		if (!empty($request->status) || gettype($request->status) == 'string') {
			switch ($request->status) {
			case 1:$query->whereHas('offer', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC', 'DCIN', 'FCIN']);
				});
				break;
			case 0:$query->where(function ($q) {
					$q->whereNull('last_activity')->orWhereDate('last_activity', '<=', date('Y-m-d H:i:s', strtotime('-5 days')));
				});
				break;
			}
		} else {
			if (Auth::guard('admin')->user()->user_role->name != 'admin') {
				$query->whereHas('offer', function ($q) {
					$q->whereIn('status', ['IN', 'PN', 'AC', 'DCIN', 'FCIN']);
				});
			} else {
				$query->whereHas('offer', function ($q) {
					$q->whereNotIn('status', ['SO', 'RJ', 'CL']);
				}, '<=', 0);
			}

		}

		if (!empty($request->opt_mode)) {
			$query->where('mode', '=', $request->opt_mode);
		}

		$data = $query->orderBy('created_at', 'desc')->get()->unique('phone_no');
		return datatables()
			->of($data)
			->addIndexColumn()
			->editColumn('optin_out', function ($row) {
				return config()->get('constants.buyer_opt_modes.' . $row->optin_out);
			})
			->editColumn('created_at', function ($row) {
				return date('d-m-Y', strtotime($row->created_at));
			})
			->editColumn('last_activity', function ($row) {
				return date('d-m-Y H:i', strtotime($row->last_activity));
			})
			->editcolumn('phone_no', function ($row) {

				if (Helper::checkAccess('view buyer')) {
					return '<a href="' . route('view-buyer', $row->web_id) . '" class="dblclick">' . $row->phone_no . '</a>';
				} else {
					return $row->phone_no;
				}
			})
			->addcolumn('Total Bids', function ($row) {
				return $row->total_bids;
			})
			->addcolumn('Approved Bids', function ($row) {
				return $row->approved_bids;
			})
			->addcolumn('Rejected Bids', function ($row) {
				return $row->unapproved_bids;
			})
			->addcolumn('Withdrawn Bids', function ($row) {

				return $row->withdrawn_bids;
			})
			->addcolumn('address', function ($row) {
				return $row->all_properties();
			})
			->addcolumn('action', function ($row) {
				$btn = '<span class="dtr-data"></span>';

				if (request()->status == '1') {
					if (Helper::checkAccess('edit buyer')) {
						if (request()->status == '0' || !isset(request()->status)) {
							$btn .= '<a href="' . route('edit-buyer', [$row->web_id, $status = 1]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit" title="edit"></i></a>';
						} else {
							$btn .= '<a href="' . route('edit-buyer', [$row->web_id, $status = 0]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit" title="edit"></i></a>';
						}
					}
				} else {

				}
				if (Auth::guard('admin')->user()->user_role->name == 'admin') {
					$btn .= '<a href="' . route('delete-buyer', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_buyer"  id="delete_buyer" title="delete"><i class="la la-trash"></i></a>';
				}

				if (Helper::checkAccess('view buyer')) {
					$btn .= '<a href="' . route('view-buyer', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_buyer"  id="view_buyer" title="view"><i class="la la-eye"></i></a>';
				}

				if (Helper::checkAccess('block buyer')) {
					$btn .= '<a href="' . route('block-buyer', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md block_buyer"  id="block_buyer" title="block"><i class="la la-ban"></i></a>';

				}
				$btn .= '</span>';

				return $btn;
			})
			->editColumn('status', function ($row) {
				$html = "";
				if ($row->status == 0) {
					$html .= "<span>Inactive </span>"; /*Inactive*/
				} elseif ($row->status == 3) {

					$html .= "<span>Block </span>"; /*Block*/
				} else {
					$html .= "Active"; /*Active*/
				}
				return $html;
			})
			// ->filter(function ($instance) use ($request) {
			// 	if (!empty($request->search['value'])) {
			// 		$instance->collection = $instance->collection->filter(function ($row) use ($request) {
			// 			if (Str::contains(Str::lower($row['full_name']), Str::lower($request->search['value']))) {
			// 				return true;
			// 			}
			// 			if (Str::contains(Str::lower($row['address']), Str::lower($request->search['value']))) {
			// 				return true;
			// 			}

			// 			return false;
			// 		});
			// 	}
			// })
			->rawColumns(['created_at', 'status', 'Total Bids', 'Approved Bids', 'Rejected Bids', 'Withdrawn Bids', 'action', 'last_activity', 'phone_no']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Buyer $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Buyer $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('buyer-table')
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
		if (request()->status == '0' || !isset(request()->status)) {
			return [

				Column::make('id')->data('DT_RowIndex')->name('ID'),
				// Column::make('property_id'),
				// Column::make('Buyer Name'),
				Column::make('phone_no')->title('Mobile Number'),
				Column::make('Total Bids'),
				Column::make('Approved Bids'),
				Column::make('Rejected Bids'),
				Column::make('Withdrawn Bids'),
				Column::computed('created_at'),
				Column::make('last_activity')->title('Last Activity Date'),
				Column::make('status'),
				Column::computed('action')
					->printable(false)
					->exportable(false)
					->printable(false)
					->addClass('text-center'),
			];
		} else {
			return [

				Column::make('id')->data('DT_RowIndex')->name('ID'),
				// Column::make('property_id'),
				// Column::make('Buyer Name'),
				Column::make('phone_no')->title('Mobile Number'),
				Column::make('Total Bids'),
				Column::make('Approved Bids'),
				Column::make('Rejected Bids'),
				Column::make('Withdrawn Bids'),
				Column::make('optin_out')->title('Opt In/Out'),
				Column::computed('created_at'),
				Column::make('last_activity')->title('Last Activity Date'),
				Column::make('status'),
				Column::computed('action')
					->printable(false)
					->exportable(false)
					->printable(false)
					->addClass('text-center'),
			];
		}
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Buyer_' . date('YmdHis');
	}
}
