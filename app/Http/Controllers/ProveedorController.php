<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Validation\Rule;


class ProveedorController extends Controller
{
    protected $proveedores;

    public function __construct(Proveedor $proveedores){
        $this->proveedores = $proveedores;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response    
     */
    public function index()
    {
        return view('pages.proveedores.mostrarProveedores');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.proveedores.crearProveedor');
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
            'nit' => ['required', 'numeric','unique:proveedores,nit'],
            'telefono' => ['required', 'numeric', 'unique:proveedores,telefono'],
            'correo' => ['nullable', 'email:rfc,dns', 'unique:proveedores,correo'],
            'direccion' => ['nullable', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]+$/u']
        ], [
            'nombre.required' => 'Se requiere que ingrese el nombre del proveedor',
            'nombre.regex' => 'El nombre no debe contener caracteres especiales',
            'nit.required' => 'Se requiere que ingrese el nit o identificador del proveedor', 
            'nit.numeric' => 'El nit debe ser un valor númerico y no debe contener espacios', 
            'nit.unique' => 'No puede haber dos proveedores con el mismo nit', 
            'telefono.required' => 'Se requiere que ingrese el teléfono del proveedor', 
            'telefono.numeric' => 'El teléfono debe ser un valor númerico y no debe contener espacios', 
            'telefono.unique' => 'No puede haber dos proveedores con el mismo teléfono', 
            'correo.email' => 'El correo electrónico debe tener un formato correcto', 
            'correo.unique' => 'No puede haber dos proveedores con el mismo correo electrónico', 
            'direccion.regex' => 'La dirección debe ser de tipo texto sin caracteres especiales'
        ]);

        $request['id_usuario'] = auth()->user()->id_usuarios;  
        $proveedor =  Proveedor::create($request->all());
        $proveedor->save();
        return redirect()->route('crearProveedor')->with('proveedor_creado', $proveedor->nombre);
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
            'nit' => ['required', 'numeric', Rule::unique('proveedores', 'nit')->ignore($id, 'id_proveedores')],
            'telefono' => ['required', 'numeric', Rule::unique('proveedores', 'telefono')->ignore($id, 'id_proveedores')],
            'correo' => ['nullable', 'email:rfc,dns', Rule::unique('proveedores','correo')->ignore($id, 'id_proveedores')],
            'direccion' => ['nullable', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ0-9\u00f1\u00d1]+$/u']
        ], [
            'nombre.required' => 'Se requiere que ingrese el nombre del proveedor',
            'nombre.regex' => 'El nombre no debe contener caracteres especiales',
            'nit.required' => 'Se requiere que ingrese el nit o identificador del proveedor', 
            'nit.numeric' => 'El nit debe ser un valor númerico y no debe contener espacios', 
            'nit.unique' => 'No puede haber dos proveedores con el mismo nit', 
            'telefono.required' => 'Se requiere que ingrese el teléfono del proveedor', 
            'telefono.numeric' => 'El teléfono debe ser un valor númerico y no debe contener espacios', 
            'telefono.unique' => 'No puede haber dos proveedores con el mismo teléfono', 
            'correo.email' => 'El correo electrónico debe tener un formato correcto', 
            'correo.unique' => 'No puede haber dos proveedores con el mismo correo electrónico', 
            'direccion.regex' => 'La dirección debe ser de tipo texto sin caracteres especiales'
        ]);
        
        $proveedor = $this->proveedores->obtenerProveedor($id);
        $proveedor->update($request->all());
        return redirect()->route('proveedores')->with('proveedor_actualizado', $proveedor->nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Proveedor::destroy($id);
    }

    /**
     * 
     */
    public function obtenerListaProveedores(Request $request){
        if($request->ajax()){
            $listaProveedores = $this->proveedores->obtenerInformacionProveedores();
            return DataTables::of($listaProveedores)->make(true);
        }
    }
}