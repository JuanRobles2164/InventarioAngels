<?php
namespace App\Services\Reportes;

use App\Models\Graficos\Data;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


/**
 * Contiene los métodos para obtener toda la data relacionada a los reportes de ventas
 * Estos reportes son:
 * getClienteMaxCompra(): Obtiene el cliente que más compró en una sola factura
 */
class VentasReportesService{

    /**
     * @param $fecha_inicial Carbon La fecha inicial debe ser un objeto de tipo Carbon
     * @param $fecha_inicial Carbon La fecha final debe ser un objeto de tipo Carbon
     * @return Data
     */
    public function getClienteMaxCompra($fecha_inicial = '', $fecha_final = ''){
        if($fecha_inicial == ''){
            $fecha_inicial = Carbon::now()->addMonths(-1);
        }
        if($fecha_final == ''){
            $fecha_final = Carbon::now();
        }

        $listado = DB::table('facturas')
            ->join('clientes', 'facturas.cliente_id', '=','clientes.id')
            ->select(DB::raw("SUM(total) as total"), 'clientes.razon_social as razon_social')
            ->groupBy('razon_social')
            ->orderByDesc('total')
            ->get();

        $dataobj = new Data;
        if($listado != null){
            foreach($listado as $i){
                $dataobj->addLabel($i->razon_social);
                $dataobj->addDataSet([
                    'label' => $i->razon_social,
                    'data' => $i->total
                ]);
            }
        }

        return $dataobj;
    }



    public function productosVendidos($fecha_inicial = '', $fecha_final = ''){

        if($fecha_inicial == ''){
            $fecha_inicial = Carbon::now()->addMonths(-1);
        }
        if($fecha_final == ''){
            $fecha_final = Carbon::now();
        }

        $listado = DB::table('ventas')
            ->join('materials', 'ventas.material_id', '=','materials.id')
            ->select(DB::raw("SUM(VENTAS.VALOR_UNITARIO*VENTAS.CANTIDAD) as total"), 'materials.nombre as nombre')
            ->groupBy('ventas.material_id', 'nombre')
            ->orderByDesc('total')
            ->get();

        $dataobj = new Data;
        if($listado != null){
            foreach($listado as $i){
                $dataobj->addLabel($i->nombre);
                $dataobj->addDataSet([
                    'label' => $i->nombre,
                    'data' => $i->total
                ]);
            }
        }

        return $dataobj;

    }
}