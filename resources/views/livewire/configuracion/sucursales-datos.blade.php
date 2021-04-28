<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        <div class="text-center">
            <h1 class="uppercase font-extrabold">Lista Sucursales</h1>
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
                        <th>Empresa</th>
                        <th>Sucursales</th>
                        <th>Negocio</th>
                        <th>Casa Central</th>
                        <th>Activo</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($sucursales as $sucursal)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $sucursal->id}} </td>
                        <td class="py-1"> {{ $sucursal->empresa->empresa }} </td>
                        <td class="py-1"> {{ $sucursal->sucursal }} </td>
                        <td class="py-1"> {{ $sucursal->negocio->negocio }} </td>
                        <td class="py-1">
                                <div class="{{ ($sucursal->es_casa_matriz) ? 'text-green-500' : '' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($sucursal->es_casa_matriz) ? 'check' : '' }}"></x-simbolos>
                                </div>
                            </td>
                        <td class="py-1">
                                <div class="{{ ($sucursal->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($sucursal->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span> {{ ($sucursal->activo) ? 'Activo' : 'No activo' }} </span>
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
                        <x-button-delete>
                        	Eliminar Sucursal
                        </x-button-delete>
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
            <h1>Confirma elimnar la Sucursal?</h1>
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

