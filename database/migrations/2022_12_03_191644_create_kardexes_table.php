<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKardexesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kardexes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("material_id");
            $table->double("cantidad");
            $table->double("cantidad_total");
            $table->unsignedBigInteger("tipo_movimiento_id");
            $table->integer("estado");
            $table->timestamps();

            $table->foreign('material_id')->references('id')->on("materials");
            $table->foreign('tipo_movimiento_id')->references('id')->on('tipo_movimientos');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kardexes');
    }
}
