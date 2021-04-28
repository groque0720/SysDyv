<div>

	 <div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {{ session('message') }}
            </div>
        @endif
    </div>

	<x-form>
		<x-slot name="titulo">
			<h1 class="text-xl uppercase">Datos de la Empresa</h1>
        </x-slot>
	    <form action="" wire:submit.prevent="update" multipart/form-data>
	    	@csrf
			@php
				header('content-type: application/json; charset=utf-8');
			@endphp
	    	<div>
	    		<x-label>Empresa Nombre</x-label>
	    		<x-input type="text" class="block mt-1 w-full" wire:model.defer="empresa_nombre" :error="$errors->first('empresa_nombre')"></x-input>
	    	</div>
	    	<div>
	    		<x-label>Dirección</x-label>
	    		<x-input type="text" class="block mt-1 w-full" wire:model.defer="direccion"></x-input>
	    	</div>
	    	<div>
	    		<x-label>CUIT</x-label>
	    		<x-input type="text" class="block mt-1 w-full" wire:model.defer="cuit"></x-input>
	    	</div>
	    	<div>
	    		<x-label>Logo</x-label>
	    		<div class="w-20 h-20 relative cursor-pointer bg-transparent hover:bg-gray-200 flex justify-center items-center">
	    			<div class="hidden hover:block">
	    				pepe
	    			</div>
	    			<span  class="absolute" wire:loading wire:target="logoUpdate" class="animate-spin text-4xl text-indigo-900">&#9696;</span>
	    			@if ($logoUpdate)
		    			<img class="w-full h-full" src="{{ $logoUpdate->temporaryUrl() }}">
		    		@else
		    			<img class="w-full h-full" src="{{ Storage::url( $logo ) }}" alt="">
		    		@endif
		    		<x-input style="position: absolute;"
		    			class="absolute border-black cursor-pointer top-0 left-0 w-full h-full opacity-0"
		    		 type="file" wire:model="logoUpdate" accept='image/*' :error="$errors->first('logoUpdate')"></x-input>
		    		 @error('logoUpdate') <span class="error">el pepe</span> @enderror
	    		</div>
	    		{{-- <x-input type="file" wire:model="logoUpdate" :error="$errors->first('logoUpdate')"></x-input> --}}
	    	</div>
	    	<div>
	    		<x-label>Favicon</x-label>
	    		<img src="{{ Storage::url( $favicon ) }}" alt="">
	    		<x-input type="file" class="block mt-1 w-full" wire:model.defer="faviconUpdate" :error="$errors->first('faviconUpdate')"></x-input>
	    	</div>
	    	<div>
	    		<x-label>Imagen</x-label>
	    		<img src="{{ Storage::url( $imagen ) }}" alt="">
	    		<x-input type="file" class="block mt-1 w-full" wire:model.defer="imagenUpdate" :error="$errors->first('faviconUpdate')"></x-input>
	    	</div>
	    	<div class="w-100 flex justify-end">
		    	<x-button class="px-5 py-3 mt-5 w-2/4 bg-blue-500 justify-center">
	                <span
	                	class="animate-spin"
	                	wire:loading wire:target="update">&#9696;</span>
	                <span wire:loading.remove wire:target="update">Aceptar</span>
	            </x-button>
	    	</div>

	    </form>
    </x-from>
</div>

