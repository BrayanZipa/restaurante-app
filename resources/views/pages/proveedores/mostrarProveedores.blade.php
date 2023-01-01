@extends('adminlte::page')

@section('title', '| Proveedores')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="formEditarProveedor" style="display: none">
            <form id="formularioProveedor" action="" method="post">
                @csrf
                @method('put')
                <div class="card card-dark mx-n3">
                    <div class="card-header">
                        <h3 class="card-title">Consultar proveedor</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                            <button type="button" id="btnOcultar" class="btn btn-tool"><i
                                    class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <input type="hidden" id="idProveedor" name="id" value="{{ old('id') }}">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombreProveedor">Nombre</label>
                                    <input type="text" id="nombreProveedor"
                                        class="proveedor form-control @error('nombre') is-invalid @enderror" name="nombre"
                                        value="{{ old('nombre') }}" autocomplete="off" placeholder="Nombre">
                                    @error('nombre')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nitProveedor">Nit o identificador</label>
                                    <input type="text" id="nitProveedor"
                                        class="proveedor form-control @error('nit') is-invalid @enderror" name="nit"
                                        value="{{ old('nit') }}" autocomplete="off" placeholder="Nit"
                                        onkeypress="return /[0-9]/i.test(event.key)">
                                    @error('nit')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="telefonoProveedor">Teléfono</label>
                                    <input type="tel" id="telefonoProveedor"
                                        class="proveedor form-control @error('telefono') is-invalid @enderror"
                                        name="telefono" value="{{ old('telefono') }}" autocomplete="off"
                                        placeholder="Teléfono" onkeypress="return /[0-9]/i.test(event.key)">
                                    @error('telefono')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="correoProveedor">Correo electrónico</label>
                                    <input type="email" id="correoProveedor"
                                        class="proveedor form-control @error('correo') is-invalid @enderror" name="correo"
                                        value="{{ old('correo') }}" autocomplete="off" placeholder="Correo electrónico">
                                    @error('correo')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="direccionProveedor">Dirección</label>
                                    <input type="tel" id="direccionProveedor"
                                        class="proveedor form-control @error('direccion') is-invalid @enderror"
                                        name="direccion" value="{{ old('direccion') }}" autocomplete="off"
                                        placeholder="Dirección">
                                    @error('direccion')
                                        <span class="errorServidor invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" id="eliminar_proveedor2" class="btn btn-danger">Eliminar</button>
                    </div>
                </div>
            </form>
        </div>

        <div class="card card-dark mt-n1 mx-n3">
            <div class="card-header">
                <h3 class="card-title">Listado de proveedores</h3>
            </div>
            <div class="card-body">
                <table id="tabla_proveedores" class="table table-bordered table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nombre</th>
                            <th>Nit</th>
                            <th>Teléfono</th>
                            <th>Correo electrónico</th>
                            <th>Dirección</th>
                            <th>Ingresado por</th>
                            <th>Editar</th>
                            <th>Eliminar</th>
                        </tr>
                    </thead>
                </table>
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
    <script src="{{ asset('js/proveedores/proveedoresMostrar.js') }}"></script>

    @if (session('proveedor_actualizado'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'El proveedor <b>{{ session('proveedor_actualizado') }}</b> se ha actualizado exitosamente',
                showConfirmButton: false,
                timer: 2000
            })
        </script>
    @endif
@stop
