<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class AnimalController extends Controller
{
    public function index(): JsonResponse
    {
        
        return response()->json(Animal::paginate(10), 200);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'especie' => 'required|string|max:255',
            'estado' => 'nullable|in:disponible,adoptado',
            'foto' => 'nullable|string',
            'descripcion' => 'nullable|string',
        ]);

        $animal = Animal::create($validated);

        return response()->json($animal, 201);
        
    }

    public function show(Animal $animal): JsonResponse
    {
        return response()->json($animal, 200);
    }
    
        
    
}
