<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Log;

class UserController extends Controller
{
    public function authenticate(Request $request)
    {
      $credentials = $request->only('email', 'password');
      try {
          if (! $token = JWTAuth::attempt($credentials)) {
              return response()->json(['error' => 'invalid_credentials'], 400);
          }
      } catch (JWTException $e) {
          return response()->json(['error' => 'could_not_create_token'], 500);
      }
      return response()->json(compact('token'));
    }

    public function getAuthenticatedUser()
    {
        try {
          if (!$user = JWTAuth::parseToken()->authenticate()) {
                  return response()->json(['user_not_found'], 404);
          }
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
                return response()->json(['token_expired'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
                return response()->json(['token_invalid'], $e->getStatusCode());
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
                return response()->json(['token_absent'], $e->getStatusCode());
        }
        return response()->json(compact('user'));
    }


    public function register(Request $request){

        Log::info($request);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if($validator->fails()){
                return response()->json($validator->errors()->toJson(),400);
        }
        $url='imagenruta';
        if($request->hasFile('file')){
            $file=$request->file('file')->store('public/imagenes');
        
            $url=Storage::url($file);
        }
      
        $empresa=Empresa::create([
            'nombre' => $request->get('nombre'),
            'eslogan' => $request->get('eslogan'),
            'direccion' => $request->get('direccion'),
            'telefono' => $request->get('telefono'),
            'imagen' => $url,
        ]);
      
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'id_tenant' => $empresa->id_tenant,
            'id_rol' => $request->get('id_rol'),
            'id_plan' => $request->get('id_plan'),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user','token'),201);
    }

    public function update(Request $request, $id){
       
        $usuario=User::find($id);
        // Hash::check($request->password, $data->password)
        if($usuario){

            $usuario->name=$request->name;
            $usuario->password=Hash::make($request->password);
            $usuario->email=$request->email;
            $usuario->save();
            // $usuario->update($request->all());
            return response()->json(['ok'=>true,
                                     'data'=>$usuario,
                                     'msg'=>''],201);
        }else{
            return response()->json(['ok'=>false,
                                     'data'=>[],
                                     'msg'=>'No se encontró el usuario'],404);
        }
    }


    public function indexFilter($tenant,$paginate){

        $users=User::filter($buscar)->where('id_tenant',$tenant)->paginate($paginate);

        if($users){
        return response()->json(['ok'=>true,
                                'data'=>$users,
                                'msg'=>''],200);
        }else{
        return response()->json(['ok'=>false,
                                'data'=>[],
                                'msg'=>'No se encontraron users'],404);
        }

    }
}

