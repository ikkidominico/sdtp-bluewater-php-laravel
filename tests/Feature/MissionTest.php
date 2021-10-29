<?php

namespace Tests\Feature;

use App\Models\Mission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MissionTest extends TestCase
{
    use WithFaker;

    public function test_store_mission() 
    {
        $data = [
            'codename' => $this->faker->words(2, true),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
        ];
        $response = $this->json('POST', route('missions.store'), $data);
        $response->assertStatus(201);
    }

    public function test_get_missions()
    {
        $response = $this->json('GET', route('missions.index'));
        $response->assertStatus(200);
    }

    public function test_get_mission()
    {
        $codename = $this->faker->words(2, true);
        $data = [
            'codename' => $codename,
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
        ];
        $response = $this->json('POST', route('missions.store'), $data);
        $mission = Mission::select()->where('codename', $codename)->first();
        $response = $this->get('api/missions/'.$mission->id);
        $response->assertStatus(200);
    }

    public function test_update_mission()
    {
        $codename =  $this->faker->words(2, true);
        $before = [
            'codename' => $codename,
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
        ];
        $response = $this->json('POST', route('missions.store'), $before);
        $mission = Mission::select()->where('codename', $codename)->first();
        $after = [
            'codename' => $this->faker->words(2, true),
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
        ];
        $response = $this->json('PUT', url('api/missions/'.$mission->id), $after);
        $response->assertStatus(200);
    }

    public function test_delete_operator()
    {
        $codename =  $this->faker->words(2, true);
        $data = [
            'codename' => $codename,
            'latitude' => $this->faker->latitude(),
            'longitude' => $this->faker->longitude(),
            'radius' => $this->faker->randomFloat(2,10000,1000000),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
        ];
        $response = $this->json('POST', route('missions.store'), $data);
        $mission = Mission::select()->where('codename', $codename)->first();
        $response = $this->delete('api/missions/'.$mission->id);
        $response->assertStatus(200);
    }
}
