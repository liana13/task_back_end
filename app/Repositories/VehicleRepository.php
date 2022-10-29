<?php

namespace App\Repositories;

use App\Models\Vehicle;
use App\Models\User;

class VehicleRepository implements VehicleRepositoryInterface
{
    /**
     * add Vehicle to user, only if user and Vehicle are available
     * @param Vehicle $vehicle
     * @param User $user
     *
     * @return bool
     */
    private function attachIfAvailable(Vehicle $vehicle, User $user): bool
    {
        if ($user->available && $vehicle->available) {
            return $vehicle->update(['user_id' => $user->id]);
        }
        return false;
    }

    /**
     * add Vehicle to user
     * @implements <VehicleRepositoryInterface>
     * @param Vehicle $vehicle
     * @param User $user
     *
     * @return bool
     */
    public function attachWitchUser(Vehicle $vehicle, User $user): bool
    {

        return $this->attachIfAvailable($vehicle, $user);
    }

    /**
     * remove Vehicle from user
     * @implements <VehicleRepositoryInterface>
     * @param Vehicle $vehicle
     *
     * @return bool
     */
    public function detachFromUser(Vehicle $vehicle): bool
    {
        return $vehicle->update(self::DETACH);
    }
}
