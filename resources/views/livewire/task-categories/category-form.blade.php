<div>
    <flux:button
        wire:click="$set('isOpen',true)"
        icon="{{$isEditing ? 'pencil':''}}"
        variant="primary"
        size="{{$isEditing ? 'xs' : 'sm'}}"
    >
        {{ $isEditing ? '' : 'Add a Category' }}
    </flux:button>
    <flux:modal wire:model.self="isOpen" class="md:w-auto">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">{{$isEditing ? 'Update' : 'Add' }} a Category </flux:heading>
            </div>

            <flux:field>
                <flux:label>Name</flux:label>

                <flux:input wire:model="name"/>

                <flux:error name="name"/>
            </flux:field>

            <flux:textarea wire:model="description" rows="6" label="Description">
                <flux:error name="description"/>
            </flux:textarea>


            <div class="flex gap-2">
                <flux:spacer/>

                <flux:modal.close>
                    <flux:button variant="ghost">Cancel</flux:button>
                </flux:modal.close>

                <flux:button wire:click="save" variant="primary">{{$isEditing ? 'Save changes' : 'Add' }}</flux:button>
            </div>
        </div>
    </flux:modal>
</div>
