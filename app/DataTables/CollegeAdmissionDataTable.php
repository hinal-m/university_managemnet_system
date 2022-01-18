<?php

namespace App\DataTables;

use App\Models\Addmission;
use App\Models\College;
use App\Models\CollegeAdmission;
use App\Models\CollegeMerit;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CollegeAdmissionDataTable extends DataTable
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
                $college = College::whereIn('id',$data->college_id)->pluck('name')->toArray();
                return implode('<br>',$college);
            })
            ->rawColumns(['course_id','college_id'])
            ->addIndexColumn();
    }

    public function query(Addmission $model)
    {
        // dd($model);
        $college = CollegeMerit::where('college_id',Auth::guard('college')->user()->id)->select('merit')->first()->toArray();


        return $model->where('merit','>=',$college['merit'])->with('course')->with('meritRound')->with('user')->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('collegeadmission-table')
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
            Column::make('id'),
            Column::make('course_id')->name('course.name'),
            Column::make('user_id')->name('user.name'),
            Column::make('merit'),
            Column::make('addmission_date'),
            Column::make('addmission_code'),
            Column::make('course_id'),
            Column::make('merit_round_id')->title('Marit round'),
        ];
    }

    protected function filename()
    {
        return 'CollegeAdmission_' . date('YmdHis');
    }
}
