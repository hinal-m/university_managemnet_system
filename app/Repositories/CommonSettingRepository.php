<?php

namespace App\Repositories;

use App\Interfaces\CommonSettingInterface;
use App\Models\CommonSetting;

class CommonSettingRepository implements CommonSettingInterface
{
    public function all()
    {
        return CommonSetting::all();

    }

}
