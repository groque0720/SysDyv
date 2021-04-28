<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aplicacion extends Model
{
    use HasFactory;

    public function perfiles()
    {
    	return $this->BelongsToMany(Perfil::class, 'aplicacions_perfils');
    }
}
