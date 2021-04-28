<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Negocio;
use Illuminate\Support\Facades\Validator;
use Livewire\Component;
use Livewire\WithPagination;

class NegociosDatos extends Component
{

	use WithPagination;
	public $negocio_id, $empresa_id = 1, $negocio_nombre, $activo;
    public $viewModal = false;
    public $viewModalDelete = false;
    public $accion = ''; //1-nuevo, 2-editar, 3-eliminar
    public $search = '';

    protected $queryString = [
		'search' => ['except' => '']
	];

   	protected $rules = [
        'negocio_nombre' => 'required|string|unique:negocios,negocio',
    ];
    protected $messages  = [
        'negocio_nombre.required' => "'Nombre Negocio' es un campo obligatorio",
        'negocio_nombre.unique' => "'Nombre Negocio' ya ha sido registrado",
    ];

    public function render()
    {
        $negocios = Negocio::where('negocio','like',"%{$this->search}%")->orderBy('id')->paginate(10);
        return view('livewire.configuracion.negocios-datos', compact('negocios'));
    }

    public function create(){
    	$this->setField();
    	$this->accion = 1;
    	$this->viewModal = true;
    }
    public function setField(){
     	$this->negocio_id = '';
    	$this->negocio_nombre = '';
    	$this->activo = 0;
    }
    public function edit($id){
    	$this->accion = 2;
      	$negocio = Negocio::find($id);
    	$this->negocio_id = $id;
    	$this->negocio_nombre = $negocio->negocio;
    	$this->activo = $negocio->activo;
    	$this->viewModal = true;
    }

    public function update(){

    	if ($this->accion == 1 ) {
    		$this->validate($this->rules);
    		$negocio = new Negocio;
    		$negocio->negocio = $this->negocio_nombre;
    		$negocio->empresa_id = $this->empresa_id;
    		$negocio->activo  = $this->activo;
    		$negocio->save();
    	}

    	if ($this->accion == 2 ) {
    		$this->validate([
    			'negocio_nombre' => 'required|string|unique:negocios,negocio,'.$this->negocio_id,
    		]);
    		$negocio = Negocio::find($this->negocio_id);
    		$negocio->negocio = $this->negocio_nombre;
    		$negocio->activo  = $this->activo;
    		$negocio->save();
    	}

    	$this->viewModal = false;
    	$this->viewModalDelete = false;
    }

    public function delete()
    {
    	$this->accion == 3;
    	$this->viewModalDelete = true;
    }

    public function confirmDelete()
    {
    	$negocio = Negocio::find($this->negocio_id);
    	$negocio->delete();
    	$this->viewModal = false;
    	$this->viewModalDelete = false;
    }

}
