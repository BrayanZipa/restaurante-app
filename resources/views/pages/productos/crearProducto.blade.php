@extends('adminlte::page')

@section('title', '| Nuevo producto')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="tarjetaProductos" class="card card-orange mx-n3">
            <div class="card-header">
                <h3 class="card-title">Registrar nuevo producto</h3>
            </div>
            <form id="formCrearProducto" action="{{ route('guardarProducto') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="nombreProducto">Ingrese el nombre del producto</label>
                                <input type="text" id="nombreProducto" class="form-control" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="codigoProducto">Ingrese el código del producto</label>
                                <input type="text" id="codigoProducto" class="form-control @error('codigo') is-invalid @enderror" name="codigo" value="{{ old('codigo') }}" placeholder="Código">
                                @error('codigo')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>   
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="proveedorProducto">Ingrese el proveedor del producto</label>
                                <select id="proveedorProducto" class="form-control" name="id_proveedor" value="{{ old('id_proveedor') }}">
                                    <option value="" disabled selected>Seleccione el proveedor</option>
                                    @foreach($proveedores as $proveedor)
                                        <option value="{{ $proveedor->id_proveedores }}">{{  $proveedor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="unidadProducto">Ingrese la unidad de medida del producto</label>
                                <input type="text" id="unidadProducto" class="form-control" name="unidad" value="{{ old('unidad') }}" placeholder="Unidad">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="totalProducto">Ingrese el total inicial de unidades del producto</label>
                                <input type="number" id="totalProducto" class="form-control" name="total" value="{{ old('total') }}" placeholder="Total inicial">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="totalProducto">Ingrese la fecha de vencimiento del producto</label>
                                <input type="date" id="fechaProducto" class="form-control" name="fecha" value="{{ old('total') }}" placeholder="Fecha vencimiento">
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

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('css')
@stop

@section('js')
    <script src="{{ asset('js/productos/productosCrear.js') }}"></script> 

    @if(session('producto_creado'))
        <script>
            Swal.fire({
                title: 'El producto <b>{{ session('producto_creado') }}</b> se ha ingresado exitosamente',
                text: '¿Desea ingresar otro producto?',
                showDenyButton: true,
                confirmButtonText: 'Sí, ingresar',
                denyButtonText: 'No, continuar',    
                }).then((result) => {
                if (result.isDenied) {
                    window.location.href =  window.location.origin + '/productos';
                }
            })
        </script>
    @endif

    <script>
        $('#proveedorProducto').select2({
            theme: 'bootstrap4',
            placeholder: 'Seleccione el proveedor',
            language: {
            noResults: function() {
            return 'No hay resultado';        
            }}
        })
    </script>
@stop