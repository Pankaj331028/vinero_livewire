<?php

namespace App\DataTables;

use App\Models\Admin;
use App\Models\ModelPermission;
use App\Models\Permission;
use App\Models\Role;
use DB;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class AccountDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable($query, Request $request) {
		DB::select("SET sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))");

		$query = Admin::select('model_has_permissions.*', 'name', 'id')
		->where('role', Role::whereName('subadmin')->first()->id)
		->join('model_has_permissions', 'model_id', '=', 'admin.id')
		->whereStatus('AC');

		if (!empty($request->start_date)) {
			$query->whereDate('model_has_permissions.created_at', '>=', $request->start_date);
		}

		if (!empty($request->end_date)) {
			$query->whereDate('model_has_permissions.created_at', '<=', $request->end_date);
		}
		$data = $query->groupBy('model_has_permissions.model_id')->groupBy('model_has_permissions.module');

		return datatables()
			->eloquent($data)
			->addIndexColumn()
			->editColumn('created_at', function ($row) {
				
				return date('M d, Y', strtotime($row->created_at));
			})
			->editColumn('model_has_permissions.module', function ($row) {
				return ucwords(str_replace('_', ' ', $row->module));
			})
			->editColumn('link_name', function ($row) {
				return ucwords($row->name) . ' <a href="' . route('edit-account', ['id' => $row->id]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md edit_account"  id="edit_account" title="edit"><i class="la la-pencil"></i></a> <a href="' . route('status-account', ['id' => $row->id]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md status_account"  id="status_account" title="Deactivate"><i class="fa fa-ban""></i></a>';
				// <a href="' . route('delete-account', ['id' => $row->id]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_account"  id="delete_account" title="delete"><i class="la la-trash"></i></a>
			})
			->addColumn('control', function ($row) {
				$pcount = ModelPermission::whereModelId($row->id)->whereModule($row->module)->count();
				$count = Permission::whereModule($row->module)->whereGuardName('admin')->count();

				return ($count == $pcount) ? 'Full' : 'Limited';
			})
			->addColumn('last_activity', function ($row) {
				return $row->actions()->where('log_name', $row->module)->count() > 0 ? date('M d, Y', strtotime($row->actions->last()->created_at)) : '-';
			})
			->addColumn('no_audits', function ($row) {
				return $row->actions()->where('log_name', $row->module)->where(DB::Raw('DATE_FORMAT(created_at,"%m")'), date('m'))->count();
			})
			->addcolumn('action', function ($row) {
				$btn = '<span class="dtr-data"></span>
	                <a href="' . route('view-account', ['module' => $row->module, 'id' => $row->id]) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_account"  id="view_account" title="view"><i class="la la-eye"></i></a>';

				return $btn;
			})->rawColumns(['created_at', 'model_has_permissions.module', 'control', 'last_activity', 'no_audits', 'link_name', 'action']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Admin $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Admin $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('accountDataTable')
			->columns($this->getColumns())
			->minifiedAjax('', "data.table='accountDataTable'")
			->parameters([
				'rowGroup' => [
					'dataSrc' => ['link_name'],
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

			Column::make('id')->data('DT_RowIndex'),
			Column::make('model_has_permissions.module')->title('Account'),
			//Column::make('link_name')->title('Manager Name')->visible(false)->exportable(false),
			Column::make('name')->title('Manager Name')->visible(false)->exportable(true),
			Column::make('created_at')->title('Appointment Date'),
			Column::make('control'),
			Column::make('last_activity')->title('Last Activity Date'),
			Column::make('no_audits')->title('# of Audits/month'),
			Column::computed('action')
				->printable(false)
				->exportable(false)
				->addClass('text-center'),
		];
	}

	/**
	 * Get filename for export.
	 *
	 * @return string
	 */
	protected function filename() {
		return 'AppointManager_' . date('YmdHis');
	}
}
