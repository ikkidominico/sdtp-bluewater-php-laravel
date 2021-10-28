<?php

namespace Database\Factories;

use App\Models\Drone;
use App\Models\Operator;
use Illuminate\Database\Eloquent\Factories\Factory;

class DroneFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Drone::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $this->faker->numerify('########'),
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
    }
}
