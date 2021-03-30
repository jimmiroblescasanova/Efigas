<?php

namespace App\Http\Controllers;

use App\Cotizacion;
use Illuminate\Http\Request;

class CotizacionController extends Controller
{
    public function index()
    {
        return view('cotizaciones.index', [
            'cotizaciones' => Cotizacion::orderByDesc('id')->paginate(),
        ]);
    }

    public function create()
    {
        return view('cotizaciones.create');
    }
}
