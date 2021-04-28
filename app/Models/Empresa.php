<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    public function negocios()
    {
    	return $this->hasMany(Negocio::class);
    }

    public function sucursales()
    {
    	return $this->hasMany(Sucursal::class);
    }
}
