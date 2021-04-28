<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sucursal extends Model
{
    use HasFactory;

    public function empresa()
    {
    	return $this->belongsTo(Empresa::class);
    }

    public function negocio()
    {
    	return $this->BelongsTo(Negocio::class);
    }

    public function usuarios()
    {
    	return $this->BelongsToMany(User::class, 'sucursals_users');
    }
}
