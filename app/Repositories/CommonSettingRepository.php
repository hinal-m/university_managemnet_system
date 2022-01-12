<?php

namespace App\Repositories;

use App\Http\Controllers\University\CommonSettingController;
use App\Interfaces\CommonSettingInterface;
use App\Models\CommonSetting;

class CommonSettingRepository implements CommonSettingInterface
{
    public function all()
    {
        return CommonSetting::all();
    }

    public function store(array $data)
    {
        $common = new CommonSetting();
        $common->subject_id = $data['subject'];
        $common->marks = $data['marks'];
        $save = $common->save();
        return $save;
    }

    public function update(array $data)
    {
        $common = CommonSetting::find($data['id']);
        $common->subject_id = $data['subject'];
        $common->marks = $data['marks'];
        $save = $common->save();
        return $save;
    }

}
