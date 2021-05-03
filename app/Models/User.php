<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function aplicaciones($seach)
    {
        // return $this->perfiles()->aplicaciones();
        return collect(DB::select("SELECT DISTINCT
                        aplicacion, icono, nombre_ruta
                        FROM
                        perfils_users
                        INNER JOIN perfils ON perfils_users.perfil_id = perfils.id
                        INNER JOIN aplicacions_perfils ON aplicacions_perfils.perfil_id = perfils.id
                        INNER JOIN aplicacions ON aplicacions_perfils.aplicacion_id = aplicacions.id
                        WHERE
                        aplicacions.aplicacion like '%". $seach ."%' AND
                        perfils_users.user_id = ?", [$this->id]));
    }

    public function perfiles()
    {
        return $this->BelongsToMany(Perfil::class, 'perfils_users')->where('perfils.activo',1);;
    }

    public function sucursales()
    {
        return $this->BelongsToMany('App\Models\Sucursal', 'sucursals_users')
                    ->where('sucursals.activo',1)
                    ->orderBy('sucursals.id');
    }

}
