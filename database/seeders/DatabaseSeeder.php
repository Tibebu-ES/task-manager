<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\TaskCategory;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()
            ->has(Task::factory()->count(30))
            ->has(TaskCategory::factory()->count(5))
            ->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
