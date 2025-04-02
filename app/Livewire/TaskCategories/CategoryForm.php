<?php

namespace App\Livewire\TaskCategories;

use App\Models\TaskCategory;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CategoryForm extends Component
{
    public ?TaskCategory $category;
    public bool $isEditing = false;
    #[Rule('string|required|min:3|max:50')]
    public string $name = '';
    #[Rule('string|nullable|max:255')]
    public string $description = '';
    public bool $isOpen = false;

    public function mount(?TaskCategory $category = null)
    {
        if($category?->id){
            $this->category = $category;
            $this->isEditing = true;
            $this->name = $category->name;
            $this->description = $category->description;
        }
    }

    public function render()
    {
        return view('livewire.task-categories.category-form');
    }

    public function save()
    {
        $this->validate();
        if($this->isEditing){
            $this->category->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }else{
            Auth::user()->taskCategories()->create([
                'name' => $this->name,
                'description' => $this->description,
            ]);
        }
        $toastMessage = $this->isEditing ? 'Category updated !' : 'Category created !';
        $this->dispatch('showToast', $toastMessage);
        $this->dispatch('categoryUpdated');



        $this->resetForm();

    }

    public function resetForm()
    {
        $this->reset(['isOpen']);
        if(!$this->isEditing) {
            $this->reset(['category','name', 'description', 'isEditing']);
        }

    }
}
