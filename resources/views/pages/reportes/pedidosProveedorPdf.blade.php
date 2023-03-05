@extends('pages.reportes.plantillaReportePdf')
@inject('carbon', 'Carbon\Carbon')

@section('table')
    <table class="tabla">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Producto</strong></th>
                <th><strong>Cantidad ingresada</strong></th>
                <th><strong>Última exitencia</strong></th>
                <th><strong>Costo</strong></th>
                <th><strong>Costo unitario</strong></th>
                <th><strong>Fecha vencimiento</strong></th>
                <th><strong>Fecha registro</strong></th>
                <th><strong>Hora registro</strong></th>
                <th><strong>Ingresado por</strong></th>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->id_inventario }}</td>
                    <td>{{ $registro->producto }} {{ $registro->peso }} {{ $registro->abreviacion }}</td>
                    <td>{{ $registro->cantidad }}</td>
                    <td>{{ $registro->cantidad_producto }}</td>
                    <td>{{ $registro->costo }}</td>
                    <td>{{ $registro->costo_unitario }}</td>
                    <td>{{ $carbon::parse($registro->fecha_vencimiento)->format('d-m-Y') }}</td>
                    <td>{{ $carbon::parse($registro->fecha)->format('d-m-Y') }}</td>
                    <td>{{ $carbon::parse($registro->fecha)->format('h:i a') }}</td>
                    <td>{{ $registro->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection