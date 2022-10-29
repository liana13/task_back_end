<?php

namespace Tests\Feature;

use App\Models\Vehicle;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleActionTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->vehicle = Vehicle::factory()->create();
    }

    public function test_get_all_vehicles(): void
    {
        $this->authUser();

        $response = $this->get(\route('vehicles.index'));

        $response->assertStatus(200);
    }

    public function test_create_new_vehicle(): void
    {

        $this->authUser();

        $response = $this->post(\route('vehicles.store', [
            'model' => $this->vehicle->model,
            'class' => $this->vehicle->class,
        ]));

        $response->assertStatus(201);
    }

    public function test_create_new_vehicle_with_user_id(): void
    {
        $user = $this->authUser();

        $response = $this->post(\route('vehicles.store', [
            'model' => $this->vehicle->model,
            'class' => $this->vehicle->class,
            'user_id' => $user->id,
        ]));

        $response->assertStatus(201);
    }

    public function test_show_vehicle_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->get(\route('vehicles.show', [
            'vehicle' => $this->vehicle->id,
        ]));

        $response->assertStatus(200);
    }

    public function test_update_vehicle_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->put(\route('vehicles.update', [
            'vehicle' => $this->vehicle->id,
            'class' => 'some new class',
        ]));

        $response->assertStatus(200);
    }

    public function test_remove_vehicle_getting_by_id(): void
    {
        $this->authUser();

        $response = $this->delete(\route('vehicles.destroy', [
            'vehicle' => $this->vehicle->id,
        ]));

        $response->assertStatus(204);
    }
}
