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
        return $this->belongsTo(Subject::class, 'subject_id');
    }


}
