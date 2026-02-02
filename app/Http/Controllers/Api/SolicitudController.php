<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SolicitudAdopcion;
use Illuminate\Http\Request;

class SolicitudController extends Controller
{   
     public function index()
    {
        return response()->json
        (SolicitudAdopcion::with(['user', 'animal'])->get());
        
    }

    public function store(Request $request)
    {
       $request->validate([
        'animal_id' => 'required|exists:animals,id',
       ]);

        $solicitud = SolicitudAdopcion::create([
        'user_id' => auth('api')->id(),
        'animal_id' => $request->animal_id,
        'fecha_solicitud' => now()->toDateString(),
        'estado' => 'pendiente',
       ]);

         return response()->json([
            'message' => 'Solicitud creada correctamente',
             'solicitud' => $solicitud, 
             ],201);
    }  

    public function mySolicitudes()
    {

        return response()->json(
            SolicitudAdopcion::where('user_id', auth('api')->id())
            ->with('animal')
           ->get());
    }

    public function update(Request $request, SolicitudAdopcion $solicitud)
    {
        $request->validate([
        'estado' => 'required|in:pendiente,aprobada,rechazada',
       ]);

        $solicitud->update([
        'estado' => $request->estado,
       ]);

         return response()->json([
            'message' => 'Estado de la solicitud actualizado correctamente',
            'solicitud' => $solicitud,
                ]);
    }
}
