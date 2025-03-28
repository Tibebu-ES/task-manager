<?php

namespace App\Livewire\TaskCategories;

use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Title;
use Livewire\Component;

class TaskCategoriesList extends Component
{

    protected $listeners = ['categoryUpdated' => '$refresh'];

    public function render()
    {
        return view('livewire.task-categories.task-categories-list',[
            'categories' => Auth::user()->taskCategories()->orderBy('created_at','desc')->paginate(10)
        ]);
    }

    #[Title('Categories')]
    public function delete(TaskCategory $category)
    {
        $category->delete();
    }
}
