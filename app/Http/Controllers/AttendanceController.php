<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Employee;
use App\Models\Breaks;
use Carbon\Carbon;
use Auth;

class AttendanceController extends Controller
{
    public function index()
    {
        $employees = Employee::with('attendances')->get();
        $attendances = Attendance::paginate(10);
        
        return view('hr.attendance', compact('employees','attendances'));
    }

    public function userAttendance()
    {
        //Get the authenticated user
        $user = Auth::user();

        //Get the authenticated user's attendance
        $attendances = Attendance::where('emp_id', $user->emp_id)->paginate(10);

        return view('hr.my-attendance', compact('attendances'));
    }

    public function date(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        
        $attendances = Attendance::whereDate('attendance_date', $date)->paginate(10);
        $employees = Employee::with('attendances')->get();

        return view('hr.attendance', compact('employees','attendances'));
    }

    public function timeTracker(Request $request)
    {
        $employee = $request->input('emp_id');
        $attendance = Attendance::where('attendance_date', Carbon::now()->toDateString())
                                ->where('emp_id', $employee)
                                ->with('breaks')
                                ->first();

        return view('hr.time-tracker', ['attendance' => $attendance]);
    }

    public function punchIn(Request $request)
    {
        // Validate the employee ID
        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID.');
        }

        // Get today's date
        $today = Carbon::now()->toDateString();

        // Check for existing attendance record for today or yesterday (for graveyard shift)
        $existingAttendance = Attendance::where('emp_id', $request->emp_id)
                                        ->where(function ($query) use ($today) {
                                            $query->where('attendance_date', $today)
                                            ->orWhere('attendance_date', Carbon::yesterday()->toDateString());
                                        })
                                        ->first();
                                        
        // If there's an existing record and no punch out time, prevent punch in
        if ($existingAttendance && is_null($existingAttendance->timeOut)) {
            return back()->with('error', 'You must punch out before punching in again.');
        }

        // Create or update the attendance record with punch in time
        $attendance = Attendance::updateOrCreate(
            ['attendance_date' => $today, 'emp_id' => $request->emp_id],
            ['timeIn' => Carbon::now()->toTimeString()]
        );

        return back()->with('success', 'Punched in successfully.');
    }

    public function punchOut(Request $request)
    {
        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID.');
        }

        // Get today's date
        $today = Carbon::now()->toDateString();

        // Check for existing attendance record for today or yesterday (for graveyard shift)
        $attendance = Attendance::where('emp_id', $request->emp_id)
                                ->where(function ($query) use ($today) {
                                    $query->where('attendance_date', $today)
                                          ->orWhere('attendance_date', Carbon::yesterday()->toDateString());
                                })
                                ->first();

        if (!$attendance || !$attendance->timeIn) {
            return back()->with('error', 'Cannot Punch Out without Punching In.');
        }

        if ($attendance->timeOut) {
            return back()->with('error', 'You have already punched out.');
        }

        // Update the attendance record with punch out time
        $attendance->update(['timeOut' => Carbon::now()->toTimeString()]);

        return back()->with('success', 'Punched out successfully.');
    }

    public function breakStart(Request $request)
    {
        $employee = Employee::where('emp_id', $request->emp_id)->first();

        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID for starting break.');
        }

        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $attendance = Attendance::where('emp_id', $request->emp_id)
                                ->where(function ($query) use ($today, $yesterday) {
                                    $query->where('attendance_date', $today)
                                          ->orWhere('attendance_date', $yesterday);
                                })
                                ->first();

        if (!$attendance || !$attendance->timeIn) {
            return back()->with('error', 'Cannot start Break without Punching In.');
        }

        $breakType = $request->input('breakType');
        if (!$breakType) {
            return back()->with('error', 'Please select a break type.');
        }

        // Specific check for lunch break to prevent multiple lunch breaks
        if ($breakType === 'lunch') {
            $existingLunchBreak = Breaks::where('attendance_id', $attendance->id)
                                        ->where('type', 'lunch')
                                        ->first();

            if ($existingLunchBreak) {
                return back()->with('error', 'Lunch Break has already been taken for this working day.');
            }
        }

        // Check if the break type already started for today or yesterday (graveyard shift)
        $existingBreak = Breaks::where('attendance_id', $attendance->id)
                               ->where('type', $breakType)
                               ->whereNull('end_time')
                               ->first();

        if ($existingBreak) {
            return back()->with('error', ucfirst($breakType) . ' Break has already been started.');
        }

        $breakStartTime = Carbon::now()->toTimeString();

        $break = new Breaks();
        $break->attendance_id = $attendance->id;
        $break->type = $breakType;
        $break->start_time = $breakStartTime;
        $break->save();

        return back()->with('success', ucfirst($breakType) . ' Break started successfully.');
    }

    public function breakEnd(Request $request)
    {
        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID.');
        }

        $attendance = Attendance::where('attendance_date', Carbon::now()->toDateString())
                                ->where('emp_id', $request->emp_id)
                                ->first();


        if (!$attendance || !$attendance->timeIn) {
            return back()->with('error', 'Cannot end Break without Punching In.');
        }

        $break = Breaks::where('attendance_id', $attendance->id)
                        ->whereNull('end_time')
                        ->orderBy('start_time', 'desc')
                        ->first();

        if (!$break) {
            return back()->with('error', 'Cannot end break without starting it.');
        }

        $break->end_time = Carbon::now()->toTimeString();
        $break->save();

        return back()->with('success', ucfirst($break->type) . ' Break ended successfully.');
    }
}