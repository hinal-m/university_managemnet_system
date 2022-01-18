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
            ->addColumn('action', 'collegeadmission.action');
    }

    public function query(Addmission $model)
    {
        // dd($model);
        $college = CollegeMerit::where('college_id',Auth::guard('college')->user()->id)->select('merit')->first()->toArray();
        // dd($college);
        // $addmission = Addmission::where('merit','<=',$college['merit'])->get();
        // dd($addmission);
        // dd($college);
        // dd($admission);
        // $admission = Addmission::select('college_id')->get()->toArray();
        // $admissionInfo = Addmission::all();
        // $college_ids =[];

        // foreach($admission as $value)
        // {
        //     // dd($value);
        //     $college_ids[]=explode(',',$value['college_id'])[0];


        //     // $college_ids[] = Addmission::whereIn('college_id',explode(',',$value['college_id']))->first();
        // }

        // $a=[];

        // foreach($admissionInfo as $values)
        // {
        //     $college_id[]=explode(',',$values['college_id'])[0];
        //     $string=implode(",",$college_id);
        //     // dd($string)
        //     if(in_array(Auth::user()->id,$college_id))
        //     {
        //             $a[]=$values;
        //     }
        // }
        // dd($a);


        return $model->where('merit','>=',$college['merit'])->newQuery();
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
            Column::make('college_id'),
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
