<?php

namespace App\Http\Middleware;

use Closure;

class CheckMaintenanceMode
{
    public function handle($request, Closure $next)
    {
        // Check if maintenance mode is enabled
        if ($this->isDownForMaintenance()) {
            return response()->view('errors.maintenance', [], 503);
        }

        return $next($request);
    }

    protected function isDownForMaintenance()
    {
        // Logic to determine if maintenance mode is enabled
        // Example: check a flag in .env file
        return env('MAINTENANCE_MODE', false);
    }
}
