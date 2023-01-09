<?php

namespace App\Http\Controllers;

use App\Models\Graficos\Grafico;
use App\Services\Reportes\VentasReportesService;
use Illuminate\Http\Request;

class ReportesController extends Controller
{
    /**
     * Trae la vista de reportes
     *
     * @param  \Illuminate\Http\Request;  $request
     * @return \Illuminate\Http\Response
     */
    public function facturas(Request $request){
        $graficos = [];
        //if(isset($request->fecha_inicio)){
            $grafico = new Grafico;
            $grafico->setType('bar');
            $objReportes = new VentasReportesService();
            $allData = $objReportes->getClienteMaxCompra();
            $grafico->setData($allData);
            array_push($graficos, $grafico);

            $grafico2 = new Grafico;
            $grafico2->setType('doughnut');
            $dataGrafico2 = $objReportes->productosVendidos();
            $grafico2->setData($dataGrafico2);
            array_push($graficos, $grafico2);

            

        //}
        return view('pages.factura.reportes', ['graficos' => collect($graficos)]);
    }

}
