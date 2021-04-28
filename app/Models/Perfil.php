<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;

    public function aplicaciones()
    {
    	return $this->BelongsToMany(Aplicacion::class, 'aplicacions_perfils');
    }

    public function usuarios()
    {
    	return $this->BelongsToMany(User::class, 'perfils_users');
    }
}
