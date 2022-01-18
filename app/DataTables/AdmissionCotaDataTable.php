<?php

namespace App\DataTables;

use App\Models\Addmission;
use App\Models\AdmissionCotum;
use App\Models\College;
use App\Models\CollegeMerit;
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

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\AdmissionCotum $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Addmission $model)
    {

        // $user = Auth::user()->id;
        // $college_merit = CollegeMerit::where('college_id', Auth::user()->id)->first();
        // if ($college_merit) {
        //     return
        //         $model->where('merit', '>=', $college_merit->merit)
        //         ->where('college_id', 'like', '%"' . $user . '"%')
        //         ->newQuery();
        // }

            $college_id = Auth::guard('college')->user()->id;
            $model = $model::where('college_id', 'like', '%"' . $college_id . '"%');

        return $model->with('course')->with('meritRound')->with('user')->newQuery();
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
            Column::make('college_id'),
            Column::make('course_id')->name('course.name'),
            Column::make('user_id')->name('user.name'),
            Column::make('merit'),
            Column::make('addmission_date'),
            Column::make('addmission_code'),
            Column::make('merit_round_id')->name('meritRound.round_no'),
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