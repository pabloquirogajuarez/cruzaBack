<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMontoSocioToSociosTable extends Migration
{
    public function up()
    {
        Schema::table('socios', function (Blueprint $table) {
            $table->decimal('montoSocio', 15, 2)->nullable()->after('observaciones');
        });
    }

    public function down()
    {
        Schema::table('socios', function (Blueprint $table) {
            $table->dropColumn('montoSocio');
        });
    }
}
