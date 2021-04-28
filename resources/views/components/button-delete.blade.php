<button wire:click.prevent="delete" {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 w-full border border-red-500 text-red-500 bg-red-50 hover:bg-red-200 justify-center']) }}>
	<span
    class="animate-spin"
    wire:loading wire:target="delete">&#9696;</span>
    <span wire:loading.remove wire:target="delete">{{ $slot }}</span>
</button>