<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $user;
    protected $employee;

    public function __construct()
    {
        // $this->middleware(function ($request, $next) {
        //     $this->user = Auth::user();
        //     $this->employee = $this->user ? $this->user->employee()->with('designationType')->first() : null;
        //     // $this->employee = $this->user ? $this->user->employee : null;

        //     // Share the user and employee date with all views
        //     view()->share('user', $this->user);
        //     view()->share('employee', $this->employee);

        //     return $next($request);
        // });
    }
}
