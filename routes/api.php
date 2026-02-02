<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AnimalController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\SolicitudController;

Route::get('/test', function(){
    return response()->json(['ok' => 'true']);
});
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('role:user')->group(function () {    
    Route::post('/solicitudes', [SolicitudController::class, 'store']);
    Route::get('/mis-solicitudes', [SolicitudController::class, 'mySolicitudes']);
});    

Route::middleware('role:admin')->group(function () {  

    Route::get('/solicitudes', [SolicitudController::class, 'index']);
    Route::put('/solicitudes/{solicitud}', [SolicitudController::class, 'update']);
    
    Route::post('/animales', [AnimalController::class, 'store']);
    Route::put('/animales/{animal}', [AnimalController::class, 'update']);
    Route::delete('/animales/{animal}', [AnimalController::class, 'destroy']);

    });
});    
    
Route::get('/animales', [AnimalController::class, 'index']);
Route::get('/animales/{animal}', [AnimalController::class, 'show']);


?>