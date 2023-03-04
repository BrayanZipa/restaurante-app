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
                        <h3 id="cantidadReferencias"></h3>
                        <p>Cantidad de referencias</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-bag"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-success">
                    <div class="inner">
                        <h3 id="cantidadProveedores"></h3>
                        <p>Cantidad de proveedores</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-stats-bars"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-warning">
                    <div class="inner">
                        <h3 id="totalUnidadesI"></h3>
                        <p>Total unidades en inventario</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-add"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
            <div class="col-lg-3 col-6">
                <div class="small-box bg-danger">
                    <div class="inner">
                        <h3 id="valorTotalI"></h3>
                        <p>Valor total del inventario</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>
    </section>

    <div class="row">
        <div class="col-12">
            <div id="grafico1"></div>
        </div> 
    </div>

    <div class="row">
        <div class="col-sm-12 col-md-6 col-lg-4">
            <div id="grafico2"></div>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="grafico3"></div>
        </div> 
        <div class="col-md-6">
            <div id="grafico4"></div>
        </div> 
    </div>

    <div class="row">
        <div class="col-md-6">
            <div id="grafico5"></div>
        </div> 
        <div class="col-md-6">
            <div id="grafico6"></div>
        </div> 
    </div>

    
@stop

@section('css')
@stop

@section('plugins.ApexCharts', true)

@section('js')
    <script src="{{ asset('js/home/dashboard.js') }}"></script>
@stop
