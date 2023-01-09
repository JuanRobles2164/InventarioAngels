<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pagos extends Model
{
    use HasFactory;
    protected $table = 'pagos';
    protected $guarded = [];

    function factura(){
        return Factura::find($this->factura_id);
    }

    function cliente(){
        return Cliente::find($this->cliente_id);
    }

    function pagosByFactura(){
        return Factura::where('factura_id', $this->factura_id)->get();
    }

    static function facturasParaPagar(){
        $listado = DB::table('facturas')
                   ->leftJoin('pagos', 'pagos.factura_id', '=', 'facturas.id')
                   ->groupBy('facturas.id')
                   ->get('facturas.id', 'facturas.numero', 'pagos.id');
        return $listado;
    }


}
