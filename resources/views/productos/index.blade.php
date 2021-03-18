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
            <productos-component></productos-component>
        </div>
    </div>
@stop

@section('scripts')

@stop
