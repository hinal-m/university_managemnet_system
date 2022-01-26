<?php

namespace App\DataTables;

use App\Models\StudentMark;
use App\Models\StudentMarks;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class StudentMarkDataTable extends DataTable
{
  
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                // dd($data->id);
                $result = '<div class="btn-group">';
                    $result .= '<a href="' . route('user.marks.edit', $data->id) .
                    '"><button class="btn-sm btn-primary mr-sm-2 mb-1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    return $result;
            })
            ->rawColumns(['course_id','action'])
            ->addIndexColumn();
    }

    public function query(StudentMark $model)
    {
        return $model->where('user_id',Auth::guard('user')->user()->id)->newQuery();

    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('studentmark-table')
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
            Column::make('user_id'),
            Column::make('subject_id'),
            Column::make('total_mark'),
            Column::make('obtain_mark'),
            Column::computed('action')
        ];
    }

    protected function filename()
    {
        return 'StudentMark_' . date('YmdHis');
    }
}
