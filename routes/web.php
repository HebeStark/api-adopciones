<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalController;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

/*Route::get('/animales', [AnimalController::class, 'index']);
Route::post('/animales', [AnimalController::class, 'store']);
*/


?>