<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Animal;

class AnimalApiTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_list_animales()
    {
       Animal::factory()->count(3)->create();
         $response = $this->getJson('/api/animales');
         $response->assertStatus(200)
        ->assertJsonCount(3, 'data');
       
    }
      
    /** @test */    
    public function it_can_create_an_animal()
    {
      $data = [
          'nombre' => 'Max',
          'especie' => 'Perro',
          'estado' => 'disponible',          
      ];
        $response = $this->postJson('/api/animales', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment([
                    'nombre' => 'Max',
                    'especie' => 'Perro',
                    'estado' => 'disponible', ]);

        $this->assertDatabaseHas('animals', [
            'nombre' => 'Max',
            'especie' => 'Perro',
            'estado' => 'disponible',
        ]);

    }
}
