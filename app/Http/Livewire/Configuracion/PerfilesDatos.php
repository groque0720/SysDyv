<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Perfil;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PerfilesDatos extends Component
{
	use WithPagination;
	public $viewModal = false;
    public $viewModalDelete = false;
    public $accion = '';

    public $perfil_id, $perfil_nombre, $activo;

    public $search = '';
    protected $queryString = [
		'search' => ['except' => '']
	];

    public function render()
    {
        $perfiles = Perfil::where('perfil','like',"%{$this->search}%")->orderBy('id')->paginate(10);
        return view('livewire.configuracion.perfiles-datos', compact('perfiles'));
    }

    public function create()
    {
    	$this->accion = 1;
    	$this->resetInput();
    	$this->viewModal = true;
    }

    public function edit($id)
    {
    	$this->accion = 2;
    	$this->perfil_id = $id;
    	$perfil = Perfil::find($id);
    	$this->perfil_nombre = $perfil->perfil;
    	$this->activo = $perfil->activo;
    	$this->viewModal = true;
    }

    public function update()
    {

	   	if ($this->accion == 1) {
    		$this->validate([
    			'perfil_nombre' => 'required|string|unique:perfils,perfil',
    		]);
    		$perfil = new Perfil;
    	}

    	if ($this->accion == 2) {
    		$this->validate([
    			'perfil_nombre' => 'required|string|unique:perfils,perfil,'.$this->perfil_id,
    		]);
    		$perfil = Perfil::find($this->perfil_id);
    	}
    	$perfil->perfil = $this->perfil_nombre;
    	$perfil->activo = $this->activo;
    	$perfil->save();

    	$this->viewModal = false;
    	$this->resetInput();
    }

    public function delete()
    {
        $this->accion == 3;
        $this->viewModalDelete = true;
    }

    public function confirmDelete()
    {
        $perfil = Perfil::find($this->perfil_id);
        $perfil->delete();
        $this->viewModal = false;
        $this->viewModalDelete = false;
    }

    public function resetInput(){
        $this->perfil_id = '';
        $this->perfil_nombre = '';
        $this->activo = 0;
    }

}
