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

    public function test_admin_can_create_animal_with_token()
    { 
        
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

         Passport::actingAs($admin, [], 'api');

        $response = $this->postJson('/api/animales', [
            'nombre' => 'Luna',
            'especie' => 'perro',
            'estado' => 'disponible',
        ]);

        $response->assertStatus(201);                

    }

    public function test_user_cannot_create_animal_event_with_token()
    {
        $user = User::create([
            'name' => 'Normal User',
            'email' => 'user@test.com',
            'password' => bcrypt('password'),
            'role' => 'user',
        ]);

        Passport::actingAs($user, [], 'api');
        $response = $this->postJson('/api/animales', [
            'nombre' => 'Luna',
            'especie' => 'perro',
            'estado' => 'disponible',
        ]);
        $response->assertStatus(403);
}
}