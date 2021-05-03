<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
    }"
    >

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',[ 'titulo' =>  "Lista Usuarios" ])
{{--         @include('layouts.parciales.form-table-busqueda-nuevo') --}}
        <div class="flex justify-between items-center">
            <div class="flex items-center">
                @include('layouts.parciales.form-table-busqueda')
            </div>
            <a href="{{ route('usuario.editar') }}">
                <x-button class="bg-indigo-500" >Agregar Usuario</x-button>
            </a>
        </div>

        <div class="flex justify-center mx-auto my-5 border overflow-hidden rounded">
            <table class="w-full">
                <thead
                    class="bg-indigo-500 text-white">
                    <tr>
                        <th class="py-2">Id</th>
                        <th class="py-2">Usuario</th>
                        <th class="py-2">Sucursales</th>
                        <th class="py-2">Activo</th>
                        <th class="py-2">Editar</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($usuarios as $usuario)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $usuario->id}} </td>

                        <td class="py-1">
                        	<div class="flex items-center">
                        		@if ($usuario->avatar != '')
                        			<img class="w-10 h-10 rounded-full mx-2 border"
                        			src="{{ Storage::url( $usuario->avatar ) }}" alt="avatar_{{ $usuario->name }}">
                        		@else
                        			<img class="w-10 h-10 rounded-full mx-2 border"
                        			src="/images/logodyvbyn.png" alt="avatar_{{ $usuario->name }}">
                        		@endif

                        		<div class="flex-grow"><span>{{ $usuario->name }}</span></div>
                        	</div>
	                         </td>

                        <td class="py-1">
	                        	@foreach ($usuario->sucursales as $sucursal)
	                        	<div>
	                        		{{ $sucursal->sucursal }} ({{ $sucursal->negocio->negocio }})
	                        	</div>
	                        	@endforeach
                        	</td>
                        <td class="py-1">
                                <div class="{{ ($usuario->activo) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl" nombre="{{ ($usuario->activo) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span> {{ ($usuario->activo) ? 'Activo' : 'No activo' }} </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <a href="{{ route('usuario.editar', [$usuario->id]) }}">
                                    <x-simbolos
                                        nombre="editar" class="text-2xl cursor-pointer hover:text-blue-500">
                                    </x-simbolos>
                                </a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $usuarios->links() }}
    </div>
</div>
