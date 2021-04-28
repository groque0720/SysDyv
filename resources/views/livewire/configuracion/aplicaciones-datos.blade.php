<div
	x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >
    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

	    <div class="text-center">
	        <h1 class="uppercase font-extrabold">Lista Aplicaciones</h1>
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
                        <th>Aplicacion</th>
                        <th>Icono</th>
                        <th>Nombre Ruta</th>
                        <th>Activo</th>
                        <th>Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($aplicaciones as $aplicacion)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $aplicacion->id}} </td>
                        <td class="py-1"> {{ $aplicacion->aplicacion }} </td>
                        <td class="py-1">
	                        	<div class="flex items-center justify-center">
	                        		<img class="w-10 h-10" src="{{ Storage::url( $aplicacion->icono ) }}" alt="">
	                        	</div>
                        	</td>
                        <td class="py-1"> <a href="{{ route($aplicacion->nombre_ruta) }}">{{ $aplicacion->nombre_ruta }}</a> </td>
                        <td class="py-1">
                                <div class="{{ ($aplicacion->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($aplicacion->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span> {{ ($aplicacion->activo) ? 'Activo' : 'No activo' }} </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <x-simbolos
                                nombre="editar" class="text-2xl cursor-pointer hover:text-blue-500"
                                wire:click="edit({{ $aplicacion->id }})">
                                </x-simbolos>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $aplicaciones->links() }}
    </div>


    <x-modal trigger="viewModal">
        <x-slot name="titulo">
            <h1 class="uppercase">{{ $accion == 1 ? 'Nueva ' : 'Editar ' }} Aplicación</h1>
        </x-slot>
        <x-form>
            <form action="" wire:submit.prevent="update" style="min-width: 350px;" multipart/form-data>
              {{--   @csrf
                @php
                    header('content-type: application/json; charset=utf-8');
                @endphp --}}
                <div>
                    <x-label>Aplicación</x-label>
                    <x-input type="text" class="block mt-1 w-full" wire:model.defer="aplicacion_nombre" :error="$errors->first('aplicacion_nombre')"></x-input>
                </div>

                <div>
                	<x-label>Icono <span class="text-xs">(max: 1Mb)</span></x-label>
                	<div class="w-full h-24 border border-gray-300 border-dashed rounded divide-dashed hover:bg-gray-50 cursor-pointer flex justify-center items-center relative">
                		<div class="w-20 h-20 flex justify-center items-center">
	                		@if ($iconoUpdateValidate)
			    			  <img class="w-full h-full" src="{{ $iconoUpdate->temporaryUrl() 	}}">
			    			@else
			    				<img class="w-full h-full" src="{{ Storage::url( $icono ) }}" alt="icono_aplicacion">
			    			@endif
                		</div>
                		<div class="absolute w-full h-full flex items-center justify-center">
                			<span  wire:loading wire:target="iconoUpdate" class="animate-spin text-4xl text-indigo-900">&#9696;</span>
                            {{-- <div x-show="isUploading">
                                <progress max="100" x-bind:value="progress"></progress>
                            </div> --}}
                		</div>
                		<x-input style="position: absolute;"
		    					class="absolute border-black cursor-pointer top-0 left-0 w-full h-full opacity-0"
		    		 			type="file" wire:model="iconoUpdate" accept='image/*' :error="$errors->first('iconoUpdate')"></x-input>
                	</div>
                </div>
                <div>
                    <x-label>Nombre Ruta</x-label>
                    <x-input type="text" class="block mt-1 w-full" wire:model.defer="nombre_ruta" :error="$errors->first('nombre_ruta')"></x-input>
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
                        <x-button-delete>
                        	Eliminar Aplicación
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
            <h1>Confirma elimnar la Aplicación?</h1>
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
