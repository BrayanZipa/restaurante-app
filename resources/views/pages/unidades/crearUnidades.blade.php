@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
@stop

@section('content')

@stop

@section('css')
    <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/proveedores/unidadesCrear.js') }}"></script>

    {{-- @if(session('proveedor_actualizado'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'El proveedor <b>{{ session('proveedor_actualizado') }}</b> se ha actualizado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif --}}
@stop