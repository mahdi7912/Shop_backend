<?php

namespace App\Providers;

use App\Models\Premission;
use Exception;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class PremissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

            try {

                Premission::get()->map(function ($permission) {
                    Gate::define($permission->name, function ($user) use ($permission){
                        return $user->hasPremissionTo($permission);
                    });
                });

            } catch (Exception $e) {
                report($e);
                return false;
            }
    }
}
