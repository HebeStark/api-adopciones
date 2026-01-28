<?php

use Illuminate\Http\Request;
use App\Http\Controllers\Api\AnimalController;
use Illuminate\Support\Facades\Route;

Route::get('/test', function(){
    return response()->json(['ok' => 'true']);
});

Route::get('/animales', [AnimalController::class, 'index']);
Route::get('/animales/{animal}', [AnimalController::class, 'show']);
Route::post('/animales', [AnimalController::class, 'store']);
Route::put('/animales/{animal}', [AnimalController::class, 'update']);
Route::delete('/animales/{animal}', [AnimalController::class, 'destroy']);


?>