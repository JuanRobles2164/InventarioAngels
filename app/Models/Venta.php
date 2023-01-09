<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;
    protected $table = 'ventas';
    protected $guarded = [];

    function material(){
        return Material::find($this->material_id);
    }

    function factura(){
        return Factura::find($this->factura_id);
    }
}
