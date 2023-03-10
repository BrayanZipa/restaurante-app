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

        td{
            border: rgb(0, 0, 0) 1px solid;
        } 
        th {
            border: rgb(3, 3, 3) 1px solid;
            background-color: rgb(255, 129, 3)
        }
        div.imagenes, h2 {
            margin-top: 10px;
        }

        /* img.pollo {
            height: 80px;
            margin-top: 10px;
            margin-bottom: 10px;
        } */

        div.info-app {
            display: inline-block;
        }

        /* div.contenedor-logo {
            width: 45%;
        }

        img.logo-app {
            height: 45px;
            margin-top: 25px;
        } */

        div.contenedor-fecha {
            width: 50%;
        }

        p {
            margin: -15px 0px 3px 0px;
         
        }
    </style>
</head>

<body>
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
                        <img class="pollo" src="{{ public_path('Image/pollo.png') }}"
                                alt="">

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
        @yield('table')
    </main>
</body>

</html>
