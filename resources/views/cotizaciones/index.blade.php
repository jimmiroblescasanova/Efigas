@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1><i class="fas fa-user"></i> Cotizaciones</h1>
    </div>
    <div class="col-sm-6">
        <a href="{{ route('cotizacion.create') }}" class="btn btn-primary btn-sm float-sm-right btn-block-xs-only">
            <i class="fas fa-pencil-alt"></i> Crear nuevo
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <table class="table table-striped table-bordered table-sm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Cliente</th>
                            <th>Total</th>
                            <th>Ver</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($cotizaciones as $cotizacion)
                        <tr>
                            <td>{{ $cotizacion->id }}</td>
                            <td>{{ $cotizacion->nombre }}</td>
                            <td class="text-right">{{ $cotizacion->grand_total }}</td>
                            <td></td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                    {{ $cotizaciones->links() }}
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

@stop
