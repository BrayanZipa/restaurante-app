@extends('adminlte::page')

@section('title', 'Proveedores')

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
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
                            <button type="button" id="btnOcultar" class="btn btn-tool" ><i class="fas fa-times"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nombreProveedor">Ingrese el nombre del proveedor</label>
                                    <input type="text" id="nombreProveedor" class="form-control" name="nombre" placeholder="Nombre">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="nitProveedor">Ingrese el Nit del proveedor</label>
                                    <input type="text" id="nitProveedor" class="form-control" name="nit" placeholder="Nit">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="telefonoProveedor">Ingrese el teléfono del proveedor</label>
                                    <input type="tel" id="telefonoProveedor" class="form-control" name="telefono" placeholder="Teléfono">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="correoProveedor">Ingrese el correo electrónico del proveedor</label>
                                    <input type="email" id="correoProveedor" class="form-control" name="correo" placeholder="Correo electrónico">
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="form-group">
                                    <label for="direccionProveedor">Dirección del proveedor</label>
                                    <input type="tel" id="direccionProveedor" class="form-control" name="direccion" placeholder="Dirección">
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

    @if(session('proveedor_actualizado'))
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