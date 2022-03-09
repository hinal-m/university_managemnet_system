<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;


class College extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact_no',
        'address',
        'logo',
        'status',
        'password',
        'google_id'
    ];
    public function getLogoAttribute($value)
    {
        return $value ? asset('storage/college' . '/' . $value) : NULL;
    }
}
