@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1><i class="fas fa-user"></i> Tanques</h1>
    </div>
    <div class="col-sm-6">
        <a href="{{ route('tanks.create') }}" class="btn btn-primary btn-sm float-sm-right btn-block-xs-only">
            <i class="fas fa-pencil-alt"></i> Crear nuevo
        </a>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <table class="table">
                        <thead>
                        <tr>
                            <th>Marca</th>
                            <th>Modelo</th>
                            <th>Numero de serie</th>
                            <th>Capacidad</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($tanks as $tank)
                            <tr>
                                <td>{{ $tank->brand }}</td>
                                <td>{{ $tank->model }}</td>
                                <td>{{ $tank->serial_number }}</td>
                                <td>{{ $tank->capacity }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop

@section('scripts')

@stop
