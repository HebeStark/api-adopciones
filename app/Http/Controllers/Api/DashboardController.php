<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Animal;
use App\Models\SolicitudAdopcion;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'animales_disponibles' => Animal::where('estado', 'disponible')->count(),
            'animales_adoptados' => Animal::where('estado', 'adoptado')->count(),
            'solicitudes_pendientes' => SolicitudAdopcion::where('estado', 'pendiente')->count(),
        ]);
    }
}
