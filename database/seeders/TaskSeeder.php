<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\ModelTask;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ModelTask::factory(10)->create();
    }
}
