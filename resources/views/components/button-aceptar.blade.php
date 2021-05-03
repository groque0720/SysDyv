<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150 border border-green-500 text-green-500 bg-green-50 hover:bg-green-200 ']) }}>
        <span
        class="animate-spin mr-5"
        wire:loading wire:target="update">
            &#9696</span>
    	<span
        class="animate-pulse"
        wire:loading wire:target="update">Procesando...</span>

    <span wire:loading.remove wire:target="update">{{ $slot ?? 'Aceptar' }}</span>
</button>
