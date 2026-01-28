<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Animal;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Animal>
 */
class AnimalFactory extends Factory
{
    protected $model = Animal::class;

    public function definition(): array
    {
        return [
            'nombre' => $this->faker->firstName(),
            'especie' => $this->faker->randomElement(['Perro', 'Gato', 'Pájaro', 'Pez']),
            'estado' => 'Disponible',
            'foto' => null,
            'descripcion' => $this->faker->sentence(),
        ];
    }
   
    
}
