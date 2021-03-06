<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\TratamientosController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

/* USER ROUTES*/
Route::post('auth/register', [UserController::class,'register']);
Route::post('auth/login', [UserController::class,'authenticate']);
Route::put('auth/update/{id}',[UserController::class,'update']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::post('auth/user',[UserController::class,'getAuthenticatedUser']);
    Route::post('auth/logout',[UserController::class,'logout']);
});

/* USER ROUTES*/
Route::apiResource('citas',CitasController::class);
Route::get('citas/tenant/{tenant}',[CitasController::class,'indexFilter']);

Route::apiResource('empleados',EmpleadosController::class);
Route::get('empleados/filter/paginate/{paginate}/tenant/{tenant}/{buscar?}',[EmpleadosController::class,'indexFilter']);

Route::apiResource('expedientes',ExpedientesController::class);
Route::get('expedientes/filter/paginate/{paginate}/tenant/{tenant}/{buscar?}',[ExpedientesController::class,'indexFilter']);

Route::apiResource('pacientes',PacientesController::class);
Route::get('pacientes/filter/paginate/{paginate}/tenant/{tenant}/{buscar?}',[PacientesController::class,'indexFilter']);

Route::apiResource('tratamientos',TratamientosController::class);
Route::get('tratamientos/filter/paginate/{paginate}/tenant/{tenant}/{buscar?}',[TratamientosController::class,'indexFilter']);

Route::apiResource('empresas',EmpresaController::class);
Route::post('empresas/update/tenant/{tenant}',[EmpresaController::class,'updateFile']);