<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\LoginController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\UseradminController;
use App\Http\Controllers\API\CultivoController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


// Users Login
route::post('logins',[LoginController::class,'logins'])->name('logins');
Route::post('/Login', [LoginController::class, 'loginapi']);
Route::post('/Registrar', [LoginController::class, 'registroapi']);


Route::middleware(['auth:sanctum'])->group(function () { 
    Route::get('/Logout', [LoginController::class, 'logout']);

});

Route::middleware(['auth:sanctum', 'auth'])->group(function () {
    // Obtener todos los cultivos del usuario 
    Route::get('/cultivos', [CultivoController::class, 'index']);

    // Crear un nuevo cultivo para el usuario 
    Route::post('/cultivos', [CultivoController::class, 'store']);

    // Obtener un cultivo específico del usuario 
    Route::get('/cultivos/{cultivo}', [CultivoController::class, 'show']);

    // Actualizar un cultivo específico del usuario 
    Route::put('/cultivos/{id}', [CultivoController::class, 'update']);

    // Eliminar un cultivo específico del usuario
    Route::delete('/cultivos/{id}', [CultivoController::class, 'destroy']);
});

//Usuario
Route::delete('/myusersdelet', [UserController::class, 'eliminarCuentapropia']);

//Administrador
Route::get('/users', [UseradminController::class, 'Usuarios']);
Route::get('/users/{id}', [UseradminController::class, 'Usuarioid']); 
Route::get('/users', [UseradminController::class, 'Usuarios']);