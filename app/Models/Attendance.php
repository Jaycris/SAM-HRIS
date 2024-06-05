<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendances';
    protected $fillable = [
        'attendance_date',
        'emp_id',
        'timeIn',
        'timeOut',
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'emp_id', 'emp_id');
    }

    public function breaks()
    {
        return $this->hasMany(Breaks::class, 'attendance_id');
    }


    public function getTotalHoursWorked()
    {
        if ($this->timeIn && $this->timeOut) {
            $timeIn = new \DateTime($this->timeIn);
            $timeOut = new \DateTime($this->timeOut);
            $interval = $timeIn->diff($timeOut);
    
            return $interval->format('%hh %im');
        }
        return 'N/A';
    }

    public function getTotalBreakTime()
    {
        if ($this->breaks->isEmpty()) {
            return 'N/A';
        }
    
        $totalBreakTime = 0;
        foreach ($this->breaks as $break) {
            if ($break->start_time && $break->end_time) {
                $start_time = new \DateTime($break->start_time);
                $end_time = new \DateTime($break->end_time);
                $interval = $start_time->diff($end_time);
    
                // Extract hours and minutes from the interval
                $hours = $interval->format('%h');
                $minutes = $interval->format('%i');
    
                // Add hours and minutes to totalBreakTime
                $totalBreakTime += ($hours * 60) + $minutes;
            }
        }
    
        if ($totalBreakTime === 0) {
            return '0h 0m';
        }
    
        $hours = floor($totalBreakTime / 60);
        $minutes = $totalBreakTime % 60;
    
        return sprintf('%dh %dm', $hours, $minutes);
    }
}
