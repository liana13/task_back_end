<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Models\User;

interface VehicleRepositoryInterface
{
    /**
     * @const  array
     * use when need to detach Vehicle from user
     */
    public const DETACH = ['user_id' => null];

    /**
     * add Vehicle to user
     * @param Vehicle $vehicle
     * @param User $user
     *
     * @return bool
     */
    public function attachWitchUser(Vehicle $vehicle, User $user): bool;

    /**
     * remove Vehicle from user
     * @param Vehicle $vehicle
     *
     * @return bool
     */
    public function detachFromUser(Vehicle $vehicle): bool;
}
