<?php

namespace App\Http\Controllers\University;

use App\DataTables\CommonSettingDataTable;
use App\Http\Controllers\Controller;
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
}
