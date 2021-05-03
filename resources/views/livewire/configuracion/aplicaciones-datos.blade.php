<div
	x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >
    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' => 'Lista Aplicaciones' ])
        @include('layouts.parciales.form-table-busqueda-nuevo')

        <div class="flex justify-center mx-auto my-5 border border-gray-300 rounded overflow-hidden">
            <table class="w-full">
                <thead
                    class="bg-indigo-500 text-white rounded">
                    <tr class="">
                        <th class="py-2">Id</th>
                        <th class="py-2">Aplicacion</th>
                        <th class="py-2">Icono</th>
                        <th class="py-2">Nombre Ruta</th>
                        <th class="py-2">Activo</th>
                        <th class="py-2">Editar</th>
                    </tr>
                </thead>
                <tbody class="last:border-black">
                    @foreach ($aplicaciones as $aplicacion)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $aplicacion->id}} </td>
                        <td class="py-1"> {{ $aplicacion->aplicacion }} </td>
                        <td class="py-1">
	                        	<div class="flex items-center justify-center">
	                        		<img class="w-8 h-8" src="{{ Storage::url( $aplicacion->icono ) }}" alt="">
	                        	</div>
                        	</td>
                        <td class="py-1">
                                <a href="{{ route($aplicacion->nombre_ruta) }}" class="text-indigo-500">
                                    <x-simbolos nombre="link"></x-simbolos>
                                    {{ $aplicacion->nombre_ruta }}</a>
                            </td>
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
	                		@if ($iconoUpdateValidate != null)
			    			  <img class="w-full h-full" src="{{ $iconoUpdate->temporaryUrl() }}">
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
            <x-button-aceptar wire:click.prevent="update">Aceptar</x-button-aceptar>
        </x-slot>

    </x-modal>

    <x-modal trigger="viewModalDelete">
        @include('layouts.parciales.form-delete-confirm',
            ['titulo' => 'Eliminar',
            'mensaje_delete' => "Confirma eliminar la aplicación'".$this->aplicacion_nombre."' ",
            ])
    </x-modal>

</div>
