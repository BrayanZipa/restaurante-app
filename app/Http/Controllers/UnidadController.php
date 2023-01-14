<?php

namespace App\Http\Controllers;

use App\Models\Unidad;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UnidadController extends Controller
{
    protected $unidades;

    public function __construct(Unidad $unidades)
    {
        $this->unidades = $unidades;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.unidades.crearUnidades');
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
            'unidad' => ['required', 'unique:unidades,unidad', 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ.\u00f1\u00d1]+$/u'],
        ], [
            'unidad.required' => 'Se requiere que ingrese el nombre de la unidad',
            'unidad.unique' => 'No puede haber dos unidades con el mismo nombre',
            'unidad.regex' => 'El nombre no debe contener caracteres especiales o numéricos',
        ]);

        $unidad = Unidad::create($request->all());
        $unidad->save();
        return redirect()->route('unidades')->with('unidad_creada', $unidad->unidad);
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
            'unidad' => ['required', Rule::unique('unidades', 'unidad')->ignore($id, 'id_unidades'), 'regex:/^[a-zA-ZÀ-ÿ\u00f1\u00d1]+(\s*[a-zA-ZÀ-ÿ\u00f1\u00d1]*)*[a-zA-ZÀ-ÿ.\u00f1\u00d1]+$/u'],
        ], [
            'unidad.required' => 'Se requiere que ingrese el nombre de la unidad',
            'unidad.unique' => 'No puede haber dos unidades con el mismo nombre',
            'unidad.regex' => 'El nombre no debe contener caracteres especiales o numéricos',
        ]);

        $unidad = $this->unidades->obtenerUnidad($id);
        $unidad->update($request->all());
        return response()->json(['unidad' => $unidad->unidad]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Unidad::destroy($id);
    }

    /**
     * 
     */
    public function obtenerListaUnidades(Request $request)
    {
        if ($request->ajax()) {
            $listaUnidades = $this->unidades->obtenerUnidades();
            return DataTables::of($listaUnidades)->make(true);
        }
    }
}
