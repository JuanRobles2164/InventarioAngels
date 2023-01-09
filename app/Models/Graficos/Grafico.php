<?php

namespace App\Models\Graficos;

use Carbon\Carbon;
use Illuminate\Support\Str;

class Grafico {
    public $nombreId;
    public $type = 'line';
    public $data;
    public $options;
    public $plugins = [];

    public function __construct()
    {
        $this->data = new Data;
        $this->nombreId = Str::random(40);
    }

    public function setType($type){
        $this->type = $type;
    }

    public function setData($data){
        $this->data = $data;
    }
}