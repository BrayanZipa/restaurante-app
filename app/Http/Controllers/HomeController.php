<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('pages.home.dashboard');
    }

    /**
     * 
     */
    public function obtenerTotalDatos()
    {
        try {
            $productos = Producto::where('estado_activacion', true);
            $proveedores = Proveedor::where('estado_activacion', true)->count();
            $cantidadProductos = Producto::where('estado_activacion', true)->sum('total');

            $arrayProductos = $productos->get();
            $valorInventario = 0;

            foreach ($arrayProductos as $producto) {
                $ultimoInventario = Inventario::select('inventario.id_producto', 'inventario.costo_unitario')
                    ->where('id_producto', $producto->id_productos)->where('estado', true)->latest('fecha')->first();

                if ($ultimoInventario) {
                    $valorInventario += $ultimoInventario->costo_unitario * $producto->total;
                }
            }

            return response()->json([
                $productos->count(), $proveedores, $cantidadProductos, $valorInventario
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function obtenerTotalListadoInventario()
    {
        try {
            $consulta = Inventario::leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true);
            return $consulta;
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function obtenerTotalListadoInventarioDia($estado, $fecha)
    {
        try {
            $consulta = $this->obtenerTotalListadoInventario()->where('estado', $estado)->whereDate('fecha', $fecha)->count();
            return $consulta;
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function obtenerTotalListadoInventarioMes($estado, $anio, $mes)
    {
        try {
            $consulta = $this->obtenerTotalListadoInventario()->where('estado', $estado)->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->count();
            return $consulta;
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function registrosInventarioPorDia()
    {
        $ingresoPorDia = [];
        $salidasPorDia = [];
        $dias = [];

        for ($i = 0; $i < 10; $i++) {
            $diaAnterior = Carbon::now()->subDays($i);

            array_unshift($dias, $diaAnterior->format('d-m-Y'));
            array_unshift($ingresoPorDia, $this->obtenerTotalListadoInventarioDia(true, $diaAnterior->toDateString()));
            array_unshift($salidasPorDia, $this->obtenerTotalListadoInventarioDia(false, $diaAnterior->toDateString()));
        }

        return response()->json([
            'ingresos' => $ingresoPorDia,
            'salidas' => $salidasPorDia,
            'dias' =>  $dias
        ]);
    }

    /**
     * 
     */
    public function registrosInventarioPorMes()
    {
        $ingresoPorMes = [];
        $salidasPorMes = [];
        $meses = [];

        for ($i = 0; $i < 8; $i++) {
            $mesAnterior = Carbon::now()->subMonth($i);

            array_unshift($meses, $mesAnterior->format('m-Y'));
            array_unshift($ingresoPorMes, $this->obtenerTotalListadoInventarioMes(true, $mesAnterior->year, $mesAnterior->month));
            array_unshift($salidasPorMes, $this->obtenerTotalListadoInventarioMes(false, $mesAnterior->year, $mesAnterior->month));
        }

        return response()->json([
            'ingresos' => $ingresoPorMes,
            'salidas' => $salidasPorMes,
            'meses' =>  $meses
        ]);
    }

    /**
     * 
     */
    public function totalEstadoProducto()
    {
        try {
            $escaso = Producto::where('total', '<=', 20)->where('estado_activacion', true)->count();
            $bajo = Producto::whereBetween('total', [21, 99])->where('estado_activacion', true)->count();
            $alto = Producto::where('total', '>=', 100)->where('estado_activacion', true)->count();

            return response()->json([
                'escaso' => $escaso,
                'bajo' => $bajo,
                'alto' => $alto
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function totalIngresosPoductos()
    {
        try {
            $fecha = Carbon::now();
            $consulta = Inventario::select('inventario.id_producto', 'pdt.nombre', DB::raw('count(*) as total_ingresos'))
                ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->where('pdt.estado_activacion', true)->where('estado', true)->whereYear('fecha', $fecha->year)
                ->groupBy('id_producto')->orderBy('total_ingresos', 'desc')->limit(10)->get();

            $consultaInversa = array_reverse($consulta->toArray());
            $nombreProductos = array_column($consultaInversa, 'nombre');
            $totalIngresos = array_column($consultaInversa, 'total_ingresos');

            return response()->json([
                'productos' => $nombreProductos,
                'ingresos' => $totalIngresos,
                'anio' => $fecha->year
            ]);
        } catch (\Throwable $th) {
            // return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
            return response()->json(['error' => $th], 500);
        }
    }

    /**
     * 
     */
    public function ultimoIngresoProductos()
    {
        try {
            $fecha = Carbon::now();

            $consulta = DB::table(function ($subquery) use ($fecha) {
                $subquery->select('i.id_producto', 'i.cantidad', 'i.fecha', 'pdt.nombre')
                    ->from('inventario as i')
                    ->leftJoin('productos as pdt', 'i.id_producto', '=', 'pdt.id_productos')
                    ->where('pdt.estado_activacion', true)->where('i.estado', true)
                    ->whereYear('i.fecha', $fecha->year)
                    ->whereMonth('i.fecha', $fecha->month)
                    ->latest('i.fecha');
                }, 'subconsulta')
                ->select('id_producto', 'nombre', DB::raw('SUM(cantidad) as cantidad, MAX(fecha) as last_fecha'))
                ->groupBy('id_producto', DB::raw('DATE(fecha)'))->latest('last_fecha')->limit(7)->get();

            $consultaArray =$consulta->toArray();
            $nombreProductos = array_column($consultaArray, 'nombre');
            $cantidadIngresada = array_column($consultaArray, 'cantidad');

            return response()->json([
                'productos' => $nombreProductos,
                'cantidades' => $cantidadIngresada
            ]);
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }
}
