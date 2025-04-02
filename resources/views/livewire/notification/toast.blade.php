<div x-data="{ show: @entangle('show'), type: @entangle('type') }"
     x-show="show"
     x-transition
     class="fixed top-5 right-5 p-4 rounded-lg shadow-lg text-white"
     x-bind:class="{
        'bg-green-500': type === 'success',
        'bg-red-500': type === 'error',
        'bg-blue-500': type === 'info'
     }"
     x-init="$watch('show', value => {
         if (value) setTimeout(() => show = false, 3000);
     })">
    <p x-text="@js($message)"></p>
</div>



