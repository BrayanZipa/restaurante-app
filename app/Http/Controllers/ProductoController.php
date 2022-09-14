<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    protected $proveedores;
    protected $productos; 

    public function __construct(Proveedor $proveedores, Producto $productos){
        $this->productos = $productos;
        $this->proveedores = $proveedores;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = $this->proveedores->obtenerProveedores();
        return view('pages.productos.mostrarProductos', compact('proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $proveedores = $this->proveedores->obtenerProveedores();
        return view('pages.productos.crearProducto', compact('proveedores'));
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
            'codigo' => ['required', 'unique:productos,codigo'],
        ], [
            'codigo.required' => 'Se requiere que ingrese el nombre del producto', 
            'codigo.unique' => 'No puede haber dos productos con el mismo codigo', 
        ]);

        $request['id_usuario'] = auth()->user()->id_usuarios;  
        $producto =  Producto::create($request->all());
        $producto->save();
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
        if($request->ajax()){
            $listaProductos = $this->productos->obtenerInformacionProductos();
            return DataTables::of($listaProductos)->make(true);
        }
    }
}