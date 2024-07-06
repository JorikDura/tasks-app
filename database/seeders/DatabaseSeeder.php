<?php

namespace Database\Seeders;

use App\Models\Task;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        /*User::factory(10)
            ->create();*/

        Task::factory(10)
            ->hasComments(5)
            ->create();
    }
}
