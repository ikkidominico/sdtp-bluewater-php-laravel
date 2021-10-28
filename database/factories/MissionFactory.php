<?php

namespace Database\Factories;

use App\Models\Mission;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'codename' => $this->faker->words(2, true),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => Carbon::createFromDate($this->faker->numberBetween(2021,2030), $this->faker->numberBetween(1,12), $this->faker->numberBetween(1,28))
        ];
    }
}
