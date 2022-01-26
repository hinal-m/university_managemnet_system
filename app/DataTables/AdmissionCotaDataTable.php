<?php

namespace App\DataTables;

use App\Models\Addmission;
use App\Models\AdmissionCotum;
use App\Models\College;
use App\Models\CollegeMerit;
use App\Models\Course;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class AdmissionCotaDataTable extends DataTable
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
                $college = College::whereIn('id', $data->college_id)->pluck('name')->toArray();
                return implode('<br>', $college);
            })
            ->editColumn('course_id',function($data){
                $course =  Course::where('id',$data->course_id)->pluck('name')->toArray();
                return $course;
            })
            ->editColumn('user_id',function($data){
                $course =  User::where('id',$data->user_id)->pluck('name')->toArray();
                return $course;
            })
            ->addColumn('Confirm', function ($data) {
                // dd($data);
                return '<button type="submit" data-id="' . $data->id . '" style="color:white" width="70px" class="btn btn-primary confirm">Confirmed</button>';
            })
            ->rawColumns(['college_id','Confirm','course_id','user_id'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdmissionCotum $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Addmission $model)
    {
        $college_merit = CollegeMerit::where('college_id', Auth::guard('college')->user()->id)->first();
        $college_id = Auth::guard('college')->user()->id;
        if ($college_merit) {
            return
                $model->where('merit', '<=', $college_merit->merit)
                ->where('college_id', 'like', '%"' . $college_id . '"%')
                ->where('status','!=','1')
                ->newQuery();
        } else {
            return $model->where('id', -1)->newQuery();
        }

        return $model->with('meritRound')->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('admissioncota-table')
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

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            Column::make('id')->data('DT_RowIndex'),
            Column::make('college_id'),
            Column::make('course_id')->name('course.name')->title('course'),
            Column::make('user_id')->name('user.name')->title('user'),
            Column::make('merit'),
            Column::make('addmission_date'),
            Column::make('addmission_code'),
            Column::make('merit_round_id')->name('meritRound.round_no')->title('merit round'),
            Column::make('Confirm'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AdmissionCota_' . date('YmdHis');
    }
}
