<?php

namespace App\Traits;

trait GeneratePdfTrait
{
    public function estimationToPdf($docto)
    {
        // Generar el PDF
        $pdf = \PDF::loadView('print.estimations-pdf', [
            'estimation' => $docto,
        ]);
        // Establece el tamaño y orientación del papel
        $pdf->setPaper('A4', 'portrait');

        return $pdf;
    }
}
