@extends('adminlte::page')

@section('title', 'Chispas De La Colina')

@section('content_header')
@stop

@section('content')
    <section class="content-header mt-n2 mx-n3">
        <div class="row">
            <div class="col-lg-3 col-6">
                <div class="small-box bg-info">
                    <div class="inner">
                        <h3 id="cantidadProductos">0</h3>
                        <p>Cantidad de productos</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="{{ route('productos') }}" class="small-box-footer">Ver productos <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="cantidadProveedores">0</h3>
                        <p>Cantidad de proveedores</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="{{ route('proveedores') }}" class="small-box-footer">Ver proveedores <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="totalUnidadesI">0</h3>
                        <p>Total unidades en inventario</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="{{ route('inventario') }}" class="small-box-footer">Ver inventario <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="valorTotalI">$ 0</h3>
                        <p>Valor total aproximado del inventario</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="{{ route('inventario') }}" class="small-box-footer">Ver inventario <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12 pr-5">
            <div id="grafico1"></div>
        </div> 
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-8">
            <div id="grafico2"></div>
        </div> 
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div id="grafico3"></div>
        </div>     
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-8"">
            <div id="grafico4"></div>
        </div> 
        <div class="col-md-6">
            <div id="grafico5"></div>
        </div> 
    </div>
@stop

@section('css')
@stop

@section('plugins.ApexCharts', true)

@section('js')
    <script src="{{ asset('js/home/dashboard.js') }}"></script>
@stop
