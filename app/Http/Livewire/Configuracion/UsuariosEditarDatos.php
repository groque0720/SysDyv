<?php

namespace App\Http\Livewire\Configuracion;

use App\Models\Perfil;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class UsuariosEditarDatos extends Component
{
	use WithFileUploads;

	public $viewModal = false;
    public $viewModalDelete = false;
    public $accion = '';

    public $search = '';
    protected $queryString = [
		'search' => ['except' => '']
	];

    protected $rules_img = [
            'avatarUpdate' => 'nullable|image|max:1024', // 1MB Max
        ];
    protected $messages_img = [
            'avatarUpdate.image' => 'El archivo debe ser una imagen válida',
            'avatarUpdate.max' => 'El archivo es muy grande'
        ];

	public User $user;
	public $user_id, $user_name, $user_email, $user_telefono, $user_password, $user_avatar, $user_activo = 0;
	public $avatarUpdate, $avatarUpdateValidate;

	public $sucursalesVinculadas = [];
	public $perfilesVinculados = [];

    public function mount($user_id = ''){
    	$this->user_id = $user_id;
    	$this->user = ($this->user_id == '' ) ? new User : User::find($this->user_id);

        $this->user_name = $this->user->name;
        $this->user_email = $this->user->email;
        $this->user_telefono = $this->user->telefono;
        $this->user_activo = $this->user->activo;
        $this->user_avatar = $this->user->avatar;

    	$this->sucursalesVinculadas = $this->user->sucursales()->pluck('sucursal_id')->toArray();
    	$this->perfilesVinculados = $this->user->perfiles()->pluck('perfil_id')->toArray();
    }

    public function render()
    {
	   	$sucursales = Sucursal::where('activo','=',1)->with('negocio')->get();
	   	$perfiles = Perfil::where('activo','=',1)->get();
        return view('livewire.configuracion.usuarios-editar-datos', compact('sucursales', 'perfiles'));
    }


    public function updatedAvatarUpdate(){
        $this->avatarUpdateValidate = null;
        $this->validate($this->rules_img, $this->messages_img);
        $this->avatarUpdateValidate = $this->avatarUpdate;
    }

    public function agregarSucursal($sucursal_id){
    	array_push($this->sucursalesVinculadas, $sucursal_id);
    	// return dd($this->sucursalesVinculadas);
    }

    public function quitarSucursal($sucursal_id){
    	if (($clave = array_search($sucursal_id, $this->sucursalesVinculadas)) !== false) {
		    // unset($this->sucursalesVinculadas[$clave]);
		    array_splice($this->sucursalesVinculadas, $clave, 1);
		}
    }

    public function agregarPerfil($perfil_id){
    	array_push($this->perfilesVinculados, $perfil_id);
    	// return dd($this->sucursalesVinculadas);
    }

    public function quitarPerfil($perfil_id){
    	if (($clave = array_search($perfil_id, $this->perfilesVinculados)) !== false) {
		    // unset($this->sucursalesVinculadas[$clave]);
		    array_splice($this->perfilesVinculados, $clave, 1);
		}
    }

    public function update(){


        $this->validate([
            'user_name'  => 'required',
            'user_email' => 'required|email|unique:users,email,'.($this->user_id ?? '' ),
        ],[
            'user_name.required' => 'El campo nombre es obligatorio',
            'user_email.unique' => 'El email ingresado ya está registrado'
        ]);

        $this->user->name     = $this->user_name;
        $this->user->email    = $this->user_email;
        $this->user->telefono = $this->user_telefono;
        $this->user->activo   = $this->user_activo;
        //
            if ($this->avatarUpdate != null) {
                Storage::disk('public')->delete($this->user->avatar);
                $this->user->avatar = $this->avatarUpdate->store('imagenes/usuarios', 'public');
            }

        $this->user->save();

    	$this->user->sucursales()->sync($this->sucursalesVinculadas);
    	$this->user->perfiles()->sync($this->perfilesVinculados);
    	return redirect()->route('usuarios');
    }
}
