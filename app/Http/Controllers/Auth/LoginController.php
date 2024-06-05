<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Auth;
use DB;
use App\Models\User;
use Carbon\Carbon;
use Session;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     * 
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     * 
     * @return void
     */

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'email'         => 'required|string|email',
            'password'      => 'required|string',
        ]);

        $email          = $request->email;
        $password       = $request->password;

        $dt             = Carbon::now();
        $toodayDate     = $dt->toDayDateTimeString();

        if (Auth::attempt(['email'=>$email,'password'=>$password]))
        {
            $user = Auth::user();
            $employee = $user->employee()->with('designationType')->first();

            if ($employee) {
                $designation = $employee->designationType->designation;

                // Check if user status is active
                if ($user->user_status == 'Active') {
                    if (in_array($designation, ['Chief Executive Officer', 'Chief Operation Officer', 'Human Resources'])) {
    
                        return redirect()->intended('home');
                    }else {
                        return redirect()->route('emp');
                    }     
                } else {
                    Auth::logout();
                    return back()->with('error', 'Your account is Inactive. Please contact your Administrator.');
                }

            }

            // Fallback if employee or designation is not found
            Auth::logout();
            return back()->with('error', 'User has no valid designation.');
        }else {
            return back()->with('error', 'Wrong Email or Password');
        }
    }

    public function logoutAction()
    {
        Auth::logout();
        return redirect('/');
    }
}
