<?php

namespace App\DataTables;

use App\Models\Admin;
use Config;
use Illuminate\Http\Request;
use Spatie\Activitylog\Models\Activity;
use Str;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ActivityLogDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {

		$user = Admin::withTrashed()->find($this->userid);

		$query = Activity::causedBy($user)->whereLogName($this->module);

		if (!empty($request->start_date)) {
			$query->whereDate('created_at', '>=', $request->start_date);
		}

		if (!empty($request->end_date)) {
			$query->whereDate('created_at', '<=', $request->end_date);
		}

		$data = $query->get();

		return datatables()
			->of($data)
			->addIndexColumn()
			->editColumn('created_at', function ($row) {
				return date('M d, Y H:i', strtotime($row->created_at));
			})
			->editColumn('log_name', function ($row) {
				return Config::get('constants.modules.' . $row->log_name)['name'];
			})
			// ->addcolumn('action', function ($row) {
			// 	$btn = '<span class="dtr-data"></span>
			//               <a target="_blank" href="' . json_decode($row->properties)->url . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="view"><i class="la la-eye"></i></a>';

			// 	return $btn;
			// })
			->filter(function ($instance) use ($request) {
				if (!empty($request->search['value'])) {
					$instance->collection = $instance->collection->filter(function ($row) use ($request) {
						if (Str::contains(Str::lower($row['log_name']), Str::lower($request->search['value']))) {
							return true;
						}
						if (Str::contains(Str::lower($row['created_at']), Str::lower($request->search['value']))) {
							return true;
						}
						if (Str::contains(Str::lower($row['description']), Str::lower($request->search['value']))) {
							return true;
						}
						return false;
					});
				}
			})->rawColumns(['created_at', 'log_name']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param Spatie\Activitylog\Models\Activity $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Activity $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('activityDataTable')
			->columns($this->getColumns())
			->minifiedAjax('', "data.table='activityDataTable'")
			->parameters([
				'rowGroup' => [
					'dataSrc' => ['log_name'],
				],
			])
			->dom('Bfrtip')
			->orderBy(3)
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

			Column::make('id')->data('DT_RowIndex')->name('S.No.')->searchable(false),
			Column::make('log_name')->title('Module'),
			Column::make('description')->title('Description'),
			Column::make('created_at')->title('Activity Date'),
			// Column::make('action'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Activity_' . date('YmdHis');
	}
}
