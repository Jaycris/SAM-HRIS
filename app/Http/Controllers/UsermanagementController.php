<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Hash;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Notifications\Messages\MailMessage;
use App\Notifications\WelcomeNotification;



class UsermanagementController extends Controller
{
    public function navbar()
    {
        
        $user = Auth::user();
        return view('layouts.master', compact('user'));
    }

    public function index()
    {
        $users = User::paginate(10);
        $userCnt = User::count();
        
        // Get employees without users
        $employees = Employee::whereDoesntHave('user')->get();

        return view('dashboard.user_control', compact('userCnt', 'users', 'employees'));
    }
    

    public function saveUser(UserRequest $request)
    {
        DB::beginTransaction();

        // try {

            // Check if user already exists by employee id, and email
            $existingUser = User::where('emp_id', $request->employeeId)
                                ->where('email', $request->email)
                                ->first();

            if ($existingUser) {
                DB::rollBack();
                return back()->with('error', 'User already exists.');
            }

            $dt = Carbon::now()->format('Y-m-d'); // Correct date format
            $pass = Str::random(30);

            $users = new User;
            $users->emp_id          = $request->employeeId;
            $users->email           = $request->email;
            $users->password        = Hash::make($pass);
            $users->date_created    = $dt;
            $users->user_status     = "Inactive";
            $users->save();

            // Send the Welcome notification with a 7-day expiration
            $users->sendWelcomeNotification();

            DB::commit();


            return redirect()->back();
        // } catch (\Exception $e) {
        //     DB::rollback();
        //     return back()->with('error', 'Failed to create user.');
        // }
    }

    public function showSetPasswordForm(User $user, Request $request)
    {
        // You can add additional validation logic here if needed
        if (!$request->hasValidSignature()) {
            abort(403, 'The welcome link does not have a valid signature or is expired.');
        }
        
        return view('auth.set-password',  ['user' => $user]);
    }

    public function setPassword(Request $request, User $user)
    {
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
        ]);
    
        $user->password = Hash::make($request->password);
        $user->user_status = "Active";
        $user->save();
    
        return redirect('/')->with('success', 'Password set successfully.');
    }

    public function updateUser(Request $request)
    {
        DB::beginTransaction();

        $users = [
            'emp_id'      => $request->employeeId,
            'email'       => $request->email,
            'user_status' => $request->userStatus,
        ];
        
        $result = User::where('id', $request->id)->update($users);
        
        if ($result) {
            DB::commit();
            return redirect()->back();
        } else {
            DB::rollback();
            return redirect()->back()->with('error', 'Failed to update user.');
        }
    }

    public function deleteUser(Request $request)
    {
        $users = User::find($request->id);

        if(!$users) {
            return redirect()->back()->with('error', 'User not found.');
        }

        $users->delete();
        return redirect()->back();
    }
}
