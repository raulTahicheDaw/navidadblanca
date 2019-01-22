<?php

namespace App\Http\Controllers;

use App\TiposServicio;
use Illuminate\Http\Request;

class TiposServicioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = TiposServicio::all();
        return view('configuraciones.tipos', compact('tipos'));
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
        $data = $request->validate([
            'nombre' => 'required|max:45',
            'descripcion' => 'max:100',
        ]);
        TiposServicio::create($data);
        return $this->index();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\TiposServicio  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function show(TiposServicio $tiposServicios)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\TiposServicio  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function edit(TiposServicio $tiposServicios)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\TiposServicio  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TiposServicio $tiposServicios)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\TiposServicio  $tiposServicios
     * @return \Illuminate\Http\Response
     */
    public function destroy(TiposServicio $tiposServicios)
    {
        //
    }
}
