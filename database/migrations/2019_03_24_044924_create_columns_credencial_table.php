<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateColumnsCredencialTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_credencial', function (Blueprint $table) {
            $table->integer('departamento_codigo')->nullable()->unsigned()->after('perfil_codigo');
            $table->foreign('departamento_codigo')->references('departamento_codigo')->on('pro_departamentos')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('columns_credencial');
    }
}
