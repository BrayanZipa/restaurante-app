<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class InventarioController extends Controller
{
    protected $inventarios;
    protected $productos;

    public function __construct(Inventario $inventarios, Producto $productos)
    {
        $this->inventarios = $inventarios;
        $this->productos = $productos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.inventario.mostrarInventario');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $productos = $this->productos->obtenerProductos();
        return view('pages.inventario.crearInventario', compact('productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'estado' => ['required'],
        ], [
            'estado.required' => 'Se requiere que ingrese el estado del registro',
        ]);

        if ($request['estado'] == 1) {
            $validaciones = [
            'id_producto' => ['required'],
            'cantidad' => ['required', 'numeric'],
            'costo' => ['required', 'numeric'],
            'fecha_vencimiento' => ['required', 'date_format:Y-m-d'],
            [
                'id_producto.required' => 'Se requiere que ingrese el nombre del producto',
                'cantidad.required' => 'Se requiere que ingrese la cantidad del producto',
                'cantidad.numeric' => 'La cantidad debe ser un valor númerico entero',
                'costo.required' => 'Se requiere que ingrese el costo del producto macooooooooooooooooooooooooo',
                'costo.numeric' => 'El costo debe ser un valor númerico entero',
                'fecha_vencimiento.required' => 'Se requiere que ingrese la fecha de vencimiento del producto mancooooooooooooooo',
                'fecha_vencimiento.date_format' => 'La fecha de vencimiento debe tener un formato válido'
            ]
            ];
        } else {
            $validaciones = [
            'id_producto' => ['required'],
            'cantidad' => ['required', 'numeric'],
            [
                'id_producto.required' => 'Se requiere que ingrese el nombre del producto',
                'cantidad.required' => 'Se requiere que ingrese la cantidad del producto',
                'cantidad.numeric' => 'La cantidad debe ser un valor númerico entero',
                ]
            ];
        }


        $producto = $this->productos->obtenerProducto($request['id_producto']);
        if ($request['estado'] == 1) {
            $producto->total += $request['cantidad'];
        } else {
            $producto->total -= $request['cantidad'];
        }
        $producto->save();

        $request['id_usuario'] = auth()->user()->id_usuarios;
        $request['fecha'] = Carbon::now()->toDateTimeString();
        $inventario = Inventario::create($request->all());
        $inventario->save();
        return redirect()->route('crearInventario')->with('inventario_creado', [$inventario->estado, $inventario->cantidad, $producto->nombre]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $request->all();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function obtenerListaInventarios(Request $request)
    {
        if ($request->ajax()) {
            $listaInventarios = $this->inventarios->obtenerInformacionInventarios();
            return DataTables::of($listaInventarios)->make(true);
        }
    }
}
