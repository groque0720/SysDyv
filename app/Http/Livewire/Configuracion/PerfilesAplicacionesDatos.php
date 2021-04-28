<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Livewire\Component;

class PerfilesAplicacionesDatos extends Component
{

    public Perfil $perfil;

    public function mount($perfil_nombre)
    {
    	$this->perfil = Perfil::where('perfil',$perfil_nombre)->first();
    }

    public function render()
    {
        $aplicaciones = $this->perfil->aplicaciones()->get();
        return view('livewire.configuracion.perfiles-aplicaciones-datos', compact('aplicaciones'));
    }
}
