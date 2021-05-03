<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' =>  "Lista Sucursales" ])
        @include('layouts.parciales.form-table-busqueda-nuevo')

        <div class="flex justify-center mx-auto my-5 border border-gray-300 rounded overflow-hidden">
            <table class="w-full">
                <thead
                    class="bg-indigo-500 text-white rounded">
                    <tr class="text-center">
                        <th class="py-2 hidden md:table-cell">
                            {{-- <span class="cursor-pointer" wire:click="newOrder('id')">Id</span> --}}
                            <x-table-head-cell-filter sort="id" sortSelect="{{ $sort }}">Id</x-table-head-cell-filter>
                        </th>
                        <th class="py-2 hidden md:table-cell ">
                            <x-table-head-cell-filter sort="empresa" sortSelect="{{ $sort }}">Empresa</x-table-head-cell-filter>
                            {{-- <span class="cursor-pointer" wire:click="newOrder('empresa')">Empresa</span> --}}</th>
                        <th class="py-2">
                            <x-table-head-cell-filter sort="sucursal" sortSelect="{{ $sort }}">Sucursales</x-table-head-cell-filter>
                            {{-- <span class="cursor-pointer" wire:click="newOrder('sucursal')">Sucursales</span> --}}</th>
                        <th class="py-2">
                            <x-table-head-cell-filter sort="negocio" sortSelect="{{ $sort }}">Negocio</x-table-head-cell-filter>
                            {{-- <span class="cursor-pointer" wire:click="newOrder('negocio')">Negocio</span> --}}
                        </th>
                        <th class="py-2 hidden md:table-cell ">Casa Central</th>
                        <th class="py-2">
                            <x-table-head-cell-filter sort="activo" sortSelect="{{ $sort }}">Activo</x-table-head-cell-filter>
                            {{-- <span class="cursor-pointer" wire:click="newOrder('activo')">Activo</span> --}}
                        </th>
                        <th class="py-2">Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($sucursales as $sucursal)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1 hidden md:table-cell "> {{ $sucursal->id }} </td>
                        <td class="py-1 hidden md:table-cell "> {{ $sucursal->empresa }} </td>
                        <td class="py-1"> {{ $sucursal->sucursal }} </td>
                        <td class="py-1"> {{ $sucursal->negocio }} </td>
                        <td class="py-1 hidden md:table-cell ">
                                <div class="{{ ($sucursal->es_casa_matriz) ? 'text-green-500' : '' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($sucursal->es_casa_matriz) ? 'check' : '' }}"></x-simbolos>
                                </div>
                            </td>
                        <td class="py-1">
                                <div class="{{ ($sucursal->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl"  nombre="{{ ($sucursal->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span class="hidden md:table-cell "> {{ ($sucursal->activo) ? 'Activo' : 'No activo' }} </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <x-simbolos
                                nombre="editar" class="text-2xl cursor-pointer hover:text-blue-500"
                                wire:click="edit({{ $sucursal->id }})">
                                </x-simbolos>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $sucursales->links() }}
    </div>


    <x-modal trigger="viewModal">
        <x-slot name="titulo">
            <h1 class="uppercase">{{ $accion == 1 ? 'Nueva ' : 'Editar ' }} Sucursal</h1>
        </x-slot>
        <x-form>
            <form action="" wire:submit.prevent="update" style="min-width: 350px;">
                <div>
                    <x-label>Empresa</x-label>
                    <x-select class="w-full" wire:model.defer="empresa_id" :error="$errors->first('empresa_id')">
                		<option value=""></option>
                    	@foreach ($empresas as $empresa)
                    		<option value="{{ $empresa->id }}" {{ $empresa->id == $empresa_id ? 'selected' : '' }} >{{ $empresa->empresa }}</option>
                    	@endforeach
                    </x-select>
                </div>
                <div>
                    <x-label>Negocio</x-label>
                    <x-select class="w-full" wire:model.defer="negocio_id" :error="$errors->first('negocio_id')">
                		<option value=""></option>
                    	@foreach ($negocios as $negocio)
                    		<option value="{{ $negocio->id }}" {{ $negocio->id == $negocio_id ? 'selected' : '' }} >{{ $negocio->negocio }}</option>
                    	@endforeach
                    </x-select>
                </div>
                <div>
                    <x-label>Sucursal</x-label>
                    <x-input type="text" class="block mt-1 w-full" wire:model.defer="sucursal_nombre" :error="$errors->first('sucursal_nombre')"></x-input>
                </div>

                <div class="flex justify-center items-center">
	                <div class="w-2/4 flex items-center mt-2">
	                    <div class="{{ ($activo) ? 'text-green-500' : 'text-red-500' }} flex items-center">
	                        <x-simbolos nombre="{{ ($activo) ? 'check' : 'nocheck' }}" class="text-2xl"></x-simbolos>
	                        <label for="activo"> {{ ($activo) ? 'Activo' : 'No activo' }} </label>
	                    </div>
	                    <x-input type="checkbox" id="activo"  class="my-3 ml-3" wire:model="activo"></x-input>
	                </div>
	               	<div class="w-2/4 flex  items-center mt-2">
	                    <div class="{{ ($es_casa_matriz) ? 'text-green-500' : 'text-red-500' }} flex items-center">
	                        <x-simbolos nombre="{{ ($es_casa_matriz) ? 'check' : 'nocheck' }}" class="text-2xl"></x-simbolos>
	                        <label for="es_casa_matriz"> {{ ($es_casa_matriz) ? 'Es Casa Matriz' : 'No Casa Matriz' }} </label for="es_casa_matriz">
	                    </div>
	                    <x-input type="checkbox" id="es_casa_matriz" class="my-3 ml-3" wire:model="es_casa_matriz"></x-input>
	                </div>
                </div>
                @if ($accion == 2)
                    <div class="w-full py-3">
                        <x-button-delete>Eliminar Sucursal</x-button-delete>
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
            'mensaje_delete' => "Confirma eliminar la sucursal '".$this->sucursal_nombre."' ",
            ])
    </x-modal>

</div>

