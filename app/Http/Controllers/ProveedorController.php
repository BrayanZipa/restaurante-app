<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;


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
        // $datos['proveedores'] = proveedor::paginate($this->proveedores);
       
        return view('pages.proveedores.mostrarProveedores');
        // return view('pages.visitantes.mostrar', compact('eps', 'arl'));
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
        $request['id_usuario']= auth()->user()->id_usuarios;  
        Proveedor::create($request->all())->save;
        return redirect()->route('proveedores');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        proveedor:: destroy($id);
        return redirect('inventario');
    }

    public function obtenerListaProveedores(Request $request){
        if($request->ajax()){
            $listaProveedores = $this->proveedores->obtenerInformacionProveedores();
            return DataTables::of($listaProveedores)->make(true);
        }
        // $listaProveedores = $this->proveedores->obtenerInformacionProveedores();
        // return  $listaProveedores;
    }
}
