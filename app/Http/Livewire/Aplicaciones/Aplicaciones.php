<?php

namespace App\Http\Livewire\Aplicaciones;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Aplicaciones extends Component
{

	public $aplicaciones;


    public function render()
    {
        $this->aplicaciones = Auth()->user()->aplicaciones();
        return view('livewire.aplicaciones.aplicaciones');
    }

    // public function aplicacionesUsuario(){
    // 	$user = Auth()->user();
    // }
}
