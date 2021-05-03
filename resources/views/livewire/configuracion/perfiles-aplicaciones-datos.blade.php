<div
    x-data = "{
        viewModal: @entangle("viewModal"),
        viewModalDelete: @entangle("viewModalDelete"),
        viewAplicaciones: @entangle("viewAplicaciones"),
    }">

    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

        @include('layouts.parciales.form-table-cabecera-back',
                [ 'titulo' =>  'Perfil <span class="text-indigo-500">'.$perfil->perfil."</span> - Lista Aplicaciones" ])

        <div class="flex justify-between items-center my-5">
            <div class="flex items-center">
                @include('layouts.parciales.form-table-busqueda')
            </div>
            <x-button class="bg-indigo-500" wire:click="$set('viewAplicaciones', true)">Asignar Aplicación</x-button>
        </div>

        <div class="flex justify-center mx-auto mb-5 border rounded overflow-hidden">
            <table class="w-full ">
                <thead
                    class="bg-indigo-500 text-white">
                    <tr>
                        <th class="py-2">Id</th>
                        <th class="py-2">Aplicaciones</th>
                        <th class="py-2">Icono</th>
                        <th class="py-2">Ruta</th>
                        <th class="py-2">Activo</th>
                        <th class="py-2">Desvincular</th>
                    </tr>
                </thead>
                <tbody >
                    @foreach ($perfil_apps as $id => $aplicacion)
                    <tr class="text-sm border-b border-gray-200 py-4 hover:bg-gray-100 text-center">
                        <td class="py-1"> {{ $aplicacion->id}} </td>
                        <td class="py-1"> {{ $aplicacion->aplicacion }} </td>
                        <td class="py-1">
                                <div class="flex items-center justify-center">
                                    <img class="w-8 h-8" src="{{ Storage::url( $aplicacion->icono ) }}" alt="">
                                </div>
                            </td>
                        <td class="py-1">
                            @if ($aplicacion->activo)
                                <a href="{{ route($aplicacion->nombre_ruta) }}" class="text-indigo-500">
                                    <x-simbolos nombre="link" class="text-xl"></x-simbolos>
                                    {{ $aplicacion->nombre_ruta }}</a>
                            @else
                                <span class="line-through">{{ $aplicacion->nombre_ruta }}</span>
                            @endif

                            </td>
                        <td class="py-1">
                                <div class="{{ ( $aplicacion->activo ) ? 'text-green-500' : 'text-red-500' }} flex justify-center items-center">
                                    <x-simbolos class="text-2xl"
                                        nombre="{{ ( $aplicacion->activo ) ? 'check' : 'nocheck' }}"></x-simbolos>
                                    <span>
                                        {{ ( $aplicacion->activo ) ? 'Activo' : 'No Activo' }}
                                    </span>
                                </div>
                            </td>
                        <td class="py-1">
                                <x-simbolos
                                nombre="un-link" class="text-2xl cursor-pointer text-gray-300 hover:text-red-500"
                                wire:click="desvincularAplicacion({{ $aplicacion->id }},'{{ $aplicacion->aplicacion }}')">
                                </x-simbolos>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $perfil_apps->links() }}

         @if ($perfil_apps->isEmpty())
            <div class="flex w-full bg-red-100 p-5 rounded-lg">
                <p class="text-red-400">
                    No hay aplicaciones asignadas
                </p>
            </div>
        @endif

    </div>


    <x-modal trigger="viewAplicaciones" class="p-5">
        <x-slot name="titulo">
            <h1 class="uppercase">Asignar Aplicaciones</h1>
        </x-slot>
            <div class="mb-2">
                <input type="search" wire:model="searchApp" class="w-full mt-3 px-4 py-1 rounded border-gray-200 focus:border-transparent" placeholder="Buscar...">
            </div>
        <div class="flex flex-auto relative" style="height: 300px; min-width: 500px;">
            <div class="w-full h-full overflow-y-auto px-2" wire:loading.delete wire:target="asignarAplicacion">
                @foreach ($aplicaciones as $aplicacion)
                    <div class="flex gap-2 justify-between items-center bg-gray-50 p-2 my-2 rounded hover:bg-indigo-500 hover:text-white">
                        <div class="flex-grow">
                            <span class="font-extrabold capitalize text-base">{{ $aplicacion->aplicacion }}</span>
                        </div>
                        <div class="w-20 flex justify-center">
                             <img class="w-10 h-10" src="{{ Storage::url( $aplicacion->icono ) }}" alt="">
                        </div>
                        <div class="w-20 flex justify-center">
                            @if ( $perfil->aplicaciones->pluck('id')->contains($aplicacion->id) )
                                <i class="fas fa-link text-2xl text-green-500"></i>
                            @else
                                <x-simbolos
                                    title="Asignar aplicación"
                                    nombre="link" class="text-2xl cursor-pointer text-gray-300 hover:text-gray-500"
                                    wire:click="asignarAplicacion({{ $aplicacion->id }})"/>
                             @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </x-modal>



    <x-modal trigger="viewModalDelete">
        @include('layouts.parciales.form-delete-confirm',
            ['titulo' => 'Perfil '.$perfil->perfil,
            'mensaje_delete' => "Desea desvincular la aplicación '".$aplicacion_nombre_seleccionada."'",
            'leyenda_boton' => 'si, desvincular',
            ])
    </x-modal>

</div>
