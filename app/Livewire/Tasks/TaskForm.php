<?php

namespace App\Livewire\Tasks;

use App\Enums\TaskPriority;
use App\Enums\TaskStatus;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class TaskForm extends Component
{
    public ?Task $task = null; //stores the task if editing otherwise null
    public $isEditing = false;
    public $title;
    public $description;
    public $status = TaskStatus::New->value; //default status
    public $priority = TaskPriority::Low->value; //default priority
    public $due_date;
    public $task_category_id;
    public $showModal = false; // controls the modal visibility

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string|max:50000',
        'status' => 'required|in:new,in_progress,completed',
        'priority' => 'required|in:low,medium,high',
        'due_date' => 'required|date|after:today',
        'task_category_id' => 'nullable|exists:task_categories,id',
    ];

    public function mount(?Task $task = null): void
    {
        if($task?->id) {
            $this->task = $task;
            $this->title = $task->title;
            $this->description = $task->description;
            $this->status = $task->status;
            $this->priority = $task->priority;
            $this->due_date = $task->due_date?->format('Y-m-d');
            $this->isEditing = (bool)$task->id;
            $this->task_category_id = $task->taskCategory?->id;
        }
    }

    public function saveTask(): void
    {
        $this->validate();
        if($this->isEditing) {
            //updating an existing task
            $this->task->update([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'due_date' => $this->due_date,
                'task_category_id' => $this->task_category_id,
            ]);
        }else{
            //creating a new task
            Auth::user()->tasks()->create([
                'title' => $this->title,
                'description' => $this->description,
                'status' => $this->status,
                'priority' => $this->priority,
                'due_date' => $this->due_date,
                'task_category_id' => $this->task_category_id,
            ]);
        }
        $this->dispatch('taskUpdated'); // Notify other components
        $this->resetForm();


    }

    public function resetForm()
    {
        if($this->isEditing) {
            $this->reset(['showModal']);
        }else{
            $this->reset(['task','title', 'description', 'status', 'priority', 'due_date', 'showModal', 'isEditing', 'task_category_id']);
        }

    }


    public function render()
    {
        return view('livewire.tasks.task-form',[
            'categories' => Auth::user()->taskCategories()->get(),
        ]);
    }
}
