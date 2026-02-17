<?php

namespace App\Providers;

use App\Repositories\Interface\AdminRepositoryInterface;
use App\Repositories\Repositories\AdminRepository;
use App\Repositories\Interface\UserRepositoryInterface;
use App\Repositories\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
