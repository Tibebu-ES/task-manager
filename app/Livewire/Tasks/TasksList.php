<?php

namespace App\Livewire\Tasks;

use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TasksList extends Component
{
    use WithPagination;
    public $sortField = "due_date"; // default sorting field
    public $sortDirection = "asc"; // default sorting direction
    public $priorityFilter = '';     // Stores the selected priority filter (empty for no filter)
    public $statusFilter = '';     // Stores the selected status filter (empty for no filter)

    public $numOfFiltersApplied = 0;

    protected $listeners = ['taskUpdated' => '$refresh'];

    public function sortBy($field){
        if($this->sortField === $field){
            $this->sortDirection = $this->sortDirection === "asc" ? "desc" : "asc"; //toggle
        }else{
            $this->sortField = $field;
            $this->sortDirection = "asc";
        }
    }

    public function delete(Task $task)
    {
        $task->delete();
        $this->dispatch('showToast', 'Task deleted !');
    }

    public function countAppliedFilters()
    {
        $filters = 0;
        if($this->priorityFilter !== ''){
            $filters ++;
        }
        if($this->statusFilter !== ''){
            $filters++;
        }
        $this->numOfFiltersApplied = $filters;

    }

    #[Title('Tasks')]
    public function render()
    {
        $tasksQuery = Auth::user()->tasks(); // Get tasks belonging to the logged-in user

        // Apply priority filter if selected
        $tasksQuery->when($this->priorityFilter, function ($query, $priorityFilter) {
            return $query->where('priority', $priorityFilter);
        });
        // Apply status filter if selected
        $tasksQuery->when($this->statusFilter, function ($query, $status) {
            $query->where('status', $status);
        });


        // Apply sorting and pagination
        $tasks = $tasksQuery->orderBy($this->sortField, $this->sortDirection)
            ->with('taskCategory')
            ->paginate(10);

        $this->resetPage();//reset back to page 1 after filtering and sorting

        //count num of filters applied
        $this->countAppliedFilters();

        return view('livewire.tasks.tasks-list',[
            'tasks' => $tasks
        ]);
    }


}
