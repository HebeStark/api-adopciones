<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use function GuzzleHttp\describe_type;

class Animal extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre ',
        'especie',
        'estado',
        'foto',
        'descripcion',
    ];

   
}
