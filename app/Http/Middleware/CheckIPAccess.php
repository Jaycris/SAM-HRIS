<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Employee;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Log;

class CheckIPAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $employeeId = $request->input('emp_id'); // Assuming the input name is 'emp_id'
        $employee = Employee::where('emp_id', $employeeId)->first();

        if ($employee && $employee->work_place === 'On-site') {
            $allowedIPs = config('app.allowed_ips');

            Log::info('Employee ID: ' . $employeeId);
            Log::info('Employee: ' . ($employee ? $employee->emp_id : 'Not found'));
            Log::info('Employee Work Place: ' . ($employee ? $employee->work_place : 'Not found'));
            Log::info('Request IP: ' . $request->ip());
            Log::info('Allowed IPs: ' . implode(', ', $allowedIPs));

            if (!in_array($request->ip(), $allowedIPs)) {
                Log::info('IP not allowed.');
                return redirect()->back()->with('error', 'You are not allowed to punch in or punch out outside the company.');
            }
        }

        return $next($request);
    }
}
