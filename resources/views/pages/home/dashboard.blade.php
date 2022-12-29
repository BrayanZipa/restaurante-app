@extends('adminlte::page')

@section('title', 'Chispas De La Colina')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <section class="content-header mt-n2">
        <p>Bienvenido al panel administrativo, todavía no esta terminado :C</p>
        <p>por favor utiliza las demás funcionalidades del menú</p>
    </section>
@stop

@section('css')
@stop

{{-- @section('plugins.Datatables', true)
@section('plugins.Sweetalert2', true)
@section('plugins.jQueryValidation', true) --}}

@section('js')
    <script src="{{ asset('js/home/dashboard.js') }}"></script>
@stop


{{-- 
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
