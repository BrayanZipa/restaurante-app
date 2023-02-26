<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use Carbon\Carbon;

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
    // public function obtenerTotalListadoInventario($estado, $fecha)
    // {
    //     try {
    //         $consulta = Inventario::leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
    //             ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
    //             ->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true)->count();
    //     } catch (\Throwable $th) {
    //         return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
    //     }
    //     return $consulta;
    // } 

    /**
     * 
     */
    public function obtenerTotalListadoInventario($estado, $fecha)
    {
        try {
            $consulta = Inventario::leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true)->where('estado', $estado)->whereDate('fecha', $fecha)->count();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
        return $consulta;
    }

    /**
     * 
     */
    public function obtenerTotalDatos()
    {
        try {
            $productos = Producto::where('estado_activacion', true);
            $proveedores = Proveedor::where('estado_activacion', true)->count();
            $cantidadProducto = Producto::where('estado_activacion', true)->sum('total');

            $arrayProductos = $productos->get();
            $inventarios = Inventario::select('inventario.cantidad_producto', 'inventario.costo_unitario','inventario.id_producto')
            ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
            ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
            ->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true)->where('estado', true);
            $arrayInventario = $inventarios->get();

            foreach ($arrayProductos as $producto){
                foreach ($arrayInventario as $inventario){
                  $prueba[] =  $inventarios->where('id_producto', $producto->id_productos)->latest('fecha')->first();
                    //  echo $prueba;
                     break;
                }
            }
            return response()->json([$prueba]);
           
            // return response()->json([  
            //     $arrayProductos,$arrayInventario
            //    ]);


            } catch (\Throwable $th) {
                return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
            }
      
        // Manco haga las funciones para traer datos
        // return response()->json([
        //     $productos->count(), $proveedores, $cantidadProducto, 40
        // ]);
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
            $fecha = Carbon::now()->subDays($i);

            array_unshift($dias, $fecha->format('d-m-Y'));
            array_unshift($ingresoPorDia, $this->obtenerTotalListadoInventario(true, $fecha->toDateString()));
            array_unshift($salidasPorDia, $this->obtenerTotalListadoInventario(false, $fecha->toDateString()));
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
}
