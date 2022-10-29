<?php

namespace Tests\Feature;

use App\Facades\VehicleManager;
use App\Models\Vehicle;
use App\Models\User;
use App\Repositories\VehicleRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RentVehicleTest extends TestCase
{
    use RefreshDatabase;

    private User $user;
    private Vehicle $vehicle;

    protected function setUp(): void
    {
        parent::setUp();

        $this->user = User::factory()->create();

        $this->vehicle = Vehicle::factory()->create(['user_id' => $this->user->id]);
    }

    public function test_get_available_vehicles(): void
    {

        $vehicles = Vehicle::factory(5)->create(VehicleRepositoryInterface::DETACH);
        $vehicles->map(function ($vehicle) {
            $this->assertTrue($vehicle->available);
        });
    }

    public function test_user_can_rent_a_vehicle(): void
    {
        $this->vehicle->update(VehicleRepositoryInterface::DETACH);

        $status = VehicleManager::attachWitchUser($this->vehicle, $this->user);

        $this->assertTrue((bool)$status);
    }

    public function test_user_can_not_rent_a_vehicle_when_the_user_is_already_using_another(): void
    {
        $anotherVehicle = clone $this->vehicle;

        $status = VehicleManager::attachWitchUser($anotherVehicle, $this->user);

        $this->assertFalse($status);
    }

    public function test_user_can_not_rent_a_vehicle_when_vehicle_is_already_in_use(): void
    {
        $anotherUser = clone $this->user;

        $status = VehicleManager::attachWitchUser($this->vehicle, $anotherUser);

        $this->assertFalse($status);
    }

    public function test_user_can_drop_off_a_vehicle(): void
    {
        $status = VehicleManager::detachFromUser($this->vehicle);

        $this->assertTrue((bool)$status);
    }
}
