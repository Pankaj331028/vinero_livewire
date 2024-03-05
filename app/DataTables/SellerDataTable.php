<?php

namespace App\DataTables;

use App\Models\Seller;
use Auth;
use Helper;
use Illuminate\Http\Request;
use Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SellerDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {

		$query = Seller::where('user_type', '=', 'seller');

		if (!empty($request->start_date)) {
			$query->whereDate('created_at', '>=', $request->start_date);
		}
		if (!empty($request->end_date)) {
			$query->whereDate('created_at', '<=', $request->end_date);
		}
		if (!empty($request->opt_mode)) {
			$query->where('mode', '=', $request->opt_mode);
		}
		if (!empty($request->status) || gettype($request->status) == 'string') {
			switch ($request->status) {
			case 1:$query->whereHas('properties', function ($q) {
					$q->whereNotIn('property.status', ['SO', 'EP']);
				}, '>', 0);
				break;
			case 0:$query->where(function ($q) {
					$q->doesntHave('properties')->orWhereHas('properties', function ($q) {
						$q->where('property.status', '!=', 'EP');
					}, '<=', 0);
				});
				break;
			}
		} else {
			if (Auth::guard('admin')->user()->user_role->name != 'admin') {
				$query->whereHas('properties', function ($q) {
					$q->whereNotIn('property.status', ['SO', 'EP']);
				}, '>', 0);
			} else {
				$query->whereHas('properties', function ($q) {
					$q->whereNotIn('property.status', ['SO', 'EP']);
				}, '<=', 0);
			}

		}

		$data = $query->orderBy('created_at', 'desc')->get()->unique('phone_no');

		return datatables()
			->of($data)
			->addIndexColumn()

			->addcolumn('Total Properties listed', function ($row) {
				// $total_bids = Property::where('user_id', $row->id)->count();
				// return $total_bids;
				return $row->properties()->where('user_type', 'seller')->count();
			})

			->addcolumn('Approved Bids', function ($row) {
				return $row->total_bids_accepted;
			})

			->addcolumn('Rejected Bids', function ($row) {
				return $row->total_rejected_bids;
			})

			->addcolumn('address', function ($row) {
				return $row->all_properties();
			})
			->editColumn('last_activity', function ($row) {
				return date('d-m-Y H:i', strtotime($row->last_activity));
			})
			->editcolumn('phone_no', function ($row) {

				if (Helper::checkAccess('view seller')) {
					return '<a href="' . route('view-seller', $row->web_id) . '" class="dblclick">' . $row->phone_no . '</a>';
				} else {
					return $row->phone_no;
				}
			})
			->editColumn('created_at', function ($row) {
				return date('d-m-Y', strtotime($row->created_at));
			})

			->addcolumn('action', function ($row) {
				$btn = '<span class="dtr-data">';
				if (Helper::checkAccess('edit seller')) {
					if (request()->status == '0' || !isset(request()->status)) {
						$btn .= '<a href="' . route('edit-seller', [$row->web_id, $status = 1]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>';
					} else {
						$btn .= '<a href="' . route('edit-seller', [$row->web_id, $status = 0]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md"><i class="la la-edit"></i></a>';
					}
				}

				if (Auth::guard('admin')->user()->user_role->name == 'admin') {
					$btn .= '<a href="' . route('delete-seller', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_buyer"  id="delete_buyer"><i class="la la-trash"></i></a>';
				}

				if (Helper::checkAccess('view seller')) {
					$btn .= '<a href="' . route('view-seller', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_buyer"  id="view_buyer"><i class="la la-eye"></i></a>';
				}

				if (Helper::checkAccess('block seller')) {
					if ($row->status == 3) {
						$btn .= '<a href="' . route('block-seller', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md block_seller"  id="block_seller" title="Unblock"><i class="la la-ban"></i></a>';
					} else {
						$btn .= '<a href="' . route('block-seller', $row->web_id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md block_seller"  id="block_seller" title="block"><i class="la la-ban"></i></a>';
					}
				}

				$btn .= '</span>';

				return $btn;
			})

			->editColumn('status', function ($row) {
				//return config()->get('constants.vmsuser_status.' . $row->status);
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

			->rawColumns(['created_at', 'status', 'Total Properties listed', 'Approved Bids', 'Rejected Bids', 'Seller Name', 'action', 'phone_no', 'last_activity']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Seller $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Seller $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('seller-table')
			->columns($this->getColumns())
			->minifiedAjax()
			->dom('Bfrtip')
			->orderBy(1)
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
				// Column::make('Seller Name'),
				Column::make('phone_no')->title('VMS Number'),
				Column::make('Total Properties listed'),
				Column::make('Approved Bids'),
				Column::make('Rejected Bids'),
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
				// Column::make('Seller Name'),
				Column::make('phone_no')->title('VMS Number'),
				Column::make('Total Properties listed'),
				Column::make('Approved Bids'),
				Column::make('Rejected Bids'),
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
		return 'Seller_' . date('YmdHis');
	}
}
