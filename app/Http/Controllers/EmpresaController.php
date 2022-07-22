<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\models\Empresa;
use Illuminate\Support\Facades\Validator;
class EmpresaController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $empresa=Empresa::find($id);
        
        if($empresa){
            return response()->json(['ok'=>true,
                                     'data'=>$empresa,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la empresa'],404);
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
        $empresa=Empresa::find($id);

        if($empresa){
            $empresa->update($request->all());
            return response()->json(['ok'=>true,
                                     'data'=>$empresa,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la empresa'],404);
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
        $empresa=Empresa::find($id);
       
        if($empresa){
            
            $empresa->estado=0;
            $empresa->save();
        
            return response()->json(['ok'=>true,
                                     'data'=>$empresa,
                                     'msg'=>'empresa eliminada'],200);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró la empresa'],404);
        }
    }


    public function updateFile(Request $request,$tenant){

        
        // $validator = Validator::make($request->all(), [
        //     'file' => 'required|image|max:800',
          
        // ]);

    //     if($validator->fails()){
    //         return response()->json($validator->errors()->toJson(),400);
    // }
 
          $empresa=Empresa::find($tenant);
        //   !$validator->fails() &&
        if($request->hasFile('file') && $empresa){
            
            $file=$request->file('file')->store('public/imagenes');
        
            $url=Storage::url($file);
         
            $empresa->imagen=$url;
            $empresa->save();

            // $fileName=$file->getClientOriginalName();
            // $fileName=pathinfo($fileName,PATHINFO_FILENAME);
            // $name_file=str_replace(" ","_",$fileName);
            
            // $extension=$file->getClientOriginalExtension();

            // $picture=date('His').'-'.$name_file.'-'.$extension;
            // $file->move(public_puth('files/'),$picture);

            return response()->json(['ok'=>true,
                                     'data'=>$empresa,
                                     'msg'=>'Foto actualizada'],404);

        }else{
          return response()->json([
            'data'=>'seleccione archivo'
          ], 200);
            // return response()->json($validator->errors()->toJson(),400);
        }

    }

}
