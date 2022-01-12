<?php

namespace App\DataTables;

use App\Models\College;
use App\Models\CollegeMerit;
use App\Models\Course;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CollegeMeritDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('college_id', function ($data) {
                return $data->college->name;

            })
            ->editColumn('course_id', function ($data) {
                return $data->course->name;

            })
            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    return $result;
            })
            ->rawColumns(['course_id','college_id','action'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\CollegeMerit $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(CollegeMerit $model)
    {
        return $model->where('college_id',Auth::guard('college')->user()->id)->with('college')->with('course')->with('Course')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('collegemerit-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
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
            Column::make('id'),
            Column::make('college_id')->title('College name')->name('college.name'),
            Column::make('course_id')->name('course.name'),
            Column::make('merit_round_id')->title('Merit Round No'),
            Column::make('merit'),
            Column::computed('action'),
            // Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'CollegeMerit_' . date('YmdHis');
    }
}
