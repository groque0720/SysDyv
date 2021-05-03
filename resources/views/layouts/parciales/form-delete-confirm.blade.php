<x-slot name="titulo">
    <h1 class="uppercase"> {{ isset($titulo) ? $titulo : '' }}</h1>
</x-slot>
<x-form class="p-20">
    <h1>{{ isset($mensaje_delete) ? $mensaje_delete : '' }}?</h1>
</x-form>
<x-slot name="footer">
    <x-button
        wire:click.prevent="confirmDelete"
        class="border border-red-500 text-red-500 bg-red-50 hover:bg-red-200 ">
            <span
                class="animate-spin mr-5"
                wire:loading wire:target="confirmDelete">
                    <x-simbolos nombre="procesando" class="text-sm"></x-simbolos></span>
            <span
                class="animate-pulse"
                wire:loading wire:target="confirmDelete">Procesando...</span>

            <span wire:loading.remove wire:target="confirmDelete">{{ isset($leyenda_boton) ? $leyenda_boton : 'Si, Eliminar' }}</span>
        </x-button>
</x-slot>