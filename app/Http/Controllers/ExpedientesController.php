<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExpedientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

        $expediente=Expediente::create($request->all());
        $tratamientos=$request->tratamientos;
        $id_expediente=$request->id_expediente;
        $data=[];
        foreach ($tratamientos as $key => $tratamiento) {
                    
            $data[$key]=array('id_expediente'=>$id_expediente,'id_tratamiento'=>$tratamiento->id_tratamiento);
         }
        
        if($expediente){
            $expediente->tratamientos()->attach($data);
            // $expediente->fecha_creacion=date('Y-m-d');
      
            return response()->json(['ok'=>true,
                                     'data'=>$expediente,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear el paciente'],404);
        } 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $expediente=Expediente::find($id);
        
        if($expediente){

            // $expediente->fecha_creacion=date('Y-m-d');
      
            return response()->json(['ok'=>true,
                                     'data'=>$expediente,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear el paciente'],404);
        } 
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
        $expediente=Expediente::find($id);
        
        $tratamientos=$request->tratamientos;
        $id_expediente=$request->id_expediente;
        $data=[];
        foreach ($tratamientos as $key => $tratamiento) {
                    
            $data[$key]=array('id_expediente'=>$id_expediente,'id_tratamiento'=>$tratamiento->id_tratamiento);
         }
        
        if($expediente){
            $expediente->tratamientos()->attach($data);
            // $expediente->fecha_creacion=date('Y-m-d');
      
            return response()->json(['ok'=>true,
                                     'data'=>$expediente,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear el paciente'],404);
        } 
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
