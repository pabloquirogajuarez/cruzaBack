<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('nombreEmpresa');
            $table->string('apoderadoEmpresa');
            $table->string('cuitEmpresa');
            $table->string('rubroEmpresa');
            $table->string('direccionEmpresa');
            $table->string('provinciaEmpresa');
            $table->string('localidadEmpresa');
            $table->string('estadoEmpresa');
            $table->string('fechaAltaEmpresa');
            $table->string('vendedor_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('empresas');
    }
}
