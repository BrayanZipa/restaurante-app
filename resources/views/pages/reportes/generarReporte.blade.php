@extends('adminlte::page')

@section('title', '| Reportes')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">

    </section>
@stop

@section('css')
@stop

{{-- @section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true) --}}

@section('js')
    <script src="{{ asset('js/reportes/generarReporte.js') }}"></script>
@stop
