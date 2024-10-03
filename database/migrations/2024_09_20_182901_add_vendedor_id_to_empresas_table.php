<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendedorIdToEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->unsignedBigInteger('vendedor_id')->nullable(); // Permite que sea opcional
            $table->foreign('vendedor_id')->references('id')->on('vendedores')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('empresas', function (Blueprint $table) {
            $table->dropForeign(['vendedor_id']);
            $table->dropColumn('vendedor_id');
        });
    }
}
