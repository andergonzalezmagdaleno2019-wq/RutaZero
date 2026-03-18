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
            Schema::create('especificaciones', function (Blueprint $table) {
                $table->id();
                // Relación con tu tabla 'motos' (Asegúrate de que el nombre sea exacto)
                $table->foreignId('moto_id')->unique()->constrained('motos')->onDelete('cascade');
                
                // Campos técnicos para la exhibición
                $table->string('motor');          // Ej: "Bicilíndrico en paralelo"
                $table->string('cilindrada');     // Ej: "649 cc"
                $table->string('transmision');    // Ej: "6 velocidades"
                $table->string('frenos');         // Ej: "Disco doble con ABS"
                $table->string('potencia');       // Ej: "67 HP @ 8,000 rpm"
                $table->text('descripcion');      // Una breve reseña del modelo
                
                $table->timestamps();
            });
        }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('especificaciones');
    }
};
