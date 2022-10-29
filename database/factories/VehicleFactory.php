<?php

namespace Database\Factories;

use App\Models\Vehicle;
use App\Models\User;
use Exception;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Vehicle>
 */
class VehicleFactory extends Factory
{
    /** @var array custom Vehicles constants */
    public const  VEHICLES = [
        'Opel' => 'astra c',
        'Ford' => 'focus',
        'Shevrolet' => 'cruze',
        'BMV' => 'm 3',
        'Mercedes' => 'c es',
        'KIA' => 'else',
        'Nissan' => 'tiidda',
        'Honda' => 'Elision',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     * @throws Exception
     */
    public function definition(): array
    {

        $class = array_rand(self::VEHICLES);
        $model = self::VEHICLES[$class];

        return [
            'user_id' => User::factory()->create()->id,
            'model' => $model,
            'class' => $class,
        ];
    }
}
