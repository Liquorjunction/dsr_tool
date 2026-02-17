<?php

namespace App\Providers;

use App\Repositories\Interface\AdminRepositoryInterface;
use App\Repositories\Repositories\AdminRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
    }

    public function boot(): void
    {
        //
    }
}
