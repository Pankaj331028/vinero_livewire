<?php

namespace App\DataTables;

use App\Models\Resource;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class ResourceDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query) {
		// dd($request->status);
		$query = Resource::where('status', '!=', 'DL');
		
		// if (!empty($request->start_date)) {
		// 	$query->whereDate('created_at', '>=', $request->start_date);
		// }
		// if (!empty($request->end_date)) {
		// 	$query->whereDate('created_at', '<=', $request->end_date);
		// }
		// if (!empty($request->status)) {
		// 	$query->where('status', $request->status);
		// }

		return datatables()
			// ->eloquent($query)
            // ->addIndexColumn();
			->of($query)
			->addIndexColumn()
			->addColumn('file', function ($image_resource) { 
				$url=asset($image_resource->file); 
				
				return '<img src="'.$url.'" border="0" width="100px" class="img-rounded" align="center" />'; 
			 })
			->addcolumn('action', function ($row) {
				$btn = '<span class="dtr-data">
        <a href="' . route('edit-resource', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><i class="la la-edit"></i></a>
        <a href="' . route('delete-resource', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_agent" id="delete_agent" title="delete"><i class="la la-trash"></i></a>
		<a href="' . route('view-resource', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_agent" id="view_agent" title="view"><i class="la la-eye"></i></a>
          </span>';

				return $btn;
			})
			->editColumn('status', function ($row) {
				if ($row->status == 'AC') {
					return '<a href="' . route('inactive-resource', $row->id) . '" title="Inactive"><span class="kt-badge kt-badge--inline kt-badge--success" style="box-shadow: 0 15px 10px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">Active</span></a>';
				} else {
					return '<a href="' . route('active-resource', $row->id) . '" title="Active"><span class="kt-badge kt-badge--inline kt-badge--warning">Inactive</span></a>';
				}
			})
			->rawColumns(['action', 'status', 'file']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Resource $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Resource $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('resource-table')
			->columns($this->getColumns())
			->parameters([
				'lengthMenu' => [10],
				'dom' => 'frtip',
				'order' => [[3, 'desc']],
				'responsive' => true,
				'link' => true,
				
			])
			->minifiedAjax()
			->dom('lBfrtip')
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
		return [
			Column::make('id')->data('DT_RowIndex')->name('ID'),
			// Column::make('type'),
			Column::make('name')->title('Title'),
			Column::make('file'),
			Column::make('status'),
			Column::make('action'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'Resource_' . date('YmdHis');
	}
}
