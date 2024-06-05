<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';
    protected $fillable = [
        'emp_id',
        'fname',
        'mname',
        'lname',
        'email',
        'des_type_id',
        'avatar',
        'department_id',
        'emp_type',
        'work_place',
        'emp_status',
    ];

    public function attendances()
    {
        return $this->hasMany(Attendance::class, 'emp_id', 'id');    
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'emp_id', 'emp_id');
    }

    public function designationType()
    {
        return $this->belongsTo(Designation::class, 'des_type_id', 'id');
    }

    public function departments()
    {
        return $this->belongsTo(Department::class, 'department_id', 'id');
    }

    public function workShift()
    {
        return $this->belongsTo(WorkShift::class, 'work_shift_id', 'id');    
    }

    public function fullName()
    {
        return $this->fname . ' ' . $this->lname;
    }
}
