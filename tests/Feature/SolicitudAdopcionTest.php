<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\User;
use App\Models\Animal;
use App\Models\SolicitudAdopcion;
use Laravel\Passport\Passport;

class SolicitudAdopcionTest extends TestCase
{
    use RefreshDatabase;
    public function test_guest_cannot_create_solicitud()
    {
        $animal = Animal::factory()->create();

        $response = $this->postJson('/api/solicitudes', [
            'animal_id' => $animal->id,
        ]);

        $response->assertStatus(401);
    }

    public function test_user_can_create_solicitud()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['role' => 'user']);
        $animal = Animal::factory()->create();

        Passport::actingAs($user, [], 'api');

        $response = $this->postJson('/api/solicitudes', [
            'animal_id' => $animal->id,
        ]);

        $response->assertStatus(201)
                 ->assertJsonFragment([
                     'user_id' => $user->id,
                     'animal_id' => $animal->id,
                     'estado' => 'pendiente',
                 ]);
    }

    public function test_user_cannot_list_all_solicitudes()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['role' => 'user']);

        Passport::actingAs($user, [], 'api');

        $response = $this->getJson('/api/solicitudes');

        $response->assertStatus(403);
    }

    public function test_admin_can_list_all_solicitudes()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);

        Passport::actingAs($admin, [], 'api');

        $response = $this->getJson('/api/solicitudes');

        $response->assertStatus(200);
                
    }

    public function test_user_can_own_solicitudes()
    {
        /** @var \App\Models\User $user */
        $user = User::factory()->create(['role' => 'user']);
        $animal = Animal::factory()->create();

        SolicitudAdopcion::create([
            'user_id' => $user->id,
            'animal_id' => $animal->id,
            'fecha_solicitud' => now()->toDateString(),
            'estado' => 'pendiente',
        ]);

        Passport::actingAs($user, [], 'api');

        $response = $this->getJson('/api/mis-solicitudes');

        $response->assertStatus(200)
                 ->assertJsonCount(1);
    }

    public function test_admin_can_update_solicitud_status()
    {
        /** @var \App\Models\User $admin */
        $admin = User::factory()->create(['role' => 'admin']);
        $animal = Animal::factory()->create();
        $user = User::factory()->create(['role' => 'user']);
        

        $solicitud = SolicitudAdopcion::create([
            'user_id' => $user->id,
            'animal_id' => $animal->id,
            'fecha_solicitud' => now()->toDateString(),
            'estado' => 'pendiente',
        ]);

        Passport::actingAs($admin, [], 'api');

        $response = $this->putJson("/api/solicitudes/{$solicitud->id}", [
            'estado' => 'aprobada',
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment([
                     'estado' => 'aprobada',
                 ]);
    }

   
}
