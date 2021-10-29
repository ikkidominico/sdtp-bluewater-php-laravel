<?php

namespace Database\Factories;

use App\Models\Drone;
use App\Models\DroneMission;
use App\Models\Mission;
use Illuminate\Database\Eloquent\Factories\Factory;

class DroneMissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $pivot = DroneMission::class;


    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'drone_id' => (string) Drone::inRandomOrder()->first()->id,
            'mission_id' => (string) Mission::inRandomOrder()->first()->id,
        ];
    }
}