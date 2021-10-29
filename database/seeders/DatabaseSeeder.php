<?php

namespace Database\Seeders;

use App\Models\Drone;
use App\Models\DroneMission;
use App\Models\Mission;
use App\Models\Operator;
use App\Models\Repair;
use App\Models\Task;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Operator::factory()->count(10)->create();
        Drone::factory()->count(10)->create();
        Repair::factory()->count(10)->create();
        Task::factory()->count(10)->create();
        Mission::factory()->count(10)->create();
        DroneMission::factory()->count(10)->create();
    }
}
