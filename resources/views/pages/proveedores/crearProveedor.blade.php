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
            <form id="formCrearProveedor" action="{{ route('guardarProveedor') }}" method="post">
                @csrf
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
                                <input type="text" id="nitProveedor" class="form-control @error('nit') is-invalid @enderror" name="nit" value="{{ old('nit') }}" placeholder="Nit">
                                @error('nit')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>   
                                @enderror
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
                                <input type="date" id="direccionProveedor" class="form-control" name="direccion" placeholder="Dirección">
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

@section('css')
@stop

@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/proveedores/proveedoresCrear.js') }}"></script> 

    @if(session('proveedor_creado'))
        <script>
            Swal.fire({
                title: 'El proveedor <b>{{ session('proveedor_creado') }}</b> se ha ingresado exitosamente',
                text: '¿Desea ingresar otro proveedor?',
                showDenyButton: true,
                confirmButtonText: 'Sí, ingresar',
                denyButtonText: 'No, continuar',    
                }).then((result) => {
                if (result.isDenied) {
                    window.location.href =  window.location.origin + '/proveedores';
                }
            })
        </script>
    @endif
@stop