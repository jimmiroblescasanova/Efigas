@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1><i class="fas fa-user"></i> Nueva Cotización</h1>
    </div>
@stop

@section('content')
    <livewire:estimations.create />
@stop
