<?php

namespace Database\Factories;

use App\Models\Drone;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class RepairFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'description' => $this->faker->words(15, true),
            'date' => Carbon::createFromDate($this->faker->numberBetween(1990,2030), $this->faker->numberBetween(1,12), $this->faker->numberBetween(1,28)),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id,
        ];
    }
}
