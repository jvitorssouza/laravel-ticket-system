<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSysCredencialPerfilColumn extends Migration
{

    public function up()
    {
        Schema::table('sys_credencial', function (Blueprint $table) {
            $table->integer('perfil_codigo')->unsigned()->after('credencial_ult_acesso');
            $table->foreign('perfil_codigo')->references('perfil_codigo')->on('sys_perfil_acesso')->onDelete('cascade');
        });
    }


    public function down()
    {
        Schema::table('sys_credencial', function (Blueprint $table) {
            $table->dropColumn('perfil_codigo');
        });
    }
}
