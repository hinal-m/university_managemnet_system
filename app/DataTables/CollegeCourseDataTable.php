<?php

namespace App\DataTables;

use App\Models\CollegeCourse;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CollegeCourseDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                // dd($data->id);
                $result = '<div class="btn-group">';
                    $result .= '<a href="' . route('college.course.edit', $data->id) .
                    '"><button class="btn-sm btn-primary mr-sm-2 mb-1" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button></a>';
                    // $result .= '<button type="submit" data-id="' . $data->id . '" class="btn-sm btn-danger mr-sm-2 mb-1 delete"><i class="fa fa-trash" aria-hidden="true"></i></button>';
                    return $result;
            })
            ->editColumn('course_id', function ($data) {
                return $data->Course->name ?? '-';
            })
            ->rawColumns(['course_id','action'])
            ->addIndexColumn();
    }


    public function query(CollegeCourse $model)
    {
        // dd($model->id);
        return $model->where('college_id',Auth::guard('college')->user()->id)->with('Course')->newQuery();
    }


    public function html()
    {
        return $this->builder()
                    ->setTableId('collegecourse-table')
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
            Column::make('course_id')->name('Course.name')->title('Course Name'),
            Column::make('reserved_seat'),
            Column::make('merit_seat'),
            Column::make('seat_no'),
            Column::make('action'),
        ];
    }

    protected function filename()
    {
        return 'CollegeCourse_' . date('YmdHis');
    }
}
