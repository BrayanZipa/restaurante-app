<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InventarioController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('inventario');
    }

   public function leeaManco()
   {
    // $alumno = new Alumno($request->all());
    // $alumno->save();
    // return redirect()->action([AlumnoController::class, 'index']);
   } 

    
}