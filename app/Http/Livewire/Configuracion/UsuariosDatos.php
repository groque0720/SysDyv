<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class UsuariosDatos extends Component
{

	use WithPagination;
	use WithFileUploads;

	// al agregar un campo mas acordarse de colocarlo en el metodo resetInput()
	public $user_nombre, $user_mail, $telefono, $avatar, $activo; //campos tabla
	public $user_sucursal_id, $user_perfil_id; // relaciones
	public $user_id_select, $user_sucursal_id_select, $user_perfil_id_select; // selecciones en vista

	public $accion='';
	public $viewModal = false;
    public $viewModalDelete = false;
    public $search = '';

    protected $queryString = [
		'search' => ['except' => ''],
	];

	protected $rules = [
    ];

    protected $messages  = [
    ];

    public function updatingSearch()
    {
        $this->gotoPage(1);
    }

    public function render()
    {
        $usuarios = User::where('name','like',"%{$this->search}%")
        				->with(['sucursales' => function($sucursal){
        					$sucursal->with('negocio');
        				}])->paginate(10);

        return view('livewire.configuracion.usuarios-datos', compact('usuarios'));
    }

    public function resetInput()
    {
        $this->$user_nombre    = '';
		$this->$user_mail      = '';
		$this->$user_avatar    = '';
		$this->$user_telefono  = '';
		$this->activo          = 0;

		$this->$user_sucursal_id = '';
		$this->$user_perfil_id   = '';

		$this->$user_id_select = '';
		$this->$user_sucursal_id_select = '';
		$this->$user_perfil_id_select = '';

    }
}
