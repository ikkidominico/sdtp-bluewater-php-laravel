<?php

namespace Database\Seeders;

use App\Models\DroneMission;
use Illuminate\Database\Seeder;

class DroneMissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DroneMission::factory()->count(10)->create();
    }
}
