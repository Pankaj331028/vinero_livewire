<?php

namespace App\DataTables;

use App\Models\Survey;
use DB;
use Helper;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class SurveyDataTable extends DataTable {
	/**
	 * Build DataTable class.
	 *
	 * @param mixed $query Results from query() method.
	 * @return \Yajra\DataTables\DataTableAbstract
	 */
	public function dataTable(Request $request, $query) {

		$query = DB::table('users')
			->join('surveys', 'users.id', '=', 'surveys.user_id')
			->join('property', 'users.property_id', '=', 'property.vms_property_id')
			->select('users.id AS u_id', 'users.user_type', 'users.phone_no', 'users.full_name', 'users.property_id', 'surveys.*', 'property.id AS propty_id');

		if (!empty($request->start_date)) {
			$query->whereDate('surveys.created_at', '>=', $request->start_date);
		}
		if (!empty($request->end_date)) {
			$query->whereDate('surveys.created_at', '<=', $request->end_date);
		}

		return datatables()
			->of($query)
			->addIndexColumn()
			->addcolumn('action', function ($row) {
				if (Helper::checkAccess('view survey')) {
					$btn = '<a href="' . route('view-survey', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md view_agent"><i class="la la-eye"></i></a> ';
				}

				return $btn;
			})
			->editColumn('phone_no', function ($row) {
				if ($row->user_type == 'buyer') {
					if (Helper::checkAccess('view buyer')) {
						return '<a href="' . route('view-buyer', $row->u_id) . '">' . $row->phone_no . '</a> ';
					} else {
						return $row->phone_no;
					}

				} elseif ($row->user_type == 'seller') {
					if (Helper::checkAccess('view seller')) {
						return '<a href="' . route('view-seller', $row->u_id) . '">' . $row->phone_no . '</a> ';
					} else {
						return $row->phone_no;
					}

				} else {
					if (Helper::checkAccess('view agent')) {
						return '<a href="' . route('view-agent', $row->u_id) . '">' . $row->phone_no . '</a> ';
					} else {
						return $row->phone_no;
					}

				}
			})
			->editColumn('property', function ($row) {
				if (Helper::checkAccess(['view all_property', 'view active_property', 'view farm_property'])) {
					$btn_p = '<a href="' . route('view-property', $row->propty_id) . '">' . $row->property_id . '</a>';
				} else {
					$btn_p = $row->property_id;
				}

				return $btn_p;
			})

			->editcolumn('Survey date', function ($row) {

				return date('d-m-Y', strtotime($row->created_at));
			})
			->editcolumn('Overall rating', function ($row) {

				$sum = Survey::where('id', $row->id)->get(['user_friendly', 'enjoyed_experience', 'convenience', 'complicated', 'exiting', 'intrusive', 'kept_me_informed', 'kept_me_control', 'kept_me_focused', 'found_value', 'will_use_it_again', 'will_recommend', 'transparency', 'fairness', 'inclusiveness', 'a_better_way', 'frictions'])->toArray();
				$count = count($sum[0]);
				$arrsum = array_sum($sum[0]);
				$avg = $arrsum / $count;
				$round = round($avg, 2);
				return $round;
			})
			->editcolumn('user_friendly', function ($row) {

				return config()->get('constants.survey.' . $row->user_friendly);
			})
			->editcolumn('enjoyed_experience', function ($row) {

				return config()->get('constants.survey.' . $row->enjoyed_experience);
			})
			->editcolumn('convenience', function ($row) {

				return config()->get('constants.survey.' . $row->convenience);
			})
			->editcolumn('complicated', function ($row) {

				return config()->get('constants.survey.' . $row->complicated);
			})
			->editcolumn('exiting', function ($row) {

				return config()->get('constants.survey.' . $row->exiting);
			})
			->editcolumn('intrusive', function ($row) {

				return config()->get('constants.survey.' . $row->intrusive);
			})
			->editcolumn('kept_me_informed', function ($row) {

				return config()->get('constants.survey.' . $row->kept_me_informed);
			})
			->editcolumn('kept_me_control', function ($row) {

				return config()->get('constants.survey.' . $row->kept_me_control);
			})
			->editcolumn('kept_me_focused', function ($row) {

				return config()->get('constants.survey.' . $row->kept_me_focused);
			})
			->editcolumn('found_value', function ($row) {

				return config()->get('constants.survey.' . $row->found_value);
			})
			->editcolumn('will_use_it_again', function ($row) {

				return config()->get('constants.survey.' . $row->will_use_it_again);
			})
			->editcolumn('will_recommend', function ($row) {

				return config()->get('constants.survey.' . $row->will_recommend);
			})
			->editcolumn('transparency', function ($row) {

				return config()->get('constants.survey.' . $row->transparency);
			})
			->editcolumn('fairness', function ($row) {

				return config()->get('constants.survey.' . $row->fairness);
			})
			->editcolumn('inclusiveness', function ($row) {

				return config()->get('constants.survey.' . $row->inclusiveness);
			})
			->editcolumn('a_better_way', function ($row) {

				return config()->get('constants.survey.' . $row->a_better_way);
			})
			->editcolumn('frictions', function ($row) {

				return config()->get('constants.survey.' . $row->frictions);
			})
			->rawColumns(['action', 'phone_no', 'property']);
	}

	/**
	 * Get query source of dataTable.
	 *
	 * @param \App\Models\Survey $model
	 * @return \Illuminate\Database\Eloquent\Builder
	 */
	public function query(Survey $model) {
		return $model->newQuery();
	}

	/**
	 * Optional method if you want to use html builder.
	 *
	 * @return \Yajra\DataTables\Html\Builder
	 */
	public function html() {
		return $this->builder()
			->setTableId('survey-table')
			->columns($this->getColumns())
			->parameters([
				'lengthMenu' => [10],
				'dom' => 'frtip',
				//'order'   => [[3, 'desc']],
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
			column::make('phone_no')->title('Contact no.'),
			column::make('user_type')->title('type'),
			column::make('property'),
			column::make('Survey date'),
			column::make('Overall rating'),
			column::make('user_friendly')->visible(false),
			column::make('enjoyed_experience')->visible(false),
			column::make('convenience')->visible(false),
			column::make('complicated')->visible(false),
			column::make('exiting')->visible(false),
			column::make('intrusive')->visible(false),
			column::make('kept_me_informed')->visible(false),
			column::make('kept_me_control')->visible(false),
			column::make('kept_me_focused')->visible(false),
			column::make('found_value')->visible(false),
			column::make('will_use_it_again')->visible(false),
			column::make('will_recommend')->visible(false),
			column::make('transparency')->visible(false),
			column::make('fairness')->visible(false),
			column::make('inclusiveness')->visible(false),
			column::make('a_better_way')->visible(false),
			column::make('frictions')->visible(false),
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
		return 'Survey_' . date('YmdHis');
	}
}
