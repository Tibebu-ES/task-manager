<?php

namespace App\Livewire\Dashboard;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Dashboard extends Component
{
    public $year;
    public $completedTasksCount;
    public $completedTasksLowPriorityCount;
    public $completedTasksMediumPriorityCount;
    public $completedTasksHighPriorityCount;
    public $newTasksCount;
    public $newTasksLowPriorityCount;
    public $newTasksMediumPriorityCount;
    public $newTasksHighPriorityCount;

    public $inProgressTasksCount;
    public $inProgressTasksLowPriorityCount;
    public $inProgressTasksMediumPriorityCount;
    public $inProgressTasksHighPriorityCount;



    public function mount()
    {
        $this->year = now()->format('Y'); // Defaults to the current year



    }

    public function loadData()
    {
        // Query tasks completed grouped by  priority
        $tasksCompleted = Auth::user()->tasks()->select(
            'priority', // Include task priority
            DB::raw('COUNT(*) as count') // Count tasks
        )
            ->where('status', TaskStatus::Completed->value) // Only completed tasks
            ->where(DB::raw("strftime('%Y', completed_date)"), $this->year) // Filter by the specified year
            ->groupBy('priority') // Group by  priority
            ->get();

        $this->completedTasksCount = $tasksCompleted->sum('count');
        $this->completedTasksHighPriorityCount = $tasksCompleted->where('priority', TaskPriority::High->value)->sum('count');
        $this->completedTasksMediumPriorityCount = $tasksCompleted->where('priority', TaskPriority::Medium->value)->sum('count');
        $this->completedTasksLowPriorityCount = $tasksCompleted->where('priority', TaskPriority::Low->value)->sum('count');

        // Query tasks in progress grouped by  priority
        $tasksInProgress = Auth::user()->tasks()->select(
            'priority', // Include task priority
            DB::raw('COUNT(*) as count') // Count tasks
        )
            ->where('status', TaskStatus::InProgress->value) // Only completed tasks
            ->where(DB::raw("strftime('%Y', created_at)"), $this->year) // Filter by the specified year
            ->groupBy('priority') // Group by  priority
            ->get();

        $this->inProgressTasksCount = $tasksInProgress->sum('count');
        $this->inProgressTasksHighPriorityCount = $tasksInProgress->where('priority', TaskPriority::High->value)->sum('count');
        $this->inProgressTasksMediumPriorityCount = $tasksInProgress->where('priority', TaskPriority::Medium->value)->sum('count');
        $this->inProgressTasksLowPriorityCount = $tasksInProgress->where('priority', TaskPriority::Low->value)->sum('count');

        // Query new tasks  grouped by  priority
        $newTasks = Auth::user()->tasks()->select(
            'priority', // Include task priority
            DB::raw('COUNT(*) as count') // Count tasks
        )
            ->where('status', TaskStatus::New->value) // Only completed tasks
            ->where(DB::raw("strftime('%Y', created_at)"), $this->year) // Filter by the specified year
            ->groupBy('priority') // Group by  priority
            ->get();
        $this->newTasksCount = $newTasks->sum('count');
        $this->newTasksHighPriorityCount = $newTasks->where('priority', TaskPriority::High->value)->sum('count');
        $this->newTasksMediumPriorityCount = $newTasks->where('priority', TaskPriority::Medium->value)->sum('count');
        $this->newTasksLowPriorityCount = $newTasks->where('priority', TaskPriority::Low->value)->sum('count');


    }


    public function render()
    {
        $this->loadData();
        return view('livewire.dashboard.dashboard');
    }
}
