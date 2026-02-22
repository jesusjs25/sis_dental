<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    // database/migrations/xxxx_xx_xx_create_pagos_table.php
public function up()
{
    Schema::create('pagos', function (Blueprint $table) {
    $table->id();
    // Relación: Si borras al paciente, se puede configurar qué pasa con sus pagos
    $table->foreignId('paciente_id')->constrained('pacientes')->onDelete('cascade');
    
    $table->decimal('monto_usd', 10, 2);
    $table->decimal('tasa_dia', 10, 2);
    $table->decimal('monto_bs', 15, 2);
    $table->string('metodo_pago');
    $table->string('banco_destino')->nullable();
    $table->decimal('vuelto_usd', 10, 2)->default(0);
    $table->timestamps();
});
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pagos');
    }
};
