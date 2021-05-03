<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' => 'Lista Negocios' ])
        @include('layouts.parciales.form-table-busqueda-nuevo')


        <div class="flex justify-center mx-auto my-5 border border-gray-300  overflow-hidden rounded">
            <table class="w-full">
                <thead
                    class="bg-indigo-500 text-white">
                    <tr>
                        <th class="py-2">Id</th>
                        <th class="py-2">Negocio</th>
                        <th class="py-2">Activo</th>
                        <th class="py-2">Editar</th>
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
                        <x-button-delete>Eliminar Negocio</x-button-delete>
                    </div>
                @endif
            </form>

        </x-form>

        <x-slot name="footer">
            <x-button-aceptar wire:click.prevent="update">Aceptar</x-button-aceptar>
        </x-slot>
    </x-modal>

    <x-modal trigger="viewModalDelete">
        @include('layouts.parciales.form-delete-confirm',
            ['titulo' => 'Eliminar',
            'mensaje_delete' => "Confirma eliminar el negocio '".$this->negocio_nombre."' ",
            ])
    </x-modal>

</div>
