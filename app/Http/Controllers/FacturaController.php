<?php

namespace App\Http\Controllers;

use App\Models\Factura;
use App\Http\Requests\StoreFacturaRequest;
use App\Http\Requests\UpdateFacturaRequest;
use App\Models\Cliente;
use App\Models\Graficos\Grafico;
use App\Models\Kardex;
use App\Models\Material;
use App\Models\Venta;
use App\Services\PdfService;
use App\Services\Reportes\VentasReportesService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class FacturaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listado = Factura::orderBy('id', 'desc')->paginate(10);
        $allData = ['facturas' => $listado];
        return view("pages.factura.index", $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //obtiene los materiales disponibles para la venta
        $materiales = Material::all();
        $clientes = Cliente::all();
        $allData = [
                'materiales' => $materiales,
                'clientes' => $clientes
            ];
        return view("pages.factura.create", $allData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreFacturaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFacturaRequest $request)
    {

        $nuevosKardex = [];
        $productosFactura = [];
        $total = 0;
        $i = 0;
        $facturaObj = new Factura();
        $ventasArr = [];

        for($i = 0; $i < count($request->cantidad_material); $i++){
            $total += ($request->cantidad_material[$i] * $request->valor_unitario_material[$i]);
        }
        $pago = false;
        if(isset($request->pago)){
            $pago = $request->pago;
        }

        //Crea la entidad de la factura y las ventas

        $facturaArr = [
            'numero' => Carbon::now()->getTimestamp(),
            'fecha' => Carbon::today(),
            'fecha_pago' => Carbon::today(),
            //3-Creado
            //4-Pagado
            'estado' => 4,
            'total' => $total,
            'cliente_id' => $request->cliente
        ];
        //Crea la factura
        $facturaObj = $facturaObj->create($facturaArr);

        for($i = 0; $i < count($request->material_id); $i++){
            $ventasObj = [
                'material_id' => $request->material_id[$i],
                'factura_id' => $facturaObj->id,
                'valor_unitario' => $request->valor_unitario_material[$i],
                'cantidad' => $request->cantidad_material[$i],
                //'estado' => 1,
            ];
            //Crea las ventas asociadas a esa factura
            $ventasObj = Venta::create($ventasObj);
            array_push($ventasArr, $ventasObj);
        }

        $error = false;
        $errorMensajes = [];
        if(isset($request->inventario)){
            for($i = 0; $i < count($request->material_id); $i++){
                $kardexObj = Kardex::getLastKardexByMaterialId($request->material_id[$i]);
                //Si ya hay un historial de registros, debe verificar que hayan existencias
                if($kardexObj != null){
                    $nuevaCantidad = ($request->cantidad_material[$i] * $request->valor_unitario_material[$i]);
                    $newKardexObjArr = [
                        'material_id' => $kardexObj->material_id,
                        //1 -> Creación
                        //2 -> Venta
                        //3 -> Entrada
                        'tipo_movimiento' => 2,
                        'cantidad' => ($request->cantidad_material[$i] * $request->valor_unitario_material[$i]),
                        'cantidad_total' => $kardexObj->cantidad_total - $nuevaCantidad,
                        'estado' => 1
                    ];
                    array_push($nuevosKardex, $newKardexObjArr);
                }else{
                    //No puede vender un producto que no esté registrado en el sistema
                    $error = true;
                    $str = "No puede vender el producto " + Material::find($request->material_id[$i])->nombre + ". No hay existencias";
                    array_push($errorMensajes, $str);
                }
            }
        }
        //Si no posee errores
        $kardexesEntidades = [];
        if($error == false){
            if((isset($request->inventario) && $request->inventario != false)){
                foreach ($nuevosKardex as $i){
                    $newKardexes = new Kardex;
                    $newKardexes = $newKardexes->create($i);
                    array_push($kardexesEntidades, $newKardexes);
                }
                //Asocia las ventas a cada movimiento de Kardex
                for($i = 0; $i < count($ventasArr); $i++){
                    $objVentas = $ventasArr[$i];
                    $objVentas->kardex_id = $kardexesEntidades[$i]->id;
                    $objVentas->save();
                }
            }
        }else{
            //Hay errores
            return back()->withErrors($errorMensajes);
        }

        $pdf = PdfService::generateFacturaPDF([
            'cliente' => Cliente::find($request->cliente),
            'factura' => $facturaObj,
            'ventas' => $ventasArr
        ]);
        return $pdf->download("factura.pdf");

    }

    public function validar(Request $request){
        $factura = Factura::find($request->factura);
        $ventas = $factura->ventas();
        $error = false;
        foreach($ventas as $v){
            $kardexMaterial = Kardex::getLastKardexByMaterialId($v->material_id);
            if($kardexMaterial != null){
                $kardexObj = Kardex::create([
                    'cantidad' => $v->cantidad,
                    'cantidad_total' => ($kardexMaterial->cantidad_total) - $v->cantidad,
                    //el movimiento que se registrará siempre es una venta
                    'tipo_movimiento_id' => 2,
                    'estado' => 1,
                    'material_id' => $v->material_id
                ]);
                $v->kardex_id = $kardexObj->id;
                $v->save();
            }else{
                $error = true;
                break;
            }
        }
        //Si hay errores, no puede validar la factura
        if($error){
            return back()->withErrors("No es posible validar la factura, hay errores en el inventario");
        }
        //cambia el estado de la factura de 4 a 5
        $factura->estado = 5;
        $factura->save();
        return Redirect::to(route("factura.index"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function show(Factura $factura)
    {
        $pdf = PdfService::generateFacturaPDF([
            'cliente' => Cliente::find($factura->cliente_id),
            'factura' => $factura,
            'ventas' => $factura->ventas()
        ]);
        return $pdf->stream();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function edit(Factura $factura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateFacturaRequest  $request
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateFacturaRequest $request, Factura $factura)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Factura  $factura
     * @return \Illuminate\Http\Response
     */
    public function destroy(Factura $factura)
    {
        //
    }
    
}