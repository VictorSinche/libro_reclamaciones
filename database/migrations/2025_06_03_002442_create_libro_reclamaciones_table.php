<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLibroReclamacionesTable extends Migration
{
    public function up()
    {
        Schema::create('libro_reclamaciones', function (Blueprint $table) {
            $table->id();
            $table->enum('tipo_reclamo_queja', ['reclamo', 'queja']);
            $table->enum('tipo_bien', ['producto', 'servicio']);
            $table->string('tipo_reclamante');
            $table->string('nombre_apellido');
            $table->string('tipo_documento');
            $table->string('nro_doc', 20);
            $table->string('nro_cel', 20);
            $table->string('telefono', 20)->nullable();
            $table->string('correo');
            $table->string('direccion');
            $table->string('ubicacion'); // departamento, provincia, distrito
            $table->string('apoderado')->nullable();
            $table->string('programa');
            $table->date('fecha_evento');
            $table->decimal('monto_reclamado', 10, 2)->nullable();
            $table->string('nom_curso');
            $table->string('oficina_involucrado');
            $table->string('motivo_reclamo');
            $table->text('descripcion_reclamo');
            $table->text('pedido');
            $table->unsignedTinyInteger('estado')->default(0); // Opcional: estado global del documento
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('libro_reclamaciones');
    }
}
