<?php

namespace Database\Seeders;

use App\Models\TipoMovimiento;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMovimientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tipo_movimientos')
        ->insert([
            [
                'id' => 1,
                'nombre' => "Creación",
                'descripcion' => "Creación de un material en el sistema",
                "razon" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                'id' => 2,
                'nombre' => "Venta",
                'descripcion' => "Venta de un material en el sistema concretado en una factura",
                "razon" => -1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ],
            [
                'id' => 3,
                'nombre' => "Entrada",
                'descripcion' => "Entrada de un material en el sistema",
                "razon" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now()
            ]
        ]);
    }
}
