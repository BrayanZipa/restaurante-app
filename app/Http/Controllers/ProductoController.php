<?php

namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;
use App\Models\Unidad;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;

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
        $request->validate([
            'nombre' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ.\u00f1\u00d1]+$/u'],
            'codigo' => ['required', 'alpha_dash', 'unique:productos,codigo'],
            'id_proveedor' => ['required'],
            'id_unidad' => ['required'],
            'total' => ['required', 'numeric'],
            'costo' => ['required', 'numeric'],
            'fecha_vencimiento' => ['required', 'date_format:Y-m-d'],
        ], [
            'nombre.required' => 'Se requiere que ingrese el nombre del producto',
            'nombre.regex' => 'El nombre no debe contener caracteres especiales',
            'codigo.required' => 'Se requiere que ingrese el código del producto',
            'codigo.alpha_dash' => 'El código puede estar conformado por letras, números, guiones y sin espacios',
            'codigo.unique' => 'No puede haber dos productos con el mismo código',
            'id_proveedor.required' => 'Se requiere que ingrese el proveedor del producto',
            'id_unidad.required' => 'Se requiere que ingrese la unidad de medida del producto',
            'total.required' => 'Se requiere que ingrese el total inicial del producto',
            'total.numeric' => 'El total debe ser un valor númerico entero',
            'costo.required' => 'Se requiere que ingrese el costo del producto',
            'costo.numeric' => 'El costo debe ser un valor númerico entero',
            'fecha_vencimiento.required' => 'Se requiere que ingrese la fecha de vencimiento del producto',
            'fecha_vencimiento.date_format' => 'La fecha de vencimiento debe tener un formato válido',
        ]);

        $request['id_usuario'] = auth()->user()->id_usuarios;
        $producto =  Producto::create($request->all());
        $producto->save();

        $request['fecha'] = Carbon::now()->toDateTimeString();
        $request['estado'] = true;
        $request['cantidad'] = $request['total'];
        $request['cantidad_producto'] = $producto->total;
        $request['costo_unitario'] = $request['costo'] / $request['total'];
        $request['id_producto'] =  $producto->id_productos;

        Inventario::create($request->all())->save();
        return redirect()->route('crearProducto')->with('producto_creado', $producto->nombre);
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
            'codigo' => ['required', 'alpha_dash', Rule::unique('productos', 'codigo')->ignore($id, 'id_productos')],
            'id_proveedor' => ['required'],
            'id_unidad' => ['required'],
        ], [
            'nombre.required' => 'Se requiere que ingrese el nombre del producto',
            'nombre.regex' => 'El nombre no debe contener caracteres especiales',
            'codigo.required' => 'Se requiere que ingrese el código del producto',
            'codigo.alpha_dash' => 'El código puede estar conformado por letras, números, guiones y sin espacios',
            'codigo.unique' => 'No puede haber dos productos con el mismo código',
            'id_proveedor.required' => 'Se requiere que ingrese el proveedor del producto',
            'id_unidad.required' => 'Se requiere que ingrese la unidad de medida del producto',
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
