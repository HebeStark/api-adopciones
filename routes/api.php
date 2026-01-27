<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AnimalController;

Route::get('/animales', [AnimalController::class, 'index']);

?>