@extends('adminlte::page')

@section('title', '| Reportes')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-sm-12 col-md-8 col-lg-7">

                <div id="tarjetaProveedores" class="card card-dark mx-n3">
                    <div class="card-header">
                        <h3 class="card-title">Generar reportes</h3>
                    </div>
                    <form id="formReportes" action="{{ route('exportarReportes') }}" method="GET">
                        <input type="hidden" id="inputFormato" name="formato">

                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">
                                <div class="col-sm-12 col-md-9">
                                    <div class="form-group">
                                        <label for="selectTipoReporte">Selecione el tipo de reporte</label>
                                        <select id="selectTipoReporte" class="form-control" name="tipoReporte">
                                            <option value="" disabled selected>Tipo de reporte</option>
                                            <option value="1">Reporte de listado proveedores</option>
                                            <option value="2">Reporte individual de pedidos de proveedor</option>
                                            <option value="3">Reporte de listado productos</option>
                                            <option value="4">Reporte individual de registros de producto</option>
                                            <option value="5">Reporte de registros de inventario</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row justify-content-center align-items-center mt-3">
                                <div id="filtroAnio" class="filtros col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectAnio">Filtrar por año</label>
                                        <select id="selectAnio" name="anio"
                                            class="filtro-select form-control">
                                            <option selected="selected" value="" disabled>Año</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="filtroMes" class="filtros col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectMes">Filtrar por mes</label>
                                        <select id="selectMes" name="mes"
                                            class="filtro-select form-control {{ $errors->has('mes') ? 'is-invalid' : '' }}">
                                            <option selected="selected" value="" disabled>Mes</option>
                                            <option value="1">Enero</option>
                                            <option value="2">Febrero</option>
                                            <option value="3">Marzo</option>
                                            <option value="4">Abril</option>
                                            <option value="5">Mayo</option>
                                            <option value="6">Junio</option>
                                            <option value="7">Julio</option>
                                            <option value="8">Agosto</option>
                                            <option value="9">Septiembre</option>
                                            <option value="10">Octubre</option>
                                            <option value="11">Noviembre</option>
                                            <option value="12">Diciembre</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="filtroEstadoProducto" class="filtros col-md-6 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectEstadoProducto">Filtrar por estado del producto</label>
                                        <select id="selectEstadoProducto" name="estadoProducto" class="filtro-select form-control">
                                            <option selected="selected" value="" disabled>Estado producto</option>
                                            <option value="1">Alto</option>
                                            <option value="2">Bajo</option>
                                            <option value="3">Escaso</option>
                                            <option value="4">Todo</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="filtroEstado" class="filtros col-md-3 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectEstado">Filtrar por estado</label>
                                        <select id="selectEstado" name="estado" class="filtro-select form-control">
                                            <option selected="selected" value="" disabled>Cambiar</option>
                                            <option value="1">Ingresos</option>
                                            <option value="2">Salidas</option>
                                            <option value="3">Todo</option>
                                        </select>
                                    </div>
                                </div>

                                <div id="filtroProveedor" class="filtros col-md-6 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectProveedor">Filtrar por proveedor</label>
                                        <select id="selectProveedor" name="proveedorId" class="filtro-select form-control">
                                            <option selected="selected" value="" disabled>Proveedor</option>
                                            @foreach ($proveedores as $proveedor)
                                                <option value="{{ $proveedor->id_proveedores }}"> {{ $proveedor->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div id="filtroProducto" class="filtros col-md-6 col-sm-12" style="display: none">
                                    <div class="form-group">
                                        <label for="selectProducto">Filtrar por producto</label>
                                        <select id="selectProducto" name="productoId" class="filtro-select form-control">
                                            <option selected="selected" value="" disabled>Producto</option>
                                            @foreach ($productos as $producto)
                                                <option value="{{ $producto->id_productos }}"> {{ $producto->nombre }}
                                                    {{ $producto->peso }} {{ $producto->abreviacion }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <div class="row justify-content-center">
                                <div class="col-6 col-md-4">
                                    <button type="button" id="btnExcel" class="btn btn-block btn-success">
                                        <i class="fas fa-file-excel mr-1"></i>
                                        Excel
                                    </button>
                                </div>
                                <div class="col-6 col-md-4">
                                    <button type="button" id="btnPdf" class="btn btn-block btn-danger">
                                        <i class="fas fa-file-pdf mr-1"></i>
                                        PDF
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@stop

@section('footer')
    @include('pages.footer')
@stop

@section('css')
@stop

@section('plugins.Select2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/reportes/generarReporte.js') }}"></script>
@stop
