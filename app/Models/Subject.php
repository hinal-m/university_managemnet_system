<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subject extends Model
{
    use HasFactory;

    public function studentMark()
    {
        return $this->hasMany(StudentMark::class, 'subject_id');
    }

    public function userStudentMark()
    {
        if(Auth::guard('user')->check())
        {
            return $this->hasOne(StudentMark::class, 'subject_id')->where('user_id',Auth::guard('user')->user()->id);
        }
    }
}
