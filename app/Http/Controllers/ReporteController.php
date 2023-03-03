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
     * 
     */
    public function exportarReportes(Request $request)
    {
        // $this->validarFiltros($request);
        $datos = $request->all();

        if ($datos['formato'] == 'excel') {
            return $this->exportarReportesExcel($datos);
        } else if ($datos['formato'] == 'pdf') {
            return $this->exportarReportesPdf($datos);
        }
    }

    public function validarFiltros(Request $request)
    {
        $tipoReporte = $request->input('tipoReporte');
        $reglas = [
            'anio' => 'required|numeric',
            'mes' => 'required|numeric'
        ];

        if ($tipoReporte == 2) {
            $reglas['fecha'] = 'required|date_format:d/m/Y';
        } else if ($tipoReporte == 3) {
            $reglas['identificacion'] = 'required|exists:se_personas,identificacion';
        }

        $request->validate($reglas, [
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
    public function exportarReportesExcel($datos)
    {
        // return $datos;
        $tipoReporte = $datos['tipoReporte'];

        if ($tipoReporte == 3) {
            return $this->prueba($datos['estado']);
        }

        // return $datos['tipoReporte'];
        // return (new ReportesExport())->download('inventario.xlsx');
    }

    /**
     * 
     */
    public function exportarReportesPdf()
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3600);

        $reportePdf = PDF::loadView('pages.reportes.plantillaReportePdf');
        $reportePdf->set_paper('letter', 'landscape');

        return $reportePdf->download('prueba.pdf');
    }

    public function prueba($estado)
    {
        try {
            $inventarios = Inventario::select('inventario.*', 'pdt.codigo', 'pdt.nombre AS producto', 'pdt.peso', 'prov.nombre AS proveedor', 'user.name', 'uni.abreviacion')
                ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('unidades AS uni', 'pdt.id_unidad', '=', 'uni.id_unidades')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true);

            if ($estado == 1) return $inventarios->where('estado', true)->get();
            if ($estado == 2) return $inventarios->where('estado', false)->get();
            if ($estado == 3) return $inventarios->get();
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }

        // return $inventarios; 
        // return (new ReportesExport())->download('inventario.xlsx');
    }
}
