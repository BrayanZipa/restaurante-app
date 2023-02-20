<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

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
    public function totalEstadoProducto()
    {
        try {
            $alto = Producto::where('total', '>=', 100)->where('estado_activacion', true)->count();
            $bajo = Producto::whereBetween('total', [20, 99])->where('estado_activacion', true)->count();
            $escaso = Producto::where('total', '<', 20)->where('estado_activacion', true)->count();

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
    public function registrosInventarioPorDia()
    {
        try {
            $alto = Producto::where('total', '>=', 100)->where('estado_activacion', true)->count();
            $bajo = Producto::whereBetween('total', [20, 99])->where('estado_activacion', true)->count();
            $escaso = Producto::where('total', '<', 20)->where('estado_activacion', true)->count();

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
