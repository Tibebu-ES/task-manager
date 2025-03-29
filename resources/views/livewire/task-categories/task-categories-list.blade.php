<div>
    <h2 class="text-xl font-bold mb-4">Categories </h2>

    {{--Add Category --}}
    <div class="mb-6">
        <livewire:task-categories.category-form />
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-accent  text-accent-foreground">
            <th class="border border-gray-300 px-4 py-2">Name</th>
            <th class="border border-gray-300 px-4 py-2">Tasks</th>
            <th class="border border-gray-300 px-4 py-2">Description</th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($categories as $category)
            <tr wire:key="{{$category->id }}">
                <td class="border border-gray-300 px-4 py-2">{{ $category->name }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ count($category->tasks) }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $category->description }}</td>



                {{--actions--}}
                <td class="border border-gray-300 px-4 py-2">
                    <span class="flex justify-center gap-2">
                        {{--Edit Modal--}}
                        <livewire:task-categories.category-form  :category="$category" :key="$category->id" />

                        {{--delet modal--}}
                        <flux:modal.trigger :name="'delete-category-'.$category->id">
                            <flux:button size="xs" icon="trash" variant="danger"></flux:button>
                        </flux:modal.trigger>
                        <flux:modal :name="'delete-category-'.$category->id" class="md:w-auto">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <flux:heading size="lg">Delete Category</flux:heading>
                                    <flux:heading>Are you sure you want to delete the Category?</flux:heading>
                                </div>



                                <div class="flex gap-2">
                                    <flux:spacer />

                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancel</flux:button>
                                    </flux:modal.close>

                                    <flux:button wire:click="delete({{$category}})" variant="danger"> Delete </flux:button>
                                </div>
                            </div>
                        </flux:modal>


                    </span>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="mt-4">
        {{ $categories->links() }} <!-- This generates the pagination controls -->
    </div>
</div>
