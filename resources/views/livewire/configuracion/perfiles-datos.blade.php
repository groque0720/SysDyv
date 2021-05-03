<div
	x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }">
    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' =>  "Lista Perfiles" ])
        @include('layouts.parciales.form-table-busqueda-nuevo')

        <div class="flex justify-center mx-auto mb-5 border rounded overflow-hidden">
            <table class="w-full">
                <thead
                    class="bg-indigo-500 text-white rounded">
                    <tr>
                        <th class="py-2">Id</th>
                        <th class="py-2">Perfil</th>
                        <th class="py-2">Aplicaciones</th>
                        <th class="py-2">Activo</th>
                        <th class="py-2">Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($perfiles as $perfil)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $perfil->id}} </td>
                        <td class="py-1"> {{ $perfil->perfil }} </td>
                        <td class="py-1 text-indigo-500"> <a href="{{ route('perfiles.aplicaciones', $perfil->perfil ) }}"><x-simbolos nombre="search"/> Aplicaciones</a></td>
                        <td class="py-1">
                                <div class="{{ ($perfil->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($perfil->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span> {{ ($perfil->activo) ? 'Activo' : 'No activo' }} </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <x-simbolos
                                nombre="editar" class="text-2xl cursor-pointer hover:text-blue-500"
                                wire:click="edit({{ $perfil->id }})">
                                </x-simbolos>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $perfiles->links() }}
    </div>

    <x-modal trigger="viewModal">
        <x-slot name="titulo">
            <h1 class="uppercase">{{ $accion == 1 ? 'Nueva ' : 'Editar ' }} Perfil</h1>
        </x-slot>
        <x-form>
            <form action="" wire:submit.prevent="update" style="min-width: 350px;">
                <div>
                    <x-label>Perfil</x-label>
                    <x-input type="text" class="block mt-1 w-full" wire:model.defer="perfil_nombre" :error="$errors->first('perfil_nombre')"></x-input>
                </div>

                <div class="flex justify-end items-center">
	                <div class="w-2/4 flex items-center justify-end mt-2">
	                    <div class="{{ ($activo) ? 'text-green-500' : 'text-red-500' }} flex items-center">
	                        <x-simbolos nombre="{{ ($activo) ? 'check' : 'nocheck' }}" class="text-2xl"></x-simbolos>
	                        <label for="activo"> {{ ($activo) ? 'Activo' : 'No activo' }} </label>
	                    </div>
	                    <x-input type="checkbox" id="activo"  class="my-3 ml-3" wire:model="activo"></x-input>
	                </div>
                </div>
                @if ($accion == 2)
                    <div class="w-full py-3">
                        <x-button-delete>Eliminar Perfil</x-button-delete>
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
            'mensaje_delete' => "Confirma eliminar el perfil '".$this->perfil_nombre."' ",
            ])
    </x-modal>

</div>
