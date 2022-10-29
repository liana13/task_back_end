<?php

namespace App\Providers;

use App\Facades\VehicleManager;
use App\Repositories\VehicleRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Create a Facade class called
     * @const array<string
     */
    private const FACADES = [
        'Vehicle' => VehicleRepositoryInterface::class
    ];

    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        foreach (self::FACADES as $abstract => $concrete) {
            $this->app->bind($abstract, $concrete);
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
