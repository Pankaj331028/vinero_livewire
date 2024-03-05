<?php

namespace App\DataTables;

use App\Models\Offers;
use App\Traits\Helper;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;
use URL;

class OfferDataTable extends DataTable {
	use Helper;
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) { 
		
		if ($this->type == 'agent') {  
			
			$query = Offers::whereIn('agent_id', explode(',', $this->user_id))->where('status', '!=', 'IN');
			
		} else {
			
			$query = Offers::whereIn('user_id', $this->user_id)->where('status', '!=', 'IN');
			
		}

		if (!empty($request->start_date)) { 
			$query->whereDate('created_at', '>=', $request->start_date);
			
		}

		if (!empty($request->end_date)) {
			$query->whereDate('created_at', '<=', $request->end_date);
			
		}

		if (!empty($request->status)) {
			$query->where('status', '=', $request->status);
			
		}

		$data = $query->orderBy('created_at', 'desc')->get();
		
		return datatables()
			->of($data)
			->addIndexColumn()
			->editColumn('property_id', function ($row) {
				
				if (Helper::checkAccess(['view all_property', 'view active_property', 'view farm_property'])) {
					return '<a href="' . route('view-property', [$row->property->id]) . '">' . $row->property->vms_property_id . '</a>';
				} else {
					return $row->property->vms_property_id;
				}

			})
			->addcolumn('offer_price', function ($row) {
				return number_format($row->transaction->offer_price) ?? 0.00;
			})
			->addcolumn('buyer', function ($row) {
				// return $row->owner->name.'('.$row->owner->phone_no.')';
				try {
					return $row->owner->phone_no;
				} catch (\Exception $e) {
					// dd($row);
				}
			})
			->editColumn('date_offer', function ($row) {
				return \Carbon\Carbon::parse($row->date_offer)->format('d, M Y');
			})
			->addcolumn('deadline', function ($row) {
				
				return \Carbon\Carbon::parse($row->property->vms_end_date)->format('d, M Y');
				// return \Carbon\Carbon::parse($row->property->deadline)->format('d, M Y');
			})
			->addcolumn('action', function ($row) {

				if (Helper::checkAccess(['view all_property', 'view active_property', 'view farm_property'])) {
					$btn = '<span class="dtr-data"></span>
					
                <a href="' . route('offer-details', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="View"><i class="la la-eye"></i></a>
                </span>';
				} else {
					$btn .= '-';
				}
				return $btn;
			})
			->editColumn('status', function ($row) {
				if ($row->status == 'AC') {
					return '<span class="btn btn-sm btn-upper btn-' . config()->get('constants.background.' . $row->status) . ' btn-sm btn-upper">Approved</span>';
					
				}else{
					return '<span class="btn btn-sm btn-upper btn-' . config()->get('constants.background.' . $row->status) . ' btn-sm btn-upper">' . config()->get('constants.offer_status.' . $row->status) . '</span>';

				}
			})->rawColumns(['property_id', 'status', 'buyer', 'date_offer', 'action', 'deadline', 'offer_price']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Offers $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Offers $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		$route = '';

		if ($this->type == 'agent') { 
			$route = route('agent-offers', ['id' => $this->user_id]);
		} else {
			$route = route('buyer-offers', ['id' => implode(',', $this->user_id)]);
		}

		$table = 'offers-table';

		return $this->builder()
			->setTableId($table)
			->columns($this->getColumns())
			->minifiedAjax($route)
			->dom('Bfrtip')
			->orderBy(1)
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
			Column::make('property_id')->title('Property Code'),
			Column::make('offer_price')->title('Offer Price (' . $this->getSetting('currency') . ')'),
			Column::make('date_offer')->title('Submitted On'),
			Column::make('deadline'),
			Column::make('buyer'),
			Column::make('created_at')->exportable(false)->visible(false)->searchable(false),
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
		return 'Offer_' . date('YmdHis');
	}
}
