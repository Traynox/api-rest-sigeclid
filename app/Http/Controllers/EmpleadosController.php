<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Empleado;
class EmpleadosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $empleados=Empleado::all()->where('estado',1);

        return response()->json(['ok'=>true,
                                 'data'=>$empleados,
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
        $empleado=Empleado::create($request->all());
        
        if($empleado){
            return response()->json(['ok'=>true,
                                     'data'=>$empleado,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear el empleado'],404);
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
        $empleado=Empleado::find($id);
        
        if($empleado){
            return response()->json(['ok'=>true,
                                     'data'=>$empleado,
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
        $empleado=Empleado::find($id);

        if($empleado){
            $empleado->update($request->all());
            return response()->json(['ok'=>true,
                                     'data'=>$empleado,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el empleado'],404);
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
        $empleado=Empleado::find($id);

        if($empleado){
            
            $empleado->estado=0;
            $empleado->save();

            return response()->json(['ok'=>true,
                                     'data'=>$empleado,
                                     'msg'=>'empleado eliminado'],200);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el empleado'],404);
        }
    }

    public function indexFilter($paginate,$buscar)
    {

        $empleados=Empleados::filter($buscar)->where('estado',1)->paginate($paginate);
            if($empleados){
            return response()->json(['ok'=>true,
                                    'data'=>$empleados,
                                    'msg'=>''],200);
            }else{
            return response()->json(['ok'=>false,
                                    'data'=>[],
                                    'msg'=>'No se encontraron empleados'],404);
            }
    }

}
