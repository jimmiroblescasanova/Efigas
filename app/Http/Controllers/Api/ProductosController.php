<?php

namespace App\Http\Controllers\Api;

use App\Producto;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductosResource;
use Illuminate\Support\Facades\Request;


class ProductosController extends Controller
{
    public function index()
    {
        $productType = request('type', '2');
        if (!in_array($productType, ['1', '2']))
        {
            $productType = '1';
        }

        $queryResults = Producto::where('tipoProducto', $productType)
            ->when(Request::get('search'), function($query) {
                $query->where('nombre', 'LIKE', '%'.Request::get('search').'%')
                    ->orWhere('codigo', 'LIKE', '%'.Request::get('search').'%');
            })->paginate(20);

        return ProductosResource::collection($queryResults);

    }
}
