<?php

namespace App\Livewire\Dashboard;

use App\Enums\TaskPriority;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class CompletedTasksChart extends Component
{
    public $labels;
    public $data;
    public $year;



    public function mount($year = null)
    {
        $this->year = $year ?? now()->format('Y'); // Defaults to the current year if no year is provided
        $this->loadData();
    }


    public function loadData()
    {
        // Query tasks grouped by both month and priority
        $tasksCompleted = Auth::user()->tasks()->select(
            DB::raw("strftime('%m', completed_date) AS month"), // Get numeric month
            'priority', // Include task priority
            DB::raw('COUNT(*) as count') // Count tasks
        )
            ->whereNotNull('completed_date') // Only completed tasks
            ->where(DB::raw("strftime('%Y', completed_date)"), $this->year) // Filter by the specified year
            ->groupBy('month', 'priority') // Group by both month and priority
            ->orderBy('month') // Order by month
            ->get();

        // Generate month labels and datasets for each priority
        $months = range(1, 12); // Ensure we include all months in the labels
        $monthNames = array_map(function ($month) {
            return date('F', mktime(0, 0, 0, $month, 10)); // Convert numeric month to name
        }, $months);
        $this->labels = $monthNames;

        // Initialize datasets for each priority
        $datasets = [
            TaskPriority::Low->value => array_fill(0, 12, 0),
            TaskPriority::Medium->value => array_fill(0, 12, 0),
            TaskPriority::High->value => array_fill(0, 12, 0),
        ];

        // Populate the datasets with counts for each priority and month
        foreach ($tasksCompleted as $task) {
            $monthIndex = (int) $task->month - 1; // Convert 1-based month to 0-based array index
            $datasets[$task->priority->value][$monthIndex] = $task->count;
        }

        // Assign the datasets to properties for the chart
        $this->data = [
            TaskPriority::Low->value => $datasets[TaskPriority::Low->value],
            TaskPriority::Medium->value => $datasets[TaskPriority::Medium->value],
            TaskPriority::High->value => $datasets[TaskPriority::High->value],
        ];
    }



    public function render()
    {

        return view('livewire.dashboard.completed-tasks-chart');
    }
}
