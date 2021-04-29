<?php

namespace App\Http\Controllers;

use App\Models\Paquete;
use Illuminate\Http\Request;
use SebastianBergmann\Environment\Console;

class PaqueteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $paquetes = Paquete::all();
        return view('paquetes.index', ['paquetes' => $paquetes]);
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
        $paquete = Paquete::create(["estado" => "Salida de planta"]);
        return response()->json($paquete);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function show(Paquete $paquete)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function edit(Paquete $paquete)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $paquete = Paquete::find($id);

        if($request->inicio != "container4"){
            if($request->estado == "container2"){
                $paquete->estado = "En Local Delivery Center";
            }else if($request->estado == "container3"){
                $paquete->estado = "En proceso de entrega";
            }else if($request->estado == "container4"){
                $paquete->estado = "Entregado";
            }else if($request->estado == "container5"){
                $paquete->estado = "Fallida";
            }
        }

        $paquete->save();

        return response()->json($paquete);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paquete  $paquete
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paquete $paquete)
    {
        //
    }
}
