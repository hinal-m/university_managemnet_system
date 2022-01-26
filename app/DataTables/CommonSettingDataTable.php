<?php

namespace App\DataTables;

use App\Models\CommonSetting;
use App\Models\Subject;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CommonSettingDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
                    $result .= '<a href="' . route('university.edit', $data->id) .
                    '"><button class="btn-sm btn-dark mr-sm-2 mb-1">Edit</button></a>';
                    return $result;
            })
            ->editColumn('subject_id', function ($data) {
                $subject = Subject::where('id',$data->id)->pluck('name')->toArray();
                return $subject;
            })
            ->rawColumns(['action','subject_id'])
            ->addIndexColumn();
    }

    public function query(CommonSetting $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('commonsetting-table')
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
            Column::make('subject_id')->title('Subject'),
            Column::make('marks'),
            Column::computed('action')
        ];
    }

    protected function filename()
    {
        return 'CommonSetting_' . date('YmdHis');
    }
}
