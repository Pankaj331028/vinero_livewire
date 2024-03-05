<?php

namespace App\DataTables;

use App\Models\Faq;
use App\Models\FaqCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FaqDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable(Request $request, $query)
    {

        $query = Faq::where('status', '!=', 'DL');

        if (!empty($request->start_date)) {
			$query->whereDate('created_at', '>=', $request->start_date);
		}
		if (!empty($request->end_date)) {
			$query->whereDate('created_at', '<=', $request->end_date);
		}
		if (!empty($request->status)) {
			$query->where('status', $request->status);
		}
        
        return datatables()
            ->of($query)
            ->addIndexColumn()
            ->addcolumn('action', function ($row) {
                $btn = '<span class="dtr-data">
              <a href="' . route('edit-faq', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md" title="edit"><i class="la la-edit"></i></a>
              <a href="' . route('delete-faq', $row->id) . '" class="btn btn-sm btn-clean btn-icon btn-icon-md delete_agent" id="delete_agent" title="delete"><i class="la la-trash"></i></a>             
              </span>';

                return $btn;
            })
            // ->addColumn('checkbox', '<input type="checkbox" name="checked[]" class="item_checkbox" value="{{ $id }}" />')
            ->addcolumn('faq_category', function ($row) {
                $faq_category_name = FaqCategory::where('id',$row->faq_category_id)->first();
            //    dd($faq_category_name->category_name);
                // $data_faq= $faq_category_name->category_name;
                return $faq_category_name->category_name;
            })
            ->addcolumn('Question', function ($row) {
                return $row->faq_que;
            })
            ->addcolumn('Answer', function ($row) {
                return $row->faq_ans;
            })
            ->editColumn('status', function ($row) {
             if($row->status == 'AC')
                {
                   return '<a href="'.route('inactive-faq',$row->id).'" title="Inactive"><span class="kt-badge kt-badge--inline kt-badge--primary">Active</span></a>'; 
                }else{
                    return '<a href="'.route('active-faq',$row->id).'" title="Active"><span class="kt-badge kt-badge--inline kt-badge--warning">Inactive</span></a>'; 
                }
            })
            ->escapeColumns('title')
            ->rawColumns(['action','status']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Faq $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Faq $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('faq-table')
                    ->columns($this->getColumns())
                    ->parameters([
                        'lengthMenu' => [ 10 ],
                        'dom'     => 'frtip',
                        'order'   => [[4, 'desc']],
                        'responsive' => true,
                        'link' => true,
                        
                    ])
                    ->minifiedAjax()
                    ->dom('lBfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            // Column::make('checkbox')
            // ->title('Select All <input type="checkbox" class="check_all" onclick="check_all()" />')
            // ->orderable(false)
            // ->searchable(false)
            // ->exportable(false)
            // ->printable(false)
            // ->width('100px'),
            Column::make('id')->data('DT_RowIndex')->name('ID'),
            Column::make('faq_category'),
            Column::make('Question'),
            Column::make('Answer'),
            Column::make('status'),
            Column::make('action'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Faq_' . date('YmdHis');
    }
}
