<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kardex extends Model
{
    use HasFactory;
    protected $table = 'kardexes';
    protected $guarded = [];

    function tipo_movimiento(){
        return TipoMovimiento::find($this->tipo_movimiento_id);
    }

    static function getLastKardexByMaterialId($materialId){
        $entity = DB::table('kardexes')
                    ->where("material_id", $materialId)
                    ->orderBy('id', 'desc')
                    ->first();
        return $entity;
    }

    static function getLastKardexToAllMaterials(){
        $listIds = DB::table('kardexes')
                ->select('material_id')
                ->groupBy('material_id')
                ->get();
        $list = [];
        foreach($listIds as $li){
            $kardexEntity = Kardex::getLastKardexByMaterialId($li->material_id);
            $kardexEntity = new Kardex([
                'id' => $kardexEntity->id,
                'material_id' => $kardexEntity->material_id,
                'cantidad' => $kardexEntity->cantidad,
                'cantidad_total' => $kardexEntity->cantidad_total,
                'tipo_movimiento_id' => $kardexEntity->tipo_movimiento_id,
                'estado' => $kardexEntity->estado
            ]);
            array_push($list, $kardexEntity);
        }
        return $list;
    }

    function material(){
        return Material::find($this->material_id);
    }
}
