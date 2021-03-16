@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1><i class="fas fa-user"></i> Productos</h1>
    </div>
    <div class="col-sm-6">
        <a href="{{ route('producto.cargar') }}" class="btn btn-sm btn-primary float-sm-right">Cargar productos</a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    Lista de productos
                </div>
                <div class="card-body p-0">
                    <productos-component></productos-component>


                    {{--<table class="table table-striped table-sm">
                        <tr>
                            <th>Código</th>
                            <th>Nombre</th>
                            <th>Precio</th>
                            <th>Edición</th>
                        </tr>
                        @forelse($productos as $producto)
                            <tr>
                                <td>{{ $producto->codigo }}</td>
                                <td>{{ $producto->nombre }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td></td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4">No existen registros en la base de datos.</td>
                            </tr>
                        @endforelse
                    </table>--}}
                </div>
                <div class="card-footer">
                    {{--{{ $productos->links() }}--}}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

@stop
