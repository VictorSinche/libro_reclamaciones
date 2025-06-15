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
        Schema::create('derivaciones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('libro_reclamacion_id')->constrained('libro_reclamaciones')->onDelete('cascade');
            $table->foreignId('area_id')->constrained('areas')->onDelete('cascade');
            $table->unsignedTinyInteger('estado')->default(0); // pendiente = 0, proceso = 1, atendido = 2
            $table->text('comentario')->nullable();
            $table->text('archivo')->nullable();
            $table->longText('informe')->nullable(); // 👈 Este es el nuevo campo para redactar con el editor tipo Word
            $table->timestamp('fecha_derivacion')->useCurrent();
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('derivaciones');
    }
};
