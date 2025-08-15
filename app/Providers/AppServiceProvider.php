<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View; // Facade for view composer
use App\Models\Menus;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Share menus with all views
        View::composer('*', function ($view) {
            $roleId = session('role_id');

            $menus = Menus::whereHas('roles', function ($q) use ($roleId) {
                $q->where('role_id', $roleId);
            })->get();

            $view->with('menus', $menus);
        });
    }
}
