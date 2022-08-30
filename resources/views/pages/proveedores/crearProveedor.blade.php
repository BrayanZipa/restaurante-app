@extends('adminlte::page')

@section('title', 'Nuevo proveedor')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="tarjetaProveedores" class="card card-dark mx-n3">
            <div class="card-header">
                <h3 class="card-title">Registrar nuevo proveedor</h3>
            </div>
            <form action="{{url('/proveedores/guardar')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nombreProveedor">Ingrese el nombre del proveedor</label>
                                <input type="text" id="nombreProveedor" class="form-control" name="nombre" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="nitProveedor">Ingrese el Nit del proveedor</label>
                                <input type="text" id="nitProveedor" class="form-control" name="nit" placeholder="Nit">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="telefonoProveedor">Ingrese el teléfono del proveedor</label>
                                <input type="tel" id="telefonoProveedor" class="form-control" name="telefono" placeholder="Teléfono">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="correoProveedor">Ingrese el correo electrónico del proveedor</label>
                                <input type="tel" id="correoProveedor" class="form-control" name="correo" placeholder="Correo electrónico">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="direccionProveedor">Dirección del proveedor</label>
                                <input type="tel" id="direccionProveedor" class="form-control" name="direccion" placeholder="Dirección">
                            </div>
                        </div>
                        
                    </div> 
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-success">Registrar</button>
                </div>
            </form>
        </div>
    </section>
@stop

@section('plugins.Sweetalert2', true)

@section('css')
@stop

@section('js')
    {{-- <script src="{{ asset('js/proveedores/proveedoresMostrar.js') }}"></script> --}}
@stop