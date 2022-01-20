<?php

namespace App\DataTables;

use App\Models\Addmission;
use App\Models\AddmissionConfirmation;
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
            ->editColumn('addmission_id', function ($data) {

                $addmission = Addmission::where('id',$data->addmission_id)->pluck('addmission_code')->first();
                return $addmission;
            })
            ->editColumn('confirmation_type', function ($data) {
                if ($data->confirmation_type == 'M') {
                    return '<a style="color:white" width="70px" class="badge badge-pill-lg badge-success status">Marit Base</a>';
                } else{
                    return '<a style="color:white" class="badge badge-pill-lg badge-warning status">Reserved base</a>';
                }
            })
            ->rawColumns(['addmission_id','confirmation_type'])
            ->addIndexColumn();
    }

    public function query(AddmissionConfirmation $model)
    {
        // dd($model);
        // $college = AddmissionConfirmation::where('confirm_college_id',Auth::guard('college')->user()->id)->first();


        return $model->where('confirm_college_id',Auth::guard('college')->user()->id)->newQuery();
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
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                    );
    }

    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex'),
            Column::make('addmission_id')->title('admission code'),
            Column::make('confirm_round_id'),
            Column::make('confirm_merit'),
            Column::make('confirmation_type'),
        ];
    }

    protected function filename()
    {
        return 'CollegeAdmission_' . date('YmdHis');
    }
}
