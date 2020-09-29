@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1>Alta de medidor</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form role="form" action="{{ route('measurers.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="serial_number">Número de serie</label>
                                    <input type="text"
                                           class="form-control {{ $errors->first('serial_number') ? 'is-invalid' : '' }}"
                                           name="serial_number"
                                           id="serial_number"
                                           placeholder="Número de serie"
                                           value="{{ old('serial_number') }}">
                                    {!! $errors->first('serial_number', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="model">Modelo</label>
                                    <input type="text"
                                           class="form-control {{ $errors->first('model') ? 'is-invalid' : '' }}"
                                           name="model"
                                           id="model"
                                           placeholder="Modelo"
                                           value="{{ old('model') }}">
                                    {!! $errors->first('model', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="actual_measure">Consumo actual</label>
                                    <input type="text"
                                           class="form-control {{ $errors->first('actual_measure') ? 'is-invalid' : '' }}"
                                           name="actual_measure"
                                           id="actual_measure"
                                           placeholder="Consumo actual"
                                           value="{{ old('actual_measure') }}">
                                    {!! $errors->first('actual_measure', '<div class="invalid-feedback">:message</div>') !!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-6">
                                <button type="submit" class="btn btn-sm btn-primary btn-block-xs-only"><i class="fas fa-save"></i> Guardar</button>
                            </div>
                            <div class="col-sm-6">
                                <button type="button" onclick="history.back();" class="btn btn-sm btn-danger btn-block-xs-only float-sm-right"><i class="fas fa-hand-point-left"></i> Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
