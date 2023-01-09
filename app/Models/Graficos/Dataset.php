<?php

namespace App\Models\Graficos;

class Dataset{
    public $label = "Mejores clientes";
    public $data = [];

    public $backgroundColor = [];
    public $borderColor = [];
    public $borderWidth = 1;

    private $BACKGROUND_COLORS = [
        'rgba(255, 99, 132, 0.2)',
        'rgba(255, 159, 64, 0.2)',
        'rgba(255, 205, 86, 0.2)',
        'rgba(75, 192, 192, 0.2)',
        'rgba(54, 162, 235, 0.2)',
        'rgba(153, 102, 255, 0.2)',
        'rgba(201, 203, 207, 0.2)'
    ];

    private $BORDER_COLORS = [
        'rgb(255, 99, 132)',
        'rgb(255, 159, 64)',
        'rgb(255, 205, 86)',
        'rgb(75, 192, 192)',
        'rgb(54, 162, 235)',
        'rgb(153, 102, 255)',
        'rgb(201, 203, 207)'
    ];

    //Se añade un dato dentro del conjunto de datos, se le asigna un color tanto de relleno como de borde
    public function addData($dataSet){
        array_push($this->data, $dataSet);
        $position = rand(0, count($this->BACKGROUND_COLORS)-1);
        array_push($this->backgroundColor, $this->BACKGROUND_COLORS[$position]);
        array_push($this->borderColor, $this->BORDER_COLORS[$position]);
    }
}