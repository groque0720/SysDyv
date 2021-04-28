<div>
    {{-- Because she competes with no one, no one can compete with her. --}}{{ $perfil->perfil }}

    <div>
    	@foreach ($aplicaciones as $aplicacion)
    		<div>
    			{{ $aplicacion->aplicacion }}
    		</div>
    	@endforeach
    </div>
</div>
