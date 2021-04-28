<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Empresa;
use Livewire\Component;
use Livewire\WithFileUploads;

class EmpresaDatos extends Component
{
	use WithFileUploads;

	public $empresa_id = 1;
	public $empresa_nombre, $cuit, $direccion, $logo, $favicon, $imagen;
	public $logoUpdate = null, $faviconUpdate = null, $imagenUpdate = null;

	protected $rules = [
        'empresa_nombre' => 'required|string',
        'logoUpdate' => 'nullable|image|max:1024',
        'faviconUpdate' => 'nullable|image|max:1024',
        'imagenUpdate' => 'nullable|image|max:1024',
    ];
    // protected $rules_logo = [
    //     'logoUpdate' => 'image|max:1024',
    // ];
    protected $messages  = [
        'empresa_nombre.required' => "'Empresa Nombre' es un campo obligatorio",
        'logoUpdate.image' => "El logo debe ser una imagen",
        'faviconUpdate.image' => "El favicon debe ser una imagen",
        'imagenUpdate.image' => "El imagen debe ser una imagen",
    ];


    public function render()
    {
       $empresa = Empresa::find($this->empresa_id);
       $this->empresa_nombre = $empresa->empresa;
       $this->direccion = $empresa->direccion;
       $this->cuit = $empresa->cuit;
       $this->logo = $empresa->logo;
       $this->favicon = $empresa->favicon;
       $this->imagen = $empresa->imagen;
       return view('livewire.configuracion.empresa-datos');
    }

    public function validarImagen(){
        $this->validate();
    }

    public function ejemplo()
    {


        return dd($this->logoUpdate);

        $this->logo = $this->logoUpdate->store('livewire/photos', 'public');

        $empresa = Empresa::find(1);
        $empresa->logo = $this->logo;
        $empresa->save();

    }

    public function update(){

        $this->validate($this->rules, $this->messages);

        if ($this->logoUpdate != null) {
        	$this->logo = $this->logoUpdate->store('livewire/photos', 'public');
        }
        if ($this->faviconUpdate != null) {
        	$this->favicon = $this->faviconUpdate->store('livewire/photos', 'public');
        }
        if ($this->imagenUpdate != null) {
        	$this->imagen = $this->imagenUpdate->store('livewire/photos', 'public');
        }

        $empresa = Empresa::find($this->empresa_id);
        $empresa->empresa = $this->empresa_nombre;
        $empresa->direccion = $this->direccion;
        $empresa->cuit = $this->cuit;
        $empresa->logo = $this->logo;
        $empresa->favicon = $this->favicon;
        $empresa->imagen = $this->imagen;
        $empresa->save();

        session()->flash('message', 'Se actulizó correctamente');
    	// return dd($this->empresa_nombre);
    }
}
