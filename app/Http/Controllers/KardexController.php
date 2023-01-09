<?php

namespace App\Http\Controllers;

use App\Models\Kardex;
use App\Http\Requests\StoreKardexRequest;
use App\Http\Requests\UpdateKardexRequest;
use App\Models\Material;
use App\Models\TipoMovimiento;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Redirect;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Kardex::getLastKardexToAllMaterials();
        $allData = ['kardexes' => $list];
        return view("pages.kardex.index", $allData);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $materiales = Material::all();
        $tipos_movimiento = TipoMovimiento::all();
        $allData = ['materiales' => $materiales, 'tipos_movimiento' => $tipos_movimiento];
        return view("pages.kardex.create", $allData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKardexRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKardexRequest $request)
    {
        $data = $request->except('_token');
        $kardexArr = [

        ];
        $tipoMovimientoObj = TipoMovimiento::find($data['tipo_movimiento_id']);
        $kardexObj = new Kardex;
        //Si recien está creando los materiales
        if($data['tipo_movimiento_id'] == 1){
            $kardexArr = [
                'material_id' => $data['material_id'],
                'cantidad' => $data['cantidad'],
                'cantidad_total' => $data['cantidad'],
                'tipo_movimiento_id' => $tipoMovimientoObj->id,
                'estado' => 1,
            ];
            $kardexObj = $kardexObj->create($kardexArr);
        }else{
            //Si realizará cualquier otro tipo de movimiento, entonces lo ejecuta
            $kardexObj = Kardex::getLastKardexByMaterialId($data['material_id']);
            $kardexArr = [
                'material_id' => $data['material_id'],
                'cantidad' => $data['cantidad'],
                'cantidad_total' => (($kardexObj->cantidad_total) + ($data['cantidad'] * $tipoMovimientoObj->razon)),
                'tipo_movimiento_id' => $tipoMovimientoObj->id,
                'estado' => 1,
            ];
            $kardexObj = Kardex::create($kardexArr);
        }
        return Redirect::to(route('kardex.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function show(Kardex $kardex)
    {
        return view("pages.kardex.details");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function edit(Kardex $kardex)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKardexRequest  $request
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKardexRequest $request, Kardex $kardex)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kardex  $kardex
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kardex $kardex)
    {
        //
    }
}
