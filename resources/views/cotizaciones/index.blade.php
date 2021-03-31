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
    @livewire('estimations.index')
@stop
