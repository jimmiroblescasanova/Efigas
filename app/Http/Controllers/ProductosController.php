<?php

namespace App\Http\Controllers;

use App\Imports\ProductosImport;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class ProductosController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('productos.index', [
            'productos' => Producto::where('tipoProducto', 1)->paginate(15),
        ]);
    }

    public function create()
    {
        return view('productos.create');
    }

    public function cargarProductos(Request $request)
    {
        $validator = Validator::make($request->file(), [
            'file' => ['file', 'mimes:xls,xlsx'],
        ]);

        if ($validator->fails())
        {
            return redirect()->back()->with('msg', 'El archivo tiene una extensión no aceptada');
        }

        $import = new ProductosImport();
        $import->import($request->file('file'));

        return 'OK';
    }

    public function cargarKits(Request $request)
    {
        return $request;
    }
}
