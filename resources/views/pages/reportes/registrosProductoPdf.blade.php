@extends('pages.reportes.plantillaReportePdf')
@inject('carbon', 'Carbon\Carbon')

@section('table')
    <table class="tabla">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Estado</strong></th>
                <th><strong>Cantidad</strong></th>
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
                    @if ($registro->estado)
                        <td style="color: rgba(29, 97, 11, 0.826)">Ingreso</td>
                    @else
                        <td style="color: rgb(231, 1, 1)">Salida</td>
                    @endif
                    <td>{{ $registro->cantidad }}</td>
                    <td>{{ $registro->cantidad_producto }}</td>
                    @if ($registro->costo)
                        <td>{{ $registro->costo }}</td>
                    @else
                        <td>-</td>
                    @endif
                    @if ($registro->costo_unitario)
                        <td>{{ $registro->costo_unitario }}</td>
                    @else
                        <td>-</td>
                    @endif
                    @if ($registro->fecha_vencimiento)
                        <td>{{ $carbon::parse($registro->fecha_vencimiento)->format('d-m-Y') }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $carbon::parse($registro->fecha)->format('d-m-Y') }}</td>
                    <td>{{ $carbon::parse($registro->fecha)->format('h:i a') }}</td>
                    <td>{{ $registro->name }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
