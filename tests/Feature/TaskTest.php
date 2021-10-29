<?php

namespace Tests\Feature;

use App\Models\Drone;
use App\Models\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use WithFaker;

    public function test_store_task() 
    {
        $data = [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'is_completed' => $this->faker->boolean(),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('tasks.store'), $data);
        $response->assertStatus(201);
    }

    public function test_get_tasks()
    {
        $response = $this->json('GET', route('tasks.index'));
        $response->assertStatus(200);
    }

    public function test_get_task()
    {
        $title = $this->faker->words(3, true);
        $data = [
            'title' => $title,
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'is_completed' => $this->faker->boolean(),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('tasks.store'), $data);
        $task = Task::select()->where('title', $title)->first();
        $response = $this->get('api/tasks/'.$task->id);
        $response->assertStatus(200);
    }

    public function test_update_task()
    {
        $title = $this->faker->words(3, true);
        $before = [
            'title' => $title,
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'is_completed' => $this->faker->boolean(),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('tasks.store'), $before);
        $task = Task::select()->where('title', $title)->first();
        $after = [
            'title' => $this->faker->words(3, true),
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'is_completed' => $this->faker->boolean(),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('PUT', url('api/tasks/'.$task->id), $after);
        $response->assertStatus(200);
    }

    public function test_delete_task()
    {
        $title = $this->faker->words(3, true);
        $before = [
            'title' => $title,
            'description' => $this->faker->words(15, true),
            'date' => $this->faker->numberBetween(1,12).'/'.$this->faker->numberBetween(1,28).'/'.$this->faker->numberBetween(1990,2030),
            'is_completed' => $this->faker->boolean(),
            'drone_id' => (string) Drone::inRandomOrder()->first()->id
        ];
        $response = $this->json('POST', route('tasks.store'), $before);
        $task = Task::select()->where('title', $title)->first();
        $response = $this->delete('api/tasks/'.$task->id);
        $response->assertStatus(200);
    }
}
