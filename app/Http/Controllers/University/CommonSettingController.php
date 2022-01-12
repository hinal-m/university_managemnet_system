<?php

namespace App\Http\Controllers\University;

use App\DataTables\CommonSettingDataTable;
use App\Http\Controllers\Controller;
use App\Models\CommonSetting;
use App\Models\Subject;
use App\Repositories\CommonSettingRepository;
use Illuminate\Http\Request;

class CommonSettingController extends Controller
{
    protected $common_setting;
    public function __construct(CommonSettingRepository $common_setting)
    {
        $this->common_setting = $common_setting;
    }
    public function index(CommonSettingDataTable $dataTable)
    {
        return $dataTable->render('university.CommonSetting.index');
    }

    public function create()
    {
        $subject = Subject::get();
        return view('University.CommonSetting.create',compact('subject'));
    }

    public function store(Request $request)
    {
        $common = $this->common_setting->store($request->all());
        return response()->json(['data' => $common]);
    }

    public function edit($id)
    {
        $common = CommonSetting::find($id);
        $subject = Subject::get();
        return view('university.CommonSetting.edit', compact('common','subject'));
    }

    public function update(Request $request)
    {
        $common = $this->common_setting->update($request->all());
        return response()->json(['data' => $common]);
    }


}
