<?php

namespace App\Repositories\Repositories;

use App\Models\User;
use App\Repositories\Interface\AdminRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class AdminRepository implements AdminRepositoryInterface
{
    public function authenticate(string $login, string $password, bool $remember = false): bool
    {
        try {
            $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            return Auth::guard('admin')->attempt([
                $field => $login,
                'password' => $password,
            ], $remember);
        } catch (\Exception $e) {
            Log::error('Admin authentication failed: ' . $e->getMessage());
            return false;
        }
    }

    public function logout(): void
    {
        Auth::guard('admin')->logout();
    }
}
