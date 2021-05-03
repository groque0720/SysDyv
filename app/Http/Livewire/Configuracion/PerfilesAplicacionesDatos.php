<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Aplicacion;
use App\Models\Perfil;
use Illuminate\Http\Request;
use Livewire\Component;
use Livewire\WithPagination;

class PerfilesAplicacionesDatos extends Component
{

    use WithPagination;

    public Perfil $perfil;
    public $perfil_nombre = "";
    public $aplicaciones_asignadas = [];
    public $aplicacion_nombre_seleccionada = '';
    public $aplicacion_id_seleccionada = '';
    public $viewModal = false;
    public $viewAplicaciones = false;
    public $viewModalDelete = false;
    public $search = '';
    public $searchApp = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'searchApp' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function mount($perfil_nombre)
    {
    	$this->perfil_nombre = $perfil_nombre;


    }

    public function render()
    {
        $this->perfil = Perfil::where('perfil',$this->perfil_nombre)->with('aplicaciones')->first();
        // $this->aplicaciones_asignadas = $this->perfil->aplicaciones->pluck('id')->collect();

        $perfil_apps = $this->perfil->aplicaciones()->where('aplicacion','like',"%{$this->search}%")->paginate(10);
        $aplicaciones = Aplicacion::where('aplicacion','like',"%{$this->searchApp}%")->orderBy('aplicacion')->get();

        return view('livewire.configuracion.perfiles-aplicaciones-datos', compact('perfil_apps','aplicaciones'));
    }

    // public function mostrarAplicaciones(){
    //     $this->viewAplicaciones = true;
    // }

    public function asignarAplicacion($aplicacion_id)
    {
        $this->perfil->aplicaciones()->attach($aplicacion_id);
    }

    public function desvincularAplicacion($aplicacion_id, $aplicacion)
    {
        $this->aplicacion_id_seleccionada = $aplicacion_id;
        $this->aplicacion_nombre_seleccionada = $aplicacion;
        $this->viewModalDelete = true;
    }

    public function confirmDelete()
    {
        $this->perfil->aplicaciones()->detach($this->aplicacion_id_seleccionada);
        $this->viewModalDelete = false;
        $this->search = '';
    }
}
