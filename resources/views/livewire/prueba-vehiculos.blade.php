<div>
    {{-- The Master doesn't talk, he acts. --}}
    hola desde prueba

    @foreach($boletos as $v)
    <ul>
    	<li>{{ $v->Cabecera->NroBoleto }}</li>
    </ul>
    @endforeach
</div>
