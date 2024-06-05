<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\WelcomeNotification\WelcomeController as BaseWelcomeController;
use App\Models\User;

class WelcomeController extends BaseWelcomeController
{
    public function sendPasswordSavedResponse(): Response

    {
        return redirect()->route('login');
    }

    public function rules()
    {
        return [
            'password' => 'required|confirmed|min:6',
        ];
    }
}
