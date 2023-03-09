<?php

namespace App\Http\Controllers;

use App\Exports\ListadoProductos;
use App\Exports\ListadoProveedores;
use App\Exports\PedidosProveedor;
use App\Exports\RegistrosInventario;
use App\Exports\RegistrosProducto;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Inventario;
use App\Models\Producto;
use App\Models\Proveedor;

class ReporteController extends Controller
{
    protected $proveedores;
    protected $productos;

    public function __construct(Proveedor $proveedores, Producto $productos)
    {
        $this->proveedores = $proveedores;
        $this->productos = $productos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $proveedores = $this->proveedores->obtenerProveedores();
        $productos = $this->productos->obtenerProductos();
        return view('pages.reportes.generarReporte', compact('proveedores', 'productos'));
    }

    /**
     * 
     */
    public function exportarReportes(Request $request)
    {
        $this->validarFiltros($request);
        $datos = $request->all();

        if ($datos['formato'] == 'excel') {
            return $this->exportarReportesExcel($datos);
        } else if ($datos['formato'] == 'pdf') {
            return $this->exportarReportesPdf($datos);
        }
    }

    public function validarFiltros(Request $request)
    {
        $request->validate([
            'tipoReporte' => ['required'],
        ], [
            'tipoReporte.required' => 'Se requiere que seleccione un tipo de reporte',
        ]);

        $tipoReporte = $request->input('tipoReporte');
        $reglas = [ 'anio' => 'required|numeric'];

        if ($tipoReporte == 2) {
            $reglas['proveedorId'] = 'required';

        } else if ($tipoReporte == 4){
            $reglas['productoId'] = 'required';

        } else if ($tipoReporte == 5){
            $reglas['mes'] = 'required';
            $reglas['estado'] = 'required';
        }

        $request->validate($reglas, [
            'anio.required' => 'Se requiere que seleccione el año',
            'mes.required' => 'Se requiere que seleccione el mes',
            'estado.required' => 'Se requiere que seleccione el estado',
            'proveedorId.required' => 'Se requiere que seleccione el proveedor',
            'productoId.required' => 'Se requiere que seleccione el producto'
        ]);
    }

    /**
     * 
     */
    public function exportarReportesExcel($datos)
    {
        $tipoReporte = $datos['tipoReporte'];

        if ($tipoReporte == 1) {
            [$consulta, $titulo] = $this->consultaListadoProveedores();
            return (new ListadoProveedores($consulta, $titulo))->download($titulo . '.xlsx');
        }
        if ($tipoReporte == 2) {
            [$consulta, $titulo]= $this->consultaPedidosProveedor($datos['proveedorId'], $datos['anio']);
            return (new PedidosProveedor($consulta, $titulo))->download($titulo . '.xlsx');
        }
        if ($tipoReporte == 3) {
            [$consulta, $titulo] = $this->consultaListadoProductos();
            return (new ListadoProductos($consulta, $titulo))->download($titulo . '.xlsx');
        }
        if ($tipoReporte == 4) {
            [$consulta, $titulo] = $this->consultaRegistrosProducto($datos['productoId'], $datos['anio']);
            return (new RegistrosProducto($consulta, $titulo))->download($titulo . '.xlsx');
        }
        if ($tipoReporte == 5) {
            [$consulta, $titulo] = $this->consultaRegistrosInventario($datos['anio'], $datos['mes'], $datos['estado']);
            return (new RegistrosInventario($consulta, $titulo))->download($titulo . '.xlsx');
        }
    }

    /**
     * 
     */
    public function exportarReportesPdf($datos)
    {
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', 3600);

        $tipoReporte = $datos['tipoReporte'];

        if ($tipoReporte == 1) {
            [$registros, $titulo] = $this->consultaListadoProveedores();
            $reportePdf = PDF::loadView('pages.reportes.listadoProveedoresPdf', compact('registros', 'titulo'));

        } else if ($tipoReporte == 2) {
            [$registros, $titulo] = $this->consultaPedidosProveedor($datos['proveedorId'], $datos['anio']);
            $reportePdf = PDF::loadView('pages.reportes.pedidosProveedorPdf', compact('registros', 'titulo'));

        } else if ($tipoReporte == 3) {
            [$registros, $titulo] = $this->consultaListadoProductos();
            $reportePdf = PDF::loadView('pages.reportes.listadoProductosPdf', compact('registros', 'titulo'));

        } else if ($tipoReporte == 4) {
            [$registros, $titulo] = $this->consultaRegistrosProducto($datos['productoId'], $datos['anio']);
            $reportePdf = PDF::loadView('pages.reportes.registrosProductoPdf', compact('registros', 'titulo'));

        } else if ($tipoReporte == 5) {
            [$registros, $titulo] = $this->consultaRegistrosInventario($datos['anio'], $datos['mes'], $datos['estado']);
            $reportePdf = PDF::loadView('pages.reportes.registrosInventarioPdf', compact('registros', 'titulo'));
        }

        $reportePdf->set_paper('letter', 'landscape');
        return $reportePdf->download($titulo . '.pdf');
    }

    /**
     * 
     */
    public function consultaListadoProveedores()
    {
        $consulta = $this->proveedores->obtenerInformacionProveedores();
        $titulo = 'Listado de proveedores';
        return [$consulta, $titulo];
    }

    /**
     * 
     */
    public function consultaPedidosProveedor($proveedorId, $anio)
    {
        try {
            $consulta = Inventario::select('inventario.*', 'pdt.codigo', 'pdt.nombre AS producto', 'pdt.peso', 'prov.nombre AS proveedor', 'user.name', 'uni.abreviacion')
                ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('unidades AS uni', 'pdt.id_unidad', '=', 'uni.id_unidades')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')
                ->where('pdt.estado_activacion', true)->where('estado', true)->where('id_proveedor', $proveedorId)
                ->whereYear('fecha', $anio)->orderBy('id_inventario')->get();

            $proveedor = $this->proveedores->obtenerProveedor($proveedorId);
            $titulo = 'Pedidos proveedor ' .  $proveedor->nombre . ' ' . $anio;
            return [$consulta, $titulo];
        
        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function consultaListadoProductos()
    {
        $consulta = $this->productos->obtenerInformacionProductos();
        $titulo = 'Listado de productos';
        return [$consulta, $titulo];
    }

    /**
     * 
     */
    public function consultaRegistrosProducto($productoId, $anio)
    {
        try {
            $consulta = Inventario::select('inventario.*', 'pdt.codigo', 'pdt.nombre AS producto', 'pdt.peso', 'prov.nombre AS proveedor', 'user.name', 'uni.abreviacion')
                ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('unidades AS uni', 'pdt.id_unidad', '=', 'uni.id_unidades')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')
                ->where('id_producto', $productoId)->orderBy('id_inventario')->whereYear('fecha', $anio)->get();

            $producto = $this->productos->obtenerProducto($productoId);
            $titulo = 'Registros ' .  $producto->nombre . ' ' . $producto->peso . $producto->abreviacion . ' ' . $anio;
            return [$consulta, $titulo];

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }

    /**
     * 
     */
    public function consultaRegistrosInventario($anio, $mes, $estado)
    {
        try {
            $inventarios = Inventario::select('inventario.*', 'pdt.codigo', 'pdt.nombre AS producto', 'pdt.peso', 'prov.nombre AS proveedor', 'user.name', 'uni.abreviacion')
                ->leftjoin('productos AS pdt', 'inventario.id_producto', '=', 'pdt.id_productos')
                ->leftjoin('unidades AS uni', 'pdt.id_unidad', '=', 'uni.id_unidades')
                ->leftjoin('proveedores AS prov', 'pdt.id_proveedor', '=', 'prov.id_proveedores')
                ->leftjoin('usuarios AS user', 'inventario.id_usuario', '=', 'user.id_usuarios')
                ->where('pdt.estado_activacion', true)->where('prov.estado_activacion', true)
                ->whereYear('fecha', $anio)->whereMonth('fecha', $mes)->orderBy('id_inventario');

            if ($estado == 1) {
                $consulta = $inventarios->where('estado', true)->get();
                $titulo = 'Ingresos de inventario ' . $mes . '-' . $anio;
            } else if ($estado == 2) {
                $consulta = $inventarios->where('estado', false)->get();
                $titulo = 'Salidas de inventario ' . $mes . '-' . $anio;
            } else if ($estado == 3) {
                $consulta = $inventarios->get();
                $titulo = 'Registros de inventario ' . $mes . '-' . $anio;
            }
            return [$consulta, $titulo];

        } catch (\Throwable $th) {
            return response()->json(['message' => 'Error al traer la información de la base de datos'], 500);
        }
    }
}
