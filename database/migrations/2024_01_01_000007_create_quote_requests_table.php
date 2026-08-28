<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quote_requests', function (Blueprint $table) {
            $table->id();

            // Datos de contacto
            $table->string('full_name');
            $table->string('company')->nullable();
            $table->string('email');
            $table->string('phone', 60);

            // Datos operativos (ninguno obligatorio salvo lo mínimo indispensable)
            $table->foreignId('service_id')->nullable()->constrained('services')->nullOnDelete();
            $table->string('service_type_other', 150)->nullable();
            $table->string('origin', 150)->nullable();
            $table->string('destination', 150)->nullable();
            $table->string('cargo_type', 150)->nullable();
            $table->boolean('requires_temperature_control')->default(false);
            $table->string('temperature_requirement', 100)->nullable();
            $table->decimal('approx_weight_kg', 10, 2)->nullable();
            $table->decimal('approx_volume_m3', 10, 2)->nullable();
            $table->unsignedInteger('pallets_or_packages')->nullable();
            $table->string('frequency', 100)->nullable(); // única vez, semanal, mensual, etc.
            $table->date('estimated_date')->nullable();
            $table->text('comments')->nullable();

            // Gestión comercial de la oportunidad
            $table->string('status', 30)->default('nueva'); // nueva, en_analisis, cotizada, ganada, perdida
            $table->text('internal_notes')->nullable();

            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent', 255)->nullable();
            $table->timestamp('read_at')->nullable();
            $table->timestamps();

            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quote_requests');
    }
};
