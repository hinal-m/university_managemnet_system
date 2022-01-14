<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addmission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'college_id',
        'addmission_date',
        'addmission_code',
        'status',
    ];

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
    public function meritRound()
    {
        return $this->belongsTo(MeritRound::class, 'merit_round_id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
   


}

