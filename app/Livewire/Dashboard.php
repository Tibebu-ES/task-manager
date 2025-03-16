<?php

namespace App\Livewire;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Dashboard extends Component
{
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
        $this->completedTasksLowPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::Completed)->where('priority',TaskPriority::Low)->count();
        $this->completedTasksMediumPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::Completed)->where('priority',TaskPriority::Medium)->count();
        $this->completedTasksHighPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::Completed)->where('priority',TaskPriority::High)->count();
        $this->completedTasksCount = $this->completedTasksLowPriorityCount + $this->completedTasksMediumPriorityCount + $this->completedTasksHighPriorityCount;

        $this->newTasksLowPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::New)->where('priority',TaskPriority::Low)->count();
        $this->newTasksMediumPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::New)->where('priority',TaskPriority::Medium)->count();
        $this->newTasksHighPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::New)->where('priority',TaskPriority::High)->count();
        $this->newTasksCount = $this->newTasksLowPriorityCount + $this->newTasksMediumPriorityCount + $this->newTasksHighPriorityCount;

        $this->inProgressTasksLowPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::InProgress)->where('priority',TaskPriority::Low)->count();
        $this->inProgressTasksMediumPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::InProgress)->where('priority',TaskPriority::Medium)->count();
        $this->inProgressTasksHighPriorityCount = Auth::user()->tasks()->where('status', TaskStatus::InProgress)->where('priority',TaskPriority::High)->count();

        $this->inProgressTasksCount = $this->inProgressTasksLowPriorityCount + $this->inProgressTasksMediumPriorityCount + $this->inProgressTasksHighPriorityCount;

    }

    public function render()
    {
        return view('livewire.dashboard');
    }
}
