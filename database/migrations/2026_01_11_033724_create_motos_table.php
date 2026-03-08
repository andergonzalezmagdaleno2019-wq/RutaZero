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
        Schema::create('motos', function (Blueprint $table) {
            $table->id();
            $table->string('marca');          // Honda, Kawasaki, Suzuki
            $table->string('modelo');         // Ejemplo: CBR 600
            $table->integer('cilindrada');    // Ejemplo: 600
            $table->decimal('precio', 10, 2); // Ejemplo: 12500.50
            $table->string('imagen');         // Aquí guardaremos la ruta/enlace de la foto
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('motos');
    }
};
