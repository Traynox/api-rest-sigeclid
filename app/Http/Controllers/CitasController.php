<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Cita;
class CitasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $citas=Cita::all();

        return response()->json(['ok'=>true,
                                 'data'=>$citas,
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
        $cita=Cita::create($request->all());
        
        if($cita){
            return response()->json(['ok'=>true,
                                     'data'=>$cita,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear la cita'],404);
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
        
        $cita=Cita::find($id);
        
        if($cita){
            return response()->json(['ok'=>true,
                                     'data'=>$cita,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la cita'],404);
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
        $cita=Cita::find($id);

        if($cita){
            $cita->update($request->all());
            return response()->json(['ok'=>true,
                                     'data'=>$cita,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la cita'],404);
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
        $cita = Cita::find($id);

        if($cita){
            
            $cita->estado=0;
            $cita->save();
            return response()->json(['ok'=>true,
                                     'data'=>$cita,
                                     'msg'=>'cita eliminada'],200);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la cita'],404);
        }
    }

    // public function indexFilter($paginate,$tenant,$buscar='')
    // {

    //     $citas=Cita::with(['paciente','empleado','tratamientos'])->where('estado',1)->where('id_tenant',$tenant)->paginate($paginate);
    //         if($citas){
    //         return response()->json(['ok'=>true,
    //                                 'data'=>$citas,
    //                                 'msg'=>''],200);
    //         }else{
    //         return response()->json(['ok'=>false,
    //                                 'data'=>[],
    //                                 'msg'=>'No se encontraron citas'],404);
    //         }

    // }

    public function indexFilter($tenant)
    {

        $citas=Cita::with(['paciente','empleado','tratamiento'])->where('estado',1)->where('id_tenant',$tenant)->get();
            if($citas){
            return response()->json(['ok'=>true,
                                    'data'=>$citas,
                                    'msg'=>''],200);
            }else{
            return response()->json(['ok'=>false,
                                    'data'=>[],
                                    'msg'=>'No se encontraron citas'],404);
            }

    }

}
