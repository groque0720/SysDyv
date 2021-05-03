<div>
    <div class="bg-white w-full md:w-9/12 mx-auto p-3 rounded-md">

    	@include('layouts.parciales.form-table-cabecera-back',[ 'titulo' => 'Lista Aplicaciones' ])
    	<div class="my-5">
        	@include('layouts.parciales.form-table-busqueda')
    	</div>
    	<div class="grid grid-cols-3 gap-5 md:grid-cols-4 lg:grid-cols-5">
	 		@foreach ($aplicaciones as $aplicacion)
				<a href="{{ ($aplicacion->nombre_ruta) ? route($aplicacion->nombre_ruta) : '' }}">
					<div class="h-full flex flex-col justify-between border rounded items-center p-1 hover:shadow-xl hover:bg-gray-100">
						<div class="overflow-hidden h-20 w-20">
								<img class="w-full h-full object-cover" src="{{ Storage::url( $aplicacion->icono) }}" alt="icono_aplicacion">
						</div>
						<div class="p-2 ">
							<span class="capitalize font-extrabold text-base">{{ $aplicacion->aplicacion }}</span>
						</div>
					</div>
				</a>
			@endforeach
    	</div>
    </div>

{{-- 	<div class="grid grid-cols-3 gap-2 p-5 md:grid-cols-5 items-center">
		@foreach ($aplicaciones as $aplicacion)
			<a href="{{ ($aplicacion->nombre_ruta) ? route($aplicacion->nombre_ruta) : '' }}">
				<div class="h-full flex flex-col justify-between border rounded items-center p-1 hover:shadow-xl hover:bg-gray-100">
					<div class="w-full overflow-hidden h-24 w-24 lg:h-32 bg-white">
							<img class="w-full h-full object-cover" style=";" src="/images/logodyvbyn.png" alt="">
					</div>
					<div class="p-2 ">
						<span class="capitalize">{{ $aplicacion->aplicacion }}</span>
					</div>
				</div>
			</a>
		@endforeach
	</div> --}}
</div>
