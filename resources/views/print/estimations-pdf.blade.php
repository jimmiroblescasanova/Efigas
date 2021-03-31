<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cotización</title>
    <style>
        .container {
            width: 100%;
        }

        /* Estilos para las secciones */
        .encabezado,
        .cuerpo,
        .pie {
            vertical-align: top;
        }

        .main-table {
            /*border: 1px solid;
            border-radius: 10px;*/
            margin: 0 auto;
            width: 100%;
        }

        .rows-table {
            /* border: 2px solid #0956a0;
            border-collapse: collapse;
            border-spacing: 0; */
            margin-top: 35px;
            text-align: left;
            width: 100%;
        }

        .rows-table > thead {
            text-align: center;
        }
        .rows-table > tbody {
            vertical-align: top;
        }

        .logo {
            margin-bottom: 30px;
        }

        .cuerpo-titulo {
            background-color: #9c9c9c;
            border-radius: 10px;
            color: white;
            margin: 10px auto;
            padding: 3px;
            text-align: center;
            width: 80%;
            display:block;
        }

        .cliente {
            margin: 1em;
        }

        span {
            display: block;
        }

        .total {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }

    </style>
</head>

<body>
    <div class="container">
        <table class="main-table">
            <tr class="encabezado">
                <td style="width: 75%;">
                    <div class="logo">
                        <img src="{{ asset('logo_new.jpg') }}" alt="Efigas SMART" width="300px">
                    </div>
                    <div class="cliente">
                        <div class="cuerpo-titulo">Datos del cliente</div>
                        <span>Cliente: {{ $estimation->nombre }}</span>
                        <span>Dirección: {{ $estimation->direccion }}</span>
                    </div>
                </td>
                <td>
                    <span>Folio: {{ $estimation->id }}</span>
                    <span>{{ $estimation->fecha->format('d/m/Y') }}</span>
                </td>
            </tr>
            <tr class="cuerpo">
                <td colspan="2">
                    <div class="cuerpo-titulo">Productos cotizados</div>
                    <table class="rows-table">
                        <thead>
                            <tr>
                                <th style="width: 15%;">Cantidad</th>
                                <th>Nombre del producto</th>
                                <th style="width: 15%">Precio</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($estimation->movimientos as $row)
                                <tr>
                                    <td>{{ $row->cantidad }}</td>
                                    <td>{{ $row->producto->nombre }}</td>
                                    <td style="text-align: right; padding-right: 10px;">$ {{ number_format($row->precio, 2) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="cuerpo-titulo">Notas</div>
                    <div>&nbsp;</div>
                </td>
                <td>
                    <div class="cuerpo-titulo">Total</div>
                    <div class="total">$ {{ $estimation->grand_total }}</div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
