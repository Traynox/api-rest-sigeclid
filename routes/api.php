<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CitasController;
use App\Http\Controllers\EmpleadosController;
use App\Http\Controllers\ExpedientesController;
use App\Http\Controllers\PacientesController;
use App\Http\Controllers\TratamientosController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('citas',CitasController::class);
Route::get('citas/filter/paginate/{paginate}/{buscar?}',[CitasController::class,'indexFilter']);

Route::apiResource('empleados',EmpleadosController::class);
Route::get('empleados/filter/paginate/{paginate}/{buscar?}',[EmpleadosController::class,'indexFilter']);

Route::apiResource('expedientes',ExpedientesController::class);
Route::get('expedientes/filter/paginate/{paginate}/{buscar?}',[ExpedientesController::class,'indexFilter']);

Route::apiResource('pacientes',PacientesController::class);
Route::get('pacientes/filter/paginate/{paginate}/{buscar?}',[PacientesController::class,'indexFilter']);

Route::apiResource('tratamientos',TratamientosController::class);
Route::get('tratamientos/filter/paginate/{paginate}/{buscar?}',[TratamientosController::class,'indexFilter']);
