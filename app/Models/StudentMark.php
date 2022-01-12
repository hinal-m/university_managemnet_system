<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentMark extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'subject_id',
        'total_mark',
        'obtain_mark',
    ];
}
