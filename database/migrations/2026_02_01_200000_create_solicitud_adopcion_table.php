<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('solicitud_adopcion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
            ->constrained('users')->cascadeOnDelete();

            $table->foreignId('animal_id')
            ->constrained('animals')->cascadeOnDelete();
            $table->date('fecha_solicitud');
            $table->enum('estado', ['pendiente', 'aprobada', 'rechazada'])->default('pendiente');
            $table->timestamps();
            $table->unique(['user_id', 'animal_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('solicitud_adopcion');
    }
};
