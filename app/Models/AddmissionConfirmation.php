<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddmissionConfirmation extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'addmission_id',
        'confirm_college_id',
        'confirm_round_id',
        'confirm_merit',
        'confirmation_type',
    ];

    public function colleges()
    {
        return $this->belongsTo(College::class, 'confirm_college_id', 'id');
    }
}
