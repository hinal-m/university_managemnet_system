<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn btn-danger mr-sm-2 mb-1 delete">Delete</button>';
                    return $result;
            })
            ->editColumn('image', function ($data) {
                return '<img src="' . asset('' . $data->image) . '" class="rounded" style="width:50px;height:30px">';
            })
            ->rawColumns(['action','image'])
            ->addIndexColumn();
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('student-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('contact_no'),
            Column::make('gender'),
            Column::make('dob'),
            Column::make('adhaar_card_no'),
            Column::make('image'),
            Column::computed('action')
        ];
    }

    protected function filename()
    {
        return 'Student_' . date('YmdHis');
    }
}
