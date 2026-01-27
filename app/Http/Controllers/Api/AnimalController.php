<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;

class AnimalController extends Controller
{
    public function index()
    {
        
        return response()->json(Animal::all(), 200);
    }
}
