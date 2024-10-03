<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistorialRetornosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historial_retornos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('socio_id');
            $table->unsignedBigInteger('empresa_id');
            $table->date('fechaDesde');
            $table->date('fechaHasta');
            $table->decimal('retribucion', 8, 2);
            $table->decimal('retencion1', 8, 2)->nullable();
            $table->decimal('retencion2', 8, 2)->nullable();
            $table->decimal('retencion3', 8, 2)->nullable();
            $table->decimal('retencion4', 8, 2)->nullable();
            $table->decimal('neto_a_cobrar', 8, 2);
            $table->timestamps();
            
            $table->foreign('socio_id')->references('id')->on('socios')->onDelete('cascade');
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('historial_retornos');
    }
}
