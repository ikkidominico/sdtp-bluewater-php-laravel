<?php

namespace Tests\Feature;

use App\Models\Drone;
use App\Models\Mission;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DroneMissionTest extends TestCase
{
    use WithFaker;

    public function test_attach_drone_mission() 
    {
        $data = [
            'drone_id' => (string) Drone::inRandomOrder()->first()->id,
            'mission_id' => (string) Mission::inRandomOrder()->first()->id,
        ];
        $response = $this->json('POST', route('attach.drone.mission'), $data);
        $response->assertStatus(201);
    }
}
