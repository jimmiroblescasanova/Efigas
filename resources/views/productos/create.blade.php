@extends('layouts.main')

@section('header')
    <div class="col-sm-6">
        <h1><i class="fas fa-user"></i> Cargar productos</h1>
    </div>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if(session()->has('msg') || $errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                                <span class="sr-only">Close</span>
                            </button>
                            <strong>Se presentaron algunos errores durante la carga:</strong>
                            @foreach($errors->messages() as $key => $error)
                                @php
                                    $fila = explode('.', $key);
                                @endphp
                                @foreach($error as $mensaje)
                                    <li>Fila: {{ $fila[0] }}: {{ $mensaje }}</li>
                                @endforeach
                            @endforeach
                            @if(session()->has('msg'))
                                <li>{{ session('msg') }}</li>
                            @endif
                            <span>Corrija los errores e intente cargar el archivo de nuevo.</span>
                        </div>
                    @endif
                    <form action="{{ route('producto.cargar.producto') }}" id="uploadProducts" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="file">Seleccionar archivo de productos</label>
                            <input type="file" class="form-control-file" name="file" id=file" required>
                            <small id="fileHelpId" class="form-text text-muted">Tipo de archivos aceptados: XLS, XLSX</small>
                        </div>
                        <button type="submit" id="submit" class="btn btn-primary btn-sm">Subir productos</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop

