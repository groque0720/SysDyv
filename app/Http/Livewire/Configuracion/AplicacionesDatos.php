<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Aplicacion;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class AplicacionesDatos extends Component
{

	use WithPagination;
	use WithFileUploads;

	public $viewModal = false;
    public $viewModalDelete = false;
    public $accion = '';

    public $search = '';
    protected $queryString = [
		'search' => ['except' => '']
	];

    protected $rules_img = [
            'iconoUpdate' => 'nullable|image|max:1024', // 1MB Max
        ];
    protected $messages_img = [
            'iconoUpdate.image' => 'El archivo debe ser una imagen válida',
            'iconoUpdate.max' => 'El archivo es muy grande'
        ];

	protected $rules = [
    ];

    protected $messages  = [
        'aplicacion_nombre.unique' => 'Nombre de la aplicación ya existe',
        'nombre_ruta.unique' => 'El nombre de Ruta ya existe para otra aplicación',
    ];

    public $aplicacion_id,
    		$aplicacion_nombre,
    		$icono,
    		$iconoUpdate,
            $iconoUpdateValidate,
    		$nombre_ruta,
    		$activo=0;

    public function render()
    {
        $aplicaciones = Aplicacion::where('aplicacion','like',"%{$this->search}%")->orderBy('aplicacion')->paginate(10);
        return view('livewire.configuracion.aplicaciones-datos', compact('aplicaciones'));
    }

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function updatedIconoUpdate(){
        $this->validate($this->rules_img, $this->messages_img);
        $this->iconoUpdateValidate = $this->iconoUpdate;
    }

    // public function tablasAux(){

    // }

    public function create(){
    	// $this->tablasAux();
    	// $this->resetInput();
    	$this->accion = 1;
    	$this->viewModal = true;
    }

    public function edit($id){
    	// $this->tablasAux();
    	$this->resetInput();
    	$this->accion   = 2;
        $this->aplicacion_id = $id;

        $aplicacion = Aplicacion::find($id);
        $this->aplicacion_nombre = $aplicacion->aplicacion;
        $this->nombre_ruta = $aplicacion->nombre_ruta;
        $this->icono = $aplicacion->icono;
        $this->activo = $aplicacion->activo;

    	$this->viewModal = true;
    }

    public function update(){

		$this->validate($this->rules_img, $this->messages_img);

    	if ($this->accion == 1 ) {
            $this->validate([
                'aplicacion_nombre' => 'required|string|unique:aplicacions,aplicacion',
                ], $this->messages);
            $aplicacion = new Aplicacion;
    	}

    	if ($this->accion == 2 ) {
            $this->validate([
                'aplicacion_nombre' => 'required|string|unique:aplicacions,aplicacion,'.$this->aplicacion_id,
                ], $this->messages);

            $aplicacion = Aplicacion::find($this->aplicacion_id);
    	}

        $aplicacion->aplicacion = $this->aplicacion_nombre;
            if ($this->iconoUpdate != null) {
                Storage::disk('public')->delete($aplicacion->icono);
                $aplicacion->icono = $this->iconoUpdate->store('imagenes/aplicaciones', 'public');
            }
        $aplicacion->nombre_ruta = $this->nombre_ruta;
        $aplicacion->activo = $this->activo;
        $aplicacion->save();

    	$this->viewModal = false;
    }


    public function delete()
    {
    	$this->accion == 3;
    	$this->viewModalDelete = true;
    }

    public function confirmDelete()
    {
    	Aplicacion::find($this->aplicacion_id)->delete();
        $this->viewModal = false;
    	$this->viewModalDelete = false;
    	$this->resetInput();
    }

    public function resetInput()
    {
		$this->errors = [];
        $this->aplicacion_nombre    = '';
		$this->icono                = '';
		$this->iconoUpdate          = null;
        $this->iiconoUpdateValidate = null;
		$this->nombre_ruta          = '';
		$this->activo               = 0;
    }
}
