<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Paciente;
use App\models\Expediente;
// use Carbon\Carbon;
class PacientesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $pacientes=Paciente::all()->where('estado',1);

        return response()->json(['ok'=>true,
                                 'data'=>$pacientes,
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
 
        $paciente=Paciente::create($request->all());
        
        if($paciente){

            // $expediente->fecha_creacion=date('Y-m-d');
            $request->codigo.=$request->id_tenant;
            $request->codigo.=$paciente->id_paciente;
           
            $expediente=Expediente::create([
                'codigo' => $request->codigo,
                'fecha_creacion' => date('Y-m-d'),
                'id_paciente' => $paciente->id_paciente,
                'id_tenant' => $request->id_tenant,
                ]);
            
            return response()->json(['ok'=>true,
                                     'data'=>$paciente,
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
        $paciente=Paciente::find($id);
        
        if($paciente){
            return response()->json(['ok'=>true,
                                     'data'=>$paciente,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el empleado'],404);
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
        $paciente=Paciente::find($id);

        if($paciente){
            $paciente->update($request->all());
            return response()->json(['ok'=>true,
                                     'data'=>$paciente,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el paciente'],404);
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
        $paciente=Paciente::find($id);
        $expediente=Expediente::where('id_paciente',$id)->limit(1)->get();
       
        if($paciente){
            
            $paciente->estado=0;
            $paciente->save();
            $expediente->estado=0;
            $expediente->save();

            return response()->json(['ok'=>true,
                                     'data'=>$paciente,
                                     'msg'=>'paciente eliminado'],200);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el paciente'],404);
        }
    }

    public function indexFilter($paginate,$tenant,$buscar='')
    {

        $pacientes=Paciente::with('expediente')->filter($buscar)->where('estado',1)->where('id_tenant',$tenant)->paginate($paginate);
            if($pacientes){
            return response()->json(['ok'=>true,
                                    'data'=>$pacientes,
                                    'msg'=>''],200);
            }else{
            return response()->json(['ok'=>false,
                                    'data'=>[],
                                    'msg'=>'No se encontraron pacientes'],404);
            }
    }


}
