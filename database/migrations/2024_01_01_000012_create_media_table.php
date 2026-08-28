<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Biblioteca de medios reutilizable (fotografías reales de NYG: flota,
     * depósito, operaciones) para no duplicar subidas de archivos entre
     * secciones distintas del panel.
     */
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('disk', 30)->default('public');
            $table->string('path');
            $table->string('original_name');
            $table->string('alt_text', 255)->nullable();
            $table->string('collection', 60)->default('general'); // flota, deposito, operaciones, oficina
            $table->unsignedInteger('size_bytes')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
