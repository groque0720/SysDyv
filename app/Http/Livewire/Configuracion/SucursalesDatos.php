<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Empresa;
use App\Models\Negocio;
use App\Models\Sucursal;
use Livewire\Component;
use Livewire\WithPagination;

class SucursalesDatos extends Component
{
	use WithPagination;

	public $sucursal_id, $empresa_id, $negocio_id, $sucursal_nombre,
			$telefono, $email, $direccion, $es_casa_matriz = 0, $imagen,
			$imagenUpdate = null, $activo = 0;
	public $empresas = [];
	public $negocios = [];
	public $accion='';
	public $viewModal = false;
    public $viewModalDelete = false;
    public $search = '';

    protected $queryString = [
		'search' => ['except' => ''],
	];

	protected $rules = [
        'empresa_id' => 'required',
        'negocio_id' => 'required',
        'sucursal_nombre' => 'required',
    ];

    protected $messages  = [
        'sucursal_nombre.required' => "'Sucursal' es un campo obligatorio",
        'negocio_id.required' => "'Negocio' es un campo obligatorio",
        'empresa_id.required' => "'Empresa' es un campo obligatorio",
    ];

    public function render()
    {
        $busq = $this->search;
        $sucursales = Sucursal::where('sucursal','like',"%{$this->search}%")
        						->with(['empresa','negocio'])
        						->orWhereHas('negocio', function($negocio) use($busq){
        							$negocio->where('negocio','like',"%{$busq}%");
        						})
        						// ->orWhereHas('empresa', function($empresa) use($busq){
        						// 	$empresa->where('empresa','like',"%{$busq}%");
        						// })
        						->orderBy('id')->paginate(10);

        return view('livewire.configuracion.sucursales-datos', compact('sucursales'));
    }

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    // public function updatingActivo(){
    //     return dd('hola');
    // }

    public function tablasAux(){
    	$this->empresas = Empresa::orderBy('empresa')->get();
    	$this->negocios = Negocio::orderBy('negocio')->get();
    }

    public function create(){
    	$this->tablasAux();
    	$this->setField();
    	$this->accion = 1;
    	$this->activo = 0;
    	$this->viewModal = true;
    }

    public function edit($id){
    	$this->tablasAux();
    	$this->setField();
    	$this->accion   = 2;

      	$sucursal = Sucursal::find($id);

    	$this->sucursal_id     = $id;
		$this->empresa_id      = $sucursal->empresa_id;
		$this->negocio_id      = $sucursal->negocio_id;
		$this->sucursal_nombre = $sucursal->sucursal;
		$this->telefono        = $sucursal->telefono;
		$this->email           = $sucursal->email;
		$this->direccion       = $sucursal->direccion;
		$this->es_casa_matriz  = $sucursal->es_casa_matriz;
		$this->imagen          = $sucursal->imagen;
		// $this->imagenUpdate = null;
		$this->activo          = $sucursal->activo;
    	$this->viewModal       = true;
    }

    public function update(){

		$this->validate($this->rules);

    	if ($this->accion == 1 ) {
    		$sucursal = new Sucursal;
    	}

    	if ($this->accion == 2 ) {
    		$sucursal = Sucursal::find($this->sucursal_id);
    	}

		$sucursal->empresa_id     = $this->empresa_id;
		$sucursal->negocio_id     = $this->negocio_id;
		$sucursal->sucursal       = $this->sucursal_nombre;
		// $sucursal->telefono       = $this->telefono;
		// $sucursal->email          = $this->email;
		// $sucursal->direccion      = $this->direccion;
		$sucursal->activo = $this->activo;
		$sucursal->es_casa_matriz = $this->es_casa_matriz;
		$sucursal->save();

    	$this->viewModal = false;
    }


    public function delete()
    {
    	$this->accion == 3;
    	$this->viewModalDelete = true;
    }

    public function confirmDelete()
    {
    	$sucursal = Sucursal::find($this->sucursal_id);
    	$sucursal->delete();
    	$this->viewModal = false;
    	$this->viewModalDelete = false;
        $this->setField();
    }



    public function setField(){

		$this->empresa_id      = '';
		$this->negocio_id      = '';
		$this->sucursal_nombre = '';
		$this->telefono        = '';
		$this->email           = '';
		$this->direccion       = '';
		$this->es_casa_matriz  = 0;
		$this->imagen          = '';
		$this->imagenUpdate    = null;
		$this->activo          = 0;
    }



}
