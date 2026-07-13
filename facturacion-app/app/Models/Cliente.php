<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    //
    protected $fillable = ['nombre', 'nit', 'email', 'telefono', 'direccion'];

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }
}
