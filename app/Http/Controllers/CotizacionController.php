<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use App\Mail\SendEstimationMail;
use App\Traits\GeneratePdfTrait;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class CotizacionController extends Controller
{
    use GeneratePdfTrait;

    public function __construct()
    {
        return $this->middleware('auth');
    }

    public function print(Cotizacion $estimation)
    {
        $pdf = $this->estimationToPdf($estimation);

        return $pdf->stream();
    }

    public function send(Cotizacion $estimation)
    {
        // Generar el documento PDF
        $pdf = $this->estimationToPdf($estimation);
        // Almacenar el PDF en disco
        $pdfName = $estimation->id . '-' . $estimation->fecha->format('dmYs');
        Storage::put('/pdf/' . $pdfName . '.pdf', $pdf->output());

        Mail::to($estimation->email)->queue(new SendEstimationMail($pdfName));

        Alert::success('Correcto', 'La cotización ha sido enviada correctamente');
        return redirect()->back();
    }
}
