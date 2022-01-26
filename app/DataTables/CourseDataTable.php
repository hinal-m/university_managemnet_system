<?php

namespace App\DataTables;

use App\Models\Course;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CourseDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('status', function ($data) {
                if ($data->status == '0') {
                    return '<a data-id="' . $data->id . '"  style="color:white" class="badge badge-pill-lg badge-danger status">Inactive</a>';
                } else {
                    return '<a data-id="' . $data->id . '"  style="color:white" width="70px" class="badge badge-pill-lg badge-success status">Active</a>';
                }
        })
        ->rawColumns(['status'])
        ->addIndexColumn();
    }


    public function query(Course $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('course-table')
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

    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex'),
            Column::computed('name'),
            Column::computed('status'),
        ];
    }

 
    protected function filename()
    {
        return 'Course_' . date('YmdHis');
    }
}
