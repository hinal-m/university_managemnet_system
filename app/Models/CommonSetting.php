<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'subject_id',
        'marks',
    ];

    public function Subject()
    {
        return $this->belongsTo(CommonSetting::class, 'subject_id','subject_id');
    }
    // public function commonSetting()
    // {
    //     return $this->hasOne(Subject::class,'subject_id','id');
    // }


}
