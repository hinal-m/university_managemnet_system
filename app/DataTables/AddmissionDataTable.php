<?php

namespace App\DataTables;

use App\Models\Addmission;
use App\Models\College;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AddmissionDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('course_id', function ($data) {
                return $data->Course->name ?? '-';
            })
            ->editColumn('user_id', function ($data) {
                return $data->user->name ?? '-';
            })
            ->editColumn('college_id', function ($data) {
                $college = College::whereIn('id', $data->college_id)->pluck('name')->toArray();
                return implode('<br>', $college);
            })
            ->editColumn('status', function ($data) {
                    return '<a style="color:white" width="70px" class="badge badge-pill-lg badge-success ">Confirm</a>';

            })
            ->rawColumns(['course_id', 'college_id','status','user_id'])
            ->addIndexColumn();
    }

    public function query(Addmission $model)
    {
        return $model->newQuery();
    }

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

    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex'),
            Column::make('college_id')->title('college'),
            Column::make('course_id')->title('course'),
            Column::make('user_id')->title('user'),
            Column::make('merit')->title('merit'),
            Column::make('addmission_date'),
            Column::make('addmission_code'),
            Column::make('merit_round_id')->title('merit round'),
            Column::make('status'),
        ];
    }

    protected function filename()
    {
        return 'Addmission_' . date('YmdHis');
    }
}
