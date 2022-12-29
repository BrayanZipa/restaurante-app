<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    protected $proveedores;
    protected $productos;
    protected $unidades;

    public function __construct(Proveedor $proveedores, Producto $productos, Unidad $unidades)
    {
        $this->productos = $productos;
        $this->proveedores = $proveedores;
        $this->unidades = $unidades;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = $this->proveedores->obtenerProveedores();
        $unidades = $this->unidades->obtenerUnidades();
        return view('pages.productos.mostrarProductos', compact('proveedores', 'unidades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = $this->proveedores->obtenerProveedores();
        $unidades = $this->unidades->obtenerUnidades();
        return view('pages.productos.crearProducto', compact('proveedores', 'unidades'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->all();
        // $date = Carbon::now();
        // return Carbon::now();
        // return date('Y-m-d H:i:s');
        // return  $date->toDateString();
        // return $date->toTimeString();
        // return $date->toDateTimeString();
        $request->validate([
            'codigo' => ['required', 'unique:productos,codigo'],
        ], [
            'codigo.required' => 'Se requiere que ingrese el nombre del producto',
            'codigo.unique' => 'No puede haber dos productos con el mismo codigo',
        ]);

        $request['id_usuario'] = auth()->user()->id_usuarios;
        $producto =  Producto::create($request->all());
        $producto->save();
        // $date = Carbon::now();
        // return  $date;
        // $request['fecha'] = Carbon::now()->toDateTimeString();  
        // $request['estado'] = true; 
        // $request['cantidad'] = $request['total']; 
        // $request['costo'] = 5000; 
        // $request['id_producto'] =  $producto->id_productos; 
        // Inventario::create($request->all())->save();
        return redirect()->route('crearProducto')->with('producto_creado', $producto->nombre);
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
        $request->validate([
            'nombre' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ.\u00f1\u00d1]+$/u'],
            'codigo' => ['required', 'unique:productos,codigo'],
            'id_proveedor' => ['required'],
            'unidad'  => ['required'],
            'total' => ['required', 'numeric', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ.\u00f1\u00d1]+$/u'],
        ], [
            'nombre.required' => 'Se requiere que ingrese el nombre del producto',
            'nombre.regex' => 'El nombre no debe contener caracteres especiales',
            'codigo.required' => 'Se requiere que ingrese el codigo o identificador del producto',
            'codigo.unique' => 'No puede haber dos productos con el mismo código',
            'id_proveedor.required' => 'Se requiere que ingrese el nombre del proveedor',
            'unidad.required' => 'Se requiere que ingrese la unidad de medida del producto',
            'total.required' => 'Se requiere que ingrese el total inicial del producto',
            'total.numeric' => 'El total inicial debe ser un valor númerico y no debe contener espacios',
            'total.regex' => 'El total inicial no debe contener caracteres especiales',


        ]);

        $producto = $this->productos->obtenerProducto($id);
        $producto->update($request->all());
        return redirect()->route('productos')->with('producto_actualizado', $producto->nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Producto::destroy($id);
    }

    /**
     * 
     */
    public function obtenerListaProductos(Request $request)
    {
        if ($request->ajax()) {
            $listaProductos = $this->productos->obtenerInformacionProductos();
            return DataTables::of($listaProductos)->make(true);
        }
    }
}
