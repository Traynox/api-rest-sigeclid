<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Tratamiento;
class TratamientosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tratamientos=Tratamiento::all()->where('estado',1);

        return response()->json(['ok'=>true,
                                 'data'=>$tratamientos,
                                 'msg'=>''],201);
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
        // $expediente=Expediente::create($request->all());
        
        // if($expediente){

        //     // $expediente->fecha_creacion=date('Y-m-d');
        //     $request->codigo+=$paciente->id_paciente;
        //     $expediente=Expediente::create($request->all());
            
        //     return response()->json(['ok'=>true,
        //                              'data'=>$paciente,
        //                              'msg'=>''],201);
        // }else{
        //     return response()->json(['ok'=>false,
        //                              'data'=>[],
        //                              'msg'=>'No se pudo crear el paciente'],404);
        // } 
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
}
