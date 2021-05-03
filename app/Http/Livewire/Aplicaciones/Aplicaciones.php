<?php

namespace App\Http\Livewire\Aplicaciones;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Aplicaciones extends Component
{

	public $user;
	public $aplicaciones;

	public $search = '';

    protected $queryString = [
		'search' => ['except' => ''],
	];

	public function mount(){
		$this->user = User::find(Auth()->user()->id);
	}


    public function render()
    {
        $this->aplicaciones = $this->user->aplicaciones($this->search);
        return view('livewire.aplicaciones.aplicaciones');
    }

    // public function aplicacionesUsuario(){
    // 	$user = Auth()->user();
    // }
}
