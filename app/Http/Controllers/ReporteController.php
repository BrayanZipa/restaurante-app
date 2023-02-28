<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade\Pdf;
use Yajra\DataTables\DataTables;
use App\Exports\ReportesExport;
use Carbon\Carbon;
use App\Models\Inventario;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.reportes.generarReporte');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    public function exportarReportes(Request $request) 
    {
        $this->validarFiltros($request);
        $datos = $request->all();

        if($datos['formato'] == 'excel'){
            return $this->exportarReportesExcel($datos);
        } else if($datos['formato'] == 'pdf'){
            return $this->exportarReportesPdf($datos);
        }
    }

    public function validarFiltros(Request $request){
        $tipoReporte = $request->input('tipoReporte');
        $reglas = [
            'anio' => 'required|numeric', 
            'mes' => 'required|numeric'
        ];

        if($tipoReporte == 2){
            $reglas['fecha'] = 'required|date_format:d/m/Y';
        } else if($tipoReporte == 3){
            $reglas['identificacion'] = 'required|exists:se_personas,identificacion';
        }

        $request->validate( $reglas, [
            'anio.required' => 'Se requiere que elija un año',
            'anio.numeric' => 'El año debe ser un número',

            'mes.required' => 'Se requiere que eilija un mes',
            'mes.numeric' => 'El mes debe ser un número',

            'fecha.required' => 'Se requiere que ingrese la fecha',
            'fecha.date_format' => 'La fecha debe tener un formato valido',

            'identificacion.required' => 'Se requiere que ingrese el número de indentificación de la persona',
            'identificacion.exists' => 'La identificación ingresada no existe en el sistema'
        ]);
    }

    /**
     * 
     */
    public function export() 
    {
        return (new ReportesExport())->download('inventario.xlsx');
        // Excel::download(new UsersExport, 'users.xlsx');

    }
}
