<div>
    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' =>  "Datos Usuario" ])

        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full mx-auto items-start mb-5">
        	<div class="">
	        	<div>
	                <x-label>Nombre</x-label>
	                <x-input type="text" class="block mt-1 w-full" wire:model.defer="user_name" :error="$errors->first('user_name')"></x-input>
	            </div>
	            <div>
	                <x-label>Email</x-label>
	                <x-input type="text" class="block mt-1 w-full" wire:model.defer="user_email" :error="$errors->first('user_email')"></x-input>
	            </div>
	            <div>
	                <x-label>Teléfono</x-label>
	                <x-input type="text" class="block mt-1 w-full" wire:model.defer="user_telefono" :error="$errors->first('user_telefono')"></x-input>
	            </div>
        	</div>
        	{{-- avatar usuario --}}
        	<div class="">
        		<div>
	        		<x-label>Avatar</x-label>
	    		    <div class="w-full h-24 border border-gray-300 border-dashed rounded divide-dashed hover:bg-gray-50 cursor-pointer flex justify-center items-center relative mt-1">
	            		<div class="w-20 h-20 flex justify-center items-center">
	                		@if ($avatarUpdateValidate != null)
			    			  <img class="w-full h-full" src="{{ $avatarUpdate->temporaryUrl() }}">
			    			@else
			    				<img class="w-full h-full" src="{{ Storage::url( $user_avatar ) }}" alt="avatar_usuario">
			    			@endif
	            		</div>
	            		<div class="absolute w-full h-full flex items-center justify-center">
	            			<span  wire:loading wire:target="avatarUpdate" class="animate-spin text-4xl text-indigo-900">&#9696;</span>
	            		</div>
	            		<x-input style="position: absolute;"
		    					class="absolute border-black cursor-pointer top-0 left-0 w-full h-full opacity-0"
		    		 			type="file" wire:model="avatarUpdate" accept='image/*' :error="$errors->first('avatarUpdate')"></x-input>
	            	</div>
	            </div>
	            <div class="flex items-center justify-end mb-2">
	            	<x-label class=" flex items-center mr-3 {{ ($user_activo) ? 'text-green-500' : 'text-red-500' }}" for="user_activo">
	            		<x-simbolos nombre="{{ ($user_activo) ? 'check' : 'nocheck' }}" class="text-2xl"></x-simbolos>
                        <span> {{ ($user_activo) ? 'Activo' : 'No activo' }} </span>
                    </x-label>
                    <x-input type="checkbox" id="user_activo" wire:model="user_activo"></x-input>
	            </div>
	            <div>
	            	<button
	            		class="w-full p-3 bg-red-400 rounded uppercase text-white hover:bg-red-700">
	            		Resetear Contraseña
	            	</button>
	            </div>
        	</div>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-5 w-full mx-auto mb-5">
        	<div class="border rounded">
        		{{-- sucursales --}}
        		<div class="bg-indigo-500 p-2 text-white rounded-t">
        			@include('layouts.parciales.form-table-cabecera',[ 'titulo' =>  "Sucursales Asociadas" ])
        		</div>

        		<table class="w-full">
        			{{-- <thead class="border-b-2 border-gray-300 text-indigo-600 w-full">
        				<tr class="w-full flex">
        					<th class="w-5/12">Sucursal</th>
        					<th class="w-5/12">Negocio</th>
        					<th class="w-2/12">Asociado</th>
        					<th style="width: 20px;"></th>
        				</tr>
        			</thead> --}}
        			<tbody class="overflow-y-scroll flex flex-col justify-start w-full" style="height: 300px;">
        				@foreach ($sucursales as $id => $sucursal)
        					<tr class="w-full flex justify-between text-sm border-b border-gray-200 hover:bg-gray-100 text-center">
        						<td class="py-2 w-5/12">{{ $sucursal->sucursal }}</td>
        						<td class="py-2 w-5/12">{{ $sucursal->negocio->negocio }}</td>
        						<td class="py-2 w-2/12">
    								@if (in_array($sucursal->id, $sucursalesVinculadas))
    									<x-input type="checkbox" wire:click="quitarSucursal({{ $sucursal->id }})" checked></x-input>
    								@else
    									<input type="checkbox" wire:click="agregarSucursal({{ $sucursal->id }})">
    								@endif
        						</td>
        					</tr>
        				@endforeach
        			</tbody>
        		</table>
        	</div>
        	{{-- perfiles --}}
        	<div class="border rounded">
                <div class="bg-indigo-500 p-2 text-white rounded-t">
                    @include('layouts.parciales.form-table-cabecera',[ 'titulo' =>  "Perfiles Asociados" ])
                </div>
        		<table class="w-full">
        			{{-- <thead class="border-b-2 border-gray-300 text-indigo-600 w-full">
        				<tr class="w-full flex">
        					<th class="w-8/12">Perfil</th>
        					<th class="w-4/12">Asociado</th>
        					<th style="width: 20px;"></th>
        				</tr>
        			</thead> --}}
        			<tbody class="overflow-y-scroll flex flex-col justify-start w-full" style="height: 300px;">
        				@foreach ($perfiles as $id => $perfil)
        					<tr class="w-full flex justify-between text-sm border-b border-gray-200 hover:bg-gray-100 text-center">
        						<td class="py-2 w-8/12">{{ $perfil->perfil }}</td>
        						<td class="py-2 w-4/12">
    								@if (in_array($perfil->id, $perfilesVinculados))
    									<x-input type="checkbox" wire:click="quitarPerfil({{ $perfil->id }})" checked></x-input>
    								@else
    									<input type="checkbox" wire:click="agregarPerfil({{ $perfil->id }})">
    								@endif
        						</td>
        					</tr>
        				@endforeach
        			</tbody>
        		</table>
        	</div>
        </div>

        <div class="w-full mx-auto mb-5 flex items-center justify-between border-t-2 mt-2 pt-2">
        	<div>
        		<a href="{{ url()->previous() }}"><x-button-cancelar>Cancelar</x-button-cancelar></a>
        	</div>
        	<div>
        		<x-button-aceptar wire:click="update">Guardar Cambios</x-button-aceptar>
        	</div>
        </div>
    </div>
</div>
