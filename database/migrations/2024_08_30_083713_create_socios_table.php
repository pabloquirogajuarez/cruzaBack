<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSociosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('socios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->string('nombre');
            $table->string('email')->unique();
            $table->string('dni');
            $table->string('domicilio');
            $table->string('provincia');
            $table->string('localidad');
            $table->date('fechanacimiento');
            $table->string('telefono1');
            $table->string('telefono2')->nullable();
            $table->string('funcion');
            $table->string('estado');
            $table->string('a_cargo_de')->nullable();
            $table->string('aportes')->nullable();
            $table->string('clave_fiscal')->nullable();
            $table->date('fecha_baja_afip')->nullable();
            $table->text('documentacion')->nullable();
            $table->date('fecha_alta');
            $table->date('fecha_baja')->nullable();
            $table->string('motivo')->nullable();
            $table->string('lugar_prestamos_servicio')->nullable();
            $table->text('observaciones')->nullable();
            $table->timestamps();
    
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
        Schema::dropIfExists('socios');
    }
}
