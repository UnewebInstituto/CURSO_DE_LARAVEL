<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    //
    protected $fillable = ['nombre', 'nit', 'email', 'telefono', 'direccion'];

    public function facturas(): HasMany
    {
        return $this->hasMany(Factura::class);
    }
}
