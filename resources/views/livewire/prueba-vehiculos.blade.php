<div
	x-data = "{
			viewModal: @entangle("viewModal"),
			respuestaConfimada: @entangle("respuestaConfimada"),
		}"
	>
    {{-- The Master doesn't talk, he acts. --}}
    <div class="text-center text-2xl my-5 ">
    	<h1>Boletos a Confirmar DyV <span class="text-3xl text-blue-500">&#8362</span> Salesforces</h1>
    </div>
    <div class="flex justify-center w-10/12 mx-auto">
    	<table class="w-full">
    		<thead
    			class="border-b-2 border-gray-300 text-indigo-600">
    			<tr>
	    			<th>Fecha</th>
	    			<th>Nro Boleto</th>
	    			<th>Sucursal</th>
	    			<th>Tipo</th>
	    			<th>Vehículo</th>
	    			<th>Cliente</th>
	    			<th>Vendedor</th>
	    			<th></th>
    			</tr>
    		</thead>
    		<tbody >
    			@foreach($boletos as $key => $boleto)
	    			<tr class="text-sm border-b border-gray-400 py-4 hover:bg-gray-100 text-center">
		    			<td class="py-1">{{ date('d/m/Y', strtotime($boleto->Cabecera->Fecha)) }}</td>
		    			<td>{{ $boleto->Cabecera->NroBoleto }}</td>
		    			<td>{{ $boleto->Cabecera->Sucursal }}</td>
		    			<td>{{ $boleto->Cabecera->Tipo }}</td>
		    			<td>{{ $boleto->Modelo->Marca }} {{ $boleto->Modelo->Modelo }}</td>
		    			<td>{{ $boleto->Cliente->Nombre }} {{ $boleto->Cliente->Apellido_RazonSocial }}</td>
		    			<td>{{ $boleto->Vendedor->Nombre }}</td>
		    			<td>
		    				<x-button
		    					wire:click="confirmar('{{ $boleto->Cabecera->NroBoleto }}','{{ $boleto->Cabecera->CRMID }}')"
		    					class="border border-green-500 text-green-500 bg-green-50 hover:bg-green-200 ">
		    					Confirmar
		    				</x-button>
		    			</td>
	    			</tr>
	    		@endforeach
    		</tbody>
    	</table>
    </div>

{{--     <x-button
		wire:click="confirmar('{{ $boleto->Cabecera->NroBoleto }}','{{ $boleto->Cabecera->CRMID }}')"
		class="border border-green-500 text-green-500 bg-green-50 hover:bg-green-200 ">
		Confirmar
	</x-button> --}}

    <x-modal trigger="viewModal">
    	<div class="bg-white border rounded flex flex-col content-between p-2">
    		<div class="flex justify-end border-b pb-2">
    			<span class="border rounded px-1 cursor-pointer hover:bg-gray-300 text" x-on:click="viewModal = false">Esc</span>
    		</div>
    		<div class="flex-grow p-5">
	   			Desea confimar el Boleto Nro. {{ $NroBoleto }}
    		</div>
    		<div class="flex justify-end border-t pt-2">
	    		<x-button
					wire:click.prevent="enviarConfirmacion"
					wire:loading.remove wire:target="enviarConfirmacion"
					class="border border-green-500 text-green-500 bg-green-50 hover:bg-green-200 ">
					<span
                	class="animate-spin"
                	wire:loading wire:target="enviarConfirmacion">&#9696;</span>
                	<span wire:loading.remove wire:target="enviarConfirmacion">Aceptar</span>
				</x-button>
    		</div>
    		<div class="flex justify-center">
    			<img class="w-10" src="/images/logodyv.png" wire:loading wire:target="enviarConfirmacion" alt="">
    			<img class="w-10" src="/images/loading.gif" wire:loading wire:target="enviarConfirmacion" alt="">
    			<img class="w-16" src="/images/logosalesforce.png" wire:loading wire:target="enviarConfirmacion" alt="">
    		</div>
    	</div>
    </x-modal>

    <x-modal trigger="respuestaConfimada">
    	<div class="bg-green-500 border rounded flex flex-col content-between p-2">
	    	<p class="animate-pulse text-white font-extrabold text-9xl text-center">
	            &check;
	        </p>
	        <p class="text-white font-extrabold text-2xl text-center mt-2">
	        	Boleto Confirmado
	        </p>
	    </div>
    </x-modal>

{{--     @foreach($boletos as $boleto)
    <ul>
    	<li>{{ date('d/m/Y', strtotime($boleto->Cabecera->Fecha)) }}</li>
    </ul>
    @endforeach --}}
</div>
