@extends('pages.reportes.plantillaReportePdf')
@inject('carbon', 'Carbon\Carbon')

@section('table')
    <table class="tabla">
        <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Nombre</strong></th>
                <th><strong>Nit</strong></th>
                <th><strong>Teléfono</strong></th>
                <th><strong>Correo electrónico</strong></th>
                <th><strong>Dirección</strong></th>
                <th><strong>Ingresado por</strong></th>
                <th><strong>Fecha última actualización</strong></th>
                <th><strong>Hora última actualización</strong></th>
        </thead>
        <tbody>
            @foreach ($registros as $registro)
                <tr>
                    <td>{{ $registro->id_proveedores }}</td>
                    <td>{{ $registro->nombre }}</td>
                    <td>{{ $registro->nit }}</td>
                    <td>{{ $registro->telefono }}</td>
                    @if ($registro->correo)
                        <td>{{ $registro->correo }}</td>
                    @else
                        <td>-</td>
                    @endif
                    @if ($registro->direccion)
                        <td>{{ $registro->direccion }}</td>
                    @else
                        <td>-</td>
                    @endif
                    <td>{{ $registro->name }}</td>
                    <td>{{ $carbon::parse($registro->updated_at)->format('d-m-Y') }}</td>
                    <td>{{ $carbon::parse($registro->updated_at)->format('h:i a') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
