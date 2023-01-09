<?php

namespace App\Enums;

class UnidadesEnum{
    protected static $unidades = [];

    static function fillEnum(){
        self::$unidades = [];
        array_push(self::$unidades, "SELECCIONE UNA UNIDAD");
        array_push(self::$unidades, "UNIDADES");
        array_push(self::$unidades, "CENTIMETROS");
        array_push(self::$unidades, "METROS");
        array_push(self::$unidades, "GRAMOS");
        array_push(self::$unidades, "LIBRAS");
        array_push(self::$unidades, "KILOGRAMOS");
    }

    static function getEnum(){
        self::fillEnum();
        return self::$unidades;
    }
}