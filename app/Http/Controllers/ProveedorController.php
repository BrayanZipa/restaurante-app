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
            // 'nombre' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u'],
            'nit' => ['required', 'unique:proveedores,nit'],
            // 'telefono' => ['required'],
            // 'correo' => ['required'],
        ], [
            'nit.required' => 'Se requiere que ingrese el nombre del proveedor', 
            'nit.unique' => 'No puede haber dos proveedores con el mismo nit', 
        ]);

        $request['id_usuario'] = auth()->user()->id_usuarios;  
        $proveedor =  Proveedor::create($request->all());
        $proveedor->save();
        return redirect()->route('crearProveedor')->with('proveedor_creado', $proveedor->nombre);
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
            // 'nombre' => ['required', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ\u00f1\u00d1]+$/u'],
            'nit' => ['required', Rule::unique('proveedores','nit')->ignore($id, 'id_proveedores'),],
            'telefono' => ['required', Rule::unique('proveedores','telefono')->ignore($id, 'id_proveedores'),],
            'correo' => ['required', Rule::unique('proveedores','correo')->ignore($id, 'id_proveedores'),],
        ], [
            
            'nit.required' => 'Se requiere que ingrese el nombre del proveedor', 
            'nit.unique' => 'No puede haber dos proveedores con el mismo nit', 
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