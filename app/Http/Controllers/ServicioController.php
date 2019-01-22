<?php

namespace App\Http\Controllers;

use App\Conductor;
use App\Servicio;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $servicios = Servicio::all();
        return view('servicios.servicios', compact('servicios'));
    }

    public function indexFecha($fecha = null)
    {

        if ($fecha == null) {
            $hoy = Carbon::now();
            $fecha = $hoy->subDay()->format('Y-m-d');
        }
        $servicios = Servicio::where('fecha', $fecha)->get();
        return view('servicios.servicios-fecha', array('servicios'=>$servicios, 'fecha'=>$fecha));
    }

    public function indexConductor($conductor = null)
    {
        $all_conductores = Conductor::all();

        if ($conductor == null) {
           $conductor = true;
        }

        $servicios = Servicio::where('conductor_id', $conductor)->get();
        return view('servicios.servicios-conductor', array('servicios'=>$servicios, 'conductor'=>$conductor,'conductores'=>$all_conductores));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Servicio $servicios
     * @return \Illuminate\Http\Response
     */
    public function show(Servicio $servicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Servicio $servicios
     * @return \Illuminate\Http\Response
     */
    public function edit(Servicio $servicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Servicio $servicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Servicio $servicios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Servicio $servicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servicio $servicios)
    {
        //
    }
}
