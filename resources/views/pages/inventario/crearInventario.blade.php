@extends('adminlte::page')

@section('title', '| Nuevo inventario')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2">
        <div id="tarjetaInventario" class="card card-primary mx-n3">
            <div class="card-header">
                <h3 class="card-title">Registrar nuevo inventario</h3>
            </div>
            <form id="formCrearInventario" action="{{ route('guardarInventario') }}" method="POST">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="estadoInventario">Ingrese el estado del registro</label>
                                <select value="" id="estadoInventario"
                                    class="inventario form-control @error('estado') is-invalid @enderror" name="estado">
                                    <option value="" disabled selected>Seleccione el estado</option>
                                    <option value="1" {{ '1' == old('estado') ? 'selected' : '' }}>Ingreso</option>
                                    <option value="0" {{ '0' == old('estado') ? 'selected' : '' }}>Salida</option>
                                </select>
                                @error('estado')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="productoInventario">Ingrese el producto</label>
                                <select id="productoInventario"
                                    class="inventario form-control @error('id_producto') is-invalid @enderror"
                                    name="id_producto">
                                    <option value="" disabled selected>Seleccione el producto</option>
                                    @foreach ($productos as $producto)
                                        <option value="{{ $producto->id_productos }}"
                                            {{ $producto->id_productos == old('id_producto') ? 'selected' : '' }}>
                                            {{ $producto->nombre }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('id_producto')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="cantidadInventario">Ingrese la cantidad de unidades del producto</label>
                                <input type="number" id="cantidadInventario"
                                    class="inventario form-control @error('cantidad') is-invalid @enderror" name="cantidad"
                                    value="{{ old('cantidad') }}" autocomplete="off" placeholder="Cantidad">
                                @error('cantidad')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group oculto" style="display:none">
                                <label for="costoInventario">Ingrese el costo total del producto</label>
                                <input type="number" id="costoInventario"
                                    class="inventario limpiar form-control @error('costo') is-invalid @enderror" name="costo"
                                    value="{{ old('costo') }}" autocomplete="off" placeholder="Costo">
                                @error('costo')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-12">
                            <div class="form-group oculto" style="display:none">
                                <label for="fechaInventario">Ingrese la fecha de vencimiento del producto</label>
                                <input type="date" id="fechaInventario"
                                    class="inventario limpiar form-control @error('fecha_vencimiento') is-invalid @enderror"
                                    name="fecha_vencimiento" value="{{ old('fecha_vencimiento') }}"
                                    placeholder="Fecha vencimiento">
                                @error('fecha_vencimiento')
                                    <span class="errorServidor invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
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

@section('plugins.Select2', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true)

@section('js')
    <script src="{{ asset('js/inventario/inventarioCrear.js') }}"></script>

    @if (session('inventario_creado'))
        <script>
            Swal.fire({
                title: 'Se registro <b>{{ session('inventario_creado')[0] == 1 ? 'el ingreso' : 'la salida' }}</b> de <b>{{ session('inventario_creado')[1] }}</b> unidades del producto <b>{{ session('inventario_creado')[2] }}</b> exitosamente',
                text: '¿Desea ingresar otro registro de inventario?',
                showDenyButton: true,
                confirmButtonText: 'Sí, ingresar',
                denyButtonText: 'No, continuar',
            }).then((result) => {
                if (result.isDenied) {
                    window.location.href = window.location.origin + '/inventario';
                }
            })
        </script>
    @endif
@stop
