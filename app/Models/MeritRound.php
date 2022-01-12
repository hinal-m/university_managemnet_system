<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeritRound extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'round_no',
        'course_id',
        'start_date',
        'end_date',
        'merit_result_declare_date',
        'status',
    ];
    public function  merit()
    {
        return $this->hasMany(MeritRound::class, 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
