<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        html {
            margin: 0.5cm 0.5cm;
            font-size: 12px;
        }

        body {
            margin: 2.1cm 0cm 0.1cm;
        }

        header {
            position: fixed;
            top: 0cm;
            left: 0cm;
            right: 0cm;
            height: 2cm;
            text-align: center;
            line-height: 30px;
        }

        th.titulos-encabezado {
            width: 20%;
            text-align: center;
        }

        .tabla {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%
        }

        td, th {
            border: black 1px solid;
        }

        div.imagenes, h2 {
            margin-top: 10px;
        }

        img.empresa {
            height: 40px;
            margin-top: 10px;
            margin-right: 10px;
        }

        div.info-app {
            display: inline-block;
        }

        div.contenedor-logo {
            width: 45%;
        }

        img.logo-app {
            height: 45px;
            margin-top: 25px;
        }

        div.contenedor-fecha {
            width: 50%;
        }

        p {
            margin: 0px 0px -4px;
        }
    </style>
</head>

<body>
    @inject('carbon', 'Carbon\Carbon')

    <header>
        <table class="tabla">
            <thead>
                <tr>
                    <th class="titulos-encabezado">
                        {{-- <div class="imagenes">
                            <img class="empresa" src="{{ public_path('assets/imagenes/aviomar.png') }}"
                                alt="Logo Aviomar">
                            <img class="empresa" src="{{ public_path('assets/imagenes/colvan.png') }}"
                                alt="Logo Colvan">
                            <img class="empresa" src="{{ public_path('assets/imagenes/snider.png') }}"
                                alt="Logo Snider">
                        </div> --}}
                    </th>
                    <th>
                        <h2>{{ $titulo }}</h2>
                    </th>
                    <th class="titulos-encabezado">
                        {{-- <div class="info-app contenedor-logo">
                            <img class="logo-app" src="{{ public_path('assets/imagenes/logo_reportes.png') }}" alt="Logo Visión">
                        </div> --}}
                        <div class="info-app contenedor-fecha">
                            <p>{{ $carbon::now()->format('d-m-Y') }}</p>
                            <p>{{ $carbon::now()->format('h:i:s A') }}</p>
                        </div>
                    </th>
                </tr>
            </thead>
        </table>
    </header>

    <main>
        <table class="tabla">
            <thead>
                <tr>
                    <th><strong>ID</strong></th>
                    <th><strong>Estado</strong></th>
                    <th><strong>Proveedor</strong></th>
                    <th><strong>Producto</strong></th>
                    <th><strong>Código</strong></th>
                    <th><strong>Cantidad</strong></th>
                    <th><strong>Última existencia</strong></th>
                    <th><strong>Costo</strong></th>
                    <th><strong>Costo unitario</strong></th>
                    <th><strong>Fecha vencimiento</strong></th>
                    <th><strong>Fecha registro</strong></th>
                    <th><strong>Hora registro</strong></th>
                    <th><strong>Ingresado por</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    @foreach ($registros as $registro)
                        <tr>
                            <td>{{ $registro->id_inventario }}</td>
                            @if( $registro->estado)
                                <td>Ingreso</td>
                            @else
                                <td>Salida</td>
                            @endif
                            <td>{{ $registro->proveedor }}</td>
                            <td>{{ $registro->producto }} {{ $registro->peso }} {{ $registro->abreviacion }}</td>
                            <td>{{ $registro->codigo }}</td>
                            <td>{{ $registro->cantidad }}</td>
                            <td>{{ $registro->cantidad_producto }}</td>
                            @if($registro->costo)
                                <td>{{ $registro->costo }}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($registro->costo_unitario)
                                <td>{{ $registro->costo_unitario }}</td>
                            @else
                                <td>-</td>
                            @endif
                            @if($registro->fecha_vencimiento)
                                <td>{{ $registro->fecha_vencimiento }}</td>
                            @else
                                <td>-</td>
                            @endif
                            <td>{{ $carbon::parse($registro->fecha)->format('d-m-Y') }}</td>
                            <td>{{ $carbon::parse($registro->fecha)->format('h:i a')}}</td>
                            <td>{{ $registro->name }}</td>
                        </tr>
                    @endforeach
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>
