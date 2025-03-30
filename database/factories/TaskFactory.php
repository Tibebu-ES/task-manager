<?php

namespace Database\Factories;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\TaskCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = $this->faker->randomElement(TaskStatus::values());
        if ($status === TaskStatus::Completed->value) {
            $dueDate = $this->faker->dateTimeBetween('-1 year', 'now');
        }else{
            $dueDate = $this->faker->dateTimeBetween('+10 day', '+1 year');
        }

        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => $status,
            'priority' => $this->faker->randomElement(TaskPriority::values()),
            'due_date' => $dueDate,
            'completed_date' => $status === TaskStatus::Completed->value ? (clone $dueDate)->modify('-1 day') : null,
        ];
    }
}
