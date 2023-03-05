<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithTitle;

class ListadoProductos implements FromView, ShouldAutoSize, WithTitle
{
    use Exportable;

    protected $consulta;
    protected $titulo;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct($consulta, $titulo)
    {
        $this->consulta = $consulta;
        $this->titulo = $titulo;
    }

    /**
    * @return \Illuminate\Support\View
    */
    public function view(): View
    {
        return view('pages.reportes.listadoProductosExcel', 
        [   'registros' => $this->consulta, 
        ]);
    }

    public function title(): string
    {
        return $this->titulo;
    }
}
