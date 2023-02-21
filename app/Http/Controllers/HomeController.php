<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;

class HomeController extends Controller
{
    protected $inventarios;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Inventario $inventarios)
    {
        $this->middleware('auth');
        $this->inventarios = $inventarios;
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
    public function registrosInventarioPorDia()
    {
        try {
            $ingresoPorDia = [];
            $salidasPorDia = [];

            for ($i = 0; $i < 10; $i++) { 
                $fecha = Carbon::now()->subDays($i)->toDateString();

                array_unshift($ingresoPorDia, Inventario::where('estado', true)->whereDate('fecha', $fecha)->get());
                array_unshift($salidasPorDia, Inventario::where('estado', false)->whereDate('fecha', $fecha)->get());
                
                // $this->inventarios->obtenerInformacionInventarios()->where('estado', true)->whereDate('fecha', $fecha)->get();

                // echo $fecha.'<br>';
            }

            // return $consulta;

            // $bajo = Producto::whereBetween('total', [20, 99])->where('estado_activacion', true)->count();
            return response()->json([
                // 'escaso' => $escaso,
                // $fechaActual->format('d-m-Y')
                'ingresos' => $ingresoPorDia,
                'salidas' => $salidasPorDia
            ]);

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
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
