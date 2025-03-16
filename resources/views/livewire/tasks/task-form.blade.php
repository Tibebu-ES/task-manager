@php use App\Enums\TaskPriority;use App\Enums\TaskStatus; @endphp
<div xmlns:flux="http://www.w3.org/1999/html">
    <flux:button
        wire:click="$set('showModal',true)"
        icon="{{$isEditing ? 'pencil':''}}"
        variant="primary"
        size="{{$isEditing ? 'xs' : 'sm'}}"
    >
        {{ $isEditing ? '' : 'Add a Task' }}
    </flux:button>
    <flux:modal wire:model.self="showModal" class="md:w-auto" >
        <!-- ... -->
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{$isEditing ? 'Update A Task' : 'Add a Task' }} </flux:heading>
            </div>

            <flux:field>
                <flux:label>Title</flux:label>

                <flux:input wire:model="title"/>

                <flux:error name="title"/>
            </flux:field>

            <flux:select wire:model="status" label="Status">
                @foreach(TaskStatus::cases() as $option)
                    <flux:select.option value="{{$option}}">{{$option->label()}}</flux:select.option>
                @endforeach
                <flux:error name="status"/>
            </flux:select>

            <flux:select wire:model="priority" label="Priority">
                @foreach(TaskPriority::cases() as $option)
                    <flux:select.option value="{{$option}}">{{$option->label()}}</flux:select.option>
                @endforeach
                <flux:error name="priority"/>
            </flux:select>

            <flux:field>
                <flux:label>Due date</flux:label>

                <flux:input wire:model="due_date" type="date"/>

                <flux:error name="due_date"/>
            </flux:field>

            <flux:textarea wire:model="description" rows="6" label="Description">
                <flux:error name="description"/>
            </flux:textarea>


            <div class="flex gap-2">
                <flux:spacer/>

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="saveTask" variant="primary">{{$isEditing ? 'Save changes' : 'Add' }}</flux:button>
            </div>
        </div>

    </flux:modal>
</div>
