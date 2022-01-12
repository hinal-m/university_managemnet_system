<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeMerit extends Model
{
    use HasFactory;

    protected $fillable = [
        'college_id',
        'course_id',
        'merit_round_id',
        'merit',
    ];


    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function college()
    {
        return $this->belongsTo(College::class, 'college_id');
    }
}
