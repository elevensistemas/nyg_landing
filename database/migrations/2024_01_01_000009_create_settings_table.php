<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Configuración editable desde el panel: contacto, redes, WhatsApp, textos
     * generales del sitio. Almacenada como pares clave/valor para no requerir
     * una migración nueva cada vez que se agrega un campo editable.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type', 30)->default('text'); // text, textarea, image, boolean, json
            $table->string('group', 60)->default('general');
            $table->string('label')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
