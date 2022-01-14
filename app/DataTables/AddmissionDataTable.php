<?php

namespace App\DataTables;

use App\Models\Addmission;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AddmissionDataTable extends DataTable
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
            ->editColumn('course_id', function ($data) {
                return $data->Course->name ?? '-';
            })
            ->editColumn('college_id', function ($data) {
                return $data->college->name ?? '-';
            })
            ->rawColumns(['course_id'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\Addmission $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Addmission $model)
    {
        return $model->with('course')->with('meritRound')->with('college')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('addmission-table')
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
            Column::make('college_id')->name('college.name'),
            Column::make('addmission_date'),
            Column::make('addmission_code'),
            Column::make('course_id')->name('course.name'),
            Column::make('merit_round_id')->name('meritRound.round_no'),
            Column::make('status'),
            Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Addmission_' . date('YmdHis');
    }
}
