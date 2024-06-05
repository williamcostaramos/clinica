<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repository\UserRepository;
use App\Repository\UserRepositoryImpl;
use App\Repository\CustomerRepository;
use App\Repository\CustomerRepositoryImpl;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(CustomerRepository::class, CustomerRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
