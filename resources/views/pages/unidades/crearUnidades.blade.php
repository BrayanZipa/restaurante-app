@extends('adminlte::page')

@section('title', 'Unidades')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div class="row">
            <div class="col-md-3 col-sm-12">
                <div class="card card-orange ml-n3 mr-n1">
                    <div class="card-header">
                        <h3 class="card-title">Registrar nueva unidad</h3>
                    </div>
                    <form id="formCrearUnidad" action="{{ route('guardarUnidad') }}" method="POST">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">

                                    <label for="nombreUnidad">Ingrese el nombre de la unidad</label>
                                    <input type="text" id="nombreUnidad" class="form-control @error('unidad') is-invalid @enderror" name="unidad" value="{{ old('unidad') }}" placeholder="Nombre">
                                    @error('unidad')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>   
                                    @enderror

                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-block btn-success">Registrar</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-md-9 col-sm-12">
                <div class="card card-orange ml-n1 mr-n3">
                    <div class="card-header">
                        <h3 class="card-title">Listado de unidades</h3>
                    </div>
                    <div class="card-body">
                        <table id="tabla_unidades" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Unidad</th>
                                    <th>Editar</th>
                                    <th>Eliminar</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

@stop

@section('css')
    <!-- Token de Laravel -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
@stop

@section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/unidades/unidadesCrear.js') }}"></script>

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