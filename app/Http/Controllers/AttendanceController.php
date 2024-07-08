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
        $user = Auth::user();
        $attendances = Attendance::where('emp_id', $user->emp_id)
                                ->orderBy('attendance_date', 'desc')
                                ->paginate(10);

        return view('hr.my-attendance', compact('attendances'));
    }

    

    public function date(Request $request)
    {
        $date = Carbon::parse($request->input('date'));
        $attendances = Attendance::whereDate('attendance_date', $date)
                                 ->orderBy('attendance_date', 'desc')
                                 ->paginate(10);

        $employees = Employee::with('attendances')->get();
    
        return view('hr.attendance', compact('employees', 'attendances'));
    }

    

    public function empDateFilter(Request $request)
    {
        $user = Auth::user();
        $date = Carbon::parse($request->input('date'));
        $attendances = Attendance::where('emp_id', $user->emp_id)
                                ->whereDate('attendance_date', $date)
                                ->orderBy('attendance_date', 'desc')
                                ->paginate(10);

        return view('hr.my-attendance', compact('attendances'));
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
        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID.');
        }

        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();
        $currentTime = Carbon::now();

        $existingAttendanceToday = Attendance::where('emp_id', $request->emp_id)
                                            ->where('attendance_date', $today)
                                            ->first();

        $existingAttendanceYesterday = Attendance::where('emp_id', $request->emp_id)
                                                ->where('attendance_date', $yesterday)
                                                ->first();

        if ($existingAttendanceToday) {
            return back()->with('error', 'You have already punched in for this working period.');
        }

        if ($existingAttendanceYesterday && !is_null($existingAttendanceYesterday->timeOut)) {
            $noonToday = Carbon::parse($today . ' 13:00:00');
            if ($currentTime < $noonToday && $existingAttendanceYesterday->timeOut < $noonToday->toTimeString()) {
                return back()->with('error', 'You can punch in again after 1:00 PM.');
            }
        }

        $attendance = Attendance::updateOrCreate(
            ['attendance_date' => $today, 'emp_id' => $request->emp_id],
            ['timeIn' => $currentTime->toTimeString()]
        );

        return back()->with('success', 'Punched in successfully.');
    }

    public function punchOut(Request $request)
    {
        $employee = Employee::where('emp_id', $request->emp_id)->first();
        if (!$employee) {
            return back()->with('error', 'Invalid Employee ID.');
        }

        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $attendanceToday = Attendance::where('emp_id', $request->emp_id)
                                    ->where('attendance_date', $today)
                                    ->first();

        $attendanceYesterday = Attendance::where('emp_id', $request->emp_id)
                                        ->where('attendance_date', $yesterday)
                                        ->first();

        $attendanceToUpdate = null;

        if ($attendanceToday && $attendanceToday->timeIn && is_null($attendanceToday->timeOut)) {
            $attendanceToUpdate = $attendanceToday;
        } elseif ($attendanceYesterday && $attendanceYesterday->timeIn && is_null($attendanceYesterday->timeOut)) {
            $attendanceToUpdate = $attendanceYesterday;
        }

        if (is_null($attendanceToUpdate)) {
            return back()->with('error', 'Cannot Punch Out without Punching In or already Punched Out.');
        }

        $attendanceToUpdate->update(['timeOut' => Carbon::now()->toTimeString()]);

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

        $attendanceToday = Attendance::where('emp_id', $request->emp_id)
                                    ->where('attendance_date', $today)
                                    ->first();

        $attendanceYesterday = Attendance::where('emp_id', $request->emp_id)
                                        ->where('attendance_date', $yesterday)
                                        ->first();

        $attendance = $attendanceToday ?? $attendanceYesterday;

        if (!$attendance || !$attendance->timeIn) {
            return back()->with('error', 'Cannot start Break without Punching In.');
        }

        $breakType = $request->input('breakType');
        if (!$breakType) {
            return back()->with('error', 'Please select a break type.');
        }

        if ($breakType === 'lunch') {
            $existingLunchBreak = Breaks::where('attendance_id', $attendance->id)
                                        ->where('type', 'lunch')
                                        ->first();

            if ($existingLunchBreak && Carbon::parse($existingLunchBreak->created_at)->isToday()) {
                return back()->with('error', 'Lunch Break has already been taken for this working day.');
            }
        }

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

        $today = Carbon::now()->toDateString();
        $yesterday = Carbon::yesterday()->toDateString();

        $attendanceToday = Attendance::where('emp_id', $request->emp_id)
                                    ->where('attendance_date', $today)
                                    ->first();

        $attendanceYesterday = Attendance::where('emp_id', $request->emp_id)
                                        ->where('attendance_date', $yesterday)
                                        ->first();

        $attendanceToUpdate = null;

        if ($attendanceToday && $attendanceToday->timeIn && is_null($attendanceToday->timeOut)) {
            $attendanceToUpdate = $attendanceToday;
        } elseif ($attendanceYesterday && $attendanceYesterday->timeIn && is_null($attendanceYesterday->timeOut)) {
            $attendanceToUpdate = $attendanceYesterday;
        }

        if (is_null($attendanceToUpdate)) {
            return back()->with('error', 'Cannot end Break without Punching In.');
        }
    
        $break = Breaks::where('attendance_id', $attendanceToUpdate->id)
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