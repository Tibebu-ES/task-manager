@php use App\Enums\TaskPriority;use App\Enums\TaskStatus; @endphp
<div>
    <h2 class="text-xl font-bold mb-4">Tasks </h2>

    {{--Add Task --}}
    <livewire:tasks.task-form />

    {{--Filters--}}
    <div class="mb-4 flex gap-4 justify-end">
        <div class="self-end">
            <flux:badge  icon="funnel" icon-variant="outline">{{$numOfFiltersApplied}}</flux:badge>
            {{--<flux:icon.funnel />--}}
        </div>
        <!-- Priority Filter Dropdown -->
        <div >
            <label for="priorityFilter" class="font-semibold">Priority: </label>
            <select wire:model="priorityFilter" wire:change="$refresh" id="priorityFilter"
                    class="border rounded-md px-2 py-1">
                <option value="">All</option>
                @foreach(TaskPriority::cases() as $taskPriority)
                    <option value="{{$taskPriority->value}}">{{$taskPriority->label()}}</option>
                @endforeach
            </select>
        </div>
        <!-- Status Filter Dropdown -->
        <div >
            <label for="statusFilter" class="font-semibold">Status: </label>
            <select wire:model="statusFilter" wire:change="$refresh" id="statusFilter" class="border rounded-md px-2 py-1">
                <option value="">All</option>
                @foreach(TaskStatus::cases() as $taskStatus)
                    <option value="{{$taskStatus->value}}">{{$taskStatus->label()}}</option>
                @endforeach
            </select>
        </div>
    </div>

    <table class="w-full border-collapse border border-gray-300">
        <thead>
        <tr class="bg-gray-200">
            <th class="border border-gray-300 px-4 py-2">Title</th>
            <th class="border border-gray-300 px-4 py-2">Status</th>
            <th class="border border-gray-300 px-4 py-2">Priority</th>
            <!-- Sortable Due Date Column -->
            <th class="border border-gray-300 px-4 py-2 cursor-pointer" wire:click="sortBy('due_date')">
                Due Date
                @if ($sortField == 'due_date')
                    @if ($sortDirection == 'asc')
                        <span>&#x2191;</span> <!-- Ascending arrow -->
                    @else
                        <span>&#x2193;</span> <!-- Descending arrow -->
                    @endif
                @endif
            </th>
            <th class="border border-gray-300 px-4 py-2">Actions</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($tasks as $task)
            <tr wire:key="{{$task->id }}">
                <td class="border border-gray-300 px-4 py-2">{{ $task->title }}</td>
                <td class="border border-gray-300 px-4 py-2">{{ $task->status->label()}}</td>

                <!-- Priority Column with Conditional Styling -->
                <td class="border border-gray-300 px-4 py-2">
                        <span class="
                            @if($task->priority == TaskPriority::Low) bg-green-200 text-green-800 @endif
                            @if($task->priority == TaskPriority::Medium) bg-yellow-200 text-yellow-800 @endif
                            @if($task->priority == TaskPriority::High) bg-red-200 text-red-800 @endif
                            px-2 py-1 rounded-full">
                            {{ $task->priority->label() }}
                        </span>
                </td>

                <td class="border border-gray-300 px-4 py-2">{{ $task->due_date->format('Y-m-d') }}</td>

                {{--actions--}}
                <td class="border border-gray-300 px-4 py-2">
                    <span class="flex justify-center gap-2">
                        {{--Edit Modal--}}
                        <livewire:tasks.task-form :task="$task" :key="$task->id"/>

                        {{--delet modal--}}
                        <flux:modal.trigger :name="'delete-task-'.$task->id">
                            <flux:button size="xs" icon="trash" variant="danger"></flux:button>
                        </flux:modal.trigger>
                        <flux:modal :name="'delete-task-'.$task->id" class="md:w-auto">
                            <div class="space-y-6">
                                <div class="space-y-2">
                                    <flux:heading size="lg">Delete Task</flux:heading>
                                    <flux:heading>Are you sure you want to delete the Task?</flux:heading>
                                </div>



                                <div class="flex gap-2">
                                    <flux:spacer />

                                    <flux:modal.close>
                                        <flux:button variant="ghost">Cancel</flux:button>
                                    </flux:modal.close>

                                    <flux:button wire:click="delete({{$task}})" variant="danger"> Delete </flux:button>
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
        {{ $tasks->links() }} <!-- This generates the pagination controls -->
    </div>
</div>
