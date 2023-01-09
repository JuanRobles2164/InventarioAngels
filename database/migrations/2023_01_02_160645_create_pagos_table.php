<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pagos', function (Blueprint $table) {
            $table->id();
            $table->double('monto');
            $table->double('restante');
            $table->unsignedBigInteger('factura_id');
            $table->unsignedBigInteger('cliente_id');
            //Activo
            $table->integer('estado')->default(1);
            $table->timestamps();
            $table->foreign('factura_id')->references('id')->on('facturas');
            $table->foreign('cliente_id')->references('id')->on('clientes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pagos');
    }
}
