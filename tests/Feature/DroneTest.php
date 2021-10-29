<?php

namespace Tests\Feature;

use App\Models\Drone;
use App\Models\Operator;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DroneTest extends TestCase
{
    use WithFaker;

    public function test_store_drone() 
    {
        $data = [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $this->faker->numerify('########'),
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('drones.store'), $data);
        $response->assertStatus(201);
    }

    public function test_get_drones()
    {
        $response = $this->json('GET', route('drones.index'));
        $response->assertStatus(200);
    }

    public function test_get_drone()
    {
        $serial = $this->faker->numerify('########');
        $data = [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $serial,
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('drones.store'), $data);
        $drone = Drone::select()->where('serial', $serial)->first();
        $response = $this->get('api/drones/'.$drone->id);
        $response->assertStatus(200);
    }

    public function test_update_drone()
    {
        $serial = $this->faker->numerify('########');
        $before = [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $serial,
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('drones.store'), $before);
        $drone = Drone::select()->where('serial', $serial)->first();
        $after = [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $serial,
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
        $response = $this->json('PUT', url('api/drones/'.$drone->id), $after);
        $response->assertStatus(200);
    }

    public function test_delete_drone()
    {
        $serial = $this->faker->numerify('########');
        $data = [
            'codename' => $this->faker->words(2, true),
            'manufacturer' => $this->faker->company(),
            'model' => $this->faker->word(),
            'serial' => $serial,
            'operator_id' => (string) Operator::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('drones.store'), $data);
        $drone = Drone::select()->where('serial', $serial)->first();
        $response = $this->delete('api/drones/'.$drone->id);
        $response->assertStatus(200);
    }
}
