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
        Schema::create('reservas', function (Blueprint $table) {
            $table->id();
        
        $table->text('titulo');
        $table->date('fecha');
        $table->time('hora');
        $table->string('estado')->default('pendiente'); // pendiente, confirmada, cancelada
        $table->timestamps();

        // Relación con la tabla pacientes (identificacion)
        $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
        
        // Evita que se registre la misma fecha y hora dos veces a nivel de DB
        $table->unique(['fecha', 'hora']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservas');
    }
};
