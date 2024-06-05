<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Designation extends Model
{
    use HasFactory;
    protected $table = 'des_types';
    protected $fillable = [
        'designation',
    ];
    
    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'id');
    }
}
