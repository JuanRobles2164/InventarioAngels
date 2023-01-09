<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVentasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('material_id');
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('kardex_id')->nullable();
            $table->double('valor_unitario');
            $table->double('cantidad');
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on('materials');
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->foreign('kardex_id')->references('id')->on('kardexes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ventas');
    }
}
