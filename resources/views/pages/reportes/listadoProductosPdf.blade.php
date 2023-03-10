@extends('pages.reportes.plantillaReportePdf')
@inject('carbon', 'Carbon\Carbon')

@section('table')
    <table class="tabla">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Código</strong></th>
                <th><strong>Peso</strong></th>
                <th><strong>Total en existencia</strong></th>
                <th><strong>Estado</strong></th>
                <th><strong>Proveedor</strong></th>
                <th><strong>Ingresado por</strong></th>
                <th><strong>Fecha última actualización</strong></th>
                <th><strong>Hora última actualización</strong></th>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->id_productos }}</td>
                    <td>{{ $registro->nombre }}</td>
                    <td>{{ $registro->codigo }}</td>
                    <td>{{ $registro->peso }} {{ $registro->abreviacion }}</td>
                    <td>{{ $registro->total }}</td>
                    @if ($registro->total >= 100)
                        <td style="color: rgba(29, 97, 11, 0.826)">Alto</td>
                    @elseif ($registro->total > 20 && $registro->total < 100)
                        <td style="color: rgb(255, 129, 3)">Bajo</td>
                    @else
                        <td style="color: rgb(231, 1, 1)">Escaso</td>
                    @endif
                    <td>{{ $registro->proveedor }}</td>
                    <td>{{ $registro->name }}</td>
                    <td>{{ $carbon::parse($registro->updated_at)->format('d-m-Y') }}</td>
                    <td>{{ $carbon::parse($registro->updated_at)->format('h:i a') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
