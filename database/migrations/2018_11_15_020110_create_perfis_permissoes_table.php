<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePerfisPermissoesTable extends Migration
{

    public function up()
    {
        Schema::create('sys_perfis_permissoes', function(Blueprint $table) {
            $table->increments('perfil_permissao_codigo');

            $table->integer('perfil_codigo')->unsigned();
            $table->foreign('perfil_codigo')->references('perfil_codigo')->on('sys_perfil_acesso')->onDelete('cascade');

            $table->integer('permissao_codigo')->unsigned();
            $table->foreign('permissao_codigo')->references('permissao_codigo')->on('sys_permissoes')->onDelete('cascade');

            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('sys_perfis_permissoes');
    }
}
