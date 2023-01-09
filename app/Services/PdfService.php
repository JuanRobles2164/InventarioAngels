<?php
namespace App\Services;

use Illuminate\Support\Facades\Log;

class PdfService{

    /**
     * @param Array $allData
     */
    public static function generateFacturaPDF($allData){
        //cliente
        //factura
        //ventas

        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);
        $pdf = \PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);
        $pdf = $pdf->loadView("pdfs/factura", $allData);

        return $pdf;
    }
}