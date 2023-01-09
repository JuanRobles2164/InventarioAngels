<?php

namespace App\Http\Controllers;

use App\Models\TipoMovimiento;
use App\Http\Requests\StoreTipoMovimientoRequest;
use App\Http\Requests\UpdateTipoMovimientoRequest;

class TipoMovimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreTipoMovimientoRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTipoMovimientoRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function show(TipoMovimiento $tipoMovimiento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoMovimiento $tipoMovimiento)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTipoMovimientoRequest  $request
     * @param  \App\Models\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTipoMovimientoRequest $request, TipoMovimiento $tipoMovimiento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoMovimiento  $tipoMovimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoMovimiento $tipoMovimiento)
    {
        //
    }
}
