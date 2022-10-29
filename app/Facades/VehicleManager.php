<?php

namespace App\Facades;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Repositories\VehicleRepositoryInterface attachWitchUser(Vehicle $vehicle, User $user): bool
 * @method static \App\Repositories\VehicleRepositoryInterface detachFromUser(Vehicle $vehicle): bool
 * @const  array<string \App\Repositories\VehicleRepositoryInterface DETACH
 */
class VehicleManager extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'Vehicle';
    }
}
