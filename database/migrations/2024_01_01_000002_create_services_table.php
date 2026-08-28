<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_category_id')->nullable()
                ->constrained('service_categories')->nullOnDelete();
            $table->string('name');
            $table->string('slug')->unique();
            // Frase corta: problema que resuelve el servicio (usada en tarjetas).
            $table->string('problem', 300)->nullable();
            $table->text('short_description');
            $table->longText('description');
            $table->text('benefits')->nullable();
            $table->string('icon', 100)->default('truck');
            $table->string('cover_image')->nullable();
            $table->unsignedInteger('order')->default(0);
            $table->boolean('is_featured_on_home')->default(false);
            $table->boolean('is_published')->default(true);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
