<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\Attendance;
use Auth;

class HomeController extends Controller
{
    public function ___construct()
    {
        $this->middleware('auth');
    }


    /**
     * Show the application dashboard.
     * 
     * @return \Illuminate\contracts\Support\Renderable
     */
    public function index()
    {
        $empCnt         = Employee::count();
        $attendances    = Attendance::count();

        return view('dashboard.home', [
            'empCnt'        => $empCnt,
            'attendances'   => $attendances,
        ]);
    }

    public function emDash()
    {
        //Get the authenticated user
        $user = Auth::user();

        //Get the authenticated user's attendance
        $attendances = Attendance::where('emp_id', $user->emp_id)->count();

        return view('dashboard.emp', [
            'attendances'        => $attendances,
        ]);       
    }
}
