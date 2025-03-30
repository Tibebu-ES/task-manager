<div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="flex items-center justify-between gap-4 p-4">
            <h1 class="text-3xl font-bold text-gray-900 dark:text-gray-100">Dashboard</h1>
            <div>
                <flux:select  wire:change="$refresh" wire:model="year"  >
                    <flux:select.option value="{{ now()->format('Y') }}">{{ now()->format('Y') }}</flux:select.option>
                    <flux:select.option value="{{ now()->subYear()->format('Y') }}">{{ now()->subYear()->format('Y') }}</flux:select.option>
                    <flux:select.option value="{{ now()->subYear(2)->format('Y') }}">{{ now()->subYear(2)->format('Y') }}</flux:select.option>
                </flux:select>
            </div>
        </div>
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            <!-- First Rectangle: New Tasks -->
            <div class="relative aspect-video flex items-center justify-center gap-4 flex-col rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">New</h2>
                    <p class="text-8xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">{{ $newTasksCount }}</p>
                </div>
                <div class="flex gap-2 mt-4">
                    <flux:badge color="green">Low: {{$newTasksLowPriorityCount}}</flux:badge>
                    <flux:badge color="yellow">Medium: {{$newTasksMediumPriorityCount}}</flux:badge>
                    <flux:badge color="red">High: {{$newTasksHighPriorityCount}}</flux:badge>
                </div>
            </div>

            <!-- Second Rectangle: In progress Tasks -->
            <div class="relative aspect-video flex items-center justify-center gap-2 flex-col rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">In Progress</h2>
                    <p class="text-8xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">{{ $inProgressTasksCount }}</p>
                </div>
                <div class="flex gap-2 mt-4">
                    <flux:badge color="green">Low: {{$inProgressTasksLowPriorityCount}}</flux:badge>
                    <flux:badge color="yellow">Medium: {{$inProgressTasksMediumPriorityCount}}</flux:badge>
                    <flux:badge color="red">High: {{$inProgressTasksHighPriorityCount}}</flux:badge>
                </div>
            </div>

            <!-- Third Rectangle: Completed Tasks -->
            <div class="relative aspect-video flex items-center justify-center gap-4 flex-col rounded-xl border border-neutral-200 dark:border-neutral-700 bg-white dark:bg-neutral-800">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                <div class="text-center">
                    <h2 class="text-2xl font-bold text-gray-900 dark:text-gray-100">Completed</h2>
                    <p class="text-8xl font-extrabold text-blue-600 dark:text-blue-400 mt-2">{{ $completedTasksCount }}</p>
                </div>
                <div class="flex gap-2 mt-4">
                    <flux:badge color="green">Low: {{$completedTasksLowPriorityCount}}</flux:badge>
                    <flux:badge color="yellow">Medium: {{$completedTasksMediumPriorityCount}}</flux:badge>
                    <flux:badge color="red">High: {{$completedTasksHighPriorityCount}}</flux:badge>
                </div>
            </div>
        </div>
        {{-- show statistics data using charts--}}
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700 ">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            <livewire:dashboard.completed-tasks-chart :key="$year" :year="$year"/>
        </div>
    </div>

@script
<script>
    $wire.on('log-data', event => {
        console.log('Livewire Data:', event.data);
    });
</script>
@endscript

