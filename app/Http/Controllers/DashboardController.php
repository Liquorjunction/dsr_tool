<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard');
    }

    public function redirectToDashboardOrLogin()
    {
        if (auth('admin')->check()) {
            return redirect()->route('dashboard');
        }
        return redirect()->route('login');
    }
}
