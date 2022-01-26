<?php

namespace App\DataTables;

use App\Models\Course;
use App\Models\MaritRound;
use App\Models\MeritRound;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MeritRoundDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
                    $result .= '<a href="' . route('university.marit.edit', $data->id) .
                    '"><button class="btn-sm btn-dark mr-sm-2 mb-1">Edit</button></a>';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn btn-danger mr-sm-2 mb-1 delete">Delete</button>';
                    return $result;
            })
            ->editColumn('course_id',function($data){
                $course =  Course::where('id',$data->course_id)->pluck('name')->toArray();
                return $course;
            })
            ->editColumn('status', function ($data) {
                if ($data->status == '0') {
                    return '<a data-id="' . $data->id . '"  style="color:white" class="badge badge-pill-lg badge-danger status">Inactive</a>';
                } else {
                    return '<a data-id="' . $data->id . '"  style="color:white" width="70px" class="badge badge-pill-lg badge-success status">Active</a>';
                }
        })
            ->rawColumns(['action','status','course_id'])
            ->addIndexColumn();
    }

    public function query(MeritRound $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('meritround-table')
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
            Column::make('round_no'),
            Column::make('course_id')->title('course'),
            Column::make('start_date'),
            Column::make('end_date'),
            Column::make('merit_result_declare_date')->title('Marit Declare Date'),
            Column::make('status'),
            Column::computed('action')

        ];
    }

    protected function filename()
    {
        return 'MeritRound_' . date('YmdHis');
    }
}
