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
        $tratamientos=Tratamiento::where('estado',1)->get();

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
        $tratamiento=Tratamiento::create($request->all());
        
        if($tratamiento){
        
            return response()->json(['ok'=>true,
                                     'data'=>$tratamiento,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se pudo crear el tratamiento'],404);
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
        $tratamiento=Tratamiento::find($id);

        if($tratamiento){
            $tratamiento->update($request->all());

            return response()->json(['ok'=>true,
                                     'data'=>$tratamiento,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el tratamiento'],404);
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
         $tratamiento=Tratamiento::findOrfail($id);
        //  $tratamiento=Tratamiento::destroy($id);
        if($tratamiento){
            
            $tratamiento->estado=0;
            $tratamiento->save();

            return response()->json(['ok'=>true,
                                     'data'=>$tratamiento,
                                     'msg'=>'tratamiento eliminado'],200);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el tratamiento'],404);
        }
    }

    public function indexFilter($paginate,$tenant,$buscar='')
    {

        $tratamientos=Tratamiento::filter($buscar)->where('estado',1)->where('id_tenant',$tenant)->paginate($paginate);
            if($tratamientos){
            return response()->json(['ok'=>true,
                                    'data'=>$tratamientos,
                                    'msg'=>''],200);
            }else{
            return response()->json(['ok'=>false,
                                    'data'=>[],
                                    'msg'=>'No se encontraron tratamientos'],404);
            }
    }
}
