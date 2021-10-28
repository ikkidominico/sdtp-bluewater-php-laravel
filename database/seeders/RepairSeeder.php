<?php

namespace Database\Seeders;

use App\Models\Repair;
use Illuminate\Database\Seeder;

class RepairSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Repair::factory()->count(10)->create();
    }
}
