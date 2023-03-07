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
                                            <option {{ old('tipoReporte') == '1' ? 'selected' : '' }} value="1">Reporte de listado proveedores</option>
                                            <option {{ old('tipoReporte') == '2' ? 'selected' : '' }} value="2">Reporte individual de pedidos de proveedor</option>
                                            <option {{ old('tipoReporte') == '3' ? 'selected' : '' }} value="3">Reporte de listado productos</option>
                                            <option {{ old('tipoReporte') == '4' ? 'selected' : '' }} value="4">Reporte individual de registros de producto</option>
                                            <option {{ old('tipoReporte') == '5' ? 'selected' : '' }} value="5">Reporte de registros de inventario</option>
                                            {{-- @foreach ($unidades as $unidad)
                                                <option value="{{ $unidad->id_unidades }}"
                                                    {{ $unidad->id_unidades == old('id_unidad') ? 'selected' : '' }}>
                                                    {{ $unidad->unidad }}
                                                </option>
                                            @endforeach --}}
                                        </select>
                                        {{-- @error('id_unidad')
                                            <span class="errorServidor invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror --}}
                                    </div>
                                </div>

                            </div>


                            <div class="row justify-content-center align-items-center mt-3">



                                    <div id="filtroAnio" class="filtros col-md-3 col-sm-12" style="display: none">
                                        <div class="form-group">
                                        <label for="selectAnio">Filtrar por año</label>

                                        {{-- <input type="hidden" id="retornoAnio" name="retornoAnio" value="{{ old('anio') }}"> --}}

                                            <select id="selectAnio" name="anio" class="filtro-select form-control {{ $errors->has('anio') ? 'is-invalid' : '' }}">
                                                <option selected="selected" value="" disabled>Año</option>
                                            </select>
                                            {{-- @if ($errors->has('anio')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('anio') }}
                                                </div>            
                                            @endif --}}
                                        </div>
                                    </div>

                                    <div id="filtroMes" class="filtros col-md-3 col-sm-12" style="display: none">
                                        <div class="form-group">
                                        <label for="selectMes">Filtrar por mes</label>
                                            <select id="selectMes" name="mes" class="filtro-select form-control {{ $errors->has('mes') ? 'is-invalid' : '' }}">
                                                <option selected="selected" value="" disabled>Mes</option>
                                                <option {{ old('mes') == '1' ? 'selected' : '' }} value="1">Enero</option>
                                                <option {{ old('mes') == '2' ? 'selected' : '' }} value="2">Febrero</option>
                                                <option {{ old('mes') == '3' ? 'selected' : '' }} value="3">Marzo</option>
                                                <option {{ old('mes') == '4' ? 'selected' : '' }} value="4">Abril</option>
                                                <option {{ old('mes') == '5' ? 'selected' : '' }} value="5">Mayo</option>
                                                <option {{ old('mes') == '6' ? 'selected' : '' }} value="6">Junio</option>
                                                <option {{ old('mes') == '7' ? 'selected' : '' }} value="7">Julio</option>
                                                <option {{ old('mes') == '8' ? 'selected' : '' }} value="8">Agosto</option>
                                                <option {{ old('mes') == '9' ? 'selected' : '' }} value="9">Septiembre</option>
                                                <option {{ old('mes') == '10' ? 'selected' : '' }} value="10">Octubre</option>
                                                <option {{ old('mes') == '11' ? 'selected' : '' }} value="11">Noviembre</option>
                                                <option {{ old('mes') == '12' ? 'selected' : '' }} value="12">Diciembre</option>
                                            </select>
                                            {{-- @if ($errors->has('mes')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('mes') }}
                                                </div>            
                                            @endif --}}
                                        </div>
                                    </div>

                                    <div id="filtroEstado" class="filtros col-md-3 col-sm-12" style="display: none">
                                        <div class="form-group">
                                        <label for="selectEstado">Filtrar por estado</label>

                                            <select id="selectEstado" name="estado" class="filtro-select form-control {{ $errors->has('estado') ? 'is-invalid' : '' }}">
                                                <option selected="selected" value="" disabled>Cambiar</option>
                                                <option {{ old('mes') == '1' ? 'selected' : '' }} value="1">Ingresos</option>
                                                <option {{ old('mes') == '2' ? 'selected' : '' }} value="2">Salidas</option>
                                                <option {{ old('mes') == '3' ? 'selected' : '' }} value="3">Todo</option>
                                            </select>
                                            {{-- @if ($errors->has('anio')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('anio') }}
                                                </div>            
                                            @endif --}}
                                        </div>
                                    </div>


                                    <div id="filtroProveedor" class="filtros col-md-6 col-sm-12" style="display: none">
                                        <div class="form-group">
                                        <label for="selectProveedor">Filtrar por proveedor</label>

                                            <select id="selectProveedor" name="proveedorId" class="filtro-select form-control {{ $errors->has('') ? 'is-invalid' : '' }}">
                                                <option selected="selected" value="" disabled>Proveedor</option>
                                                @foreach($proveedores as $proveedor)
                                                    <option value="{{ $proveedor->id_proveedores }}"> {{ $proveedor->nombre }}</option>
                                                @endforeach
                                            </select>
                                            {{-- @if ($errors->has('anio')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('anio') }}
                                                </div>            
                                            @endif --}}
                                        </div>
                                    </div>

                                    <div id="filtroProducto" class="filtros col-md-6 col-sm-12" style="display: none">
                                        <div class="form-group">
                                        <label for="selectProducto">Filtrar por producto</label>

                                            <select id="selectProducto" name="productoId" class="filtro-select form-control {{ $errors->has('') ? 'is-invalid' : '' }}">
                                                <option selected="selected" value="" disabled>Producto</option>
                                                @foreach($productos as $producto)
                                                    <option value="{{ $producto->id_productos }}"> {{ $producto->nombre }} {{ $producto->peso }} {{ $producto->abreviacion }}</option>
                                                @endforeach
                                            </select>
                                            {{-- @if ($errors->has('anio')) 
                                                <div class="invalid-feedback">
                                                    {{ $errors->first('anio') }}
                                                </div>            
                                            @endif --}}
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
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/reportes/generarReporte.js') }}"></script>
@stop
