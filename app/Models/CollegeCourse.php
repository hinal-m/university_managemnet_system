<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CollegeCourse extends Model
{
    use HasFactory;

    protected $table="college_courses";

    protected $fillable = [
        'college_id',
        'course_id',
        'seat_no',
        'reserved_seat',
        'merit_seat',
    ];

    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
