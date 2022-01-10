<?php

namespace App\DataTables;

use App\Models\College;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class CollegeDataTable extends DataTable
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
            ->addColumn('action', function ($data) {
                $result = '<div class="btn-group">';
            $result .= '<a href=""><button class="btn-sm btn-warning mr-sm-2 mb-1" >Show</button></a>';
                    $result .= '<a href="' . route('university.college.edit', $data->id) .
                    '"><button class="btn-sm btn-dark mr-sm-2 mb-1">Edit</button></a>';
                    $result .= '<button type="submit" data-id="' . $data->id . '" class="btn btn-danger mr-sm-2 mb-1 delete">Delete</button>';
                    return $result;
            })
            ->editColumn('logo', function ($data) {
                return '<img src="' . asset('' . $data->logo) . '" class="rounded" style="width:50px;height:30px">';
            })
            ->editColumn('status', function ($data) {
                    if ($data->status == '0') {
                        return '<a data-id="' . $data->id . '"  style="color:white" class="badge badge-pill-lg badge-danger status">Inactive</a>';
                    } else {
                        return '<a data-id="' . $data->id . '"  style="color:white" width="70px" class="badge badge-pill-lg badge-success status">Active</a>';
                    }
            })
            ->rawColumns(['action','logo','status'])
            ->addIndexColumn();
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\College $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(College $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('college-table')
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
            Column::make('name'),
            Column::make('email'),
            Column::make('address'),
            Column::computed('contact_no'),
            Column::computed('logo'),
            Column::computed('status'),
            Column::computed('action')
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'College_' . date('YmdHis');
    }
}
