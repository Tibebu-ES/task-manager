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
        // Create a single user
        $user = User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create 30 tasks for the user
        $tasks = Task::factory()->count(30)->create(['user_id' => $user->id]);

        //create 5 task categories for the user
        $categories = TaskCategory::factory()->count(5)->create(['user_id' => $user->id]);

        // Randomly assign some tasks to categories and leave some uncategorized
        foreach ($tasks as $task) {
            if (rand(0,1)) { //50 % chance to assign a category
                $task->task_category_id = $categories->random()->id;
                $task->save();
            }
        }
    }
}
