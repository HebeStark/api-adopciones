<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Passport\Passport;

class AnimalAuthTest extends TestCase
{
   use DatabaseMigrations;

    public function test_cannot_create_animal_without_token()
    {
        $response = $this->postJson('/api/animales', [
            'nombre' => 'Luna',
            'especie' => 'perro',
            'estado' => 'disponible',
        ]);

        $response->assertStatus(401);
    }

    public function test_can_create_animal_with_token()
    { 
        
        $user = User::create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => bcrypt('password'),
        ]);

         Passport::actingAs($user);

        $response = $this->postJson('/api/animales', [
            'nombre' => 'Luna',
            'especie' => 'perro',
            'estado' => 'disponible',
        ]);

        $response->assertStatus(201);                

    }
}
