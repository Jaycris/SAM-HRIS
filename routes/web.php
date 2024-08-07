<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\SetPasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HRController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\ImprintController;
use App\Http\Controllers\EmployeeTypeController;
use App\Http\Controllers\UsermanagementController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\WorkShiftController;
use App\Http\Controllers\ComingSoonController;
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\WelcomeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::middleware('maintenance')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });
});

Route::group(['middleware'=>'auth'], function()
{
    Route::get('home', function()
    {
        return view('dashboard.home');
    });
});

Auth::routes();


//---------------------- Main Dashboard ------------------------//

Route::controller(HomeController::class)->group(function () {
    Route::get('/home', 'index')->middleware('auth','isAdmin','maintenance')->name('home');
    Route::get('/em/dashboard', 'emDash')->middleware('auth','maintenance')->name('emp');
});

//---------------------- login ---------------------------------//

Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'login')->middleware('maintenance')->name('login');
    Route::post('/login', 'authenticate');
    Route::get('/logout', 'logoutAction')->middleware('maintenance')->name('logout');
});


Route::controller(UsermanagementController::class)->group(function () {
    Route::get('/navbar', 'navbar')->middleware('auth','maintenance')->name('navbar');
    Route::get('/user/list', 'index')->middleware('auth','isAdmin','maintenance')->name('userList');
    Route::post('/user/save', 'saveUser')->middleware('auth','isAdmin','maintenance')->name('userSave');
    Route::post('/user/update', 'updateUser')->middleware('auth','isAdmin','maintenance')->name('userUpdate');
    Route::post('/user/delete', 'deleteUser')->middleware('auth','isAdmin','maintenance')->name('userDelete');
    Route::get('/set-password/{user}', 'showSetPasswordForm')->name('set-password','maintenance')->middleware('signed');
    Route::post('/set-password/{user}', 'setPassword')->name('save-password');
    ;
});

Route::controller(HRController::class)->group(function () {
    Route::get('/employeelist', 'employeeList')->middleware('auth','isAdmin','maintenance')->name('employeelist');
    Route::post('/employee/save', 'saveEmployee')->middleware('auth','isAdmin')->name('employeeSave');
    Route::post('/employee/update', 'updateEmployee')->middleware('auth','isAdmin')->name('employeeUpdate');
    Route::get('/employeeDetails/{$employees}', 'showEmployeeDetails')->middleware('auth','maintenance')->name('employeeDetails');
    // Route::delete('/employee/delete/{id}','deleteEmployee')->middleware('auth')->name('EmployeeDelete');});
    Route::post('/employee/delete/','deleteEmployee')->middleware('auth','isAdmin')->name('EmployeeDelete');});


Route::controller(DepartmentController::class)->group(function () {
    Route::get('/departmentlist', 'department')->middleware('auth','isAdmin','maintenance')->name('departmentlist');
    Route::post('/department/save','saveDepartment')->middleware('auth','isAdmin')->name('departmentSave');
    Route::post('/department/update', 'updateDepartment')->middleware('auth','isAdmin')->name('departmentUpdate');
});

Route::controller(DesignationController::class)->group(function () {
    Route::get('/designationlist', 'designation')->middleware('auth','isAdmin','maintenance')->name('designationlist');
    Route::post('/designation/save', 'saveDesignation')->middleware('auth','isAdmin')->name('designationSave');
    Route::post('/designation/update', 'updateDesignation')->middleware('auth','isAdmin')->name('designationUpdate');
    Route::post('/designation/delete', 'deleteDesignation')->middleware('auth','isAdmin')->name('designationDelete');

});

Route::controller(AttendanceController::class)->group(function () {
    Route::get('/timesheet','index')->middleware('auth','isAdmin','maintenance')->name('timesheet');
    Route::get('/my-timesheet','userAttendance')->middleware('auth','maintenance')->name('myTimesheet');
    Route::get('/attendance/create', 'create')->middleware('auth','maintenance')->name('attendanceCreate');
    Route::get('/time-tracker', 'timeTracker')->middleware('maintenance')->name('time-tracker');
    Route::post('/attendance/punchIn', 'punchIn')->middleware('ip.check')->name('attendancePunchIn');
    Route::post('/attendance/punchOut', 'punchOut')->middleware('ip.check')->name('attendancePunchOut');
    Route::post('/break-start', 'breakStart')->middleware('ip.check')->name('attendanceBreakStart');
    Route::post('/break-end', 'breakEnd')->middleware('ip.check')->name('attendanceBreakEnd');
    Route::get('/attendance/date', 'date')->middleware('auth','maintenance')->name('dateSearch');
    Route::get('/attendance/date-filter', 'empDateFilter','maintenance')->middleware('auth')->name('emp.date');
});


Route::view('/forbidden', 'forbidden')->name('forbidden');
Route::fallback([ComingSoonController::class, 'index']);
