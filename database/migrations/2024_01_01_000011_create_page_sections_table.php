<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Bloques de contenido editable dentro de una página (título, texto, imagen).
     * Permite que NYG edite textos institucionales (Empresa, Tecnología, etc.)
     * sin tocar código ni vistas Blade.
     */
    public function up(): void
    {
        Schema::create('page_sections', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();
            $table->string('key', 100); // ej: hero, historia, mision, vision, valores
            $table->string('title')->nullable();
            $table->text('subtitle')->nullable();
            $table->longText('body')->nullable();
            $table->string('image_path')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_published')->default(true);
            $table->timestamps();

            $table->unique(['page_id', 'key']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_sections');
    }
};
