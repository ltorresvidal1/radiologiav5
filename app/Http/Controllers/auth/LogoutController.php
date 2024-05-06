<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;

class LogoutController extends Controller
{
    public function store()
    {
        auth()->Logout();

        return redirect()->route('login');
    }
}
