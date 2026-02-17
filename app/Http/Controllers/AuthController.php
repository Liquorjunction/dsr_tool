<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\AdminLoginRequest;
use App\Repositories\Interface\AdminRepositoryInterface as AdminRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showloginform()
    {
        return view('auth.login');
    }

    public function login(AdminLoginRequest $request, AdminRepo $adminRepo)
    {
        $credentials = $request->only('login', 'password');
        $remember = $request->boolean('remember');

        if ($adminRepo->authenticate($credentials['login'], $credentials['password'], $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->withErrors([
            'login' => 'The provided credentials do not match our records.',
        ])->onlyInput('login');
    }

    public function logout(Request $request, AdminRepo $adminRepo)
    {
        $adminRepo->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
