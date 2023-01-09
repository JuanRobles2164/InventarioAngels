<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\FacturaController;
use App\Http\Controllers\KardexController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PagosController;
use App\Http\Controllers\ReportesController;
use App\Http\Controllers\VentaController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function(){
    return Redirect::to('/material');
});

Route::resource('material', MaterialController::class);
Route::resource('cliente', ClienteController::class)->except(['destroy']);
Route::resource('factura', FacturaController::class);

Route::name("factura.")->group(function(){
    Route::controller(FacturaController::class)->group(function(){
        Route::get('/factura/validar/{factura}', 'validar')->name("validar");
    });
});

Route::get('reportes/facturas', [ReportesController::class, 'facturas'])->name('reportes.facturas');

Route::resource('kardex', KardexController::class)->except(['edit', 'update', 'destroy']);
Route::resource('venta', VentaController::class);

Route::resource('pago', PagosController::class);

