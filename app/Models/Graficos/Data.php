<?php

namespace App\Models\Graficos;

class Data {
    public $labels = [];
    public $datasets = [];

    public function __construct()
    {
        $this->datasets = [];
        array_push($this->datasets, new Dataset);
    }

    public function addLabel($label){
        array_push($this->labels, $label);
    }

    //Recibe un array que contiene: label, data
    public function addDataSet($dataSet){
        $this->addLabel($dataSet['label']);
        $this->datasets[0]->addData($dataSet['data']);
    }

    public function setDataset($dataset){
        $this->datasets[0] = $dataset;
    }

}