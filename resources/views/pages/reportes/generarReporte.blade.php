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
                    <form id="formCrearProveedor" action="{{ route('guardarProveedor') }}" method="get">
                        <input type="hidden" id="inputFormato" name="formato">
                        <div class="card-body">
                            <div class="row justify-content-center align-items-center">



                                <div class="col-sm-12 col-md-9">
                                    <div class="form-group">
                                        <label for="selectTipoReporte">Selecione el tipo de reporte</label>
                                        <select id="selectTipoReporte" class="form-control" name="tipoReporte">
                                            <option value="" disabled selected>Tipo de reporte</option>
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

@section('css')
@stop

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/reportes/generarReporte.js') }}"></script>
@stop
