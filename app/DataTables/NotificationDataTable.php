<?php

namespace App\DataTables;

use App\Models\Notification;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class NotificationDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {

		if ($request->type) {
			$query = Notification::whereJsonContains('data->notification_type', $request->type);

			if (!empty($request->start_date)) {
				$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date("Y-m-d", strtotime($request->start_date)) . '"');
			}

			if (!empty($request->end_date)) {
				$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") <= "' . date("Y-m-d", strtotime($request->end_date)) . '"');
			}

		} else {
			if ($this->type != 'all') {
				$query = Notification::whereJsonContains('data->notification_type', $this->type);
			}

			if (!empty($request->start_date)) {
				$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") >= "' . date("Y-m-d", strtotime($request->start_date)) . '"');
			}

			if (!empty($request->end_date)) {
				$query->whereRaw('DATE_FORMAT(created_at, "%Y-%m-%d") <= "' . date("Y-m-d", strtotime($request->end_date)) . '"');
			}
		}
		$data = $query->orderBy('created_at', 'desc')->get();

		return datatables()
			->of($data)
			->addIndexColumn()
			->addColumn('title', function ($row) {
				return $row->data['title'];
			})
			->addColumn('description', function ($row) {
				return $row->data['details'] ?? $row->data['description'];
			})
			->editColumn('created_at', function ($row) {
				return date('d-m-Y', strtotime($row->created_at));
			})
			->rawColumns(['title', 'description', 'created_at', 'status']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Notification $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Notification $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		// dd($this->type);
		$route = route('get-notifications', ['type' => $this->type]);

		return $this->builder()
			->setTableId('notification-table')
			->columns($this->getColumns())
			->minifiedAjax($this->type != 'all' ? $route : '')
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
			Column::make('title'),
			Column::make('description'),
			Column::make('created_at'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Notification_' . date('YmdHis');
	}
}
