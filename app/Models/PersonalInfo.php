<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalInfo extends Model
{
    use HasFactory;
    protected $table = 'personal_info';
    protected $fillable = [
        'emp_id',
        'personal_email',
        'personal_number',
        'birth_date',
        'gender',
        'address',
        'country',
        'nationality',
        'marital_status',
        'date_hired',
    ];
}
