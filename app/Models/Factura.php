<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Factura extends Model
{
    use HasFactory;
    protected $table = 'facturas';
    protected $guarded = [];

    function ventas(){
        return Venta::where('factura_id', $this->id)->get();
    }

    function cliente(){
        return Cliente::find($this->cliente_id);
    }
}
