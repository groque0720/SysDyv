<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        <div class="text-center">
            <h1 class="uppercase font-extrabold">Lista Negocios</h1>
        </div>

        <div class="flex items-center justify-between my-5">
            <div class="text-black bg-white flex items-center justify-center">
              <div class="border rounded overflow-hidden flex">
                <button class="flex items-center justify-center px-4 border-l">
                  <x-simbolos class="text-sm text-gray-500" nombre="search" />
                </button>
                <input type="search" wire:model="search" class="px-4 py-1 border-none focus:border-transparent" placeholder="Buscar...">
              </div>
            </div>
            <div class="">
                <x-button class="bg-indigo-600" wire:click="create()">
                    <x-simbolos nombre="plus-circle" />
                </x-button>
            </div>
        </div>

        <div class="flex justify-center mx-auto mb-5">
            <table class="w-full">
                <thead
                    class="border-b-2 border-gray-300 text-indigo-600">
                    <tr>
                        <th>Id</th>
                        <th>Negocio</th>
                        <th>Activo</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($negocios as $negocio)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $negocio->id}} </td>
                        <td class="py-1"> {{ $negocio->negocio }} </td>
                        <td class="py-1">
                                <div class="{{ ($negocio->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($negocio->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span> {{ ($negocio->activo) ? 'Activo' : 'No activo' }} </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <x-simbolos
                                nombre="editar" class="text-2xl cursor-pointer hover:text-blue-500"
                                wire:click="edit({{ $negocio->id }})">
                                </x-simbolos>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $negocios->links() }}
    </div>



    <x-modal trigger="viewModal">
        <x-slot name="titulo">
            <h1 class="uppercase">{{ $accion == 1 ? 'Nuevo ' : 'Editar ' }} Negocio</h1>
        </x-slot>
        <x-form>
            <form action="" wire:submit.prevent="update" style="min-width: 350px;">
                <div>
                    <x-label>Nombre</x-label>
                    <x-input type="text" class="block mt-1 w-full" wire:model.defer="negocio_nombre" :error="$errors->first('negocio_nombre')"></x-input>
                </div>
                <div class="flex justify-between items-center mt-2">
                    <div class="{{ ($activo) ? 'text-green-500' : 'text-red-500' }} flex items-center">
                        <x-simbolos nombre="{{ ($activo) ? 'check' : 'nocheck' }}" class="text-2xl"></x-simbolos>
                        <span> {{ ($activo) ? 'Activo' : 'No activo' }} </span>
                    </div>
                    <x-input type="checkbox" class="my-3" wire:model="activo"></x-input>
                </div>
                @if ($accion == 2)
                    <div class="w-full py-3">
                        <x-button
                            wire:click.prevent="delete"
                            class="w-full border border-red-500 text-red-500 bg-red-50 hover:bg-red-200 justify-center">
                            <span
                            class="animate-spin"
                            wire:loading wire:target="delete">&#9696;</span>
                            <span wire:loading.remove wire:target="delete">Eliminar Negocio</span>
                        </x-button>
                    </div>
                @endif
            </form>
        </x-form>

        <x-slot name="footer">
            {{-- <x-button class="bg-indigo-600" wire:click="update()">Aceptar</x-button> --}}
            <x-button
                wire:click.prevent="update"
                class="border border-green-500 text-green-500 bg-green-50 hover:bg-green-200 ">
                    <span
                        class="animate-spin mr-5"
                        wire:loading wire:target="update">
                            &#9696</span>
                    <span
                        class="animate-pulse"
                        wire:loading wire:target="update">Procesando...</span>

                    <span wire:loading.remove wire:target="update">Aceptar</span>
                </x-button>
        </x-slot>
    </x-modal>

    <x-modal trigger="viewModalDelete">
        <x-slot name="titulo">
            <h1 class="uppercase">Eliminar</h1>
        </x-slot>
        <x-form class="p-20">
            <h1>Confirma elimnar el Negocio?</h1>
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

                    <span wire:loading.remove wire:target="confirmDelete">Si, Eliminar</span>
                </x-button>
        </x-slot>
    </x-modal>

</div>
