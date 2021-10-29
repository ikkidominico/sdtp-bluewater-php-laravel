<?php

namespace Tests\Feature;

use App\Models\Drone;
use App\Models\Repair;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RepairTest extends TestCase
{
    use WithFaker;

    public function test_store_repair() 
    {
        $data = [
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('repairs.store'), $data);
        $response->assertStatus(201);
    }

    public function test_get_repairs()
    {
        $response = $this->json('GET', route('repairs.index'));
        $response->assertStatus(200);
    }

    public function test_get_repair()
    {
        $description = $this->faker->words(15, true);
        $data = [
            'description' => $description,
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('repairs.store'), $data);
        $repair = Repair::select()->where('description', $description)->first();
        $response = $this->get('api/repairs/'.$repair->id);
        $response->assertStatus(200);
    }

    public function test_update_repair()
    {
        $description = $this->faker->words(15, true);
        $before = [
            'description' => $description,
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('repairs.store'), $before);
        $repair = Repair::select()->where('description', $description)->first();
        $after = [
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('PUT', url('api/repairs/'.$repair->id), $after);
        $response->assertStatus(200);
    }

    public function test_delete_repair()
    {
        $description = $this->faker->words(15, true);
        $data = [
            'description' => $description,
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('repairs.store'), $data);
        $repair = Repair::select()->where('description', $description)->first();
        $response = $this->delete('api/repairs/'.$repair->id);
        $response->assertStatus(200);
    }
}
