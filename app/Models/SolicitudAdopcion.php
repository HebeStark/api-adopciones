<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolicitudAdopcion extends Model
{
    protected $table = 'solicitud_adopcion';
   protected $fillable = [
    'user_id',
    'animal_id',
    'fecha_solicitud',
    'estado',
   ];

    public function user()
    {
         return $this->belongsTo(User::class);
    }
    public function animal()
    {
         return $this->belongsTo(Animal::class);
    }
}
